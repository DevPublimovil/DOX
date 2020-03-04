<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Documento;
use Auth;
use DataTables;
use App\User;
use Illuminate\Support\Facades\Mail;

class DocumentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       if(Auth::user()->hasPermission('browse_home')){
        $documentos = Documento::where('estado',0)->orWhere('estado',1)->with(['user' => function ($query) {
            $query->where('country_id',Auth::user()->country_id)->with('compania');
        },'tipo'])->orderBy('documentos.created_at','DESC')->get();

        return $documentos;
       }else{
           abort(403);
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentos = Documento::where('estado',0)->orWhere('estado',1)->with('tipo')->orderBy('created_at','DESC')->get();
        return view('empleadoindex', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermission('browse_home')){
            $documento = Documento::firstOrCreate($request->all());
            return $documento;
        }else{
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $documento = Documento::find($id);
        $user = User::find($documento->user_id);
        $recepcionista = User::where('role_id',4)->where('country_id',$user->country_id)->first();

        $asunto = "!Correspondencia rechazada por " . $user->name . "!";
        $motivo = $request->description;
        
        Mail::send('emails.resumecorrespondencia', [
            'documento' => $documento,
            'motivo' => $motivo], function($mail) use ($asunto,$recepcionista){
                $mail->from('dox@grupopublimovil.com', 'DOX');
                $mail->to($recepcionista->email);
                $mail->subject($asunto);
            });
            
        $documento->update(['estado' => 3]);
        return back()->with('status','¡La correspondencia ha sido rechazada!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
