<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Ruta para consultar todos los owners: GET url: /owner
Route::get('/owner', [OwnerController::class, 'showAll']);
//Ruta para consultar un owner por id: GET url: /owner/{id}
Route::get('owner/{id}', [OwnerController::class, 'showById']);
//Ruta para crear un owner: POST url: /owner
Route::post('owner', [OwnerController::class, 'create']);
//Ruta para actualizar un owner: PUT /owner/{id}
Route::put('owner/{id}', [OwnerController::class, 'update']);

Route::delete('owner/{id}', [OwnerController::class, 'delete']);

//12feb
//Cuando haga un GET a la url /student, se hace cargo de esa petición StudentController.index()
Route::get('student', [StudentController::class, 'index']);
//Ruta para añadir (POST) un student: /student, StudentController.store()
Route::post('student', [StudentController::class, 'store']);
//Ruta PUT (actualizar) un student: /student/XXXXXX, StudentController.update()
Route::put('student/{id}', [StudentController::class, 'update']);
Route::delete('student/{id}', [StudentController::class, 'delete']);
Route::get('student/{id}', [StudentController::class, 'show']);

Route::get('animal', [AnimalController::class, 'indexRest']);
Route::get('animal/{id}', [AnimalController::class, 'showByIdRest']);
Route::post('animal', [AnimalController::class, 'createRest']);
Route::put('animal/{id}',  [AnimalController::class, 'updateRest']);
Route::delete('animal/{id}', [AnimalController::class, 'deleteRest']);
Route::get('animal-name/{name}', [AnimalController::class, 'showByNameRest']);
Route::get('animal-2', [AnimalController::class, 'showByNameRest2']);

