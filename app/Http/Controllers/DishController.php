<?php

namespace App\Http\Controllers;

use App\Models\Resto;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dishes = match ($request->sort) {
            'asc' => Dish::orderBy('dish', 'asc')->get(),
            'desc' => Dish::orderBy('dish', 'desc')->get(),
            default => Dish::all()
        };

        return view('dishes.index', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $restos = Resto::all();
        $dishes = Dish::all();

        return view('dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dish = new Dish;
        if ($request->file('dish_photo')) { // jeigu file yra

            $photo = $request->file('dish_photo');
            $extension = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '-' . rand(100000, 999999) . '.' . $extension;
            $photo->move(public_path() . '/images', $file);
            $dish->photo = asset('/images') . '/' . $file;
        }

        $dish->dish = $request->dish_name;
        $dish->description = $request->description;
        // $dish->resto_id = $request->resto_id;


        $dish->save();

        return redirect()->route('dishes-index')->with('success', 'Well done!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function show(int $dishId)
    {
        $dish = Dish::where('id', $dishId)->first();

        return view('dishes.show', ['dish' => $dish]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {

        // $restos = Resto::all();
        $dishes = Dish::all();

        return view('dishes.edit', ['dish' => $dish]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        if ($request->file('dish_photo')) { // jeigu file yra

            // istrinam is DB
            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $extension = pathinfo($dish->photo, PATHINFO_EXTENSION);
            $path = asset('/images') . '/' . $name . '.' . $extension;

            if (file_exists($path)) {
                unlink($path);
            }
            // idedam nauja

            $photo = $request->file('dish_photo');
            $extension = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '-' . rand(100000, 999999) . '.' . $extension;
            $photo->move(public_path() . '/images', $file);
            $dish->photo = asset('/images') . '/' . $file;
        }
        $dish->dish = $request->dish_name;
        $dish->description = $request->description;
        // $dish->resto_id = $request->resto_id;

        $dish->save();

        return redirect()->route('dishes-index')->with('success', 'You are the best!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resto  $resto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        // istrinam is DB
        if ($dish->photo) {
            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $extension = pathinfo($dish->photo, PATHINFO_EXTENSION);
            $path = asset('/images') . '/' . $name . '.' . $extension;

            if (file_exists($path)) {
                unlink($path);
            }
        }
        $dish->delete();

        return redirect()->route('dishes-index')->with('deleted', 'Dish is dead :(');
    }
    public function deletePic(Dish $dish)
    {
        // istrinam is DB
        $name = pathinfo($dish->photo, PATHINFO_FILENAME);
        $extension = pathinfo($dish->photo, PATHINFO_EXTENSION);
        $path = asset('/images') . '/' . $name . '.' . $extension;

        if (file_exists($path)) {
            unlink($path);
        }
        //istrinam is musu filo
        $dish->photo = null; // pic padarom null
        $dish->save();


        return redirect()->back()->with('deleted', 'No more pics');
    }
}
