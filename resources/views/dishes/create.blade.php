@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>dish Create</h1>
                </div>
                <div class="card-body">
                    <form action="{{route('dishes-store')}}" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Dish</label>
                            <input class="form-control" type="text" name="dish_name" />
                            Description<input class="form-control" type="text" name="description" />

                        </div>
                        <div class="form-group">
                            <label>Which menu?</label>
                            {{-- <select class="form-control" name="menu_id">
                                @foreach($menus as $menu)
                                <option value="{{$menu->id}}">{{$menu->menu}}</option>
                            @endforeach
                            </select> --}}

                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="dish_photo" />
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
