<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\UserUpdate;


class UserProfileController extends Controller
{
        //User Profile Method to show the View of the User Data
        public function userprofile($id){
            $profile = User::find($id);
            return view('layouts.main.profile' , compact('profile'));
        }

        //User Profile Edit Method to Edit the View of the User Data
        public function editprofile($id){
            $profile = User::find($id);
            return view('layouts.main.editprofile' , compact('profile'));
        }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UserUpdate $request)
    {
        $validated = $request->validated();
        $validated['img'] = $this->updateImage($request);
        $validated['password'] = $this->updatePassword($request, $validated);
        USER::find($request->id)->update($validated);
        toastr()->success('User Updated Successfully');
        return redirect('/');
    }

    public function deleteimg($data){
        if(file_exists(public_path() .  '/images/users/' . $data->img) && $data->img !=null){
            unlink(public_path() .  '/images/users/' . $data->img);    
        }
    }
    
    public function saveImage($request){
        if($request->hasFile('img')){
            $file = $request->file('img');
            $exten = $file->getClientOriginalExtension();
            $newname = uniqid(). '.' .$exten;
            $destenationpath = 'images/users/';
            $file->move($destenationpath , $newname);
            return $newname;
        }
    }

    public function updateImage($request){
        $data = User::find($request->id);
        if($request->img){
            $this->deleteimg($data);
            $img = $this->saveImage($request);
            $validated['img'] = $img;
        }else{
            $validated['img'] = $data->img;
        }
        return  $validated['img'];
    }
    
    public function updatePassword($request, $validated){
        $data = User::find($request->id);
        if($request->password){
            $validated['password'] = $this->passwordIncrypt($validated['password']);
        }else{
            $validated['password'] = $data->password;
        }
        return $validated['password'];
    }


// getting Orders For the Authed User
    public function userOrders(Request $request){
        $id = auth()->user()->id;
        $orders = Order::where('user_id' , $id)->with('products')->paginate(10);
        return view('layouts.main.userOrders',compact('orders'));
    }
}
