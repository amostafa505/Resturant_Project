<?php

namespace App\Http\Controllers;

use App\Models\chef;
use Illuminate\Http\Request;
use App\Http\Requests\chefstore;
use App\Http\Requests\chefupdate;
use Illuminate\Support\Facades\Storage;

class ChefController extends Controller
{
    public function index()
    {
        $data = chef::all();
        return view('layouts/chefs/show', compact('data'))->with('id', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts/chefs/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(chefstore $request)
    {
        $validated = $request->validated();
        $img = $this->saveImage($request);
        $validated['img'] = $img;
        chef::Create($validated);
        toastr()->success('Done Create New Product');
        response()->json(["status" => "sucess", "Message" => "Created Successfully"]);
        return redirect()->route('chefs.index');
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
        $chef = chef::findOrFail($id);
        return view('layouts/chefs/edit', compact('chef'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(chefUpdate $request)
    {
        $validated = $request->validated();
        $validated['img'] = $this->updateImage($request);
        chef::find($request->id)->update($validated);
        toastr()->success('Done Update This Chef');
        response()->json(["status" => "success", "Message" => "Updated Succussfully"]);
        return redirect()->route('chefs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(chef $chef)
    {
        chef::destroy($chef->id);
        // unlink(public_path() .  '/images/chefs/' . $chef->img);
        if (Storage::disk('s3')->exists($chef->img)) {
            Storage::disk('s3')->delete($chef->img);
        }
        return response()->json(["status" => "success", "Message" => "Deleted Succussfully"]);
    }

    public function saveImage($request)
    {
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $exten = $file->getClientOriginalExtension();
            $newname = uniqid() . '.' . $exten;
            $destenationpath = 'images/chefs';
            //save file in the local drive
            //******************************
            // $file->move($destenationpath , $newname);


            //save file in the Aws S3 Bucket
            //******************************** */
            $newname = Storage::disk('s3')->put($destenationpath, $file);
            return $newname;
        }
    }

    public function updateImage($request)
    {
        $data = chef::find($request->id);
        if ($request->img) {
            // if(file_exists(public_path() .  '/images/chefs/' . $data->img)){
            //     unlink(public_path() .  '/images/chefs/' . $data->img);    
            // }
            if (Storage::disk('s3')->exists($data->img)) {
                Storage::disk('s3')->delete($data->img);
            }
            $img = $this->saveImage($request);
            $validated['img'] = $img;
        } else {
            $validated['img'] = $data->img;
        }
        return  $validated['img'];
    }
}
