<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


# clientes
Route::get('clientes/index', 'App\Http\Controllers\Cliente\ClienteController@index')->name('clientes.index');
Route::get('clientes/create', 'App\Http\Controllers\Cliente\ClienteController@create')->name('clientes.create');
Route::post('clientes/store', 'App\Http\Controllers\Cliente\ClienteController@store')->name('clientes.store');
Route::get('clientes/edit', 'App\Http\Controllers\Cliente\ClienteController@edit')->name('clientes.edit');
Route::post('clientes/update', 'App\Http\Controllers\Cliente\ClienteController@update')->name('clientes.update');
Route::get('clientes/delete', 'App\Http\Controllers\Cliente\ClienteController@delete')->name('clientes.delete');

#vendedores
Route::get('vendedores/index', 'App\Http\Controllers\Vendedor\VendedorController@index')->name('vendedores.index');

#vendedores
Route::get('categorias/index', 'App\Http\Controllers\Categoria\CategoriaController@index')->name('categorias.index');

#vendedores
//Route::get('clientes/index', 'App\Http\Controllers\Cliente\ClienteController@index')->name('clientes.index');
#vendedores
//Route::get('clientes/index', 'App\Http\Controllers\Cliente\ClienteController@index')->name('clientes.index');

});

require __DIR__.'/auth.php';
