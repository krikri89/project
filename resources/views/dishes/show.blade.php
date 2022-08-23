@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background:{{$dish->dishFmResto->resto}};">

                    <h1 class="nice">{{$dish->dish}}</h1>
                    Price <input class="form-control" type="text" name="description" value="{{$dish->description}}" />




                </div>
                <div class="card-body">
                    <div class="color-bin">
                        <div class="controls">
                            <a class="btn btn-outline-success m-2" href="{{route('dishes-edit', $dish)}}">Edit</a>
                            <form class="delete" action="{{route('dishes-delete', $dish)}}" method="post">
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
