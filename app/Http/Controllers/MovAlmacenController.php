<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovAlmacen;
class MovAlmacenController extends Controller
{
    
    public function index(){
        $mov_almacen = Devolucion::all();
        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'movAlmacen' => $mov_almacen
        ]);
    }

    public function show($folio){
        $mov_almacen = Devolucion::find($folio);
        if(is_object($mov_almacen)){
            $data = [
                'code' => 200,
                'status' => 'succes',
                'movAlmacen' => $mov_almacen
            ];            
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Movimiento no existe'
            ];
        }

        return response() ->json($data, $data['code']);
    }

    public function store(Request $request){
        $json = $request -> input('datos', null);
        $params_array = json_decode($json, true);
        

        $movAlmancen = new MovAlmacen();
        $movAlmacen -> fecha = $params_array['fecha'];
        $movAlmacen -> empleado = $params_array['empleado'];
        $movAlmacen -> tipo = $params_array['tipo'];
        $movAlmacen -> motivo = $params_array['motivo'];
        $mov_almacen ->save();

    }
}
