@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Our dishes</h1>
                    <div>
                        <a href="{{route('dishes-index', ['sort'=>'asc'])}}">A-Z</a>
                        <a href="{{route('dishes-index', ['sort'=>'desc'])}}">Z-A</a>
                        <a href="{{route('dishes-index')}}">Reset</a>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-group">
                        @forelse($dishes as $dish)

                        <li class="list-group-item">
                            <div class="service-bin">
                                <div class="service-box">
                                    {{-- <input readonly value="{{$dish->dishFmResto->resto}} - {{$dish->dishFmResto->city}}"> --}}


                                    <h1>{{$dish->dish}}
                                    </h1>
                                    <div class="image-box">
                                        <img src="{{$dish->photo}}">
                                        <input class="form-control" type="text" name="description" value="{{$dish->description}}" />




                                    </div>


                                </div>

                                <div class="controls">
                                    <a class="btn btn-outline-secondary m-2" href="{{route('dishes-show', $dish->id)}}">Show</a>

                                    {{-- @if(Auth::user()->role > 9) --}}
                                    <a class="btn btn-outline-primary m-2" href="{{route('dishes-edit', $dish)}}">Edit</a>
                                    <form class="delete" action="{{route('dishes-delete', $dish)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger m-2" type="submit">Delete</button>
                                    </form>
                                    {{-- @endif --}}

                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No dishes available at the moment</li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
