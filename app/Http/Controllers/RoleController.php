<?php

namespace App\Http\Controllers;
use App\Http\Requests\addrole;
use App\Http\Requests\editrole;
use App\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role['role'] = role::paginate(10);
        return view('role.show', $role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(addrole $request)
    {
        $role = new role();
        $role['name'] = $request->name;
        $role['desc'] = $request->desc;
        $role->save();

        return redirect()->intended('/listrole')->with('success', 'Thêm quyền thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role['role'] = role::find($id);
        return view('role.edit', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(editrole $request, $id)
    {
        $role = role::find($id);
        $role->name = $request->name;
        $role->desc = $request->desc;
        $role->save();
        return redirect()->intended('/listrole')->with('success','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->intended('/listrole')->with('error','Không thể xóa quyền');
    }
}
