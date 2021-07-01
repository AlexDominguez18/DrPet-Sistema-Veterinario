<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use App\Models\Treatment;
use Illuminate\Support\Facades\Route;

//Landing page
Route::get('/', function () {
    return view('welcome');
});

//Inicio
Route::get('/inicio', function (){
    return view('layouts.inicio');
})->middleware('auth');

//Pet routes
Route::resource('pet', PetController::class)->middleware('auth');

//Owner routes
Route::post('/owner', [OwnerController::class,'store'])->middleware('auth');
Route::patch('/owner/{owner}/{pet}',[OwnerController::class,'update'])->middleware('auth');

//users routes
Route::resource('user',UserController::class)->middleware('admin','auth');

//Products routes
Route::resource('product',ProductController::class)->middleware('auth');

//Traetments routes
Route::resource('treatment',TreatmentController::class)->middleware('auth');