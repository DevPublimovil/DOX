<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Agenda;
use App\Etiqueta;
use App\User;
use \Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agenda');
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
        $user = Auth::user()->id;

        $horainicio = DB::table('agendas')->where('tipo','publica')->where('title',$request->title)->WhereRaw('? between agendas.start and agendas.end', [$request->start])->exists();
        $horafin = DB::table('agendas')->where('tipo','publica')->where('title',$request->title)->WhereRaw('? between agendas.start and agendas.end', [$request->end])->exists();
        
        if($horainicio ){
            return response()->json(['errormessage' => 'Al parecer alguien más ya tiene un evento a la misma hora de inicio!']);
        }else if($horafin){
            return response()->json(['errormessage' => 'Al parecer alguien más ya tiene un evento a la misma hora fin!']);
        }else{
            $agenda = Agenda::create([
                'start' => $request->start,
                'allDay' => $request->allDay,
                'textColor' => $request->textColor,
                'end' => $request->end,
                'backgroundColor' => $request->backgroundColor,
                'title' => $request->title,
                'user_id' => Auth::user()->id,
                'tipo' => $request->tipo
            ]);
                
            if($agenda){
                return response()->json(['message' => '!El evento se guardo con éxito!'], 200);
            }else{
                return response()->json(['message' => '!Vaya! al parecer tu evento no se guardo, intentalo de nuevo'], 500);
            }
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
        $evento = Agenda::find($id);
        $user = User::find($evento->user_id);
        return response()->json([
            'user' => $user,
            'evento' => $evento
        ]);
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
        $agenda = Agenda::find($id);
        $horainicio = DB::table('agendas')->where('tipo','publica')->where('title',$request->title)->WhereRaw('? between agendas.start and agendas.end', [$request->start])->where('user_id','!=',$agenda->user_id)->get();
        $horafin = DB::table('agendas')->where('tipo','publica')->where('title',$request->title)->WhereRaw('? between agendas.start and agendas.end', [$request->end])->where('user_id','!=',$agenda->user_id)->get();
        
        if(count($horainicio)>0){
            return response()->json(['errormessage' => 'Al parecer alguien más ya tiene un evento a la misma hora de inicio!']);
        }else if(count($horafin)>0){
            return response()->json(['errormessage' => 'Al parecer alguien más ya tiene un evento a la misma hora fin!']);
        }else{
            $user = User::find($agenda->user_id);
            if($user->id == Auth::user()->id){
                $agenda->update([
                    'start' => $request->start,
                    'end' => $request->end,
                    'allDay' => $request->allDay,
                    'backgroundColor' => $request->backgroundColor,
                    'title' => $request->title,
                    'user_id' => Auth::user()->id
                ]);
                return response()->json(200);
            }else{
                return response()->json(500);
            }
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
        $agenda = Agenda::find($id);
        $agenda->delete();

        return response()->json('El evento se eliminó con éxito!');
    }

    public function getAgenda(){
        $user = User::find(Auth::user()->id);
        $etiquetas = Etiqueta::where('user_id', Auth::user()->id)
                ->orWhere('user_id', null)->orderBy('created_at','DESC')->get();
        $agendas = Agenda::where('user_id', Auth::user()->id)->orWhere('tipo', 'publica')->with('user')->get();

        return response()->json([
            'agendas' => $agendas,
            'etiquetas' => $etiquetas,
            'user' => $user
        ]);
    }

    public function deleteEtiqueta($id){
        $etiqueta = Etiqueta::find($id);
        if($etiqueta->tipo == 'publica' || $etiqueta->tipo == 'privada' && Auth::user()->role_id == 4){
            $etiqueta->delete();
            return 200;
        }else if($etiqueta->tipo == 'privada' && Auth::user()->role_id == 3){
            $etiqueta->delete();
            return 200;
        }else{
            return 403;
        }
    }

    public function addEtiqueta(Request $request){
        $etiqueta = Etiqueta::create([
            'descripcion' => $request->descripcion,
            'bgcolor' => $request->bgcolor,
            'textColor' => $request->textcolor,
            'tipo' => $request->tipo,
            'user_id' => ($request->tipo == 'publica') ? null : Auth::user()->id,
        ]);

        return response()->json('¡La etiqueta se agregó con éxito!',200);
    }
}
