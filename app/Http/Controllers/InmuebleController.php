<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use App\Models\UsuarioInmueble as Usin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $inmuebles = DB::table('usuarios_has_inmuebles')
                        ->join('inmuebles', 'inmuebles.idInmueble', '=', 'usuarios_has_inmuebles.inmuebles_idInmueble')
                        // ->join('usuarios', 'usuarios.idUsuario', '=', 'usuarios_has_inmuebles.usuarios_idUsuario')
                        ->where('usuarios_has_inmuebles.usuarios_idUsuario', $user->idUsuario)
                        ->select('inmuebles.idInmueble', 'inmuebles.nombre_inmueble', 'inmuebles.direccion')
                        ->get();

        return response()->json(['data' => $inmuebles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'nombre_inmueble' => 'required|string',
            'direccion' => 'required|string'
        ]);

        $inmueble = Inmueble::create([
            'nombre_inmueble' => $request->nombre_inmueble,
            'direccion' => $request->direccion,
        ]);

        Usin::create([
            'usuarios_idUsuario' => $user->idUsuario,
            'inmuebles_idInmueble' => $inmueble->idInmueble
        ]);

        return response()->json([
            'success' => 'Inmueble creado con exito'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function show(Inmueble $inmueble)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function edit(Inmueble $inmueble)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inmueble $inmueble)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inmueble  $inmueble
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Inmueble $inmueble)
    {
        //Encuentra el inmueble por su ID y retorna la informacion del mismo
        $inmu = Inmueble::findOrFail($inmueble->idInmueble);
        $user = $request->user();
        
        // Elimina el registro de la tabla rompimiento entre usuarios e inmuebles
        $response1 = Usin::select('id_UI')
                    ->where('inmuebles_idInmueble', $inmu->idInmueble)
                    ->where('usuarios_idUsuario', $user->idUsuario)
                    ->delete();

        // Elimina el inmueble de la tabla de inmuebles
        $response = $inmu->delete();
        
        if ($response and $response1) {
            return response()->json([
                'success' => 'Se ha eliminado el inmueble con exito',
            ]);
        }else {
            return response()->json([
                'success' => 'Ha habido un error, intenta de nuevo',
            ]);
        }
        
    }
}
