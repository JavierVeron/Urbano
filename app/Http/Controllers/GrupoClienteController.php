<?php

namespace App\Http\Controllers;

use App\Models\GrupoCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class GrupoClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupo_cliente = GrupoCliente::all();
        Log::info("Se accedieron a todos los registros de la tabla 'grupo_clientes'");
        
        return response()->json(["status" => "ok", "data" => $grupo_cliente]);  
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
        $validate_data = Validator::make($request->all(), ["nombre" => "required|unique:grupo_clientes|max:255"]);

        if ($validate_data->fails()) {
            Log::error("No superó la validación del campo 'GrupoCliente::nombre' el valor: " .$request->nombre);

            return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Nombre!"]);
        }

        $grupo_cliente = new GrupoCliente();
        $grupo_cliente->nombre = $request->nombre;
        $grupo_cliente->save();
        Log::info("Se agregó en la tabla 'grupo_clientes' el registro: #" .$grupo_cliente->id);
        
        return response()->json(["status" => "ok", "message" => "El Grupo de Cliente se ha almacenado correctamente!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grupo_cliente = GrupoCliente::find($id);

        if ($grupo_cliente) {
            Log::info("Se accedió al Grupo de Cliente: #" .$id);

            return response()->json(["status" => "ok", "data" => $grupo_cliente]);
        }

        Log::error("No existe el Grupo de Cliente: #" .$id);

        return response()->json(["status" => "error", "message" => "Error! El Grupo de Cliente no existe!"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GrupoCliente  $grupoCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(GrupoCliente $grupoCliente)
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
        if ($id > 1) {
            $grupo_cliente = GrupoCliente::find($id);

            if (!$grupo_cliente) {
                Log::error("No existe el Grupo de Cliente: #" .$id);
                
                return response()->json(["status" => "error", "message" => "Error! El Grupo de Cliente no existe!"]);
            }

            $validate_data = Validator::make($request->all(), ["nombre" => "required|unique:grupo_clientes|max:255"]);

            if ($validate_data->fails()) {
                Log::error("No superó la validación del campo 'GrupoCliente::nombre' con el valor: " .$request->nombre);

                return response()->json(["status" => "error", "message" => "Ingrese correctamente un valor para el Campo Nombre!"]);
            }

            $grupo_cliente->nombre = $request->nombre;
            $grupo_cliente->save();
            Log::info("Se actualizó en la tabla 'grupo_clientes' el registro: #" .$id);

            return response()->json(["status" => "ok", "message" => "El Grupo de Cliente se ha actualizado correctamente!"]);
        }

        Log::error("No se puede actualizar el Grupo de Cliente: #" .$id);

        return response()->json(["status" => "error", "message" => "Error! No se puede actualizar el Grupo de Cliente!"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id > 1) {
            $grupo_cliente = GrupoCliente::find($id);

            if (!$grupo_cliente) {
                Log::error("No existe el Grupo de Cliente: #" .$id);

                return response()->json(["status" => "error", "message" => "Error! El Grupo de Cliente no existe!"]);
            }

            $grupo_cliente->obtenerClientes()->update(['grupo_cliente_id' => 1]);
            $grupo_cliente->delete();
            Log::info("Se eliminó de la tabla 'grupo_clientes' el registro: #" .$id);

            return response()->json(["status" => "ok", "message" => "El Grupo de Cliente se ha eliminado correctamente!"]);
        }

        Log::error("No se puede eliminar el Grupo de Cliente: #" .$id);

        return response()->json(["status" => "error", "message" => "Error! No se puede eliminar el Grupo de Cliente!"]);
    }

    /**
     * Busca los Grupo de Clientes a partir de un texto de búsqueda.
     *
     * @param  string $value
     * @return \Illuminate\Http\Response
     */
    public function buscar($value)
    {
        $grupo_cliente = GrupoCliente::where('nombre', 'LIKE', '%' .$value .'%')->get();

        if ($grupo_cliente->count() > 0) {
            Log::info("Se buscó al Grupo de Cliente con el valor: " .$value);

            return response()->json(["status" => "ok", "data" => $grupo_cliente]);
        }

        Log::error("No existe el Grupo de Cliente con el valor: " .$value);
        
        return response()->json(["status" => "error", "message" => "Error! El Grupo de Cliente ingresado no existe!"]);
    }
}
