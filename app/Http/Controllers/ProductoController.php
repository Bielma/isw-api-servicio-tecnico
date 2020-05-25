<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{
    
    
    public function index(){
        $products = Producto::all();
        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'products' => $products
        ]);
    }
    public function show($id_producto){
        //var_dump($id_producto); die();   
        $product = Producto::find($id_producto);
        if(is_object($product)){
            $data = [
                'code' => 200,
                'status' => 'succes',
                'product' => $product
            ];            
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Producto no existe'
            ];
        }
        
        
        return response()->json($data, $data['code']);
    }
    
    public function store(Request $request){
        $json = $request->input('datos',null);
        $params_array = json_decode($json, true);
        $producto = new Producto();
        $producto->nombre = $params_array['nombre'];
        $producto->descripcion = $params_array['descripcion'];
        $producto->precio = $params_array['precio'];
        $producto->existencia = $params_array['existencia'];
        $producto->departamento = $params_array['departamento'];
        $producto->save();
        
        $data = [
                'code' => 200,
                'status' => 'succes',
                'product' => $producto
            ];     
        
        return response()->json($data, $data['code']);
    }
    
}
