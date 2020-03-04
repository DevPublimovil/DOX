<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use DataTables;
use Auth;
use App\Compania;
use App\Departamento;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermission('browse_directorio')){
            $companias = Compania::where('country_id',Auth::user()->country_id)->get();
            $departamentos = Departamento::orderBy('nombre','ASC')->get();

            return view('users.index', compact('companias','departamentos'));
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
    public function store(UserStoreRequest $request)
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
        if(Auth::user()->hasPermission('show_user')){
            $user = User::find($id)->load(['compania','departamento']);
            return view('users.show', compact('user'));
        }else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasPermission('edit_user')){
            $companias = Compania::where('country_id',Auth::user()->country_id)->get();
            $departamentos = Departamento::orderBy('nombre','ASC')->get();
            $user = User::find($id);

            return view('users.edit', compact('user','companias','departamentos'));
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
    public function update(UserUpdateRequest $request, $id)
    {
        if(Auth::user()->hasPermission('edit_user')){
            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'cargo' => $request->cargo,
                'telefono' => $request->telefono,
                'compania_id' => $request->compania_id,
                'departamento_id' => $request->departamento_id
            ]);

            return redirect()->route('contactos.index')->with('info', 'El empleado ha sido actualizado correctamente');
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
        //
    }

}
