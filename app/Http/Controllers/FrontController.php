<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\URL;


class FrontController extends Controller
{

    private $perPage = 10;

    public function index(Request $request)
    {

        if ($request->s) { // search part*********************************************************************************

            list($w1, $w2) = explode(' ', $request->s . ' ');

            $menusDir = [DB::table('menus')
                ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo') //isvardinti laukus kuriuos norim matyti
                ->where('restaurants.restaurant', 'like', '%' . $w1 . '%') //ieskome restaurant pavadinime
                ->where('menus.menu', 'like', '%' . $w2 . '%') //ieskome menu pavadinime
                ->orWhere(fn ($query) => $query
                    ->where('restaurants.restaurant', 'like', '%' . $w2 . '%')
                    ->where('menus.menu', 'like', '%' . $w1 . '%'))
                ->orWhere(fn ($query) => $query
                    ->where('menus.menu', 'like', '%' . $w2 . '%')
                    ->where('menus.menu', 'like', '%' . $w1 . '%'))
                ->orderBy('menus.price', 'asc')
                ->get(), 'default'];
            $filter = 0;
        } else { // filter part-------------------------------------------------------------------------------
            if (!$request->restaurant_id) {

                $allCount = DB::table('menus')
                    ->select(DB::raw('count(menus.id) AS allmenus, count(DISTINCT(menus.menu)) AS allNames'))
                    ->first()->allmenus;

                $page = $request->page ?? 1; // jeigu nieko nerandam tai atiduodam 1st page, nes 0 nera. 
                //sort part =====================================================================================
                $menusDir = match ($request->sort) {
                    // 'restaurant-asc' => [DB::table('menus')
                    //     ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    //     ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                    //     ->orderBy('restaurants.restaurant', 'asc')
                    //     ->offset(($page - 1) * $this->perPage) // is page - 1 ir * kiek yra perpage. 
                    //     ->limit($this->perPage) // kiek rodys max = 10 
                    //     ->get(), 'restaurant-asc'],
                    // 'restaurant-desc' => [DB::table('menus')
                    //     ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    //     ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                    //     ->orderBy('restaurants.restaurant', 'desc')
                    //     ->offset(($page - 1) * $this->perPage)
                    //     ->limit($this->perPage)
                    //     ->get(), 'restaurant-desc'],

                    'menu-asc' => [DB::table('menus') //'menu-asc pavadinimas kuri naudojam view-box blade. 
                        ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                        ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                        ->orderBy('menus.price', 'asc') // pagal ka norim kad butu sort. 
                        ->orderBy('restaurants.restaurant', 'asc') // antraeilis sort, jei norim 
                        ->offset(($page - 1) * $this->perPage)
                        ->limit($this->perPage)
                        ->get(), 'menu-asc'],
                    'menu-desc' => [DB::table('menus')
                        ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                        ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                        ->orderBy('menus.price', 'desc')
                        ->orderBy('restaurants.restaurant', 'asc')
                        ->offset(($page - 1) * $this->perPage)
                        ->limit($this->perPage)
                        ->get(), 'menu-desc'],

                    default => [DB::table('menus')
                        ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                        ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                        ->offset(($page - 1) * $this->perPage)
                        ->limit($this->perPage)
                        ->get()->shuffle(), 'default']
                };
                $filter = 0;
            } else { // sort part
                $menusDir = match ($request->sort) {
                    // 'restaurant-asc' => [DB::table('menus')
                    //     ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    //     ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                    //     ->where('menus.restaurant_id', $request->restaurant_id)
                    //     ->orderBy('restaurants.restaurant', 'asc')
                    //     ->get(), 'restaurant-asc'],
                    // 'restaurant-desc' => [DB::table('menus')
                    //     ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    //     ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                    //     ->where('menus.restaurant_id', $request->restaurant_id)
                    //     ->orderBy('restaurants.restaurant', 'desc')
                    //     ->get(), 'restaurant-desc'],

                    'menu-asc' => [DB::table('menus')
                        ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                        ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                        ->where('menus.restaurant_id', $request->restaurant_id)
                        ->orderBy('menus.price', 'asc')
                        ->orderBy('restaurants.restaurant', 'asc')
                        ->get(), 'menu-asc'],
                    'menu-desc' => [DB::table('menus')
                        ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                        ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                        ->where('menus.restaurant_id', $request->restaurant_id)
                        ->orderBy('menus.price', 'desc')
                        ->orderBy('restaurants.restaurant', 'asc')
                        ->get(), 'menu-desc'],

                    default => [DB::table('menus')
                        ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                        ->select('restaurants.*', 'menus.id AS aid', 'menus.menu', 'menus.price', 'menus.restaurant_id', 'menus.photo')
                        ->where('menus.restaurant_id', $request->restaurant_id)
                        ->get()->shuffle(), 'default']
                };
                $filter = (int) $request->restaurant_id;
            }
        }

        //    dd($menus);

        $query = $request->query();
        parse_str($query['query'] ?? '', $prevQuery);
        // $parsedUrl = parse_url(url()->full());
        // parse_str($parsedUrl['query'] ?? '', $prevQuery);

        return view('front.index', [
            'menus' => $menusDir[0],
            'sort' => $menusDir[1],
            'restaurants' => Restaurant::all(),
            'filter' => $filter,
            's' => $request->s ?? '',
            'allCount' => $allCount ?? 0, //kad nebutu error jei ne ten uzeinam
            'perPage' => $this->perPage ?? 0,
            'prevQuery' => $prevQuery,
            'pageNow' => $page ?? 0,
        ]);
    }
}
