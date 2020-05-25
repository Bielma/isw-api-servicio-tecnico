<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use PHPUnit\Framework\TestCase;

class VentaTest extends TestCase
{
  
    public function testGetVentas(){
        $response = $this -> visit(route('/sem-isw/venta'));
        $response ->assertStatus(200);
    }

/*
    public function testValidationError(){
        $response = $this->post(route('sem-isw/login'), []);
        $response->assertStatus(404);
        $response->assertSessionHasErrors('email');
    }
 
    public function GetVenta(){

        $response = $this -> get(route('venta/42'));
        $response ->assertStatus(200);
        $response -> assertJson([
            'code'  => '200',
            'status'=> 'succes',
            'venta' => ''
        ]);          
    }*/




    public function insertarVenta(){
     //   $response = $this
    }
}
