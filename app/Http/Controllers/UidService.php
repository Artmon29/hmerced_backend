<?php
    namespace App\Http\Controllers;
    use Illuminate\Http\Request;
    use App\Models\Paciente;
    class UidService extends Controller
    {
        public function getUid(Request $request)
        {
            // Obtener el uid de la solicitud
            //$rfid = $request->input('rfid');
            // Obtener el uid de la solicitud
            $rfid = $request->input('rfid');

            // Buscar al paciente por el uid
            $paciente = Paciente::where('rfid', $rfid)->first();

            // Devolver el paciente
            return $paciente;
            // Imprimir el uid en la terminal
            //var_dump('UID recibido:', $uid);

            // Devolver el uid
            ////return $rfid;
            // Devolver el uid como un objeto
            /*return (object) [
                'uid' => $uid,
            ];*/
        }
    }
?>
