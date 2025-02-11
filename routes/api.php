<?php

use App\Http\Controllers\OwnerController;
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