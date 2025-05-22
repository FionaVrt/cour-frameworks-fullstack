<?php
use App\Http\Controllers\Api\PlaylistApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->get('/playlists', [PlaylistApiController::class, 'index']);
