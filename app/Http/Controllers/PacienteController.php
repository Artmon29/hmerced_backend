<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Especialidad;
class PacienteController extends Controller
{
    //constructor de la autenticacion
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /* public function buscarPorCi(Request $request)
    {
        // Obtén el número de cédula del request
        $ci = $request->query('ci');

        // Busca al paciente por su número de cédula
        $paciente = Paciente::where('ci', $ci)->first();

        if ($paciente) {
            // Si se encuentra el paciente, devuelve sus datos
            return response()->json($paciente);
        } else {
            // Si el paciente no se encuentra, devuelve una respuesta vacía o un mensaje de error
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
    } */
    public function buscarPorCi($ci)
    {
        // Busca al paciente por su número de cédula
        $paciente = Paciente::where('ci', $ci)->first();

        if ($paciente) {
            // Si se encuentra el paciente, devuelve sus datos
            return response()->json($paciente->id);
        } else {
            // Si el paciente no se encuentra, devuelve una respuesta vacía o un mensaje de error
            return response()->json(['message' => 'Paciente no encontrado'], 404);
        }
    }
//devolver vista
    public function obtenerIdPaciente(Request $request) {
        // Obtener el CI del paciente
        $ci = $request->input('ci');

        // Realizar la consulta a la base de datos
        $paciente = Paciente::where('ci', $ci)->first();

        // Devolver el ID del paciente
        return response()->json($paciente->id);
    }

    public function index(Request $request)
    {
        //return(Paciente::all());//metodoo all mostrados de todos los apacinetes en un array
        /* $paciente=Paciente::all();
        return response()->json($paciente); */
        $pacientes = Paciente::all();

        $token = $request->bearerToken();

        $headers = [
            'Authorization' => 'Bearer ' . $token,
        ];

        return response()->json($pacientes, 200, $headers);
    }


    public function store(Request $request){
        //
        $request->validate([
            'ci' => 'required',
            'nombres' => 'required|string',
            'apellidos'=> 'required|string',
            'direccion'=>'required|string',
            'rfid'=>'required|string',
            'user_id'=>'integer'
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

    public function show(Request $request)
    {
        // Obtiene el uid del paciente
        $uid = $request->get('uid');

        // Busca el paciente con el uid
        $paciente = Paciente::where('rfid', $uid)->first();

        // Devuelve el paciente
        return $paciente;
    }
    public function verP(Request $request)
    {
        // Obtiene el uid del paciente
        $id = $request->input('paciente_id');

        // Busca el paciente con el uid
        $paciente = Paciente::where('id', $id)->first();

        // Devuelve el paciente
        return response()->json($paciente);
    }
    public function verP2(Request $request)
    {
        $id = $request->paciente_id;

        // Busca el paciente con el uid
        $paciente = Paciente::where('id', $id)->first();

        // Devuelve el paciente
        return response()->json($paciente);
    }
    public function verP3(Request $request)
    {
        $id = $request->especialidad_id;

        // Busca el paciente con el uid
        $paciente = Especialidad::where('id', $id)->first();

        // Devuelve el paciente
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
