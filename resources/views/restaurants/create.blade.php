@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Add new restaurant</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('restaurants-store')}}" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="restaurant" value="" />

                        </div>
                        <div class="form-group">
                            <label>Steet</label>
                            <input class="form-control" type="text" name="streetAddress" value="" />

                            Code <input class="form-control" type="text" name="code" value="" />

                        </div>
                        <div class="form-group">
                            <label class="mt-2">City</label>
                            <input class="form-control" type="text" name="city" value="" />
                        </div>


                        @csrf
                        @method('post')
                        <button class="btn btn-outline-success mt-4" type="submit">Add new</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
