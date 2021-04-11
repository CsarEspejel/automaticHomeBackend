<?php

namespace App\Http\Controllers;

use App\Models\Inmueble;
use Illuminate\Http\Request;

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
        $inmuebles = Inmueble::all()->where('idUsuario', '=', $user->idUsuario);

        return response()->json([
            'usersazo' => $user,
            'inmuebles' => $inmuebles
        ]);
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
        $request->validate([
            'nombre_inmueble' => 'required|string',
            'direccion' => 'required|string'
        ]);

        Inmueble::create([
            'nombre_inmueble' => $request->nombre_inmueble,
            'direccion' => $request->direccion,
            'idUsuario' => $request->idUsuario
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
        $inmu = Inmueble::findOrFail($inmueble->idInmueble);
        $user = $request->user();
        // return response()->json([
        //     'inmu idusuario' => $inmu->idUsuario,
        //     'user idusuario' => $user->idUsuario,
        // ]);
        if ($inmu->idUsuario === $user->idUsuario) {
            $response = $inmu->delete();
            if ($response === true) {
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
}
