<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "datos"; 
    public $timestamps = false;
    //Definir el nombre de nuestra primary key personalizada.
    protected $primaryKey = 'rfc';
    protected $fillable = [
        'rfc', 'nombre', 'correo', 'sexo', 'domicilio','telefono'
    ];

    public function compras()
    {
        return $this->hasMany('App\Venta');

    }
}
