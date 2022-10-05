<?php
namespace gamboamartin\boletaje\models;
use base\orm\modelo;
use PDO;

class bol_invitacion extends modelo{
    public function __construct(PDO $link){
        $tabla = 'bol_invitacion';
        $columnas = array($tabla=>false);
        $campos_obligatorios = array('descripcion','codigo','codigo_bis','descripcion_select','n_boletos',
            'n_boletos_extra','n_ingresos','evento','nombre_completo','licenciatura','generacion','domicilio',
            'fecha_hora','plantel');

        parent::__construct(link: $link,tabla:  $tabla, campos_obligatorios: $campos_obligatorios,
            columnas: $columnas);
    }
}