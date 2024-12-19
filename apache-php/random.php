<?php
// Genera un número aleatorio entre 1 y 100
$randomNumber = rand(1, 100);

// Determina si el número es par o impar
$parImpar = ($randomNumber % 2 == 0) ? 'par' : 'impar';

// Crea un array con al menos 5 elementos
$array = ["manzana", "banana", "naranja", "uva", "fresa"];

// Selecciona un elemento aleatorio del array
$randomElement = $array[array_rand($array)];

// Crea el JSON de salida
$response = [
    "randomNumber" => $randomNumber,
    "parImpar" => $parImpar,
    "randomElement" => $randomElement
];

// Devuelve la respuesta como JSON
echo json_encode($response);
?>
