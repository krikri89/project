@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('front.box')
            <div class="card">
                <div class="card-header">Choose your travel</div>
                <div class="card-body">
                    @include('front.pager')
                    <ul class="list-group">
                        @forelse($menus as $menu)
                        <li class="list-group-item">
                            <div class="item-box2">
                        <li class="list-group-item">
                            <h4>{{$menu->menu}} menu</h4>
                            <h5>{{$menu->restaurant}}</h5>
                            {{-- <a href="https://www.google.com/search?q={{$menu->restaurant}}" target="_blank">More about the destination</a> --}}



                            <div class="item-bin">
                                <div class="item-box">
                                    <div class="item-box">
                                        <div>{{$menu->price}} EUR</div>
                                    </div>

                                </div>
                                @if($menu->photo)
                                <div class="image-box">
                                    <img src="{{$menu->photo}}">
                                </div>
                                @endif




                            </div>
                            {{-- @if(Auth::user()?->role > 0) --}}
                            <div class="controls">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-outline-warning m-2 add--cart">Book it!</button>

                                        </div>
                                        <div class="col-2">
                                            <input class="form-control m-2" type="number" style="width:50px;" name="menus_count" />
                                        </div>
                                        <input type="hidden" value="{{$menu->aid}}" name="menu_id">
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                        </li>
                        @empty
                        <li class="list-group-item">Nothing to choose</li>
                        @endforelse
                    </ul>
                </div>
                @include('front.pager')
            </div>
        </div>
    </div>
</div>
@endsection
