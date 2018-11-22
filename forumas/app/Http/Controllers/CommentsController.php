<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Theme;
use\App\Comment;
use Auth;

class CommentsController extends Controller
{

    public function index()
    {
        //
        $comments = Comment::all();


        return view("", ["comments"=>$comments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $allComments = Comment::all();
        $allThemes = Theme::all();

        return view('commentsshow', ["allComments" => $allComments, "allThemes" => $allThemes, 'commentID' => $id]);
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
            'text.required' => 'Teksto laukelis turi būti užpildytas nemažiau kaip 2 simboliais'
        ];

        $validateData = $request->validate([
            'text'=> 'required|min:2',
            'image'=>'nullable| image',
        ], $messages);

        $komentaras = new Comment;
        $komentaras->text = $request->text;
        $komentaras->theme_id = $request->theme_id;
        $komentaras->user_id = Auth::user()->id;

        if(!empty($request->file('image'))) {
        $request->file('image')->store('public');
        $komentaras->image = $request->file('image')->hashname();
        }
        $komentaras->save();

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
        $ThemeComments = Theme::find($id);
        $comments = Comment::paginate(5);
        return view('commentsshow', compact('comments'), ["ThemeComments" => $ThemeComments]);
        //return view('commentsshow', ["ThemeComments" => $ThemeComments, "comments" => $comments]);
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
        $comment = Comment::find($id);
        $comment -> delete();

        return back();
    }
}
