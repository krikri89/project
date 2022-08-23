<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant as R;
use App\Models\Menu as M;

class Dish extends Model
{
    use HasFactory;

    // public function dishesToMenu()
    // {
    //     return $this->belongsToMany(M::class);
    // }
}
