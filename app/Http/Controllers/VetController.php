<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use Illuminate\Http\Request;

class VetController extends Controller
{

    public function mostrar()
    {
        return "hola :)";
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vets = Vet::all(); //Pido al modelo todos los Vets
        return view('vet.index', compact('vets'));
    }

    /**
     * Show the form for creating a new vet.
     */
    public function create()
    {
        return view('vet.create');
    }

    /**
     * Store a newly created vet in the database.
     */
    public function store(Request $request)
    {
        //Verificar que el nombre no esté dentro de la BD:
        /*$name = $request['name'];
        $v = Vet::where('name', $name)->get();
        if (sizeof($v) != 0) {
            return redirect()->route('vet.create')->with('error', 'Vet name already exists');
        }
        *///Este código de arriba se puede poner como regla en validate: unique:vets,name
        //Validar los datos:
        $request->validate([
            'name' => 'required|min:3|unique:vets,name',
            'email' => 'required|email',
            'phone' => 'required|integer'
        ]);
        //Guardar en la bd:
        Vet::create($request->all());
        //Ir a la vista index con un mensaje de OK
        return redirect()->route('vet.index')->with('success', 'Vet created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vet $vet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vet $vet)
    {
        return view('vet.edit', compact('vet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vet $vet)
    {
        //Validar los datos:
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|integer'
        ]);
        //$request contiene los datos del formulario
        $vet->update($request->all());
        //Reenviamos al index:
        return redirect()->route('vet.index')->with('success', 'Vet updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vet $vet)
    {
        //
    }
}
