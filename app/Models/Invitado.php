<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    protected $table = "invitado";
    protected $primaryKey = "idInvitado";
    public $timestamps = false;

    protected $fillable = [
        "name_inv",
        "username_inv",
        "password",
        "idUsuario"
    ];

    public function Usuario(){
        return $this->belongsTo(User::class);
    }
}
