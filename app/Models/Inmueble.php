<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble extends Model
{
    protected $table = "inmuebles";
    protected $primaryKey = "idInmueble";
    protected $id = "idInmueble";
    public $timestamps = false;

    protected $fillable = [
        'nombre_inmueble',
        'direccion'
    ];

    public function Usuario(){
        return $this->belongsTo(Usuario::class, "idUsuario");
    }    
}
