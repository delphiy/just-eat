@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-3">
                @include('partials.my-account-sidebar')
            </div>

            <div class="col-md-9">
                Here is content
            </div>
        </div>
    </div>
@endsection
