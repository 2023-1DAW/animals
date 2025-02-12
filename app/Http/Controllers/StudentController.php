<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        //Creo una respuesta en formato JSON con los datos:
        return response()->json($students);
    }

    public function store(Request $request)
    {
        try {
            $s = Student::create($request->all());
            //Se inserta bien:
            return response()->json([
                "message" => "Created",
                "data" => $s
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error" . $e->getMessage(),
                "data" => []
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);   //Código 500
        }
    }

    public function update($id, Request $request)
    {
        try {
            $s = Student::findOrFail($id);  //Si no lo encuentra, lanza excepción
            $s->update($request->all());
            return response()->json([
                "message" => "Updated",
                "data" => $s
            ]);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Error" . $e->getMessage(),
                "data" => []
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);   //Código 500
        }
    }

    public function delete($id)
    {
        try {
            $s = Student::findOrFail($id);
            $s->delete();
            return response()->json([
                "data" => $s,
                "message" => "Deleted"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "data" => [],
                "message" => "Nothing to delete"
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $s = Student::findOrFail($id);
            return response()->json($s);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Not found",
                "data" => []
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
