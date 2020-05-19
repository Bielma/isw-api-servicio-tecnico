<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empleado;


class EmpleadoController extends Controller
{
    public function index(){
        $empleados = Empleado::all();

        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'products' => $empleados
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
            $empleado = new Empleado();
            
            $pwd = password_hash($params_array['contraseña'],PASSWORD_BCRYPT, ['const' => 4] );
            $empleado -> rfc = $params_array['rfc'];
            $empleado -> nombre = $params_array['nombre'];
            $empleado -> apellido = $params_array['apellido'];
            $empleado -> telefono = $params_array['telefono'];
            $empleado -> direccion = $params_array['direccion'];
            $empleado -> correo = $params_array['correo'];
            $empleado -> puesto = $params_array['puesto'];
            echo $pwd;
            $empleado -> contraseña = $pwd;
            $empleado -> save();
            
            $data = array(
                'status'=>'succes',
                'code'=> '200',
                'message'=> 'Empleado guardado con exito'
            );

        return  response() -> json($data, $data['code']);
        }        
    }

    public function show($rfc){
        //var_dump($id_producto); die();   
        $empleado = Empleado::find($rfc);
        if(is_object($empleado)){
            $data = [
                'code' => 200,
                'status' => 'succes',
                'product' => $empleado
            ];            
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'Empleado no existe'
            ];
        }
        
        
        return response()->json($data, $data['code']);
    }
    
}

