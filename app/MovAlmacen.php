<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovAlmacen extends Model
{
    protected $table = "mov_almacen"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'folio';
    protected $fillable = [
        'folio','fecha', 'empleado', 'folio_generador', 'tipo', 'motivo'
    ];

    public function detalles(){
        return $this->hasMany('App\DetalleMovAlmacen', 'folio', 'folio');
    }
}
