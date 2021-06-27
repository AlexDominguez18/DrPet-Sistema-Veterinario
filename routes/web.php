<?php

use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Models\Owner;
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

Route::post('/owner', [OwnerController::class,'store']);

Route::resource('pet', PetController::class)->middleware('auth');