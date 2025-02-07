<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Vet;
use Illuminate\Http\Request;

class PlayGroundController extends Controller
{
    public function mostrar()
    {
        /*$a = new Animal();
$a->name = 'Nombre';
$a->weight = 3.1;
$a->age = 2;
$a->description = "...";
$a->save();
$a = Animal::create([
    'name' => 'Nombre',
    'age' => 12,
    'weight' => 1.3,
    'description' => ""
]);
$a->name = "nuevo";
$a->save(); //similar $a->update();
Animal::where('age', '>=', 5)->update(['description' => '5 years or more']);
$animal = Animal::find(2);

        exit();
        $animals = Animal::where('name', '!=', 'a1')->get();
        $animals = Animal::where('weight', '>=', 3)->get();
        $animals = Animal::where([
            ['name', '!=', 'a1'],
            ['weight', '>=', 3]
        ])->get();
        $animals = Animal::where('name', 'a1')
            ->orWhere('weight', '<', 3)
            ->get();
        $animals = Animal::where('weight', '>=', 3)
            ->orderBy('age', 'desc')
            ->get();
        //Con este bucle podríamos comprobar el resultado del select
        foreach ($animals as $a) {
            echo $a->name . " " . $a->weight . " " . $a->age . "<br>";
        }

        exit();*/
        //Busco animales y veterinarios
        $animals = Animal::all();
        $vets = Vet::all();

        //Creo una vista con dichos animales y vets
        return view('playground.index', compact('animals', 'vets'));
    }
    public function filtrar(Request $request)
    {
        //Busco los animales con el nombre introducido en el campo de búsqueda:
        $animals = Animal::where('name', $request->name)->get();
        //Añado otra variable para ver si he filtrado en el index
        $filter = $request->name;
        //Si se dejó el campo vacío, retorno todos:
        if ($request->name == null) {
            $animals = Animal::all();
        }
        //Busco vets:
        $vets = Vet::all();
        //Devuelvo la vista playground.index con los animales encontrados:
        return view('playground.index', compact('animals', 'vets', 'filter'));
    }
}
