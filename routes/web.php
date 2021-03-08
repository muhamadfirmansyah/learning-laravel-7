<?php

use App\Exports\StudentsExport;
use App\Student;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::delete('barang/{barang}/forceDelete', 'BarangController@forceDelete')->name('barang.forceDelete');
Route::patch('barang/{barang}/restore', 'BarangController@restore')->name('barang.restore');
Route::resource('barang', 'BarangController');

Route::patch('kategori/{kategori}/forceDelete', 'CategoryController@forceDelete')->name('kategori.forceDelete');
Route::patch('kategori/{kategori}/restore', 'CategoryController@restore')->name('kategori.restore');
Route::resource('kategori', 'CategoryController');

Route::get('/contoh', function () {
    return view('admin.index')->with('tes', 'ini merupakan tes 2');
});

Route::get('/students', function() {
    // $students = Student::get(['nis', 'nama', 'id_kelas', 'password']);

    return view('students.index');
});

Route::get('/api/students', function() {
    // $students = Student::orderBy('id', 'DESC')->get(['id', 'nama', 'id_kelas', 'password']);
$students = Student::count();

    return response()->json($students);
});

Route::get('/students/export', function() {
    $type = request()->type;

    if ($type == 'xlsx') {
        return Excel::download(new StudentsExport, 'students.xlsx');
    } elseif ($type == 'csv') {
        return Excel::download(new StudentsExport, 'students.csv', 'Csv', [
            'content-type' => 'text/csv'
        ]);
    }

    return "Silahkan masukkan request type-nya";
});