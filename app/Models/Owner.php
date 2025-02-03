<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ["name", "phone"];

    public function animal(){
        return $this->belongsTo(Animal::class);
    }
    
}
