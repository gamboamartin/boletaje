<?php
/**
 * @author Martin Gamboa Vazquez
 * @version 1.0.0
 * @created 2022-05-14
 * @final En proceso
 *
 */
namespace gamboamartin\boletaje\controllers;

include('vendor/autoload.php');
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use gamboamartin\boletaje\models\bol_invitacion;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\bol_invitacion_html;

use PDO;
use stdClass;

class controlador_bol_invitacion extends system {

    public string $link_bol_invitacion_alta_bd;
    public function __construct(PDO $link,  html $html = new \gamboamartin\template_1\html(),
                                stdClass $paths_conf = new stdClass()){
        $modelo = new bol_invitacion(link: $link);
        $html = new bol_invitacion_html($html);
        $obj_link = new links_menu($this->registro_id);
        parent::__construct(html:$html, link: $link,modelo:  $modelo, obj_link: $obj_link, paths_conf: $paths_conf);

        $this->titulo_lista = 'Invitacion';

        $this->link_bol_invitacion_alta_bd = $obj_link->links->bol_invitacion->alta_bd;


        $this->keys_row_lista['nombre_completo'] = new stdClass();
        $this->keys_row_lista['nombre_completo']->campo = 'bol_invitacion_nombre_completo';

        $this->keys_row_lista['n_boletos'] = new stdClass();
        $this->keys_row_lista['n_boletos']->campo = 'bol_invitacion_n_boletos';

        $this->keys_row_lista['n_boletos_extra'] = new stdClass();
        $this->keys_row_lista['n_boletos_extra']->campo = 'bol_invitacion_n_boletos_extra';

        $this->keys_row_lista['licenciatura '] = new stdClass();
        $this->keys_row_lista['licenciatura ']->campo = 'bol_invitacion_licenciatura';



    }

    public function alta(bool $header, bool $ws = false): array|string
    {
        $r_alta =  parent::alta($header, $ws); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear template',data:  $r_alta, header: $header,ws:  $ws);
        }

        $in_evento = (new bol_invitacion_html($this->html_base))->input_evento(cols:12, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_evento',data:  $in_evento, header: $header,ws:  $ws);
        }

        $in_nombre = (new bol_invitacion_html($this->html_base))->input_nombre(cols:12, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_ap = (new bol_invitacion_html($this->html_base))->input_ap(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_ap',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_am = (new bol_invitacion_html($this->html_base))->input_am(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_nombre_completo = (new bol_invitacion_html($this->html_base))->input_nombre_completo(
            cols:12, row_upd: new stdClass(), value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_licenciatura = (new bol_invitacion_html($this->html_base))->input_licenciatura(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_generacion = (new bol_invitacion_html($this->html_base))->input_generacion(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_domicilio = (new bol_invitacion_html($this->html_base))->input_domicilio(cols:12, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_fecha_hora = (new bol_invitacion_html($this->html_base))->input_fecha_hora(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_plantel = (new bol_invitacion_html($this->html_base))->input_plantel(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_n_boletos = (new bol_invitacion_html($this->html_base))->input_n_boletos(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_n_boletos_extra = (new bol_invitacion_html($this->html_base))->input_n_boletos_extra(cols:6, row_upd: new stdClass(), value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }



        $this->inputs = new stdClass();
        $this->inputs->am = $in_am;
        $this->inputs->ap = $in_ap;
        $this->inputs->domicilio = $in_domicilio;
        $this->inputs->evento = $in_evento;
        $this->inputs->fecha_hora = $in_fecha_hora;
        $this->inputs->generacion = $in_generacion;
        $this->inputs->licenciatura = $in_licenciatura;
        $this->inputs->n_boletos = $in_n_boletos;
        $this->inputs->n_boletos_extra = $in_n_boletos_extra;
        $this->inputs->nombre = $in_nombre;
        $this->inputs->nombre_completo = $in_nombre_completo;
        $this->inputs->plantel = $in_plantel;


        return $r_alta;
    }

    public function ingreso(bool $header, bool $ws = false)
    {

    }

    public function genera_qr(bool $header, bool $ws = false)
    {
            $data = 'xxx';
            $qr = QrCode::create($data);
            $writer = new PngWriter();
            $writer->write($qr)->saveToFile((new \config\generales())->path_base."archivos/QR.PNG");
            echo "<H1>" .$data . "<H1>";
    }


}
