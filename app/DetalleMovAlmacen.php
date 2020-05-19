<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleMovAlmacen extends Model
{
    protected $table = "detalle_movimientos_almacen"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'folio_detalle';
    protected $fillable = [
        'folio_detalle ', 'folio_mov_almacen', 'producto', 'cantidad'
    ];
    
}
