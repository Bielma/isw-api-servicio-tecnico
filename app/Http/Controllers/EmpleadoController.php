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
   
        $validate = \Validator::make($params_array, [
            
            'rfc'       => 'required',
            'nombre'    => 'required|alpha',
            'correo'    => 'required|email',
            'puesto'    => 'required',
            'apellido'  => 'required'
        ]);
        
        if($validate->fails()){            
            $data = array(
                'status'=>'error',
                'code'=> '200',
                'message'=> 'Empleado no se ha creado',
                'errors' => $validate->errors()
            );    
            return response() ->  json($data, $data['code']);
        }else{
            $empleado = new Empleado();
            
            $pwd = hash('sha256', $params_array['contraseña']);
            //Regresa un cifrado diferente
            //password_hash($params_array['contraseña'],PASSWORD_BCRYPT, ['const' => 4] );
            $empleado -> rfc = $params_array['rfc'];
            $empleado -> nombre = $params_array['nombre'];
            $empleado -> apellido = $params_array['apellido'];
            $empleado -> telefono = $params_array['telefono'];
            $empleado -> direccion = $params_array['direccion'];   
            $empleado -> correo = $params_array['correo'];
            $empleado -> puesto = $params_array['puesto'];
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
    public function actualizarInventario(){

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
    
    public function login(Request $request ){        
        $jwtAuth = new \JwtAuth();
        $json = $request -> input('datos', null);
        $params_array = json_decode($json, true);

        $validate = \Validator::make($params_array, [
            'rfc'     => 'required',
            'pass'    => 'required'
        ]);

        if($validate->fails()){
            //Validacion fallida
            $signup = array(
                'code' => 404,
                'status' => 'error',
                'message' => 'Usuario no se ha podido identificar'
            );
        }else{
            $id = $params_array['rfc'];        
            $password = $params_array['pass'];    
            $pwd = hash('sha256', $password);
            $signup = $jwtAuth -> signup($id, $pwd);
            if(!empty($params_array['get_token'])){
                $signup = $jwtAuth -> signup($id, $pwd, true);
            }

        }
        
        return response()-> json($signup, 200 );
    }

    public function prueba(Request $request){
        $token = $request -> header('Authorization');
        $jwtAuth = new \JwtAuth();
        $checkToken = $jwtAuth -> checkToken($token);
        
        if($checkToken){
            $uwu = 'Ta bien';
        }else{
            $uwu = 'Ta mal';
        }
        //die();
            
        return $uwu;

    }
}

