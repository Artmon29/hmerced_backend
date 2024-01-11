<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Backup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UidService;
use Carbon\Carbon;
use Axios\Axios;
class RfidController extends Controller
{
    private $uidService;
    public function __construct()
    {
        // Agregar el middleware 'auth:api'
        $this->middleware('auth:api', ['except' => ['index','getPaciente','getDatosPaciente','ultimo']]);

        // Inyectar la clase UidService
    }
    public function index()
    {
        // Obtener el uid de la solicitud HTTP
        $rfid = request()->input('rfid');

        // Consultar el paciente por el uid
        $paciente = Paciente::where('rfid', $rfid)->first();

        // Devolver el paciente
        return $paciente;
    }
    //getpacientezxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    public function getPaciente(Request $request)
    {
        // Obtener el uid de la solicitud
        $rfid = $request->uid;
        // Almacenar el uid en la variable global
        //$_REQUEST['uid'] = $rfid;
        // Buscar al paciente en la base de datos
        $paciente = DB::table('pacientes')->where('rfid', $rfid)->first();

        // Si el paciente existe, devolver sus datos
        if ($paciente) {

            $paciente=Backup::create([
                'ci' =>$paciente->ci,
                'nombres' =>$paciente->nombres,
                'apellidos'=>$paciente->apellidos,
                'rfid'=>$paciente->rfid,
            ]);
            $paciente->save();
            return response()->json([
                'message'=>'sucess',
                'nombres' => $paciente->nombres,
                'apellidos' => $paciente->apellidos,
                'ci' => $paciente->ci,
            ]);
        } else {
            // Si el paciente no existe, devolver un error
            return response()->json([
                'error' => 'El paciente no existe',
                'rfid'=>$rfid
            ]);
        }
    }
    public function ultimo(Request $request)
    {

       /*   // Obtener el último registro de la tabla "backup" que se haya creado en los últimos 5 minutos
        $backup = Backup::whereDate('created_at', '>=', Carbon::now()->subMinutes(5))->latest()->first();
        return response()->json($backup); */
        //
        // Obtener la fecha actual
            $fechaActual = Carbon::now()->format('Y-m-d');

            // Consultar si existe un registro para el día actual
            $backup = Backup::whereDate('created_at', '=', $fechaActual)->first();

            // Devolver la respuesta
            if ($backup) {
                return response()->json([
                'data' => $backup,
                'existe' => true,
                ]);
            } else {
                return response()->json([
                'existe' => false,
                ]);
            }
    }
    //////////////////////////////////////////prueba
    public function ultimo2(Request $request)
    {

       /*   // Obtener el último registro de la tabla "backup" que se haya creado en los últimos 5 minutos
        $backup = Backup::whereDate('created_at', '>=', Carbon::now()->subMinutes(5))->latest()->first();
        return response()->json($backup); */
        //
        // Obtener la fecha actual
            //$fechaActual = Carbon::now()->format('Y-m-d');

            // Consultar si existe un registro para el día actual
           // $backup = Backup::whereDate('created_at', '=', $fechaActual)->first();
            $backup = Backup::latest()->first();
                //return response()->json($backup)
            // Devolver la respuesta
            if ($backup) {
                return response()->json([
                'data' => $backup,
                'existe' => true,
                ]);
            } else {
                return response()->json([
                'existe' => false,
                ]);
            }
    }
}
