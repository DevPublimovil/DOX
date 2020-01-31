<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $tipo = 'recibo de anda';
        $detalles = 'HTML Reference
        CSS Reference
        JavaScript Reference
        SQL Reference
        Python Reference
        W3.CSS Reference
        Bootstrap Reference
        PHP Reference
        HTML Colors
        jQuery Reference
        Java Reference
        Angular Reference';
         return view('emails.correspondencia', compact('tipo','detalles'));
        /* $flight = Flight::firstOrCreate(['number'=>560,'status'=>'no-active']); */
        /* $flight = Flight::updateOrCreate(
            ['number' => 570],
            ['status'=>'valio']
        ); */

        /* $flights = Flight::all();
        return $flights; */
        /* $model = App\Flight::where('legs', '>', 100)
            ->firstOr(['id', 'legs'], function () {
                // ...
            }); */
        /* $model = Flight::where('id', '>', 4)->firstOr(function () {
            return 'no se encontro';
        }); */

        
        // $flight = App\Flight::firstWhere('active', 1);
        /* return Destination::orderByDesc(
            Flight::select('arrived_at')
                ->whereColumn('destination_id', 'destinations.id')
                ->orderBy('arrived_at', 'desc')
                ->limit(1)
        )->get(); */
       /*  $fligts = Flight::cursor()->filter(function ($fligt) {
            return $fligt->number > 500;
        });

        return $fligts; */
        /* $cosas = array();
        foreach (Flight::where('status', 'active')->cursor() as $flight) {
            array_push($cosas, $flight);
        }

        return $cosas; */

       
        /* $flights = Flight::all();

        $numbers = $flights->reject(function ($number) {
            return  $number->status === 'no-activo';
        })->map(function($user){
            return $user;
        }); */
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
}
