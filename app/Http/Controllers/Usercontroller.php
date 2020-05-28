<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\role;
use App\Http\Requests\addUser;
use Hash;
use Auth;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user['user'] = User::paginate(10);
        return view('user.show', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user['role'] = role::all();
        return view('user.add', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(addUser $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->intended('/listusers')->with('success','Thêm người dùng thành công'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        $user['role'] = role::all();
        if(Auth::user()->role_id == 1){
         $user['user'] = User::find($id);
        }
        else 
         $user['user'] = User::find(Auth::user()->id);
         return view("user.edit",$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $user = User::find($id);
         $user['name'] = $request->name;
         $user['role_id'] = $request->role_id;
         $user['email'] = $request->email;
         if(!Hash::check($user['password'],Hash::make($request->password)))
         $user['password'] =  hash::make($request->password);
         
         $user->save();
         return redirect()->intended('/listusers')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.

     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->intended('/listusers')->with('success', 'Xóa thành công');
    }
}
