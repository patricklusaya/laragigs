<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;

Route::get('/', [ListingController::class, 'index'] );

Route::get('/listings/create', [ListingController::class, 'create'] )->middleware('auth');

Route::post('/listings', [ListingController::class, 'store'] );

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'] )->middleware('auth');
Route::put('/listings/{listing}', [ListingController::class, 'update'] )->middleware('auth');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'] )->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

Route::get('/listings/{id}', [ListingController::class, 'show'] )->middleware('auth');




Route::get('/register', [UserController::class, 'show'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/users/register', [UserController::class, 'create']);




Route::get('/login', [UserController::class, 'showLogin'])->name('login')->middleware('guest') ;
Route::post('/authenticate', [UserController::class, 'authenticate']);