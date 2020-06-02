<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Detalleventa;
use App\Producto;
class VentaController extends Controller
{
    public function __construct(){
        $this->middleware('api.auth', ['except' =>['index', 'show']]);
    }
    public function index(){
        $ventas = Venta::all()->load('detalles');
        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'ventas' => $ventas
        ]);
    }
    
    public function store(Request $request){    
        $json = $request->input('datos', null);        
        $params_array = json_decode($json, true);
        //var_dump($params_array); die();
        
        $venta = new Venta();  
        $venta -> fecha      = $params_array['fecha'];
        $venta -> id_cliente = $params_array['cliente'];
        $venta -> forma_pago = $params_array['forma_pago'];
        $venta -> id_empleado  = $params_array['id_empleado'];                            
        $venta -> status  = "1";   
        $venta->save();
        
        //var_dump($venta['folio']); die();            
        $productos = $params_array['productos'];                                                    
       
        for($i= 0; $i<count($productos); $i++){
            $detalles = new DetalleVenta();
            $detalles -> folio_venta = $venta['folio'];
            $detalles -> id_producto = $productos[$i]['codigo'];    
            $detalles -> cantidad = $productos[$i]['cantidad'];    
            $detalles -> precio_a_la_fecha = $productos[$i]['precio'];    
            $detalles -> save();
            //Actualizar stock de producto
            $producto = Producto::find($productos[$i]['codigo']);
            $producto_update = Producto::where('id_producto', $productos[$i]['codigo'] ) -> update(['existencia' => $producto ->existencia - $productos[$i]['cantidad']]);
            


        }                   

        //Respuesta de error. 
        $data = array(
          'status' => 'succes',
          'code' => '200',
            'message' => 'El registro se ha insertado con exito',
            'venta' => $venta
        );
        
        return  response() -> json($data, $data['code']);                    
    }

    public function show($folio){
        $venta = Venta::find($folio)->load('detalles');
        if(is_object($venta)){
            $data = array(
                'status' => 'succes',
                'code' => 200,
                'venta' => $venta 
            );

        }else{
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Venta no existe'
            );

        }
        
        return response() -> json($data, $data['code']);
    }
}
        
        
        
