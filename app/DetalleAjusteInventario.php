<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAjusteInventario extends Model
{
    protected $table = "detalles_ajuste"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'folio_detalle';
    protected $fillable = [
        'folio_detalle', 'id_producto','cantidad', 'motivo', 'folio_ajuste'
    ];
    
}
