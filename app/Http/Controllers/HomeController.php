<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\Documento;
use App\Compania;
use App\Tipo;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $excluidos = Documento::where('estado',3)->count();
       if(Auth::user()->hasPermission('browse_home')){
        $companias =  Compania::where('country_id', Auth::user()->country_id)->orderBy('nombre','ASC')->get();
        $empleados = User::select('id','name','compania_id as compania')->where('role_id',3)->where('country_id',Auth::user()->country_id)->orderBy('name','ASC')->get();
        $tipos =    Tipo::orderBy('created_at','DESC')->get();

        return view('home', compact('companias','empleados','tipos','excluidos'));
       }else{
        return redirect()->route('documentos.create');
       }
    }

    public function arraysSystem(){
        $companias =  Compania::where('country_id', Auth::user()->country_id)->orderBy('nombre','ASC')->get();
        $empleados = User::select('id','name','compania_id as compania')->where('role_id',3)->where('country_id',Auth::user()->country_id)->orderBy('name','ASC')->get();
        $tipos =    Tipo::orderBy('nombre','ASC')->get();

        return response()->json([
            'companias' => $companias,
            'empleados' => $empleados,
            'tipos' => $tipos
        ]);
    }

}
