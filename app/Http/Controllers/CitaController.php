<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitaP;
use App\Models\Paciente;
use App\Models\Especialidad;
use App\Models\Medico;
use Illuminate\Support\Facades\Gate;
class CitaController extends Controller
{
    //constructor de la autenticacion
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $citas=CitaP::all();
        return response()->json($citas); */
        if (! Gate::allows('view-citas')) {
            return abort(403);
        }

        $citas = CitaP::all();

        return view('citas.index', compact('citas'));
    }
    public function citasM(Request $request)
    {
        $espe = $request->input('especialidad_id');
        $pac = $request->input('paciente_id');
        $medic = $request->input('medico_id');
        //busqueda
        /* $datosEspe = Especialidad::where('espacialidad_id', $espe)->get();
        $datosPac = Paciente::where('paciente_id', $pac)->get();
        $datosMedi = Medico::where('medico_id', $medic)->get(); */

        $datosEspe = Especialidad::where('id', $espe)->first();
        $datosPac = Paciente::where('id', $pac)->first();
        $datosMedi = Medico::where('id', $medic)->first();
        return response()->json([
            'espe'=>$datosEspe->nombres,
            'paci'=>$datosPac->ci,
            'paci2'=>$datosPac->nombres,
            'paci3'=>$datosPac->apellidos,
            'medic'=>$datosMedi->nombres,
        ]);
    }
    public function citasM2(Request $request)
        {
            $espe = $request->input('especialidad_id');
            $pac = $request->input('paciente_id');
            $medic = $request->input('medico_id');
            //busqueda
            /* $datosEspe = Especialidad::where('espacialidad_id', $espe)->get();
            $datosPac = Paciente::where('paciente_id', $pac)->get();
            $datosMedi = Medico::where('medico_id', $medic)->get(); */

            $datosEspe = Especialidad::where('id', $espe)->first();
            $datosPac = Paciente::where('id', $pac)->first();
            $datosMedi = Medico::where('id', $medic)->first();
            return response()->json([
                'espe'=>$datosEspe->nombres,
                'paci'=>$datosPac->ci,
                'paci2'=>$datosPac->nombres,
                'paci3'=>$datosPac->apellidos,
                'medic'=>$datosMedi->nombres,
            ]);
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
    public function verP(Request $request)
    {
        // Obtiene el uid del paciente
        $id = $request->input('especialidad_id');

        // Busca el paciente con el uid
        $paciente = Especialidad::where('id', $id)->first();

        // Devuelve el paciente
        return response()->json($paciente);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datos=$request->json();
        // Convertir la instancia de InputBag a una instancia de Request
        $request = new Request($request->request->all());
        // Validar los datos recibidos en la solicitud
        $this->validate($request, [
            'fecha' => 'required',
            'hora' => 'required',
            'especialidad_id' => 'required',
            'paciente_id' => 'required',
            'medico_id' => 'required'
        ]);
        //return response()->json($datos);
        // Crear una nueva cita
        $cita = new CitaP([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'especialidad_id' => $request->especialidad_id,
            'paciente_id' => $request->paciente_id,
            'medico_id' => $request->medico_id
        ]);

        // Guardar la cita en la base de datos
        $cita->save();
        //$paciente =Paciente::find($cita->paciente_id);
        return response()->json([
            'status' => 'success',
            'message' => 'Cita creada EXITOSAMENTE',
            'cita' => $cita
            /* 'paciente'=>$paciente->only('rfid','nombres','apellidos') */
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
        $cita = CitaP::findOrFail($id);
        return response()->json($cita);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
        {
        // Obtener la cita
        $cita = CitaP::findOrFail($id);

        // Pasar la cita al componente Vue
        return response()->json($cita);
        }


    public function citadatos(Request $request){
        // Obtener el CI del paciente
        // Comprobar que los datos de la cita son válidos
        /* if (!$request->has('medico') || !$request->has('especialidad') || !$request->has('paciente_id') || !$request->has('fecha') || !$request->has('hora')) {
            return response()->json([
            'success' => false,
            'message' => 'Los datos de la cita son inválidos',
            ], 400);
        } */
        $fecha = $request->input('fecha');
        $hora = $request->input('fecha');
        $especialidad = $request->input('especialidad');
        $medico = $request->input('medico');
        $paciente = $request->input('paciente_id');
        // Realizar la consulta a la base de datos
        $espe = Especialidad::where('nombres', $especialidad)->first();
        $medic = Medico::where('nombres', $medico)->first();
        $espe=$espe->id;
        $medic=$medic->id;
        return response()->json([
            'fecha'=>$fecha,
            'hora'=>$hora,
            'espe'=>$espe->id,
            'medic'=>$medic->id,
            'paciente_id'=>$paciente
        ]);
        // Crear la cita
        /* $cita = new CitaP();
        $cita->fecha = $fecha->get('fecha');
        $cita->hora = $hora->get('hora');
        $cita->especialidad = $espe->get('especialidad');
        $cita->paciente_id = $paciente->get('paciente_id');
        $cita->medico = $medic->get('medico_id');
        $cita->save();
         */
        // Devolver el ID del paciente
        //eturn response()->json($paciente->id);
        // Devolver la respuesta
        return response()->json([
            'success' => true,
            'message' => 'La cita se creó correctamente',
        ], 201);
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
        //
        $request->validate([
            'fecha' => 'required',
            'hora' => 'required',
            'especialidad_id' => 'required',
            'paciente_id' => 'required',
            'medico_id' => 'required'
        ]);

        $cita = CitaP::findOrFail($id);

        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->especialidad_id = $request->especialidad_id;
        $cita->paciente_id = $request->paciente_id;
        $cita->medico_id = $request->medico_id;

        $cita->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Cita updated successfully',
            'cita' => $cita,
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
        $cita = CitaP::findOrFail($id);

        $cita->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cita deleted successfully',
        ]);
    }
}
