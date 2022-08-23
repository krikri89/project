@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>menu Create</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('menus-store')}}" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>menu</label>
                            <input class="form-control" type="text" name="menu" />
                            Price<input class="form-control" type="text" name="price" /> eur

                        </div>
                        {{-- <div class="form-group">
                            <label>Which restaurant?</label>
                            <select class="form-control" name="restaurant_id">
                                @foreach($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}">{{$restaurant->restaurant}}</option>
                        @endforeach
                        </select> --}}

                </div>


                @csrf
                @method('post')
                <button class="btn btn-outline-success mt-4" type="submit">add new</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
