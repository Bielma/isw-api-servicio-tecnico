<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AjusteInventario extends Model
{
    protected $table = "ajustes_inventario"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'folio_ajuste';
    protected $fillable = [
        'folio_ajuste','fecha', 'empleado'
    ];

     public function detalles(){
        return $this->hasMany('App\DetalleAjusteInventario', 'folio', 'folio_devolucion');
    }
}
