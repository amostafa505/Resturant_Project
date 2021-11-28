<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\product;

class productImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
