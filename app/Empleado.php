<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Empleado extends Authenticatable
{
    //use Notifiable;
    
    protected $table = "empleados";  
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'rfc';
    public $incrementing = false;
    protected $fillable = [
        'rfc', 'nombre', 'apellido', 'telefono', 'direccion', 'correo', 'puesto','contraseña'
    ];

    protected $hidden = [
        'contraseña'
    ];

    //falta id_cliente
     public function ventas(){
        return $this->hasMany('App\Venta', 'folio', 'folio_devolucion');
    }
    public function devoluciones(){
        return $this->hasMany('App\Devolucion', 'folio', 'folio_devolucion');
    }
    public function ajustes(){
        return $this->hasMany('App\AjusteInventario', 'folio', 'folio_devolucion');
    }
    public function movimientos_almacen(){
        return $this->hasMany('App\MovAlmacen', 'folio', 'folio_devolucion');
    }

}
