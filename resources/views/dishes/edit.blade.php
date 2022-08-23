@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>dish Edit</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('dishes-update', $dish)}}" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>dish name</label>
                        </div>
                        <input class="form-control" type="text" name="dish_name" value="{{$dish->dish}}" />
                        <input class="form-control" type="text" name="description" value="{{$dish->description}}" />


                </div>
                <div class="form-group">
                    <label>Which resto?</label>
                    {{-- <select class="form-control" name="resto_id">
                        @foreach($restos as $resto)
                        <option value="{{$resto->id}}" @if($resto->id == $dish->resto_id)selected @endif>{{$resto->title}}</option>
                    @endforeach
                    </select> --}}
                </div>

                @if($dish->photo)
                <div class="image-box">
                    <img src="{{$dish->photo}}">
                </div>
                @endif

                <div class="form-group">
                    <label>New image</label>
                    <input class="form-control" type="file" name="dish_photo" />
                </div>

                @csrf
                @method('put')
                <button class="btn btn-outline-success mt-4" type="submit">Ja, update</button>
                </form>
                @if($dish->photo)
                <form action="{{route('dishes-delete-pic', $dish)}}" method="post">
                    @csrf
                    @method('put')
                    <button class="btn btn-outline-danger mt-4" type="submit">Delete pic</button>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
</div>
@endsection
