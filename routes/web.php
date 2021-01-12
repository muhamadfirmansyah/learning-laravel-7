<?php

use Illuminate\Support\Facades\Route;

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


Route::resource('barang', 'BarangController');

Route::patch('kategori/{kategori}/forceDelete', 'CategoryController@forceDelete')->name('kategori.forceDelete');
Route::patch('kategori/{kategori}/restore', 'CategoryController@restore')->name('kategori.restore');
Route::resource('kategori', 'CategoryController');
