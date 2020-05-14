<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    protected $table = "productos"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'id_producto', 'nombre', 'descripcion', 'precio', 'existencia', 'departamento'
    ];
    
    /*
    public function art(){
        return $this->belongTo('App\Art', 'id_productos');          
    }
    */
    
    
}
