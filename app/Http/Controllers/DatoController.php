<?php

namespace App\Http\Controllers;

use App\Dato;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DatoController extends Controller
{
    public function buscar(Request $request)
    {
        //
        $datos = Dato::all();
        //$datos = Dato::where('nombre','like','%'.$request->q1.'%')->get();
        $data = [];
        $mensaje = "Exito sin Resultado";
    
        foreach($datos as $dato)
        {
            similar_text(request()->q1,$dato->nombre,$porcentaje);
    
            if(round($porcentaje) <= request()->q2){
                $data[] = Arr::add($dato, 'porcentaje',round($porcentaje));
                $mensaje = "Exitoso con Resultados!";
            }
        }
        
        $data= collect($data)->sortByDesc('porcentaje')->values()->all();
        
        return response()->json([
            'datos' => $data,
            'mensaje' => $mensaje
        ]);
    
    }
}
