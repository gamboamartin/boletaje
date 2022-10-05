<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\boletaje\controllers;

use gamboamartin\boletaje\models\bol_invitacion;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\bol_invitacion_html;
use PDO;
use stdClass;

class controlador_bol_invitacion extends system {

    public function __construct(PDO $link,  html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new bol_invitacion(link: $link);
        $html = new bol_invitacion_html($html);
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Invitacion';

    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta($header, $ws); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear template',data:  $r_alta, header: $header,ws:  $ws);
        }
        return $r_alta;
    }

    public function ingreso(bool $header, bool $ws = false)
    {

    }


}
