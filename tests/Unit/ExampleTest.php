<?php

test('comprobar una suma', function () { // nombre del test
   $result = 1 + 2; //lo que hará el código
 
   expect($result)->toBe(3); //resultado que se espera
});


test('comprobar si una persona es mayor de edad', function(){
    $edad = 16;

    $esMayor = $edad >= 18;

    expect($esMayor)->toBeFalse();
});


test('Cantidad de productos', function(){
    $productos = ['pan', 'leche', 'azucar'];

    expect($productos)->toHaveCount(3);

});


function calcularDescuento($precio, $descuento){
    return $precio - ($precio * $descuento/100);
}

test('Calcular Correctamente un Descuento', function(){
    $resultado = calcularDescuento(200, 10);

    expect($resultado)->toEqual(180);

});


test('Calcular Descuento de Estudiante', function(){
    $resultado = calcularDescuento(200, 50);

    expect($resultado)->toEqual(100);

});

test('Calcular Descuento de Profesor', function(){
    $resultado = calcularDescuento(200, 0);

    expect($resultado)->toEqual(200);

});


test('Calcular Diferentes Descuentos', function($precio, $descuento, $esperado){
    $resultado = calcularDescuento($precio, $descuento);

    expect($resultado)->toEqual($esperado);

}) -> with([
    'Descuento de 10%' => [200, 10, 180],
    'Descuento de 50%' => [200, 50, 100],
    'Sin Descuento' => [200, 0, 200],
]); 

