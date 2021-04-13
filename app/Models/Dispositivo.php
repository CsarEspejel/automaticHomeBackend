<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    protected $table = 'dispositivos';
    protected $primaryKey = 'idDispositivo';
    protected $id = 'id_Dispositivo';
    public $timestamps = false;

    protected $fillable = [
        'nombre_dispositivo',
        'descripcion'
    ];
}
