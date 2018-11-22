<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use\App\User;
use Auth;
use Session;

class UsersController extends Controller
{

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('edituser', ["user"=>$user]);
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
        $messages = [
            'name' => 'Vartotojo vardas jau egzistuoja arba yra mažiau nei 3 simboliai'
        ];

        $validateData = $request->validate([
            'name' => 'required|min:3',
        ], $messages);

        $user = User::find($id);
        $user->name = $request->name;

        //$user->image = $request->image;
        if(!empty($request->file('image'))) {
            $request->file('image')->store('public');
            $user->image = $request->file('image')->hashname();
        }
        $user->save();

        Session::flash('status', 'Paskyra sėkmingai atnaujinta');
        return redirect()->route('kategorijos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}

