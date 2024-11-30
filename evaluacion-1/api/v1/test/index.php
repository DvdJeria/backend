<?php

include_once '../version1.php';

//print_r(getallheaders()['Authorization']);

$data = array(
    array(
        'id' => 1,
        'nombre' => 'David',
        'apellido' => 'Jeria',
        'fono' => 972152461
    ),
    array(
        'id' => 2,
        'nombre' => '',
        'apellido' => '',
        'fono' => 0
    ),
    array(
        'id' => 3,
        'nombre' => '',
        'apellido' => '',
        'fono' => 0
        ),
    array(
        'id' => 4,
        'nombre' => '',
        'apellido' => '',
        'fono' => 0
            ),
);

switch ($_method) {
    case 'GET':
        if ($_Authorization === 'Bearer ipss') {
            http_response_code(200);
            //$data = array();
            echo json_encode($data);

        } else {
            http_response_code(403);
            echo json_encode(['error' => 'Prohibido']);
        }
        break;
    default:
        http_response_code(501);
        echo json_encode(['error' => 'No implementado']);
        break;
}

