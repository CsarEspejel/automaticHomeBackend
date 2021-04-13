<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispositivoUsuario extends Model
{
    protected $table = 'dispositivos_has_usuarios';
    protected $primaryKey = 'id_DU';
    protected $id = 'id_DU';
    public $timestamps = false;

    protected $fillable = [
        'Dispositivos_idDispositivo',
        'Usuarios_idUsuario'
    ];
}
