<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    protected $fillable = ['name', 'age', 'weight', 'description'];

    //private Vet $vet;
    public function vet()
    {
        return $this->belongsTo(Vet::class);
    }

    //Animal va a ser el propietario de la relación 1 a 1 con Owner
    public function owner()
    {
        return $this->hasOne(Owner::class);
    }
}
