<?php
namespace gamboamartin\boletaje\models;
use base\orm\modelo;
use PDO;

class bol_invitacion extends modelo{
    public function __construct(PDO $link){
        $tabla = 'bol_invitacion';
        $columnas = array($tabla=>false);
        $campos_obligatorios = array();

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }
}