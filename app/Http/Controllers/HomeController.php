<?php

namespace App\Http\Controllers;

use App\Models\chef;
use App\Models\User;
use App\Models\Product;
use App\Models\FoodMenu;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){   
        $menus = FoodMenu::with('products')->get();
        $products_data = product::with('foodmenu')->get();
        $chefs = chef::all();
        return view('layouts.main.index' , compact('menus','chefs', 'products_data'));
    }
    //Menu Method to send the Menu and its products Data to the View
    public function menu(){
        $menus=foodmenu::all();
        foreach($menus as $menu):
            $productslimit[] = $menu->products()->take(4)->get();
        endforeach; 
        $products = Product::with('foodmenu')->get();
        return view('layouts.main.menu' , compact('menus','products','productslimit'));
    }
    //Gallary Method to send the Products to the View
    public function gallary(){
        $products = Product::with('foodmenu')->get();
        $menus = foodmenu::all();
        return view('layouts.main.gallery' , compact('products' , 'menus'));
    }

    //Chef Method to send the Chefs Data to the View
    public function chef(){
        $chefs= Chef::all();
        return view('layouts.main.chefs' , compact('chefs'));
    }

    //contact Method to show the View of the contact form
    public function contact(){
        return view('layouts.main.contact');
    }
    //conact Method to show the View of the contact form
    public function productview($id){
        $product = product::find($id);
        return view('layouts.main.product' , compact('product'));
    }


    

}
