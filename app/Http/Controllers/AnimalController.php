<?php

namespace App\Http\Controllers;

use App\Models\Animal;
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
        return view('animal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Aquí guardo el modelo en la BD
        Animal::create($request->all());
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
        //
        $animal->delete();
        return redirect()->route('animal.index')->with('success', 'Animal deleted');
    }
}
