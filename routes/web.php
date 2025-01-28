<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\VetController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', 
    function(){
        return "hola";
    }
);

Route::get('user/{id}', function(string $id){
    return "hola user con id $id";
});

Route::resource('/animal', AnimalController::class);
//Route::get('/animal', [AnimalController::class, 'index'])->name('animal.index');
//Route::post('/animal', [AnimalController::class, 'store'])->name('animal.store');

Route::resource('/vet', VetController::class);

//Esta será una ruta para pruebas:
//Le digo que cuando visite mi url/veterinarios ejecutará el método mostrar de VetController
Route::get('/veterinarios', [VetController::class, 'mostrar'])->name("mirutita");