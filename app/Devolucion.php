<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
     protected $table = "devoluciones"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'folio_devolucion';
    protected $fillable = [
        'folio_devolucion', 'folio_venta', 'fecha', 'id_empleado', 'status'
    ];
    //falta id_cliente
     public function detalles(){
        return $this->hasMany('App\DetalleDevolucion', 'folio', 'folio_devolucion');
    }
}
