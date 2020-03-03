<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DataTables;
use App\Area;
use App\Compania;
use App\Departamento;
use PDF;
use Illuminate\Support\Facades\Mail;

class DirectorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermission('browse_directorio')){
            $contactos = User::orderBy('name','ASC')->with('compania')->where('country_id',Auth::user()->country_id)->get();
            $companias = Compania::where('country_id',Auth::user()->country_id)->get();
            $departamentos = Departamento::orderBy('nombre','ASC')->get();
            return view('directorio.index', compact('contactos','companias','departamentos'));
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
        
     
        return view('directorio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasPermission('browse_directorio')){
            $user = User::find($request->user);
            $contactos = User::where('country_id',Auth::user()->country_id)->with(['compania:id,nombre','departamento:id,nombre'])->orderBy('name', 'ASC')->get();
            $filtered = $contactos->except([64,67,76,21,32,12,68,38,46,7,72,27,23,78,47]);
    
            $pdf = PDF::loadView('contactospdf', [
                'contactos' => $filtered
            ])->setPaper('letter', 'portrait')->save(public_path().'/directorio.pdf');

            $asunto = 'Directorio telefónico';

            Mail::send('emails.contactos',[
                'empleado' => $user,], function($mail) use ($asunto,$user){
                    $mail->from('dox@grupopublimovil.com', 'DOX');
                    $mail->to($user->email);
                    $mail->subject($asunto);
                    $mail->attach(public_path().'/directorio.pdf', [
                        'as' => 'directorio.pdf',
                        'mime' => 'application/pdf',
                    ]);
            });
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
        //
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

    public function listcontactos(){
        if(Auth::user()->hasPermission('browse_directorio')){
            if(Auth::user()->role_id == 4 || Auth::user()->role_id == 1){
                return DataTables::of(User::where('country_id',Auth::user()->country_id)->with(['compania:id,nombre','departamento:id,nombre'])
                ->select('users.*'))->addColumn('opcion', function($row){
                    $editUser = route('users.edit', $row->id);
                    $viewUser = route('users.show', $row->id);

                    return view('partials.actionsuser', compact('editUser','viewUser'));
                })->toJson(200);
            }else if(Auth::user()->role_id == 3){
                $query = User::select('users.*')->where('country_id',Auth::user()->country_id)->with(['compania:id,nombre','departamento:id,nombre'])
                ->get();

                $seleccionados = $query->except([64,67,76,21,32,12,68,38,46,7,72,27,23,78,47]);

                return DataTables::of($seleccionados)->addColumn('opcion', function($row){
                    $editUser = route('users.edit', $row->id);
                    $viewUser = route('users.show', $row->id);

                    return view('partials.actionsuser', compact('editUser','viewUser'));
                })->toJson(200);
            }
        }else{
            abort(403);
        }
    }
}
