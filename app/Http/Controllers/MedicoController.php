<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Models\Medico;
//use App
class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        /* $this->middleware('permission'); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (Medico::all());
    }
    public function verP(Request $request)
    {
        // Obtiene el uid del paciente
        $id = $request->input('medico_id');

        // Busca el paciente con el uid
        $paciente = Medico::where('id', $id)->first();

        // Devuelve el paciente
        return response()->json($paciente);
    }
    //
    public function obtenerMedico(Request $request) {
        // Obtener el CI del paciente
        $nombre = $request->input('nombre');

        // Realizar la consulta a la base de datos
        $paciente = Medico::where('nombres', $nombre)->first();

        // Devolver el ID del paciente
        return response()->json($paciente->id);
    }
    public function obtenerespe(Request $request) {
        // Obtener el CI del paciente
        $nombre = $request->input('nombre');

        // Realizar la consulta a la base de datos
        $paciente = Especialidad::where('nombres', $nombre)->first();

        // Devolver el ID del paciente
        return response()->json($paciente->id);
    }
    public function espe()
    {
        return (Especialidad::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEsp(Request $request)
    {
        //
        $request->validate([
            'nombres' => 'required|string',
            'descripcion' => 'required|string',

            /* 'user_id' => 'required|integer|exists:users,id' */
        ]);

        $medico = new Especialidad([
            'nombres' => $request->nombres,
            'descripcion' => $request->apellidos,
        ]);

        $medico->save();

        return response()->json($medico);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'ci' => 'required|integer',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|integer',
            'especialidad_id' => 'required|integer',
            'user_id' => 'required|integer'
            /* 'user_id' => 'required|integer|exists:users,id' */
        ]);

        $medico = new Medico([
            'ci' => $request->ci,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'especialidad_id' => $request->especialidad_id,
            'user_id' => $request->user_id
        ]);

        $medico->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Medico created successfully',
            'medico' => $medico,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medico = Medico::findOrFail($id);

        return response()->json($medico);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ci' => 'required|integer',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|integer',
            'especialidad_id' => 'required|integer|exists:especialidads,id',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $medico = Medico::findOrFail($id);

        $medico->ci = $request->ci;
        $medico->nombres = $request->nombres;
        $medico->apellidos = $request->apellidos;
        $medico->direccion = $request->direccion;
        $medico->email = $request->email;
        $medico->telefono = $request->telefono;
        $medico->especialidad_id = $request->especialidad_id;
        $medico->user_id = $request->user_id;

        $medico->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Medico updated successfully',
            'medico' => $medico,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);

        $medico->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Medico deleted successfully',
        ]);
    }
}
