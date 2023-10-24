<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    //constructor de la autenticacion
    public function __construct()
    {
        $this->middleware('auth:api');
    }

//devolver vista
    public function index()
    {
        //return(Paciente::all());//metodoo all mostrados de todos los apacinetes en un array
        $paciente=Paciente::all();
        return response()->json($paciente);
    }


    public function store(Request $request){
        //
        $request->validate([
            'ci' => 'required',
            'nombres' => 'required|string',
            'apellidos'=> 'required|string',
            'direccion'=>'required|string',
            'rfid'=>'required|string',
            'userd_id'=>'integer'
        ]);
        $paciente=Paciente::create([
            'ci' =>$request->ci,
            'nombres' =>$request->nombres,
            'apellidos'=>$request->apellidos,
            'direccion'=>$request->direccion,
            'rfid'=>$request->rfid,
            'user_id'=>$request->user_id
        ]);
        $paciente->save();
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'paciente' => $paciente,

        ]);
    }

    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);

        return response()->json($paciente);
    }
    //
    /* public function edit(){

    } */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ci' => 'required',
            'nombres' => 'required|string',
            'apellidos'=> 'required|string',
            'direccion'=>'required|string',
            'rfid'=>'required|string'
        ]);

        $paciente = Paciente::findOrFail($id);

        $paciente->ci = $request->ci;
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->direccion = $request->direccion;
        $paciente->rfid = $request->rfid;

        $paciente->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Paciente updated successfully',
            'paciente' => $paciente,
        ]);
    }

    //
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);

    $paciente->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Paciente eliminado correctamente',
    ]);

    }
    //lectura y devolucion de tarjeta rfid
    /* public function readRFID($request)
    {
        // Leer el RFID del paciente
        $rfid = $request->input('rfid');

        // Devolver el RFID del paciente
        return response()->json($rfid);
    } */
    public function create()
    {
        //
    }
    public function edit($id)
    {
        //
    }
}
