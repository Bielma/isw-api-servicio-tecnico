<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    public function index(){
        $clientes = Cliente::all();

        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'products' => $clientes
        ]);
    }


    public function store(Request $request)
    {
        $json = $request->input('datos', null);
        $params_array = json_decode($json, true);
     

        //Validar datos

   /*
        $validate = \Validator::make($params_array, [
            'rfc' => 'required',
            'nombre' => 'required|alpha',
            'correo' => 'required|email',
            'puesto' => 'requiered|alpha',
            'apellido' => 'required|alpha'
        ]);*/
   
        //if($validate->fails()){
        $aber = false;
         if(!true){
            $data = array(
                'status'=>'error',
                'code'=> '2',
                'message'=> 'Empleado no se ha creado',
                'errors' => $validate->erros()
            );    
            return response() ->  json($data, $data['code']);
        }else{
            $clientes = new Cliente();                        
            $clientes -> rfc = $params_array['rfc'];
            $clientes -> nombre = $params_array['nombre'];            
            $clientes -> correo = $params_array['correo'];
            $clientes -> sexo = $params_array['sexo'];            
            $clientes -> domicilio = $params_array['domicilio'];
            $clientes -> telefono = $params_array['telefono'];               
            $clientes -> save();
            
            $data = array(
                'status'=>'succes',
                'code'=> '200',
                'message'=> 'Cliente guardado con exito'
            );

        return  response() -> json($data, $data['code']);
        }        
    }


    public function show($rfc){
        //var_dump($id_producto); die();   
        $cliente = Cliente::find($rfc);
        if(is_object($cliente)){
            $data = [
                'code' => 200,
                'status' => 'succes',
                'product' => $cliente
            ];            
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Cliente no existe'
            ];
        }
        
        
        return response()->json($data, $data['code']);
    }
    




}
