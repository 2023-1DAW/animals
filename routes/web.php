<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\DBTestController;
use App\Http\Controllers\VetController;
use App\Http\Controllers\PlayGroundController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', 
    function(){
        return "hola";
    }
);

Route::get('user/{id}', function(string $id = "no hay"){
    return "hola user con id $id";
});

Route::resource('/animal', AnimalController::class);
//Route::get('/animal', [AnimalController::class, 'index'])->name('animal.index');
//Route::post('/animal', [AnimalController::class, 'store'])->name('animal.store');
//Route::delete('/animal/{animal}', [AnimalController::class, 'delete'])->name('animal.destroy');

Route::resource('/vet', VetController::class);

//Esta será una ruta para pruebas:
//Le digo que cuando visite mi url/veterinarios ejecutará el método mostrar de VetController
//Route::get('/veterinarios', [VetController::class, 'mostrar'])->name("mirutita");

Route::get('/playground', [PlaygroundController::class, 'mostrar'])->name('playground.index');
Route::post('/playground', [PlaygroundController::class, 'filtrar'])->name('playground.filtrar');

Route::get('/dbtest', [DBTestController::class, 'inserts'])->name('dbtest.inserts');
Route::get('/dbsearch', [DBTestController::class, 'search'])->name('dbtest.search');
Route::get('/dbupdate', [DBTestController::class, 'update'])->name('dbtest.update');
Route::get('/dbdelete', [DBTestController::class, 'delete']);