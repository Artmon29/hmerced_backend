<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalMedico;
class PersonalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|integer',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|integer'
        ]);

        $personalMedico = new PersonalMedico([
            'ci' => $request->ci,
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'direccion' => $request->direccion,
            'email' => $request->email,
            'telefono' => $request->telefono
        ]);

        $personalMedico->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Personal medico created successfully',
            'personalMedico' => $personalMedico,
        ]);
    }

    public function show($id)
    {
        $personalMedico = PersonalMedico::findOrFail($id);

        return response()->json($personalMedico);
    }

    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'ci' => 'required|integer',
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'direccion' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|integer'
        ]);

        $personalMedico = PersonalMedico::findOrFail($id);

        $personalMedico->ci = $request->ci;
        $personalMedico->nombres = $request->nombres;
        $personalMedico->apellidos = $request->apellidos;
        $personalMedico->direccion = $request->direccion;
        $personalMedico->email = $request->email;
        $personalMedico->telefono = $request->telefono;

        $personalMedico->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Personal medico updated successfully',
            'personalMedico' => $personalMedico,
        ]);
    }

    public function destroy($id)
    {
        //
        $personalMedico = PersonalMedico::findOrFail($id);

        $personalMedico->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Personal medico deleted successfully',
        ]);
    }

    public function create()
    {
        //
    }
     public function edit($id)
    {
        //
    }
}
