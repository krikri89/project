@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1>Change restaurant</h1>
                </div>


                <div class="card-body">
                    <ul>
                        <form action="{{route('restaurants-update', $restaurant)}}" method="post">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="restaurant" value="" />

                            </div>
                            <div class="form-group">
                                <label>Steet</label>
                                <input class="form-control" type="text" name="streetAddress" value="" />

                                Code <input class="form-control" type="text" name="code" value="" />

                            </div>
                            <div class="form-group">
                                <label class="mt-2">City</label>
                                <input class="form-control" type="text" name="city" value="" />
                            </div>



                            @csrf
                            @method('put')
                            <button class="btn btn-outline-success m-2" type="submit">Update it</button>


                        </form>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
