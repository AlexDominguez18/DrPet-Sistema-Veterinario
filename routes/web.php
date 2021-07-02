<?php

use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Rutas para la verificacion de correo
Route::get('/email/verify', function (){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Landing page
Route::get('/', function () {
    return view('welcome');
});

//Inicio
Route::get('/inicio', function (){
    return view('layouts.index');
})->middleware(['verified','auth'])->name('index');

//Pet routes
Route::post('/pet/{pet}/add-treatment',[PetController::class,'addTreatment']
)->name('pet.add-treatment')->middleware(['verified','auth']);

Route::delete('/pet/{pet}/{treatment}/delete-treatment',[PetController::class,'deleteTreatment']
)->name('pet.delete-treatment')->middleware(['verified','auth']);

Route::resource('pet', PetController::class)->middleware(['verified','auth']);

//Owner routes
Route::post('/owner', [OwnerController::class,'store'])->middleware(['verified','auth']);
Route::patch('/owner/{owner}/{pet}',[OwnerController::class,'update'])->middleware(['verified','auth']);

//Users routes
Route::resource('user',UserController::class)->middleware(['verified','auth']);

//Products routes
Route::resource('product',ProductController::class)->middleware(['verified','auth']);

//Traetments routes
Route::resource('treatment',TreatmentController::class)->middleware(['verified','auth']);

// Adoption routes
Route::resource('adoption', AdoptionController::class)->middleware(['verified','auth']);
