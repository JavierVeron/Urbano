<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::obtenerClientes();
        Log::info("Se accedieron a todos los registros de la tabla 'clientes'");
        
        return response()->json(["status" => "ok", "data" => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = Validator::make($request->all(), ["nombre" => "required|max:255"]);

        if ($validate_data->fails()) {
            Log::error("No superó la validación del campo 'Cliente::nombre' el valor: " .$request->nombre);

            return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Nombre!"]);
        }

        $validate_data = Validator::make($request->all(), ["email" => "required|email|max:255"]);

        if ($validate_data->fails()) {
            Log::error("No superó la validación del campo 'Cliente::email' el valor: " .$request->email);

            return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Email!"]);
        }

        $validate_data = Validator::make($request->all(), ["grupo_cliente_id" => "required"]);

        if ($validate_data->fails()) {
            Log::error("No superó la validación del campo 'Cliente::grupo_cliente_id' el valor: " .$request->grupo_cliente_id);

            return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Grupo Cliente!"]);
        }

        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = (is_null($request->apellido) ? "" : $request->apellido);
        $cliente->email = $request->email;
        $cliente->observaciones = ($request->observaciones == "" ? "" : $request->observaciones);
        $cliente->grupo_cliente_id = $request->grupo_cliente_id;
        $cliente->save();
        Log::info("Se agregó en la tabla 'clientes' el registro: #" .$cliente->id);
        
        return response()->json(["status" => "ok", "message" => "El Cliente se ha almacenado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        if ($cliente) {
            Log::info("Se accedió al Cliente: #" .$id);

            return response()->json(["status" => "ok", "data" => $cliente]);
        }

        Log::error("No existe el Cliente: #" .$id);

        return response()->json(["status" => "error", "message" => "Error! El Cliente no existe!"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            Log::error("No existe el Cliente: #" .$id);

            return response()->json(["status" => "error", "message" => "Error! El Cliente no existe!"]);
        }

        $validate_data = Validator::make($request->all(), ["nombre" => "required|max:255"]);

        if ($validate_data->fails()) {
            Log::error("No superó la validación del campo 'Cliente::nombre' con el valor: " .$request->nombre);

            return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Nombre!"]);
        }

        $validate_data = Validator::make($request->all(), ["email" => "required|email|max:255"]);

        if ($validate_data->fails()) {
            Log::error("No superó la validación del campo 'Cliente::email' con el valor: " .$request->email);

            return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Email!"]);
        }

        $validate_data = Validator::make($request->all(), ["grupo_cliente_id" => "required"]);

        if ($validate_data->fails()) {
            Log::error("No superó la validación del campo 'Cliente::grupo_cliente_id' con el valor: " .$request->grupo_cliente_id);

            return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Grupo Cliente!"]);
        }

        $cliente->nombre = $request->nombre;
        $cliente->apellido = (is_null($request->apellido) ? "" : $request->apellido);
        $cliente->email = $request->email;
        $cliente->observaciones = (is_null($request->observaciones) ? "" : $request->observaciones);
        $cliente->grupo_cliente_id = $request->grupo_cliente_id;
        $cliente->save();
        Log::info("Se actualizó en la tabla 'clientes' el registro: #" .$id);
        
        return response()->json(["status" => "ok", "message" => "El Cliente se ha actualizado correctamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            Log::error("No existe el Cliente: #" .$id);

            return response()->json(["status" => "error", "message" => "Error! El Cliente no existe!"]);
        }

        $cliente->delete();
        Log::info("Se eliminó de la tabla 'clientes' el registro: #" .$id);

        return response()->json(["status" => "ok", "message" => "El Cliente se ha eliminado correctamente!"]);
    }

    /**
     * Busca los Clientes a partir de un texto de búsqueda.
     *
     * @param  string $value
     * @return \Illuminate\Http\Response
     */
    public function buscar($value)
    {
        $clientes = Cliente::buscarClientes($value);

        if ($clientes->count() > 0) {
            Log::info("Se buscó el Cliente con el valor: " .$value);

            return response()->json(["status" => "ok", "data" => $clientes]);
        }

        Log::error("No existe el Cliente con el valor: " .$value);
        
        return response()->json(["status" => "error", "message" => "Error! El Cliente ingresado no existe!"]);
    }

    /**
     * Obtener los Clientes de un determinado Grupo de Cliente.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function filtrar($id)
    {
        $clientes = Cliente::filtrarClientes($id);

        if ($clientes->count() > 0) {
            Log::info("Se filtraron los Clientes por el Grupo de Cliente: #" .$id);
        
            return response()->json(["status" => "ok", "data" => $clientes]);
        }

        Log::error("No existe el Grupo de Cliente: #" .$id);

        return response()->json(["status" => "error", "message" => "Error! El Grupo de Cliente no existe!"]);
    }
}
