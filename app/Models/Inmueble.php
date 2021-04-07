<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    private $table = "inmuebles";
    private $primaryKey = "idInmueble";
    public $timestamps = false;

    protected $fillable = [
        'nombre_inmueble',
        'direccion',
        'idUsuario'
    ];

    public function usuario(){
        return $this->hasOne(Usuario::class, "idUsuario");
    }    
}
