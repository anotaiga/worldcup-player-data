<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\UsersController;

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
Route::get('/index2/{player_id}',[PlayersController::class,'index2'])->name('player.index2');

//detailのルーディング
Route::get('/detail/{player_id}',[PlayersController::class,'detail'])->name('player.detail');
Route::get('/detail2/{player_id}',[PlayersController::class,'detail2'])->name('player.detail2');

//ダイレクトアクセス禁止
Route::get('/detail',[PlayersController::class,'reindex'])->name('reindex');


Route::get('/update/{player_id}',[PlayersController::class,'update'])->name('player.update');

Route::get('/edit/{player_id}',[PlayersController::class,'edit'])->name('player.edit');

Route::get('/show/{player_id}',[PlayersController::class,'show'])->name('player.show');


Route::get('/delete/{player_id}',[PlayersController::class,'delete'])->name('player.delete');

//戻るボタン
Route::get('/back-to-index', [PlayersController::class, 'backToIndex']);
// Route::get('/back-to-index2', [PlayersController::class, 'backToIndex2']);
// Route::get('/index3/{country_id}', [PlayersController::class, 'backToIndex2']);


Route::get('/create_new_entry',[UsersController::class,'create_new_entry'])->name('create_new_entry');
Route::get('/back-to-login', [UsersController::class, 'backToLogIn']);
Route::get('/register', [UsersController::class, 'register'])->name('user.register');
Route::get('/back-to-create', [UsersController::class, 'backToCreate']);
Route::get('/login',[UsersController::class,'login'])->name('user.login');
Route::get('/signin',[UsersController::class,'signin'])->name('user.signin');