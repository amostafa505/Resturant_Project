<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class FoodMenu extends Model
{
    use HasFactory;

    protected $table = 'foodmenus';
    protected $appends = ['products'];


    public function products(){
        return $this->hasMany(Product::class, 'menu_id');
    }

    protected $fillable = [
        'menu_name',
    ];

    //sending this attribute to be a variable to be sent with every relational data from this model with products model 
    public function getProductsAttribute(){
        return Product::where('menu_id',$this->id)->limit(4)->get();
    }
}
