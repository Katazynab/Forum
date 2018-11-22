<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Theme;
use\App\Category;
use Session;
use Auth;

class ThemesController extends Controller
{

    public function index()
    {
       $themes = Theme::all();

         return view("", ["themes"=>$themes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $allThemes = Theme::all();
        $allCategories = Category::all();

        return view('createtheme', ["allThemes" => $allThemes, "allCategories" => $allCategories, 'themeID' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [

            'title1.required' => 'Pavadinimo laukelis turi būti užpildytas nemažiau kaip 10 simbolių',
            'text.required' => 'Teksto laukelis turi būti užpildytas nemažiau kaip 10 simbolių'

        ];

        $validateData = $request->validate([
            'title1'=> 'required|min:5',
            'text'=> 'required|min:10',
        ], $messages);

        $tema = new Theme;
        $tema->title = $request->title1;
        $tema->text = $request->text;
        $tema->category_id = $request->category_id;
        $tema->user_id = 1;

        if(!empty($request->file('image'))) {
            $request->file('image')->store('public');
            $tema->image = $request->file('image')->hashname();
        }

        $tema->save();
        //sesijos pranesimas
        Session::flash('status', 'Tema sėkmingai pridėta');
        return redirect()->route('kategorijos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $categoryThemes = Category::find($id);


        return view('themesshow', ["categoryThemes" => $categoryThemes]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theme = Theme::find($id);
        $theme ->delete();

        return redirect()->route('temos.show', $theme->category->id);
    }
}
