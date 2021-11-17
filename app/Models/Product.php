<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\Model;
use App\Models\FoodMenu;


class Product extends Model
{
    use HasFactory;
    
    public function foodmenu(){
        return $this->belongsTo(FoodMenu::class,'menu_id');
    }

    protected $fillable = [
        'name', 'price', 'qty','menu_id','img' ,'status','description'
    ];

}
