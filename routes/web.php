<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

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