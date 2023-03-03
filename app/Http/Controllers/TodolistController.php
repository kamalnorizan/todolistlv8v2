<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\User;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTodolistRequest;
use App\Http\Requests\UpdateTodolistRequest;
use Auth;
use Hash;
use Validator;
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
        $todolists = Todolist::with('images','user','comments.user', 'comments.images')->latest()->get();
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

    public function wizard()
    {
        return view('wizard.create');
    }

    public function wizardValidate(Request $request)
    {
        if($request->currentIndex == 0){
            // $request->validate([
            //     'name'=>'required',
            //     'email'=>'required|email|unique:users,email',
            //     'password'=>'required',
            // ]);

            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
            ]);
        }else if($request->currentIndex == 1){

            $validator = Validator::make($request->all(), [
                'title'=>'required',
                'description'=>'required',
                'image'=>'required|image|mimes:png,jpg,jpeg|max:20000'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
                'title'=>'required',
                'description'=>'required',
                'image'=>'required|image|mimes:png,jpg,jpeg|max:20000',
                'imageComment'=>'required|image|mimes:png,jpg,jpeg|max:20000',
            ]);
        }

        if ($validator->fails()) {
            $data['errors'] = $validator->errors();
            $data['status'] = 'failed';
            return response()->json($data);
        }

        if($request->currentIndex == 2){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $todolist = new Todolist;
            $todolist->title = $request->title;
            $todolist->description = $request->description;
            $user->todolists()->save($todolist);

            $comment = new Comment;
            $comment->comment = $request->comment;
            $comment->todolist_id = $todolist->id;
            $comment->user_id = $user->id;
            $comment->save();

            if ($request->has('image')) {
                $image = new Image;
                $image->image_path = base64_encode(file_get_contents($request->file('image')));

                $todolist->images()->save($image);
            }

            if ($request->has('imageComment')) {
                $image = new Image;
                $image->image_path = base64_encode(file_get_contents($request->file('imageComment')));

                $comment->images()->save($image);
            }
        }

        $data['status'] = 'success';
        return response()->json($data);

    }

    public function dropdown()
    {
        $users = User::pluck('name','id');
        return view('wizard.dropdown', compact('users'));
    }

    public function ajaxLoadTitle(Request $request)
    {
        $user = User::find($request->user_id);
        $titles = $user->todolists->pluck('title','id');

        return response()->json($titles);
    }

    public function dropdownStore(Request $request)
    {
        # code...
    }
}
