<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Model;
use App\Models\FoodMenu;
use App\Models\productImage;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'price', 'qty','menu_id' ,'status','description' , 'discount'
    ];
    public function foodmenu(){
        return $this->belongsTo(FoodMenu::class,'menu_id');
    }


    public function productimages(){
        return $this->hasMany(productImage::class);
    }

    public function getPriceDiscountAttribute(){
        return $this->price - ($this->price * $this->discount / 100)  ;
    }
}
