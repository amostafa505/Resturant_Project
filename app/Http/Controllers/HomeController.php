<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\FoodMenu;
use App\models\Product;
use App\Models\chef;


class HomeController extends Controller
{
    public function index(){
        // $product = Product::limit(4)->get();
        // // dd($menu);
        // $contents = [];
        //     foreach($menus as $menu){
            //     $menu = $menu->products()->with('status' , 'Active')->limit(4);
            // }
            // dd($contents);        
            // $products = product::all();
            // $menus = foodmenu::with(['products' => function ($query) {
                //     $query->latest()->limit(4);
                // }])->get();
                
                // $products = product::all();
                // dd($productslimit);
                // foreach($menus as $menu):
                //     $productslimit[] = $menu->products()->take(4)->get();
                // endforeach;    
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
