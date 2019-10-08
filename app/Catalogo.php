<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    //
    protected $primaryKey ='idcategoria';
    protected $fillable = [
        'idcategoria','nombre'
    ]; 
}
