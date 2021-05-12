<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getSetupIntent()
    {
        return auth()->user()->createSetupIntent();
    }

    public function getPaymentMethods()
    {
        $user = auth()->user();
        $paymentMethods = [];

        if ($user->hasPaymentMethod()) {
            foreach ($user->paymentMethods() as $method) {
                array_push($paymentMethods, [
                    'id' => $method->id,
                    'brand' => $method->card->brand,
                    'last_four' => $method->card->last4,
                    'exp_month' => $method->card->exp_month,
                    'exp_year' => $method->card->exp_year,
                ]);
            }
        }

        return response()->json([
            "methods" => $paymentMethods,
            "default_payment_method" => $user->defaultPaymentMethod()->id
        ]);
    }

    public function postPaymentMethod(Request $request) {
        $user = auth()->user();
        $paymentMethodID = $request->get("payment_method_id");

        if($user->stripe_id == null) {
            $user->createAsStripeCustomer();
        }

        $user->addPaymentMethod($paymentMethodID);
        $user->updateDefaultPaymentMethod($paymentMethodID);

        return response()->json('', 200);
    }

    public function store(Request $request) {
        //I might change this but the idea will be the same, in real application I might use db transaction
        $questions = $request->input('form_response')->definition->fields;
        $answers = $request->input('form_response')->answers;

        foreach($questions as $jsonQuestion) {
            $question = Question::create([
                "title" => $jsonQuestion->title,
                //we can save more in here
            ]);

            foreach($answers as $answer) {
                if($answer->field->id == $jsonQuestion->id) {
                    Answer::create([
                        "question_id" => $question->id,
                        "type" => $answer->field->type,
                        //we can save more in here
                    ]);
                }
            }
        }
    }

    public function myAccount() {
        return view('account.my-account');
    }

    public function trackOrder() {
        return view('account.track-order');
    }
}
