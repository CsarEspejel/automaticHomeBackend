<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primary_key = 'idRol';
    public $timestamps = false;

    protected $fillable = [
        'nombre_rol'
    ];

    public function Usuarios(){
        return $this->belongsTo(User::class);
    }
}
