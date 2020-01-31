<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Documento;
use App\User;

class EmailsController extends Controller
{
    public function enviar($id){
       $empleado = User::find($id);

       $documentos = Documento::where('user_id', $empleado->id)->where('estado', 0)->update(['estado' => 1]);
       $correspondencias = Documento::where('user_id', $empleado->id)->get();

       return $correspondencias;
       /*  Mail::send('emails.notificacion',[
            'usuario' => $usuario,
            'empresa' => $empresa, 
            'pais' => $pais,
            'contenido' => $contenido], function($mail) use ($asunto){
                $mail->from(Auth::user()->email, 'Mediacam');
                $mail->to('mediacam@grupopublimovil.com');
                $mail->subject($asunto);

        }); */
    }
}
