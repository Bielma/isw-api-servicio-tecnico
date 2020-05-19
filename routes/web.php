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

//Empleados
Route::resource('/sem-isw/empleado', 'EmpleadoController');

//Clientes
Route::resource('/sem-isw/cliente', 'ClienteController');

//Flujo de efectivo
Route::resource('/sem-isw/flujo', 'FlujoEfectivoController');

//Ajustes de inventario
Route::resource('/sem-isw/ajuste', 'AjusteInventarioController');