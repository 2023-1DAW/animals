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
        //Buscar todos los veterinarios
        $vets = Vet::all();

        //Se lo envío a la vista:
        return view('animal.create', compact('vets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$description = $request->input('description');
        //$input = $request->collect(['description','otra']);
        //var_dump($request->input('otra'));
        //var_dump($input);
        //exit();
        // Aquí guardo el modelo en la BD
        //Animal::create($request->all());
        //Animal::create($request->collect(['name','description','weight','age'])->toArray());

        //Primero tengo que crear el animal:
        $animal = Animal::create($request->all());

        //Después tengo que crear el propietario:
        //Opción 1: crear un objeto Owner, meterle en sus atributos los datos del formulario, guardar en bd
        $owner = new Owner();
        $owner->name = $request->input('ownername');
        $owner->phone = $request->input('ownerphone');
        $owner->animal()->associate($animal);
        $owner->save();

        //Redirecciono a index
        return redirect()->route('animal.index')->with('success', 'Animal created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Animal $animal)
    {
        //
        return view('animal.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Animal $animal)
    {
        return view('animal.edit', compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Animal $animal)
    {
        
        //$request contiene los datos del formulario
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
        $animal->owner->delete();
        $animal->delete();
        return redirect()->route('animal.index')->with('success', 'Animal deleted');
    }
}
