@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Our menus</h1>
                    {{-- <div>
                        <a href="{{route('menus-index', ['sort'=>'asc'])}}">A-Z</a>
                    <a href="{{route('menus-index', ['sort'=>'desc'])}}">Z-A</a>
                    <a href="{{route('menus-index')}}">Reset</a>
                </div> --}}
            </div>

            <div class="card-body">
                <ul class="list-group">
                    @forelse($menus as $menu)

                    <li class="list-group-item">
                        <div class="service-bin">
                            <div class="service-box">
                                {{-- <input readonly value="{{$menu->menuFmrestaurant->restaurant}} - {{$menu->menuFmrestaurant->city}}"> --}}


                                <h1>{{$menu->menu}}
                                </h1>
                                <div class="image-box">
                                    <input class="form-control" type="text" name="price" value="{{$menu->price}}" />
                                </div>


                            </div>

                            <div class="controls">
                                <a class="btn btn-outline-secondary m-2" href="{{route('menus-show', $menu->id)}}">Show</a>

                                {{-- @if(Auth::user()->role > 9) --}}
                                <a class="btn btn-outline-primary m-2" href="{{route('menus-edit', $menu)}}">Edit</a>
                                <form class="delete" action="{{route('menus-delete', $menu)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-outline-danger m-2" type="submit">Delete</button>
                                </form>
                                {{-- @endif --}}

                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item">No menus available at the moment</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
