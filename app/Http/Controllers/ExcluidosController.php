<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DataTables;
use App\User;
use App\Documento;
use Auth;
use App\Compania;
use App\Tipo;

class ExcluidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermission('browse_excluidos')){
            return view('excluidos.index');
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
        //
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
       if(Auth::user()->hasPermission('edit_excluido')){
        $documento = Documento::find($id)->load('user');
        $user =  User::select('compania_id as compania','id','name')->where('id',$documento->user->id)->first();
        return view('excluidos.edit', compact('documento','user'));
       }else{
           abort(403);
       }
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
        if(Auth::user()->hasPermission('edit_excluido')){
            $documento = Documento::find($id)->load('tipo');
            $empleado = User::find($request->user_id);
            $asunto = 'Nueva correspondencia';

            if($empleado->compania_id == $request->compania_id){
                Mail::send('emails.correspondencia',[
                    'empleado' => $empleado,
                    'documento' => $documento], function($mail) use ($asunto, $empleado){
                        $mail->from('dox@grupopublimovil.com', 'DOX');
                        $mail->to($empleado->email);
                        $mail->subject($asunto);
                });
                $documento->update([
                    'descripcion' => $request->descripcion,
                    'estado' => $request->estado,
                    'user_id' => $request->user_id,
                    'tipo_id' => $request->tipo_id,
                ]);
                return response()->json([
                    'tipo' => 'success',
                    'mensaje' => '¡El empleado ha sido notificado!',
                ]);
            }else{
                return response()->json([
                    'tipo' => 'error',
                    'mensaje' => '¡El empleado no pertence a la compañia seleccionada!',
                ]);
            }
        }else{
            abort(403);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = Documento::find($id);
        $documento->delete();

        return back()->with('status', 'eliminado');
    }

    public function listentregados(){
        if(Auth::user()->hasPermission('browse_excluidos')){
            return DataTables::of(Documento::select('documentos.*')
            ->where('estado',3)->with(['user' => function ($query) {
                $query->where('country_id',Auth::user()->country_id)->with('compania');
            },'tipo'])->orderBy('documentos.created_at','DESC')->get())
            ->addColumn('actions', 'partials.actions')->rawColumns(['actions'])
            ->toJson();
        }else{
            abort(403);
        }
    }
}
