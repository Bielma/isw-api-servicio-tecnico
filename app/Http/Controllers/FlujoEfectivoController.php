<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FlujoEfectivo;
class FlujoEfectivoController extends Controller
{
    function store(Request $request){
        $json = $request ->input('datos', null);
        $params_array = json_decode($json, true);

        $flujoEfectivo = new FlujoEfectivo();
        $flujoEfectivo ->fecha = $params_array['fecha'];
        $flujoEfectivo ->hora = $params_array['hora'];
        $flujoEfectivo ->id_empleado = $params_array['empleado'];
        $flujoEfectivo ->monto = $params_array['monto'];
        $flujoEfectivo ->save();

        $data = array(
            'code' => '200',
            'status' => 'succes',
            'flujo_efectivo' => $flujoEfectivo
        );

        return response() -> json($data, $data['code']);
    }

    function show($folio){
        $flujo_efectivo = FlujoEfectivo::find($folio);
        if(is_object($flujo_efectivo)){
            $data = [
                'code' => 200,
                'status' => 'succes',
                'flujo_efectivo' => $flujo_efectivo
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

    function index(){
        $flujo_efectivo = FlujoEfectivo::all();
        return response() -> json([
            'code' => '200',
            'status' => 'succes',
            'flujo_efectivo' => $flujo_efectivo
        ]);

    }

}
