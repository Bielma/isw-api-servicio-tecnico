<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlujoEfectivo extends Model
{
    protected $table = 'flujo_efectivo';
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'folio';
    protected $fillable = [
        'folio', 'fecha', 'hora','id_empleado', 'monto'
    ];
}
