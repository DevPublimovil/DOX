<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use App\User;
use App\Tipo;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;


class ApiDocumentosController extends Controller
{
    public function listdocuments(){
        $documentos = Documento::select('documentos.id','documentos.descripcion','tipos.nombre')
            ->join('tipos','tipos.id','documentos.tipo_id')->where('estado',1)->where('user_id', Auth::user()->id)->get();
            
        if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4){
            return response()->json('¡Ud no recibe correspondencia!');
        }
        return response()->json(['documentos' => $documentos]);
    }

    public function entregardocuments(Request $request){

        if($request->imagen){
            $image = $request->imagen;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10).'.'.'png';
           \File::put(storage_path(). '/app/public/firmas/' . $imageName, base64_decode($image));
           $cadena = trim($request->documents, "[]");
           $array = explode(',',$cadena);

            foreach ($array as $item) {
                $documento = Documento::find($item);
                $documento->update(['estado' => 2, 'firma' => 'firmas/'. $imageName]);
            }
        }

        $this->envioEmail($array);

        $excluidos = Documento::where('estado',1)->where('user_id', Auth::user()->id)->get();
        foreach ($excluidos as $items) {
           $dox =  Documento::find($items->id);
           $dox->update(['estado' => 3]);
        }



        $request->user()->token()->revoke();
        return response()->json(['message' => 
            'Successfully logged out']);
            
    }

    public function envioEmail($array){
        $empleado = User::find(Auth::user()->id);
        
        foreach ($array as $item) {
            $documento = Documento::find($item);
            $correspondencias[] = $documento;
        }

        $asunto = "Infome de recibo de correspondencias";


        Mail::send('emails.resumecorrespondencia', [
            'empleado' => $empleado,
            'correspondencias' => $correspondencias], function($mail) use ($asunto, $empleado){
                $mail->from('dox@grupopublimovil.com', 'DOX');
                $mail->to($empleado->email);
                $mail->subject($asunto);
            });
    }
}
