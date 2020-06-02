<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AjusteInventario;
use App\DetalleAjusteInventario;
use App\Producto;
class AjusteInventarioController extends Controller
{

    public function __construct(){
        $this->middleware('api.auth', ['except' =>['index', 'show']]);
    }
    public function index(){
        $ajusteInventario = AjusteInventario::all()->load('detalles');
        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'ajustes' => $ajusteInventario
        ]);
    }

    public function show($folio){
        $ajusteInventario = AjusteInventario::find($folio)->load('detalles');
        if(is_object($ajusteInventario)){
            $data = [
                'code' => 200,
                'status' => 'succes',
                'ajuste' => $ajusteInventario
            ];            
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Ajuste no existe'
            ];
        }

        return response() ->json($data, $data['code']);
    }

    public function store(Request $request){
        $json = $request -> input('datos', null);
        $params_array = json_decode($json, true);
        
        $ajusteInventario = new AjusteInventario();
        $ajusteInventario -> fecha = $params_array['fecha'];
        $ajusteInventario -> id_empleado = $params_array['empleado'];        
        $ajusteInventario ->save();

        $productos = $params_array['productos'];
        //var_dump(count($productos)); die();      
        for($i =0; $i < count($productos); $i++){
            $detalles = new DetalleAjusteInventario();            
            $detalles -> folio_ajuste = $ajusteInventario['folio_ajuste'];
            $detalles -> id_producto = $productos[$i]['codigo'];    
            $detalles -> cantidad = $productos[$i]['cantidad'];                
            $detalles -> motivo = $productos[$i]['motivo'];
            $detalles -> save();
            $producto = Producto::find($productos[$i]['codigo']);
            $producto_update = Producto::where('id_producto', $productos[$i]['codigo'] ) -> update(['existencia' => $producto ->existencia - $productos[$i]['cantidad']]);
        }


        $data = array(
            'status' => 'succes',
            'code' => '200',
              'message' => 'El registro se ha insertado con exito',
              'ajuste' => $ajusteInventario
          );
          
          return  response() -> json($data, $data['code']);

    }
}
