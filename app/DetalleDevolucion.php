<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDevolucion extends Model
{
     protected $table = "detalle_devoluciones"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'folio';
    protected $fillable = [
        'folio', 'id_producto', 'cantidad', 'motivo','folio_devolucion'
    ];
}
