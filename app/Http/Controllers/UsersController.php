<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\userStore;
use App\Http\Requests\UserUpdate;
use App\Models\User;

class UsersController extends Controller
{
    // this Construct Function is For Accepting that the Guest Can Create and account
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create','store', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate('10');
        return view('layouts/users/show', compact('users'))->with('id',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts/users/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(userStore $request)
    {
        $validated = $request->validated();
        $img = $this->saveImage($request);
        $validated['img'] = $img;
        $validated['password'] = $this->passwordIncrypt($validated['password']);
        User::create($validated);
        $this->sendEmail($validated);
        toastr()->success('User Created Successfully :D');
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
        $user = User::findOrFail($id);
        return view('layouts/users/Profile' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('layouts/users/edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request)
    {
        $validated = $request->validated();
        $validated['img'] = $this->updateImage($request);
        $validated['password'] = $this->updatePassword($request, $validated);
        USER::find($request->id)->update($validated);
        toastr()->success('User Updated Successfully');
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        $this->deleteimg($user);
        return response()->json(["status"=>"success" , "Message"=>"Deleted Succussfully"]);
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
    public function passwordIncrypt($validated){
        $incrypted = bcrypt($validated);
        return $incrypted;
    }

    public function sendEmail($validated){
        // Mail::to($validated['email'])->send(new WelcomeMessage($validated));
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
}
