@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>menu Edit</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('menus-update', $menu)}}" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>menu name</label>
                        </div>
                        <input class="form-control" type="text" name="menu" value="{{$menu->menu}}" />
                        <input class="form-control" type="text" name="price" value="{{$menu->price}}" />
                </div>
                {{-- <div class="form-group">
                    <label>Which restaurant?</label>
                    <select class="form-control" name="restaurant_id">
                        @foreach($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}" @if($restaurant->id == $menu->restaurant_id)selected @endif>{{$restaurant->restaurant}}</option>
                @endforeach
                </select>
            </div> --}}


            @csrf
            @method('put')
            <button class="btn btn-outline-success mt-4" type="submit">Ja, update</button>
            </form>


        </div>
    </div>
</div>
</div>
</div>
@endsection
