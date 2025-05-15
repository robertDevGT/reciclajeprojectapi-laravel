<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'calle',
        'codigo_postal',
        'colonia',
        'ciudad',
        'numero',
    ];
}
