@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Our restaurants</h3>
                    {{-- <div>
                        <a href="{{route('restaurants-index', ['sort'=>'asc'])}}">A-Z</a>
                    <a href="{{route('restaurants-index', ['sort'=>'desc'])}}">Z-A</a>
                    <a href="{{route('restaurants-index')}}">Reset</a>
                </div> --}}
            </div>

            <div class="card-body">
                <ul class="list-group">
                    @forelse($restaurants as $restaurant)

                    <li class="list-group-item">
                        <div class="item-bin">
                            <div class="item-box">
                                <h5>{{$restaurant->restaurant}} </h5>
                            </div>
                            <div class="item-bin">

                                <div>No.{{$restaurant->code}} </div>
                            </div>
                            <div class="item-bin">
                                <div>{{$restaurant->streetAddress}} </div>
                            </div>
                            <div class="item-bin">

                                <div>{{$restaurant->city}} </div>
                            </div>


                            <div></div>

                            <div class="controls">
                                <a class="btn btn-outline-secondary m-2" href="{{route('restaurants-show', $restaurant->id)}}">Show</a>

                                {{-- @if(Auth::user()->role > 9) --}}
                                <a class="btn btn-outline-primary m-2" href="{{route('restaurants-edit', $restaurant)}}">Edit</a>
                                <form class="delete" action="{{route('restaurants-delete', $restaurant)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger m-2" type="submit">Delete</button>
                                </form>
                                {{-- @endif --}}

                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item">Sorry, we are out of service at the moment</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
