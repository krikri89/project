<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Restaurant as R;
use App\Models\Dish as D;

class Menu extends Model
{
    use HasFactory;
    public function menuToResto()
    {
        return $this->belongsTo(R::class, 'restaurant_id', 'id');
    }
}
