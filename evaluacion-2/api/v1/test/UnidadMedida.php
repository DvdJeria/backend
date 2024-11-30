<?php

class UnidadMedida
{
    private $id;
    private $simbolo;
    private $codigo;
    private $nombre_singular;
    private $nombre_plural;
    private $activo;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSimbolo()
    {
        return $this->simbolo;
    }

    public function setSimbolo($simbolo)
    {
        $this->simbolo = $simbolo;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getNombreSingular()
    {
        return $this->nombre_singular;
    }

    public function setNombreSingular($nombre_singular)
    {
        $this->nombre_singular = $nombre_singular;
    }

    public function getNombrePlural()
    {
        return $this->nombre_plural;
    }

    public function setNombrePlural($nombre_plural)
    {
        $this->nombre_plural = $nombre_plural;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }


}