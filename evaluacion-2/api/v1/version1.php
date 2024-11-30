<?php

$_method = $_SERVER['REQUEST_METHOD'];

header("Access-Control-Allow-Origin: *");
header("Access-Control-ALlow-Methods: GET, POST");
header("Content-Type: application/json; charset=UTF-8");

$_authorization = null;
try {
    if (isset(getallheaders()['Authorization'])) {
        $_authorization = getallheaders()['Authorization'];
    }else{
        http_response_code(401);
        echo json_encode(['Error' => 'No tiene autorización']);
    }
} catch (Exception $e) {
    echo 'Error';
}

$_token_get = 'Bearer ippsGET';
$_token_post = 'Bearer ippsPOST';