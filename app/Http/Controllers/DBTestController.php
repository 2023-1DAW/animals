<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Vet;
use Illuminate\Http\Request;

class DBTestController extends Controller
{
    public function inserts()
    {
        //1. Método save() que pertenece al objeto
        /*$v = new Vet();
        $v->name = "Prueba";
        $v->phone = "321321";
        $v->email = "email@a.com";
        $v->save();*/

        //2. Método create() que pertenece al modelo
        //Esto es lo que hacemos cuando ponemos Animal::create($request->all())
        $v = Vet::create([
            'name' => 'nommm',
            'phone' => '654687',
            'email' => "ñalskdjfjklds",
            "asdfasdf" => "asdfasdf"    //Esto no se guarda en ningún sitio, pero no da error.
        ]);
        return "Insertado vet con id {{$v->id}}";
    }

    public function search()
    {
        //1. Búsqueda con cláusulas where: animales con nombre = 
        $animals = Animal::where('name', 'nuevo')->get();
        foreach ($animals as $a) {
            echo $a->name . " - " . $a->weight . "<br>";
        }

        //2. Buscar animales con peso superior a 3
        echo "<h3>Animales con peso superior a 3</h3>";
        $animals = Animal::where('weight', '>', '3')->get();
        foreach ($animals as $a) {
            echo $a->name . " - " . $a->weight . "<br>";
        }

        //3. Buscar animales con peso superior a 3 y menor o igual a 7
        echo "<h3>Animales con peso superior a 3 y <= a 7</h3>";
        $animals = Animal::where([
            ['weight', '>', '3'],
            ['weight', '<=', 7]
        ])->get();
        //Similar a esto:
        $animals = Animal::where('weight', '>', '3')
            ->where('weight', '<=', 7)
            ->get();
        foreach ($animals as $a) {
            echo $a->name . " - " . $a->weight . "<br>";
        }

        //4. Buscar los animales con un nombre que contenga la "a":
        echo "<h3>Animales nombre que contenga a</h3>";
        $animals = Animal::where('name', 'like', '%a%')->get();
        foreach ($animals as $a) {
            echo $a->name . " - " . $a->weight . "<br>";
        }

        //5. Buscar animales con peso menor o igual a 5 y edad mayor o igual a 2
        echo "<h3>Animales con peso menor o igual a 5 y edad mayor o igual a 2</h3>";
        $animals = Animal::where('weight', '<=', 5)
            ->orWhere('age', '>=', 2)
            ->get();
        foreach ($animals as $a) {
            echo $a->name . " - " . $a->weight . " - " . $a->age . "<br>";
        }
        //6. Buscar animales con peso menor o igual a 5 y edad mayor o igual a 2 ordenados de más viejo a más joven
        echo "<h3>Animales con peso menor o igual a 5 y edad mayor o igual a 2</h3>";
        $animals = Animal::where('weight', '<=', 5)
            ->orWhere('age', '>=', 2)
            ->orderBy('age', 'desc')
            ->get();
        foreach ($animals as $a) {
            echo $a->name . " - " . $a->weight . " - " . $a->age . "<br>";
        }
    }

    public function update()
    {
        //1. Busco un elemento por id y le cambio el nombre:
        $a = Animal::find(20);
        $a->name = "asdfasdf";
        $a->save();

        //2. Modificar todos los animales que pesen menos de 5 kilos poner en su descripcion "menos de 5kg".
        Animal::where('weight', '<', 5)->update(['description' => 'Menos de 5kg']);
    }

    public function delete()
    {
        //1. Elimino los animales con ids 3, 7 y 8
        Animal::destroy(9, 18);

        //2. Eliminar con condiciones: eliminar los animales con peso > 40
        Animal::where('weight', '>', 40)->delete();
        $animals = Animal::all();
        return view('animal.index', compact('animals'));
    }
}
