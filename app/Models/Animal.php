<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //
    protected $fillable = ['name', 'age', 'weight', 'description'];
}
