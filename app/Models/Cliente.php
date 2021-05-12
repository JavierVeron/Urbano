<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = ['nombre', 'email', 'grupo_cliente_id'];

    static function obtenerClientes()
    {
        $clientes = DB::table("clientes")
                    ->join("grupo_clientes", "clientes.grupo_cliente_id", "=", "grupo_clientes.id")
                    ->select("clientes.id", "clientes.nombre", "clientes.apellido", "clientes.email", "grupo_clientes.nombre as grupo_cliente_nombre")
                    ->get();
        
        return $clientes;
    }

    static function buscarClientes($value)
    {
        $clientes = DB::table("clientes")
                    ->join("grupo_clientes", "clientes.grupo_cliente_id", "=", "grupo_clientes.id")
                    ->select("clientes.id", "clientes.nombre", "clientes.apellido", "clientes.email", "grupo_clientes.nombre as grupo_cliente_nombre")
                    ->where('clientes.nombre', 'LIKE', '%' .$value .'%')
                    ->orWhere('clientes.apellido', 'LIKE', '%' .$value .'%')
                    ->orWhere('clientes.email', 'LIKE', '%' .$value .'%')
                    ->get();
        
        return $clientes;
    }

    static function filtrarClientes($id)
    {
        $clientes = DB::table("clientes")
                    ->join("grupo_clientes", "clientes.grupo_cliente_id", "=", "grupo_clientes.id")
                    ->select("clientes.id", "clientes.nombre", "clientes.apellido", "clientes.email", "grupo_clientes.nombre as grupo_cliente_nombre")
                    ->where('clientes.grupo_cliente_id', $id)
                    ->get();
        
        return $clientes;
    }
}
