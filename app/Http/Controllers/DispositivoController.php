<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use App\Models\DispositivoUsuario as Disu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DispositivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $dispositivo = DB::table('dispositivos_has_usuarios')
                        ->join('dispositivos', 'dispositivos.idDispositivo', '=', 'dispositivos_has_usuarios.Dispositivos_idDispositivo')
                        // ->join('usuarios', 'usuarios.idUsuario', '=', 'usuarios_has_inmuebles.usuarios_idUsuario')
                        ->where('dispositivos_has_usuarios.Usuarios_idUsuario', $user->idUsuario)
                        ->select('dispositivos.idDispositivo', 'dispositivos.nombre_dispositivo', 'dispositivos.descripcion')
                        ->get();

        return response()->json(['data' => $dispositivo]);
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
        $user = $request->user();
        $request->validate([
            'nombre_dispositivo' => 'required|string',
            'descripcion' => 'required|string|max:250'
        ]);

        $dispositivo = Dispositivo::create([
            'nombre_dispositivo' => $request->nombre_dispositivo,
            'descripcion' => $request->descripcion,
        ]);

        Disu::create([
            'Dispositivos_idDispositivo' => $dispositivo->idDispositivo,
            'Usuarios_idUsuario' => $user->idUsuario
        ]);

        return response()->json([
            'success' => 'Dispositivo creado con exito'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function show(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Dispositivo $dispositivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dispositivo $dispositivo)
    {

        // $request->validate([
        //     'nombre_dispositivo' => 'string',
        //     'descripcion' => 'string|max:255'
        // ]);
        // $user = $request->user();
        // $dispo = Disu::select('Dispositivos_idDispositivo')
        //             ->where('Dispositivos_idDispositivo', $dispositivo->idDispositivo)
        //             ->where('Usuarios_idUsuario', $user->idUsuario)
        //             ->get();
        
        // return response()->json([
        //     'user' => $user,
        //     'idDispo' => $dispositivo
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dispositivo  $dispositivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Dispositivo $dispositivo)
    {
        //Encuentra el dispositivo por su ID y retorna la informacion del mismo
        $dispo = Dispositivo::findOrFail($dispositivo->idDispositivo);
        $user = $request->user();
        
        // Elimina el registro de la tabla rompimiento entre usuarios y dispositivos
        $response1 = Disu::select('id_DU')
                    ->where('dispositivos_idDispositivo', $dispo->idDispositivo)
                    ->where('usuarios_idUsuario', $user->idUsuario)
                    ->delete();

        // Elimina el inmueble de la tabla de inmuebles
        $response = $dispo->delete();
        
        if ($response and $response1) {
            return response()->json([
                'success' => 'Se ha eliminado el dispositivo con exito',
            ]);
        }else {
            return response()->json([
                'success' => 'Ha habido un error, intenta de nuevo',
            ]);
        }
    }
}
