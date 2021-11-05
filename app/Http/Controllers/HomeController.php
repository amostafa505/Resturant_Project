<?php

namespace App\Http\Controllers;

use App\events\contactformEvent;
use Illuminate\Http\Request;
use App\models\FoodMenu;
use App\models\Product;
use App\Models\chef;
use App\Http\Requests\ContactFormRequest;

class HomeController extends Controller
{
    public function index(){
        // $product = Product::limit(4)->get();
        // $menu = FoodMenu::with('products')->limit(1)->get();
        // dd($menu);
        $products = product::all();
        $menus = foodmenu::all();
        $chefs = chef::all();
        return view('layouts.main.index' , compact('products','menus','chefs'));
    }
    //Menu Method to send the Menu and its products Data to the View
    public function menu(){
        $menus=foodmenu::all();
        $products = Product::with('foodmenu')->get();
        return view('layouts.main.menu' , compact('menus','products'));
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

    //conact Method to show the View of the contact form
    public function contact(){
        return view('layouts.main.contact');
    }

    public function sendcontact(ContactFormRequest $request)
    {
        $validated = $request->validated();
        
        event(new contactformEvent($validated));
        toastr()->success('Done Send Your Contact To the Admin');
        return back();
    }

}
