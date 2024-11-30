<?php

class Conexion
{
    private $connection;
    private $host;
    private $user;
    private $pass;
    private $dbname;
    private $port;
    private $server;

    /* MYSQL
        ***************** Para levantar la base de datos *****************
        CREATE schema 'ipss_backend';

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

        INSERT INTO unidad_medida (id, simbolo, codigo, nombre_singular, nombre_plural, activo)
        VALUES (4,'$','USD','Dolar','Dolares', TRUE );

        INSERT INTO unidad_medida (id, simbolo, codigo, nombre_singular, nombre_plural, activo)
        VALUES (5,'¥','JPY','Yen','Yenes', TRUE );

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
               (3, 'USD', 'Dolar Observado', 4, 945.87, TRUE),
               (4, 'EUR', 'Euro Observado', 3, 1043.72, TRUE),
               (5,'JPY', 'Yen', 5, 6.51);

     */

    public function __construct()
    {
        $this->connection = null;
        $this->host = 'localhost';
        $this->user = 'ipss_backend_t3_s70';
        $this->pass = '1pss_b4ck3nd';
        $this->dbname = 'ipss_backend';
        $this->port = 3306;
        $this->server = $_SERVER['SERVER_NAME'];
    }

    public function getConnection()
    {
        try {
            $this->connection = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname, $this->port);
            mysqli_set_charset($this->connection, 'utf8');
            if (!$this->connection) {
                throw new Exception("Error en la conexión: " . mysqli_connect_error());
            }
            return $this->connection;
        } catch (Exception $ex) {
            // Mejor manejo del error
            error_log($ex->getMessage());  // Guarda el error en los logs
            echo json_encode(['Error' => $ex->getMessage()]);  // Devuelve el error en la respuesta
            http_response_code(500);  // Código de error general
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            mysqli_close($this->connection);
        }
    }

}












