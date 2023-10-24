<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CitaP;
use App\Models\Paciente;
class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas=CitaP::all();
        return response()->json($citas);
        /* $citas = CitaP::join('especialidads', 'citas_p_s.especialidad_id', '=', 'especialidads.id')
            ->join('pacientes', 'citas_p_s.paciente_id', '=', 'pacientes.id')
            ->join('medicos', 'citas_p_s.medico_id', '=', 'medicos.id')
            ->select('citas_p_s.fecha','citas_p_s.hora', 'especialidads.nombres', 'pacientes.nombres', 'medicos.nombres')
            ->get();

        return response()->json($citas); */
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
        //$datos=$request->json();
        // Convertir la instancia de InputBag a una instancia de Request
        $request = new Request($request->request->all());
        // Validar los datos recibidos en la solicitud
        $this->validate($request, [
            'fecha' => 'required|date',
            'hora' => 'required',
            'especialidad_id' => 'required|integer',
            'paciente_id' => 'required|integer',
            'medico_id' => 'required|integer'
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
        $paciente =Paciente::find($cita->paciente_id);
        return response()->json([
            'status' => 'success',
            'message' => 'Cita creada EXITOSAMENTE',
            'cita' => $cita,
            'paciente'=>$paciente->only('rfid','nombres','apellidos')
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
    public function edit($id)
    {
        //
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
            'fecha' => 'required|date',
            'hora' => 'required|time',
            'especialidad_id' => 'required|integer|exists:especialidads,id',
            'paciente_id' => 'required|integer|exists:pacientes,id',
            'medico_id' => 'required|integer|exists:medicos,id'
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
