@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" >

                    <h1 class="nice">{{$menu->menu}}</h1>
                    Price <input class="form-control" type="text" name="price" value="{{$menu->price}}" />


                </div>
                <div class="card-body">
                    <div class="color-bin">
                        <div class="controls">
                            <a class="btn btn-outline-success m-2" href="{{route('menus-edit', $menu)}}">Edit</a>
                            <form class="delete" action="{{route('menus-delete', $menu)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger m-2">Destroy</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
