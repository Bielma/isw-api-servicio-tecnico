<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovAlmacen;
use App\DetalleMovAlmacen;
use App\Producto;
class MovAlmacenController extends Controller
{
    
    public function index(){
        $mov_almacen = MovAlmacen::all()->load('detalles');
        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'movAlmacen' => $mov_almacen
        ]);
    }

    public function show($folio){
        $mov_almacen = MovAlmacen::find($folio)->load('detalles');
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
        
        $movAlmacen = new MovAlmacen();
        $movAlmacen -> fecha = $params_array['fecha'];
        $movAlmacen -> empleado = $params_array['empleado'];
        $movAlmacen -> folio_generador = 1;        
        $movAlmacen -> tipo = $params_array['tipo'];
        $movAlmacen -> motivo = $params_array['motivo'];        
         $movAlmacen ->save();

        $productos = $params_array['productos'];
        //var_dump(count($productos)); die();      
        for($i =0; $i < count($productos); $i++){
            $detalles = new DetalleMovAlmacen();            
            $detalles -> folio_mov_almacen = $movAlmacen['folio'];
            $detalles -> producto = $productos[$i]['codigo'];    
            $detalles -> cantidad = $productos[$i]['cantidad'];                            
            $detalles -> save();
            $producto = Producto::find($productos[$i]['codigo']);
            if(strcasecmp($params_array['tipo'], 'Entrada')==0){
                $producto_update = Producto::where('id_producto', $productos[$i]['codigo'] ) -> update(['existencia' => $producto ->existencia + $productos[$i]['cantidad']]);                

            }else{
                $producto_update = Producto::where('id_producto', $productos[$i]['codigo'] ) -> update(['existencia' => $producto ->existencia - $productos[$i]['cantidad']]);
            }
        }


        $data = array(
            'status' => 'succes',
            'code' => '200',
              'message' => 'El registro se ha insertado con exito',
              'mov_almacen' => $movAlmacen
          );
          
          return  response() -> json($data, $data['code']);

    }
}
