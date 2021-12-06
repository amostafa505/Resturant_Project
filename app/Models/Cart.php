<?php

namespace App\Models;

use App\Models\chef;
use App\Models\Product;

class Cart
{
    public $items = [];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null)
    {
        if($cart){
            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        }else{
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }
    public function add($product){

        $item = [
            'id'    =>   $product->id,
            'name'  =>   $product->name,
            'price' =>   $product->Pricediscount,
            'qty'   =>   0,
            // 'image' =>   $product->name,
        ];

        if(!array_key_exists($product->id , $this->items)){
            $this->items[$product->id] = $item;
            $this->totalQty += 1;
            $this->totalPrice += $product->Pricediscount;
        }else{
              $this->totalQty += 1;
              $this->totalPrice += $product->Pricediscount;
        }

        $this->items[$product->id]['qty']+= 1 ;
    }

    public function updateQty($id , $qty){
        // dd($this->items[$id]['id']);
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];
            
            $this->items[$id]['qty'] = $qty;

            $this->totalQty += $qty;
            $this->totalPrice += $this->items[$id]['price'] * $qty;
    }

    public function remove($id){
        // dd($this->items[$id['id']]);
        if(array_key_exists($id['id'],$this->items)){
            $this->totalQty -= $this->items[$id['id']]['qty'];
            $this->totalPrice -= $this->items[$id['id']]['qty'] * $this->items[$id['id']]['price'];
            unset($this->items[$id['id']]);
        }
    }
}
