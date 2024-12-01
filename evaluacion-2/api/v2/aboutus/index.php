<?php


include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === $_token_get) {
            $lista = [];
            //llamamos al archivo que contiene la clase conexion
            include_once '../conexion.php';
            include_once 'modeloAboutus.php';
            include_once 'modeloUnidadMedida.php';
            //se realiza la instancia al modelo services
            $modelo = new Aboutus();
            $lista = $modelo->getAllAboutus();

            http_response_code(200);
            echo json_encode(['data' => $lista]);
        } else {
            http_response_code(403);
            echo json_encode(['error' => 'Prohibido']);
        }

        break;

    case 'POST':
        if ($_authorization === $_token_post) {
            include_once '../conexion.php';
            include_once 'modeloAboutus.php';

            // Instanciar el modelo Services
            $aboutus = new Aboutus();

            // Obtener y decodificar los datos del cuerpo de la solicitud
            $body = json_decode(file_get_contents("php://input", true));

            // Validar los datos requeridos
            if (isset($body->titulo, $body->descripcion, $body->activo)) {
                // Asignar los datos al modelo
                $aboutus->setTitulo($body->titulo); // Espera un objeto para `titulo`
                $aboutus->setDescripcion($body->descripcion); // Espera un objeto para `descripcion`
                $aboutus->setActivo($body->activo); // `activo` debe ser true/false

                // Insertar el nuevo registro
                $respuesta = $aboutus->addAboutus($aboutus);

                if ($respuesta) {
                    http_response_code(201); // Created
                    echo json_encode(['Creado' => 'Sin errores']);
                } else {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['error' => 'Error al insertar en la base de datos']);
                }
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['error' => 'Datos incompletos']);
            }
        } else {
            http_response_code(403); // Forbidden
            echo json_encode(['error' => 'Prohibido']);
        }
        break;
}
