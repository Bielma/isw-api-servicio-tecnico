<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovAlmacen extends Model
{
    protected $table = "mov_almacen"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'id_producto', 'nombre', 'descripcion', 'precio', 'existencia', 'departamento'
    ];
}
