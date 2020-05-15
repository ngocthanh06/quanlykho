<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Requests\addClientRequest;
use App\Http\Requests\editClientRequest;

class ClientController extends Controller
{

    public function loadClient($id){
        return Client::find($id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client['client'] = Client::paginate(10);
        return view('clients.show', $client);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(addClientRequest $request)
    {
        $client = new Client();
        $client['name'] = $request->name;
        $client['address'] = $request->address;
        $client['phone'] = $request->phone;
        $client['email'] = $request->email;
        $client->save();
        return redirect()->intended('/listClient')->with('success','Thêm thành công'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
         $client['client'] = Client::find($id);
        return view('clients.edit', $client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(editClientRequest $request, $id)
    {
        $client = Client::find($id);
        $client['name'] = $request->name;
        $client['address'] = $request->address;
        $client['phone'] = $request->phone;
        $client['email'] = $request->email;
        $client->save();
        return redirect()->intended('/listClient')->with('success','Thêm thành công'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Client $client)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->intended('/listClient')->with('success','Xóa Thành Công'); 
    }
}
