<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function showAll()
    {
        //Consulto todos los owners
        $owners = Owner::all();

        //Los devuelvo en formato JSON:
        return response()->json($owners);
    }

    public function showById($id)
    {
        $owner = Owner::find($id);  //Busco owner por id
        //Si se ha encontrado:
        if ($owner != null) {
            return response()->json($owner);
        } else {
            //Si no se ha encontrado:
            return response()->json([
                "message" => "Owner not found"
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create(Request $request)
    {
        try {
            $owner = Owner::create($request->all());
            return response()->json([
                "data" => $owner,
                "message" => "Created successfully"
            ]);
        } catch (Exception $e) {
            //Si no se ha podido insertar (porque no tiene el campo "name"),
            //respuesta JSON con error.
            return response()->json([
                "data" => [],
                "message" => "Error " . $e->getMessage()
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $owner = Owner::findOrFail($id);
            $owner->update($request->all());
            return response()->json([
                "data" => $owner,
                "message" => "Updated successfully"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "data" => [],
                "message" => "Error"
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        $owner = Owner::destroy($id);
        if ($owner > 0) {
            return response()->json([
                "data" => $owner,
                "message" => "Deleted successfully"
            ]);
        } else {
            return response()->json([
                "data" => $owner,
                "message" => "Nothing to delete"
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
