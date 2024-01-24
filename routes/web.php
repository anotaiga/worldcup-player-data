<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/index',function(){
//     return view('players/index');
// });

Route::get('/index', [PlayersController::class,'index'])->name('index');
// Route::get('/detail/{id}',[PlayersController::class,'detail'])->name('detail');

// Route::post('/process-button-click', [PlayersController::class,'detail'])->name('button.click');
Route::get('/detail/{player_id}',[PlayersController::class,'detail'])->name('player.detail');

Route::get('/detail',[PlayersController::class,'reindex'])->name('reindex');

// routes/web.php




Route::get('/player/{id}',[PlayersController::class,'player'])->name('player');