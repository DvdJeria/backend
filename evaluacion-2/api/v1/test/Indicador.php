<?php

class Indicador
{
    private $id;
    private $codigo;
    private $nombre;
    private $unidad_medida_id;
    private $valor;
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

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getUnidadMedidaId()
    {
        return $this->unidad_medida_id;
    }

    public function setUnidadMedidaId($unidad_medida_id): void
    {
        $this->unidad_medida_id = $unidad_medida_id;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor): void
    {
        $this->valor = $valor;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo): void
    {
        $this->activo = $activo;
    }

    public function obtenerTodo()
    {
        $info = [];
        $con = new Conexion();
        $query = "select  id, codigo, nombre, unidad_medida_id, valor, activo from indicador";
        $rs = mysqli_query($con->getConnection(), $query);
        if ($rs) {
            while ($registro = mysqli_fetch_assoc($rs)) {
                $registro['activo'] = $registro['activo'] == 1 ? true : false;
                array_push($info, $registro);
            }
            mysqli_free_result($rs);
        }
        $con->closeConnection();
        return $info;
    }

    public function agregar(Indicador $_nuevo)
    {
        $con = new Conexion();
        $nuevoId = count($this->obtenerTodo()) + 1;

        $query = "INSERT INTO indicador (id, codigo, nombre, unidad_medida_id, valor) VALUES (" . $nuevoId . ", '" . $_nuevo->getCodigo() . "', '" . $_nuevo->getNombre() . "', " . $_nuevo->getUnidadMedidaId() . ", " . $_nuevo->getValor() . ");";
        $rs = mysqli_query($con->getConnection(), $query);
        $con->closeConnection();
        if($rs){
            return true;
        }
        return false;
    }


}