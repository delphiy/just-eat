@extends('layouts.app')

@section('content')
    <section class="saction4">
        <div class="container" id="offer">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="dotted3 os-animation" data-os-animation="bounceInLeft" data-os-animation-delay="1s"></div>
                    <div class="special">
                        <h2 class="os-animation" data-os-animation="bounceInDown" data-os-animation-delay="0.50s">Restaurants</h2>
                        <div class="dotted4 os-animation" data-os-animation="bounceInRight" data-os-animation-delay="1s"></div>
                    </div>
                </div>
                @foreach($restaurants as $restaurant)
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="slider clearfix os-animation" data-os-animation="fadeInDown
" data-os-animation-delay="0.20s">
                            <div class="img clearfix"> <img src="images/002.png" alt=""/> </div>
                            <div class="title clearfix">
                                <h3>{{ $restaurant->name }}<br/></h3>
                                <p>{{ $restaurant->address }}</p>
                                <a href="{{ route('restaurant.products', ['slug' => $restaurant->slug ]) }}">GRAB IT &#10152;</a> </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
