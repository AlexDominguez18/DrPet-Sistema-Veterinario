<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/inicio', function (){
    return view('layouts.inicio');
});

//Pet routes
Route::resource('pet', PetController::class)->middleware('auth');

//Owner routes
Route::post('/owner', [OwnerController::class,'store'])->middleware('auth');
Route::patch('/owner/{owner}/{pet}',[OwnerController::class,'update'])->middleware('auth');

//users routes
Route::resource('user',UserController::class)->middleware('admin','auth');
