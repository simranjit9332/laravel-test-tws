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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/manage-company',[App\Http\Controllers\ManageCompany::class,'index']);
Route::get('/admin/add-company',[App\Http\Controllers\ManageCompany::class,'addCompany'])->name('addCompany');
Route::post('/admin/saveCompany',[App\Http\Controllers\ManageCompany::class,'saveCompany'])->name('saveCompany');
Route::get('/admin/updatecompany/{id}',[App\Http\Controllers\ManageCompany::class,'updateCompany']);
Route::post('/admin/editCompany',[App\Http\Controllers\ManageCompany::class,'editCompany'])->name('editCompany');
Route::get('/admin/deletecompany/{id}',[App\Http\Controllers\ManageCompany::class,'deleteCompany']);

Route::get('/admin/manage-employee',[App\Http\Controllers\ManageEmployee::class,'index']);
Route::get('/admin/add-employee',[App\Http\Controllers\ManageEmployee::class,'addEmployee'])->name('addEmployee');
Route::post('/admin/saveEmployee',[App\Http\Controllers\ManageEmployee::class,'saveEmployee'])->name('saveEmployee');
Route::get('/admin/updateemployee/{id}',[App\Http\Controllers\ManageEmployee::class,'updateEmployee']);
Route::post('/admin/editEmployee',[App\Http\Controllers\ManageEmployee::class,'editEmployee'])->name('editEmployee');
Route::get('/admin/deleteemployee/{id}',[App\Http\Controllers\ManageEmployee::class,'deleteemployee']);