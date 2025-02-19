<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Owner;
use App\Models\Vet;
use Exception;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //1. Pido al modelo que busque todos los animales en la BD
        $animals = Animal::all();
        //2. Creo una vista con dichos animales
        return view('animal.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Aquí suministro una vista con un formulario en blanco de creación

        //Buscar todos los veterinarios para pasárselos a la vista y que pueda rellenar el select
        $vets = Vet::all();

        //Se lo envío a la vista:
        return view('animal.create', compact('vets'));
    }

    /**
     * Guarda un modelo en la base de datos que se le pasa como parámetro POST
     * @param \Illuminate\Http\Request $request Información de la petición POST
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista de index.
     */
    public function store(Request $request)
    {
        //Primero tengo que crear el animal:
        $animal = Animal::create($request->all());

        if ($request->owner != null) {
            //Después tengo que crear el propietario:
            //Creo un objeto Owner, meterle en sus atributos los datos del formulario, guardar en bd
            $owner = new Owner();
            $owner->name = $request->input('ownername');
            $owner->phone = $request->input('ownerphone');
            $owner->animal()->associate($animal);
            $owner->save();
        }

        //Busco el veterinario en la base de datos:
        $v = Vet::find($request->input('vets'));
        if ($v != null) {
            $animal->vet()->associate($v);
            $animal->update();
        }

        //Redirecciono a index
        return redirect()->route('animal.index')->with('success', 'Animal created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        return view('animal.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        //Para editar necesito consultar todos los veterinarios, y pasárselos también a la vista para rellenar el select
        $vets = Vet::all();
        return view('animal.edit', compact('animal', 'vets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        //$request contiene los datos del formulario

        if ($animal->owner != null) {
            //Obtengo el objeto Owner a través de su id (primary key) para editarlo con los datos del formulario
            $o = Owner::find($animal->owner->id);
            $o->name = $request->input('ownername');
            $o->phone = $request->input('ownerphone');
            $o->update();
        } else if ($request->ownername != null) {
            //El propietario no existía pero ahora se está creando uno nuevo:
            $owner = new Owner();
            $owner->name = $request->input('ownername');
            $owner->phone = $request->input('ownerphone');
            $owner->animal()->associate($animal);
            $owner->save();
        }
        //Busco el veterinario en la base de datos. Si existe, se lo asigno al atributo del animal
        $v = Vet::find($request->input('vets'));
        if ($v != null) {
            $animal->vet()->associate($v);
        }

        //Actualizo animal con los datos del formulario
        $animal->update($request->all());

        //Reenviamos al index:
        return redirect()->route('animal.index')->with('success', 'Animal updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Animal $animal)
    {
        //Primero tengo que eliminar el propietario:
        if ($animal->owner != null) {
            $animal->owner->delete();
        }

        //Elimino el animal
        //(no hay que hacer nada con el veterinario, pues sigue existiendo aunque se eliminen sus animales asociados)
        $animal->delete();
        return redirect()->route('animal.index')->with('success', 'Animal deleted');
    }

    public function indexRest()
    {
        $animals = Animal::with("owner", "vet")->get();
        return response()->json($animals);
    }

    public function showByIdRest($id)
    {
        $a = Animal::with("owner", "vet")->find($id);  //Busco owner por id
        

        //Si se ha encontrado:
        if ($a != null) {
            return response()->json([
                "data" => $a,
                "message" => "OK"
            ]);
        } else {
            //Si no se ha encontrado:
            return response()->json([
                "message" => "Animal not found"
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createRest(Request $request)
    {
        try {
            $a = Animal::create($request->all());
            return response()->json([
                "data" => $a,
                "message" => "Created successfully"
            ], JsonResponse::HTTP_CREATED); //201
        } catch (Exception $e) {
            //Si no se ha podido insertar (porque no tiene el campo "name"),
            //respuesta JSON con error.
            return response()->json([
                "data" => "",
                "message" => "Error " . $e->getMessage()    //Fase de desarrollo
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);   //500
        }
    }

    public function updateRest($id, Request $request)
    {
        $a = Animal::find($id);
        if ($a != null) {
            $a->update($request->all());
            $a->save();
            return response()->json([
                "data" => $a,
                "message" => "Updated successfully"
            ], JsonResponse::HTTP_CREATED); //201
        } else {
            return response()->json([
                "data" => "",
                "message" => "Error Animal not found"
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);   //500
        }
    }

    public function deleteRest($id)
    {
        $num = Animal::destroy($id);
        if ($num == 1) {
            return response()->json([
                "data" => [$id],
                "message" => "Deleted successfully"
            ]); //200
        } else {
            return response()->json([
                "data" => [],
                "message" => "Not found"
            ], JsonResponse::HTTP_BAD_REQUEST); //400
        }
    }

    public function showByNameRest($name)
    {
        //$a = FacadesDB::table("animals")->whereLike("name", "%". $name . "%")->get();
        $animals = Animal::whereLike("name", "%" . $name . "%")->get();
        return response()->json($animals);
    }

    //http://127.0.0.1:8000/api/animal?name=XXX&weight=YYY
    public function showByNameRest2(Request $request)
    {
        //$a = FacadesDB::table("animals")->whereLike("name", "%". $name . "%")->get();
        $animals = Animal::where(
            [
                ["name", "LIKE" , "%" . $request->name . "%"],
                ["weight",">", $request->weight]
            ]
        )->get();
        return response()->json($animals);
    }
}
