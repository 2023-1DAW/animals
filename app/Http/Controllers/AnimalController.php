<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Owner;
use App\Models\Vet;
use Illuminate\Http\Request;

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

        //Después tengo que crear el propietario:
        //Opción 1: crear un objeto Owner, meterle en sus atributos los datos del formulario, guardar en bd
        $owner = new Owner();
        $owner->name = $request->input('ownername');
        $owner->phone = $request->input('ownerphone');
        $owner->animal()->associate($animal);
        $owner->save();

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

        //Obtengo el objeto Owner a través de su id (primary key) para editarlo con los datos del formulario
        $o = Owner::find($animal->owner->id);
        $o->name = $request->input('ownername');
        $o->phone = $request->input('ownerphone');
        $o->update();

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
}
