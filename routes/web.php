<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodolistController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// DB::listen(function ($event) {
//     dump($event->sql);
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/myblade', function () {
    return view('myblade');
});

Route::get('/myblade2/{name?}', function ($name=null) {
    return view('myblade2', compact('name'));
})->name('myblade123');

Route::resource('user', UserController::class);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('todolist', [TodolistController::class,'index'])->name('todolist.index');
Route::get('todolist/create', [TodolistController::class,'create'])->name('todolist.create');
Route::post('todolist/', [TodolistController::class,'store'])->name('todolist.store');
Route::get('todolist/{todolist}/edit', [TodolistController::class,'edit'])->name('todolist.edit');
Route::put('todolist/{todolist}', [TodolistController::class,'update'])->name('todolist.update');

