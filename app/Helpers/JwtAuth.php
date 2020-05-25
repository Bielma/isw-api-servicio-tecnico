<?php

namespace App\Helpers;

//use Firebase\JWT\JWT;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use App\Empleado;

class JwtAuth {

    public $key;

    public function __construct(){
        $this->key = 'clave-secretaxdxd';
    }
    public function signup($rfc, $password, $getToken = null){        
        //Buscar si existe el empleado
        $user = Empleado::where([
            'rfc'           =>$rfc,
            'contraseña'    =>$password
        ])->first();

        //Conprobar si el objeto es correcto
        $signup = false;
        if(is_object($user)){
            $signup = true;
        }
        
        //Generar Token
        if($signup){
            $token = array(
                'sub'       => $user -> rfc,
                'nombre'    => $user -> nombre,                               
                'ait'       => time(),
                'exp'       => time() + (7*24 *60 *60)
            );
            $jwt = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode ($jwt ,$this->key, ['HS256']);
            if(is_null($getToken)){
                $data = $jwt;
            }else{
                $data= $decoded;
            }
        }else{
            $data = array(
                'status'    => 'error',
                'message'   => 'Error',
            );
        }

        return $data;//response()->json();
    }

    public function checkToken($jwt, $getIdentity= false){
        $auth = false;

        try{
            $jwt = str_replace('"', "", $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        }catch(\UnexpectedValueException $e){
            $auth = false;
        }catch(\DomainException $e){
            $auth = false;
        }
        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)){
            $auth = true;
        }else{
            $auth = false;
        }
        return $auth;
    }

}
