<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
// use App\events\CreateFoodMenuEvent;
use App\Http\Requests\MenuStore;
use App\Http\Requests\MenuUpdate;


class FoodMenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $FoodMenus = FoodMenu::paginate('10');
        return view('layouts/FoodMenus/show',compact('FoodMenus'))->with('id',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts/FoodMenus/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStore $request)
    {
        $validated = $request->Validated();
        FoodMenu::Create($validated);
        toastr()->success('Menu Added Successfully');
        // event(new CreateFoodMenuEvent($validated));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = FoodMenu::findOrFail($id);
        return view('layouts/FoodMenus/edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuUpdate $request)
    {
        $validated = $request->validated();
        // dd($request['id']);
        FoodMenu::findOrFail($request['id']);
        FoodMenu::where('id' , $request['id'])->update($validated);
        toastr()->success('Menu Updated Successfully');
        return redirect('menus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FoodMenu::destroy($id);
        return response()->json(["status"=>"success" , "Message"=>"Deleted Succussfully"]);
    }

}
