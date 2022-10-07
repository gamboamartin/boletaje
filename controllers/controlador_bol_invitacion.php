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

use config\generales;
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
use Throwable;

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

    private function asigna_link_row(stdClass $row, string $accion, string $propiedad, string $estilo): array|stdClass
    {
        $keys = array('bol_invitacion_id');
        $valida = $this->validacion->valida_ids(keys: $keys,registro:  $row);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al validar row',data:  $valida);
        }

        $link = $this->obj_link->link_con_id(accion: $accion,registro_id:  $row->bol_invitacion_id,
            seccion:  $this->tabla);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al genera link',data:  $link);
        }

        $row->$propiedad = $link;
        $row->$estilo = 'info';

        return $row;
    }

    public function ingreso(bool $header, bool $ws = false)
    {

    }

    public function genera_qr(bool $header, bool $ws = false): array|string
    {
        $bol_invitacion = (new bol_invitacion($this->link))->registro(registro_id: $this->registro_id);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al obtener boleto',data:  $bol_invitacion, header: $header,ws:  $ws);
        }

        $ruta_archivos = $this->path_base.'archivos';
        if(!file_exists($ruta_archivos)){
            mkdir($ruta_archivos,0777,true);
        }
        if(!file_exists($ruta_archivos)){
            return $this->retorno_error(mensaje: 'Error no existe '.$ruta_archivos, data: $ruta_archivos, header: $header, ws: $ws);
        }

        $ruta_archivos_model = $ruta_archivos.'/'.$this->tabla;

        if(!file_exists($ruta_archivos_model)){
            mkdir($ruta_archivos_model,0777,true);
        }
        if(!file_exists($ruta_archivos_model)){
            return $this->retorno_error(mensaje: 'Error no existe '.$ruta_archivos_model,
                data: $ruta_archivos_model, header: $header, ws: $ws);
        }
        $bol_invitacion_codigo = $bol_invitacion['bol_invitacion_codigo'];
        $name_file_bol_invitacion = $ruta_archivos_model."/$bol_invitacion_codigo.png";

        $qr = QrCode::create($bol_invitacion_codigo);
        $writer = new PngWriter();
        try {
            $writer->write($qr)->saveToFile($name_file_bol_invitacion);
        }
        catch (Throwable $e){
            return $this->retorno_error(mensaje: 'Error al genera qr '.$ruta_archivos, data: $e, header: $header, ws: $ws);
        }

        $_SESSION['exito'][]['mensaje'] = 'QR generado del id '.$this->registro_id;
        header('Location:'."index.php?seccion=bol_invitacion&accion=lista&session_id=$this->session_id");

        return $name_file_bol_invitacion;

    }

    public function lista(bool $header, bool $ws = false): array
    {
        $r_lista = parent::lista($header, $ws);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar datos',data:  $r_lista, header: $header,ws:$ws);
        }

        $registros = $this->maqueta_registros_lista(registros: $this->registros);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al maquetar registros',data:  $registros, header: $header,ws:$ws);
        }

        $this->registros = $registros;

        return $r_lista;
    }

    private function maqueta_registros_lista(array $registros): array
    {
        foreach ($registros as $indice=> $row){
            $row = $this->asigna_link_row(row: $row, accion: "genera_qr",propiedad: "link_genera_qr",
                estilo: "link_genera_qr_style");
            if(errores::$error){
                return $this->errores->error(mensaje: 'Error al maquetar row',data:  $row);
            }
            $registros[$indice] = $row;

            $row = $this->asigna_link_row(row: $row, accion: "ver_qr",propiedad: "link_ver_qr",
                estilo: "link_ver_qr_style");
            if(errores::$error){
                return $this->errores->error(mensaje: 'Error al maquetar row',data:  $row);
            }
            $registros[$indice] = $row;
        }
        return $registros;
    }

    public function ver_qr(){

    }


}
