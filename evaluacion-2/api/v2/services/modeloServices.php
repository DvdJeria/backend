<?php

class Services
{
    private $id;
    private $titulo;
    private $descripcion;
    private $activo;

    public function __construct() {}
    //accesadores
    public function getId()
    {
        return $this->id;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getActivo()
    {
        return $this->activo;
    }
    //mutadores
    public function setId($_n)
    {
        $this->id = $_n;
    }
    public function setTitulo($_n)
    {
        $this->titulo = $_n;
    }
    public function setDescripcion($_n)
    {
        $this->descripcion = $_n;
    }
    
    public function setActivo($_n)
    {
        $this->activo = $_n;
    }

    public function getAllServices()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, titulo, descripcion, activo FROM services;";
        $rs = mysqli_query($con->getConnection(), $query);
        
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                // Decodificar las columnas JSON
                $registro['titulo'] = json_decode($registro['titulo'], true);
                $registro['descripcion'] = json_decode($registro['descripcion'], true);
                // Convertir el campo 'activo' en un booleano
                $registro['activo'] = (bool)$registro['activo'];
    
                // Agregar el registro procesado a la lista
                $lista[] = $registro;
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
    
        return $lista;
    }

    public function addServices(Services $_nuevo)
    {
        $con = new Conexion();
        $query = "INSERT INTO services (titulo, descripcion, activo) VALUES (?, ?, ?)";
        $stmt = $con->getConnection()->prepare($query);
    
        // Preparar los datos
        $titulo = json_encode($_nuevo->getTitulo()); // Asegurarse de que sea JSON válido
        $descripcion = json_encode($_nuevo->getDescripcion()); // Asegurarse de que sea JSON válido
        $activo = $_nuevo->getActivo() ? 1 : 0; // Convertir activo a un valor numérico
    
        // Vincular los parámetros a la consulta
        $stmt->bind_param('sss', $titulo, $descripcion, $activo);
    
        // Ejecutar la consulta
        $result = $stmt->execute();

        if(!$result){
            echo "Error en la base de datos". $stmt->error;
        }
    
        // Cerrar la conexión y liberar recursos
        $stmt->close();
        $con->closeConnection();
    
        return $result;
    }
}
