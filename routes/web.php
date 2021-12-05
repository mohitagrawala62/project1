<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});
Route::get('/category',[CategoryController::class,'index']);

Route::post('/add-category',[CategoryController::class,'addCategory'])->name('category.add');

Route::delete('/category/{id}',[CategoryController::class,'deleteCategory']);
