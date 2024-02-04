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

//indexのルーディング
Route::get('/index', [PlayersController::class,'index'])->name('index');
Route::get('/index1/{player_id}',[PlayersController::class,'index1'])->name('player.index1');

//detailのルーディング
Route::get('/detail/{player_id}',[PlayersController::class,'detail'])->name('player.detail');

//ダイレクトアクセス禁止
Route::get('/detail',[PlayersController::class,'reindex'])->name('reindex');


Route::get('/update/{player_id}',[PlayersController::class,'update'])->name('player.update');

Route::get('/edit/{player_id}',[PlayersController::class,'edit'])->name('player.edit');

Route::get('/show/{player_id}',[PlayersController::class,'show'])->name('player.show');


Route::get('/delete/{player_id}',[PlayersController::class,'delete'])->name('player.delete');

//戻るボタン
Route::get('/back-to-index', [PlayersController::class, 'backToIndex']);


