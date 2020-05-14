<?php

use Illuminate\Support\Facades\Route;


//Rutas para Ventas
Route::resource('/sem-isw/venta', 'VentaController');


//Producto
Route::resource('/sem-isw/producto', 'ProductoController');
    
    

//Devoluciones
Route::resource('/sem-isw/devolucion', 'DevolucionController');

//Mov_Almacen
Route::resource('/sem-isw/mov_almacen', 'MovAlmacenController');
