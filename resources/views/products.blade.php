@extends('layouts.app')

@section('content')
    <section class="saction4">
        <div class="container" id="offer">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="dotted3 os-animation" data-os-animation="bounceInLeft" data-os-animation-delay="1s"></div>
                    <div class="special">
                        <h2 class="os-animation" data-os-animation="bounceInDown" data-os-animation-delay="0.50s">Products</h2>
                        <div class="dotted4 os-animation" data-os-animation="bounceInRight" data-os-animation-delay="1s"></div>
                    </div>
                </div>
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="slider clearfix os-animation" data-os-animation="fadeInDown
" data-os-animation-delay="0.20s">
                            <div class="img clearfix"> <img src="/images/{{ $product->image_name }}" alt="" style="width: 100%"/> </div>
                            <div class="title">
                                <h3>{{ $product->name }}<br/></h3>
                                <p>{{ $restaurant->description }}</p>
                                <add-to-cart-button :product="{{ $product }}"/>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
