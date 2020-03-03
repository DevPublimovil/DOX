<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Documento;
use App\User;
use Auth;
use PDF;

class EmailsController extends Controller
{
    public function enviar($id){
       $empleado = User::find($id)->load('compania');
       $correspondencias = Documento::where('user_id', $empleado->id)->where('estado',0)->with('tipo')->get();
       $documentos = Documento::where('user_id', $empleado->id)->where('estado', 0)->update(['estado' => 1]);


       $asunto = 'Nueva correspondencia';

        Mail::send('emails.correspondencia',[
            'empleado' => $empleado,
            'correspondencias' => $correspondencias], function($mail) use ($asunto,$empleado){
                $mail->from('dox@grupopublimovil.com', 'DOX');
                $mail->to($empleado->email);
                $mail->subject($asunto);
        });
    }
}
