<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $primaryKey ='idmodelo';
    protected $fillable = [
        'modelo','descripcion'
    ];    
}
