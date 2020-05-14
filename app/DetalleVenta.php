<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $table = "detalle_ventas";
    public $timestamps = false;
    protected $fillable = [
        'id','folio_venta', 'id_producto', 'cantidad', 'precio_a_la_fecha',
    ];
    
}
