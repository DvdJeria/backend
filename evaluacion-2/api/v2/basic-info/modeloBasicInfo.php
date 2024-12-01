<?php

class BasicInfo
{
    private $id;
    private $tipo;
    private $items;
    private $activo;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): void
    {
        $this->items = $items;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo): void
    {
        $this->activo = $activo;
    }
    public function getAllBasicInfo()
    {
        $lista = [];
        $con = new Conexion();
        $query = "SELECT id, tipo, items, activo FROM basic_info;";
        $rs = mysqli_query($con->getConnection(), $query);

        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                // Decodificar las columnas JSON
                $registro['tipo'] = json_decode($registro['tipo'], true);
                $registro['items'] = json_decode($registro['items'], true);
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

    public function addBasicInfo(BasicInfo $_nuevo)
    {
        $con = new Conexion();
        $query = "INSERT INTO basic_info (tipo, items, activo) VALUES (?, ?, ?)";
        $stmt = $con->getConnection()->prepare($query);

        // Preparar los datos
        $tipo = json_encode($_nuevo->getTipo()); // Asegurarse de que sea JSON válido
        $items = json_encode($_nuevo->getItems()); // Asegurarse de que sea JSON válido
        $activo = $_nuevo->getActivo() ? 1 : 0; // Convertir activo a un valor numérico

        // Vincular los parámetros a la consulta
        $stmt->bind_param('ssi', $tipo, $items, $activo);

        // Ejecutar la consulta
        $result = $stmt->execute();

        // Cerrar la conexión y liberar recursos
        $stmt->close();
        $con->closeConnection();

        return $result;
    }
}
