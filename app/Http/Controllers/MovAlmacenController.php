<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovAlmacen;
class MovAlmacenController extends Controller
{
    
    public function index(){
        $mov_almacen = Devolucion::all();
        return response()->json([
           'code' => 200,
            'status' => 'succes',
            'devoluciones' => $devoluciones
        ]);
    }
}
