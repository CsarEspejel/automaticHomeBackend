<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioInmueble extends Model
{
    protected $table = 'usuarios_has_inmuebles';
    protected $primaryKey = 'id_UI';
    protected $id = 'id_UI';
    public $timestamps = false;

    protected $fillable = [
        'usuarios_idUsuario',
        'inmuebles_idInmueble'
    ];
}
