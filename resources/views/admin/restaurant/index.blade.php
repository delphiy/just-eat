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
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="alert alert-success">
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <a href="{{ route('restaurant.create') }}" class="btn btn-primary" style="margin-bottom: 10px">Add new</a>

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Postcode</th>
                                                <th>Location</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($restaurants as $restaurant)
                                                <tr>
                                                    <td> {{ $restaurant->name }}</td>
                                                    <td> {{ $restaurant->address }} </td>
                                                    <td> {{ $restaurant->postcode }} </td>
                                                    <td> {{ $restaurant->lat }} , {{ $restaurant->lng }}</td>
                                                    <td>
                                                        <form action="" method="POST">
                                                            <a href="" class="btn btn-primary">Edit</a>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
