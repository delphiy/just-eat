@extends('layouts.app')

@section('content')
    <section class="saction4">
        <div class="container bg-white p-5 card">
            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{ Auth::user()->basket->count('qty') }}</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach($basket as $item)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-muted">{{ $item->product->name }}</small>
                            </div>
                            <span class="text-muted">£{{ number_format($item->qty * $item->price, 2) }}</span>
                        </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>£{{ Auth::user()->getBasketTotal() }}</strong>
                        </li>
                    </ul>

{{--                    <form class="card p-2">--}}
{{--                        <div class="input-group">--}}
{{--                            <input type="text" class="form-control" placeholder="Promo code">--}}
{{--                            <div class="input-group-append">--}}
{{--                                <button type="submit" class="btn btn-secondary">Redeem</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation" novalidate action="{{ route('checkout.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <hr class="mb-4">

                        <h4 class="mb-3">Payment</h4>

                        <stripe-payment-form></stripe-payment-form>

                        <button class="btn btn-primary btn-lg btn-block mt-5" type="submit">Place order</button>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
