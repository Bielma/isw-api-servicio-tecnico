<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";
    public $timestamps = false;    
    protected $primaryKey = 'folio';
    protected $fillable = [
        'folio','fecha', 'id_empleado', 'id_cliente', 'forma_pago',
    ];
    
    //Relación de uno a muchos
    public function detalles(){
        return $this->hasMany('App\DetalleVenta', 'folio_venta', 'folio');
    }
    
    
    
    
}
