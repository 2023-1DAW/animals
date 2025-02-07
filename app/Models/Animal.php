<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    protected $fillable = ['name', 'age', 'weight', 'description'];


    //Animal va a ser el propietario de la relación 1 a 1 con Owner
    public function owner()
    {
        return $this->hasOne(Owner::class);
    }


    //Esta es la parte secundaria de la relación bidireccional con Vet
    //El "dueño" de la relación es Vet, que tiene el hasMany.
    public function vet()
    {
        return $this->belongsTo(Vet::class);
    }

}
