<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table = 'foodmenus';

    public function products(){
        return $this->hasMany(Product::class, 'menu_id');
    }

    protected $fillable = [
        'menu_name',
    ];

}
