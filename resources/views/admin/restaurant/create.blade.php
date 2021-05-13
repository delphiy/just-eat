@extends('layouts.admin')
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <!-- OVERVIEW -->
                <div class="panel panel-headline">
                    <div class="panel-heading">
                        <h3 class="panel-title">Create Restaurant</h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                @if(!isset($restaurant->id))
                                    <form action="{{ route('restaurant.store') }}" method="post"
                                          enctype="multipart/form-data">
                                        @else
                                            <form action="{{ route('restaurant.update', [$restaurant]) }}" method="post"
                                                  enctype="multipart/form-data">
                                                @method('PATCH')
                                                @endif

                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                           placeholder="Enter name"
                                                           value="{{ old('name', $restaurant->name) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="slug">slug</label>
                                                    <input type="text" class="form-control" name="slug"
                                                           placeholder="Enter slug"
                                                           value="{{ old('slug', $restaurant->slug) }}">
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label for="latitude">Latitude</label>
                                                        <input type="text" class="form-control" name="latitude"
                                                               placeholder="Enter Latitude"
                                                               value="{{ old('latitude', $restaurant->lat) }}">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="Longitude">Longitude</label>
                                                        <input type="text" class="form-control" name="longitude"
                                                               placeholder="Enter Longitude"
                                                               value="{{ old('longitude', $restaurant->lng) }}">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="postcode">Postcode</label>
                                                    <input type="text" class="form-control" name="postcode"
                                                           placeholder="Enter postcode"
                                                           value="{{ old('postcode', $restaurant->postcode) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="address">address</label>
                                                    <input type="text" class="form-control" name="address"
                                                           placeholder="Enter address"
                                                           value="{{ old('address', $restaurant->address) }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="restaurant_image">Restaurant Image</label>
                                                    @if($restaurant->image_name)
                                                        <img
                                                            src="/images/{{ old('image_name', $restaurant->image_name) }}"
                                                            alt="" width="100%">
                                                    @endif
                                                    <input id="restaurant_image" type="file" class="form-control"
                                                           name="restaurant_image">
                                                </div>
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif

                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
