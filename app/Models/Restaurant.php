<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dish as D;
use App\Models\Menu as M;

class Restaurant extends Model
{
    use HasFactory;

    public function fatherResto()
    {
        return $this->hasMany(M::class, 'restaurant_id', 'id');
    }
    // public function fathertoDish()
    // {
    //     return $this->hasMany(D::class, 'dish_id', 'id');
    // }
}
