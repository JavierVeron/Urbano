<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoCliente extends Model
{
    use HasFactory;

    protected $table = 'grupo_clientes';
    
    protected $fillable = ['nombre'];

    public function obtenerClientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
