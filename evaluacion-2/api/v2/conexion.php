<?php

class Conexion
{
    private $connection;
    private $host;
    private $username;
    private $password;
    private $db;
    private $port;
    private $server;

    public function __construct()
    {
        $this->server = $_SERVER['SERVER_NAME'];
        $this->connection = null;
        $this->port = 3306; //puerto por default de mysql
        $this->db = 'ipss_backend';
        $this->username = 'ipss_backend_t3_s70';
        $this->password = '1pss_b4ck3nd';

    }

    public function getConnection()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        mysqli_set_charset($this->connection, 'utf8');
        if (!$this->connection) {
            echo 'Error: '.mysqli_connect_errno();
            return mysqli_connect_errno();
        }
        return $this->connection;
    }

    public function closeConnection()
    {
        mysqli_close($this->connection);
    }
}

/*
 * Creación base de datos MYSQL
 *
 * CREATE schema 'ipss_backend';

CREATE USER 'ipss_backend_t3_s70' IDENTIFIED BY '1pss_b4ck3nd';

GRANT ALL PRIVILEGES ON *.* TO 'ipss_backend_t3_s70';

FLUSH PRIVILEGES;

CREATE TABLE unidad_medida
(
    id              INT PRIMARY KEY,
    simbolo         VARCHAR(5)  NOT NULL,
    codigo          VARCHAR(5)  NOT NULL UNIQUE,
    nombre_singular VARCHAR(50) NOT NULL,
    nombre_plural   VARCHAR(50) NOT NULL,
    activo          BOOLEAN     NOT NULL DEFAULT FALSE
);

INSERT INTO unidad_medida (id, simbolo, codigo, nombre_singular, nombre_plural, activo)
VALUES (1, '$', 'CLP', 'Peso', 'Pesos', TRUE);

INSERT INTO unidad_medida (id, simbolo, codigo, nombre_singular, nombre_plural, activo)
VALUES (2, '$', 'MXN', 'Peso', 'Pesos', TRUE);

INSERT INTO unidad_medida (id, simbolo, codigo, nombre_singular, nombre_plural, activo)
VALUES (3, '€', 'EUR', 'Peso', 'Pesos', TRUE);

CREATE TABLE indicador
(
    id               INT PRIMARY KEY,
    codigo           VARCHAR(10) NOT NULL UNIQUE,
    nombre           VARCHAR(50) NOT NULL UNIQUE,
    unidad_medida_id INT         NOT NULL,
    valor            DECIMAL(7, 2),
    activo           BOOLEAN     NOT NULL DEFAULT FALSE
);

INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor, activo)
VALUES (1, 'UF', 'Unidad de Fomento', 1, 37968.98, TRUE),
       (2, 'IVP', 'Indice de Valor Promedio', 1, 39443.16, TRUE),
       (3, 'dolar', 'Dolar Observado', 1, 945.87, TRUE),
       (4, 'euro', 'Euro Observado', 1, 1043.72, TRUE);


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

CREATE TABLE aboutus (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único autoincrementable
    titulo JSON NOT NULL,              -- Para almacenar los títulos en JSON
    descripcion JSON NOT NULL,         -- Para almacenar las descripciones en JSON
    activo BOOLEAN NOT NULL DEFAULT FALSE -- Para indicar si el servicio está activo
);

INSERT INTO aboutus (titulo, descripcion, activo) VALUES
(

    '{"esp": "Servicios de soporte, gestión y diseño de TI altamente personalizados.", "eng": "Highly Tailored IT Design, Management & Support Services."}',
    '{"esp": "Acelere la innovación con equipos tecnológicos de clase mundial. Lo conectaremos con un equipo remoto completo de increíbles talentos independientes para todas sus necesidades de desarrollo de software.", "eng": "Accelerate innovation with world-class tech teams We’ll match you to an entire remote team of incredible freelance talent for all your software development needs."}',
    TRUE
),
(
    '{"esp": "Misión", "eng": "Mission"}',
    '{"esp": "Nuestra misión es ofrecer soluciones digitales innovadoras y de alta calidad que impulsen el éxito de nuestros clientes, ayudándolos a alcanzar sus objetivos empresariales a través de la tecnología y la creatividad.", "eng": "Our mission is to deliver high-quality, innovative digital solutions that drive our clients'' success, helping them achieve their business goals through technology and creativity."}',
    TRUE
),
(
    '{"esp": "Visión", "eng": "Vision"}',
    '{"esp": "Nos visualizamos como líderes en el campo de la consultoría y desarrollo de software, reconocidos por nuestra excelencia en el servicio al cliente, nuestra capacidad para adaptarnos a las necesidades cambiantes del mercado y nuestra contribución al crecimiento y la transformación digital de las empresas.", "eng": "We see ourselves as leaders in the field of software consulting and development, recognized for our excellence in customer service, our ability to adapt to changing market needs and our contribution to the growth and digital transformation of companies."}',
    TRUE
);

CREATE TABLE basic_info (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único autoincrementable
    tipo JSON NOT NULL,              -- Para almacenar los títulos en JSON
    items JSON NOT NULL,         -- Para almacenar las descripciones en JSON
    activo BOOLEAN NOT NULL DEFAULT FALSE -- Para indicar si el servicio está activo
);

INSERT INTO basic_info (tipo, items, activo) VALUES
(
    JSON_OBJECT('tipo', 'menu-principal'),
    '{
        "esp": [
            {"link": "#home", "texto": "Inicio", "activo": true},
            {"link": "#our-services", "texto": "Nuestros Servicios", "activo": true},
            {"link": "#contact-us", "texto": "Contáctenos", "activo": true},
            {"link": "#about-us", "texto": "Nosotros", "activo": true}
        ],
        "eng": [
            {"link": "#home", "texto": "Home", "activo": true},
            {"link": "#our-services", "texto": "Our Services", "activo": true},
            {"link": "#contact-us", "texto": "Contact Us", "activo": true},
            {"link": "#about-us", "texto": "About Us", "activo": true}
        ]
    }',
    TRUE
),
(
    JSON_OBJECT('tipo', 'hero'),
    '{
        "titulo": {
            "esp": "Su socio para soluciones digitales",
            "eng": "Your partner for digital solutions"
        },
        "parrafo": {
            "esp": "Proporcionamos el diseño de TI más responsivo y funcional para empresas y negocios de todo el mundo.",
            "eng": "We provide the most responsive and functional IT design for companies and businesses worldwide."
        }
    }',
    TRUE
),
(
    JSON_OBJECT('tipo', 'contacto'),
    '[
        {"tipo": "direccion", "valor": "Av. Providencia 1234, Oficina 601 Providencia, Santiago Chile", "activo": true},
        {"tipo": "telefono", "valor": "+56 2 1234 5678", "activo": true},
        {"tipo": "email", "valor": "info@coningenio.cl", "activo": true}
    ]',
    TRUE
),
(
    JSON_OBJECT('tipo', 'rrss'),
    '[
        {"rrss": "facebook", "icono": "fa fa-facebook", "link": "#", "activo": true},
        {"rrss": "instagram", "icono": "fa fa-instagram", "link": "#", "activo": true}
    ]',
    TRUE
);
 *  */
