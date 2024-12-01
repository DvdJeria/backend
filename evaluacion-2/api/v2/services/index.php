<?php
include_once '../version1.php';

switch ($_method) {
    case 'GET':
        if ($_authorization === $_token_get) {
            $lista = [];
            //llamamos al archivo que contiene la clase conexion
            include_once '../conexion.php';
            include_once 'modeloServices.php';
            //include_once 'modeloUnidadMedida.php';
            //se realiza la instancia al modelo services
            $modelo = new Services();
            $lista = $modelo->getAllServices();

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
            include_once 'modeloServices.php';

            // Instanciar el modelo Services
            $services = new Services();

            // Obtener y decodificar los datos del cuerpo de la solicitud
            $body = json_decode(file_get_contents("php://input", true));

            // Validar los datos requeridos
            if (isset($body->titulo, $body->descripcion, $body->activo)) {
                // Asignar los datos al modelo
                $modelo->setTitulo($body->titulo); // Espera un objeto para `titulo`
                $modelo->setDescripcion($body->descripcion); // Espera un objeto para `descripcion`
                $modelo->setActivo($body->activo); // `activo` debe ser true/false

                // Insertar el nuevo registro
                $respuesta = $services->addServices($services);

                if ($respuesta) {
                    http_response_code(201); // Created
                    echo json_encode(['Creado' => 'Sin errores']);
                } else {
                    http_response_code(500); // Internal Server Error
                    echo json_encode(['error' => 'Error al insertar en la base de datos']);
                }
            } else {
                http_response_code(400); // Bad Request
                echo json_encode(['error' => 'Datos incompletos.']);
            }
        } else {
            http_response_code(403); // Forbidden
            echo json_encode(['error' => 'Prohibido']);
        }
        break;
}

/* CODIGO MYSQL PARA CREAR TABLA SERVICES
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único autoincrementable
    titulo JSON NOT NULL,              -- Para almacenar los títulos en JSON
    descripcion JSON NOT NULL,         -- Para almacenar las descripciones en JSON
    activo BOOLEAN NOT NULL DEFAULT FALSE -- Para indicar si el servicio está activo
);

INSERT INTO services (titulo, descripcion, activo) VALUES
(
    '{"esp": "Consultoría digital", "eng": "Digital consulting"}',
    '{"esp": "Identificamos las fallas y conectamos los puntos entre tu negocio y tu estrategia digital. Nuestro equipo experto cuenta con años de experiencia en la definición de estrategias y hojas de ruta en función de tus objetivos específicos.", "eng": "We identify failures and connect the dots between your business and your digital strategy. Our expert team has years of experience defining strategies and roadmaps based on your specific objectives."}',
    TRUE
),
(
    '{"esp": "Soluciones multiexperiencia", "eng": "Multi-experience solutions"}',
    '{"esp": "Deleitamos a las personas usuarias con experiencias interconectadas a través de aplicaciones web, móviles, interfaces conversacionales, digital twin, IoT y AR. Su arquitectura puede adaptarse y evolucionar para adaptarse a los cambios de tu organización.", "eng": "We delight users with interconnected experiences through web applications, mobile applications, conversational interfaces, digital twin, IoT and AR. Its architecture can adapt and evolve to adapt to changes in your organization."}',
    TRUE
),
(
    '{"esp": "Evolución de ecosistemas", "eng": "Ecosystem evolution"}',
    '{"esp": "Ayudamos a las empresas a evolucionar y ejecutar sus aplicaciones de forma eficiente, desplegando equipos especializados en la modernización y el mantenimiento de ecosistemas técnicos. Creando soluciones robustas en tecnologías de vanguardia.", "eng": "We help companies evolve and run their applications efficiently, deploying teams specialized in the modernization and maintenance of technical ecosystems. Creating robust solutions in cutting-edge technologies."}',
    TRUE
),
(
    '{"esp": "Soluciones Low-Code", "eng": "Low-Code Solutions"}',
    '{"esp": "Traemos el poder de las soluciones low-code y no-code para ayudar a nuestros clientes a acelerar su salida al mercado y añadir valor. Aumentamos la productividad y la calidad, reduciendo los requisitos de cualificación de los desarrolladores.", "eng": "We bring the power of low-code and no-code solutions to help our clients accelerate time to market and add value. We increase productivity and quality, reducing developer qualification requirements."}',
    TRUE
);
*/
