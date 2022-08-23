<div class="card mb-4">
    <div class="card-header">
        <h1>Sort Filter Search</h1>
    </div>
    <div class="card-body">
        <form class="delete" action="{{route('front-index')}}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>What sort?</label>
                            <select class="form-control" name="sort">
                                <option value="dafault" @if($sort=='default' )selected @endif>Default sort</option>
                                {{-- <option value="restaurant-asc" @if($sort=='restaurant-asc' )selected @endif>restaurant A-Z</option>
                                <option value="restaurant-desc" @if($sort=='restaurant-desc' )selected @endif>restaurant Z-A</option> --}}
                                <option value="menu-asc" @if($sort=='menu-asc' )selected @endif>price fm lowest</option>
                                <option value="menu-desc" @if($sort=='menu-desc' )selected @endif>price fm highest</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>What restaurant?</label>
                            <select class="form-control" name="restaurant_id">
                                <option value="0" @if($filter==0) selected @endif>No filter</option>
                                @foreach($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}" @if($filter==$restaurant->id) selected @endif>{{$restaurant->restaurant}}</option>

                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="col-6">
                        <button class="btn btn-outline-warning m-2 mt-4" type="submit">Sort</button>
                        <a class="btn btn-outline-primary m-2 mt-4" href="{{route('front-index')}}">Clear</a>
                    </div>
                </div>
            </div>
        </form>
        <form class="delete" action="{{route('front-index')}}" method="get">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mt-4">
                            <label>Search</label>
                            <input class="form-control" type="text" name="s" value="{{$s}}" />
                        </div>
                        <button class="btn btn-outline-success mt-2" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
