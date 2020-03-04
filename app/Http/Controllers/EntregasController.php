<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\User;
use App\Documento;
use Auth;

class EntregasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasPermission('browse_home')){
            return view('entregas.index');
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
        if(Auth::user()->hasPermission('browse_home')){
            $documento = Documento::find($id)->load(['tipo','user']);

            return view('entregas.show',compact('documento'));
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

    public function listEntregas(){
         if(Auth::user()->hasPermission('browse_home')){
            return DataTables::of(Documento::where('estado',2)->with(['user' => function ($query) {
                $query->where('country_id',Auth::user()->country_id)->with('compania');
            },'tipo'])->orderBy('documentos.updated_at','DESC'))
            ->addColumn('firma', function($row){
                $firma = $row->firma;
                return view('partials.firmasentrega', compact('firma'));
            })->make(true);
         }else{
             abort(403);
         }
    }
}
