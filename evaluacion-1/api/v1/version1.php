<?php

$_method = $_SERVER['REQUEST_METHOD'];
$_host = $_SERVER['HTTP_HOST'];
$uri = $_SERVER['REQUEST_URI'];


header("Access-Control-Allow-Origin: *"); //Evita que que conecten desde otros servidores
header("Access-Control-Allow-Methods: GET"); //Indica los métodos que estan permitidos en el servidor
header("Content-Type: application/json; charset=UTF-8"); //Este header indica que la salida del archivo sera a través de un JSON

//Configuración de la autorización en la API
$_Authorization = null;

try {
    if (isset(getallheaders()['Authorization'])) {
        $_Authorization = getallheaders()['Authorization'];
        //echo 'Tenemos autorización';
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'no tiene autorización']);
    }

} catch (Exception $e) {

}
