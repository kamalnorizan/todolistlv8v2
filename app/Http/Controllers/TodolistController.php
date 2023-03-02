<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\Image;
use App\Http\Requests\StoreTodolistRequest;
use App\Http\Requests\UpdateTodolistRequest;
use Auth;
// use Image as img;
class TodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $todolists = Todolist::with('comments')->whereHas('comments')->get();
        // $todolists = Todolist::with('comments')->get();

        // dd($todolists);
        $todolists = Todolist::with('images','user','comments.user', 'comments.images')->get();
        return view('todolist.index', compact('todolists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todolist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodolistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodolistRequest $request)
    {

        // Todolist::create([
        //     'title'=>$request->title,
        // ]);

        $todolist = new Todolist;
        $todolist->title = $request->title;
        // $todolist->user_id = Auth::user()->id;
        $todolist->description = $request->description;
        // $todolist->save();

        Auth::user()->todolists->save($todolist);

        // $todolist->images()->create([
        //     'image_path'=>base64_encode(file_get_contents($request->file('image')))
        // ]);

        $image = new Image;
        $image->image_path = base64_encode(file_get_contents($request->file('image')));

        $todolist->images()->save($image);

        flash('Created')->success()->important();
        return redirect()->route('todolist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        return view('todolist.edit',compact('todolist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodolistRequest  $request
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodolistRequest $request, Todolist $todolist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        //
    }
}
