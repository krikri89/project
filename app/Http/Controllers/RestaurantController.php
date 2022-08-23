<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', ['restaurants' => $restaurants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = new Restaurant;

        $restaurant->restaurant = $request->restaurant;
        $restaurant->code = $request->code;
        $restaurant->streetAddress = $request->streetAddress;
        $restaurant->city = $request->city;

        $restaurant->save();
        return redirect()->route('restaurants-index')->with('success', 'New restaurant succesfully added to the list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(int $restaurantId)
    {
        $restaurant = Restaurant::where('id', $restaurantId)->first();
        return view('restaurants.show', ['restaurant' => $restaurant]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', ['restaurant' => $restaurant]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $restaurant->restaurant = $request->restaurant;
        $restaurant->code = $request->code;
        $restaurant->streetAddress = $request->streetAddress;
        $restaurant->city = $request->city;

        $restaurant->save();
        return redirect()->route('restaurants-index')->with('success', 'Info updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if (!$restaurant->fatherResto->count()) {

            $restaurant->delete();
            return redirect()->route('restaurants-index')->with('deleted', 'Restaurant gone');
        }

        return redirect()->back()->with('deleted', 'not possible to delete');
    }
}
