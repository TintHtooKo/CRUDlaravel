<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/',[PostController::class,'home'])->name('homePage');
Route::post('/create',[PostController::class,'create']);
Route::get('delete/{id}',[PostController::class,'postDelete']);
Route::get('/read/{id}',[PostController::class,'read']);
Route::get('/update/{id}',[PostController::class,'update'])->name('updatePage');
Route::post('/updatePost/{id}',[PostController::class,'updatePost']);


