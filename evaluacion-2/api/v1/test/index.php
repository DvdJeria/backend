<?php

include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === $_token_get) {
            $lista = [];

            include_once '../conexion.php';
            include_once 'Indicador.php';
            include_once 'UnidadMedida.php';

            $modelo = new Indicador();
            $lista = $modelo->obtenerTodo();

            http_response_code(200);
            echo json_encode(['GET' => $lista]);

        } else {
            http_response_code(401);
            echo json_encode(['GET' => 'Ingreso incorrecto']);
        }

        break;
    case 'POST':
        if ($_authorization === $_token_post) {

            include_once '../conexion.php';
            include_once 'modeloIndicador.php';
            include_once 'modeloUnidadMedida.php';


            $modelo = new Indicador();
            //se recuperan los datos RAW del body en formato JSON
            $body = json_decode(file_get_contents('php://input', true));

            echo json_encode(['POST' => 'Ingreso correcto']);

            $modelo->setCodigo($body->codigo);
            $modelo->setNombre($body->nombre);
            $modelo->setUnidadMedidaId($body->unidad_medida_id);
            $modelo->setValor($body->valor);
            // print_r($modelo);
            //agrega el nuevo valor
            $respuesta = $modelo->add($modelo);
            if ($respuesta) {
                http_response_code(201);
                echo json_encode(['Creado' => 'Sin errores']);
            }
        } else {
            http_response_code(401);
            echo json_encode(['POST' => 'Ingreso incorrecto']);
        }
        break;
    default:
        http_response_code(501);
        echo json_encode(['error' => 'No implementado']);
        break;
}