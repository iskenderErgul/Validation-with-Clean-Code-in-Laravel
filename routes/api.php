<?php

use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ScoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('create-player', [PlayerController::class,'create']);
Route::get('player-list',[PlayerController::class,'playerList']);
Route::put('update-player',[PlayerController::class,'playerUpdate']);


Route::post('create-score',[ScoreController::class,'createScore']);
Route::get('score-list',[ScoreController::class,'listAllScore']);


Route::post('ranking-weekly',[PlayerController::class,'rankingWeekly']);
Route::get('ranking-totally',[ScoreController::class,'rankingTotally']);

