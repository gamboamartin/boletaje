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
use Dompdf\Dompdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use gamboamartin\boletaje\models\bol_invitacion;
use gamboamartin\errores\errores;
use gamboamartin\system\links_menu;
use gamboamartin\system\system;
use gamboamartin\template\html;
use html\bol_invitacion_html;

use PDO;
use setasign\Fpdi\Fpdi;
use stdClass;
use Throwable;
use ZipArchive;


class controlador_bol_invitacion extends system {

    public string $link_bol_invitacion_alta_bd;
    public string $link_bol_invitacion_modifica_bd;
    public string $url_qr_code;
    public string $url_qr_js;
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

    private function carga_dom_pdf(): string
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml('');
        $dompdf->setPaper('letter');
        $dompdf->render();
        $doc_tmp_name = mt_rand(1000000000,9999999999).'.pdf';
        file_put_contents($doc_tmp_name, $dompdf->output());
        return $doc_tmp_name;
    }

    private function crea_qr(string $data, string $ruta_qr): array|string
    {
        $qr = QrCode::create($data);

        $writer = new PngWriter();
        try {
            $writer->write($qr)->saveToFile($ruta_qr);
        }
        catch (Throwable $e){
            return $this->errores->error(mensaje: 'Error al genera qr '.$ruta_qr, data: $e);
        }
        return $ruta_qr;
    }

    private function ejecuta_qr_crea(array $bol_invitacion): array|string
    {
        $name_file_bol_invitacion = $this->genera_name_file_invitacion(bol_invitacion: $bol_invitacion);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener name_file_bol_invitacion',data:  $name_file_bol_invitacion);
        }

        $bol_invitacion_codigo = $bol_invitacion['bol_invitacion_codigo'];


        $qr = $this->crea_qr(data: $bol_invitacion_codigo, ruta_qr: $name_file_bol_invitacion);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al crear qr',data:  $qr);
        }
        return $qr;
    }

    private function file_pdf(stdClass $bol_invitacion): array|stdClass
    {
        $ruta_archivos_model_pdfs = $this->genera_ruta_archivos_model_pdfs();
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al crear ruta',data:  $ruta_archivos_model_pdfs);
        }

        $name_pdf = $this->name_pdf(bol_invitacion: $bol_invitacion);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al crear name',data:  $name_pdf);
        }

        $data_file = new stdClass();
        $data_file->path = $ruta_archivos_model_pdfs.$name_pdf;
        $data_file->name = $name_pdf;

        return $data_file;
    }

    public function ingreso(bool $header, bool $ws = false)
    {
        $select = (new bol_invitacion_html(html:$this->html_base))->select_bol_invitacion_id(
            cols: 6, con_registros:true, id_selected:$this->registro_id,link: $this->link);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al generar select',data:  $select);
        }

        $this->inputs = new stdClass();
        $this->inputs->select = $select;

        $this->url_qr_js = (new generales())->url_base."js/qr.js";

    }

    public function genera_qr(bool $header, bool $ws = false): array|string
    {
        $qr = $this->inserta_qr(bol_invitacion_id: $this->registro_id);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear qr',data:  $qr, header: $header,ws:  $ws);
        }

        $_SESSION['exito'][]['mensaje'] = 'QR generado del id '.$this->registro_id;
        header('Location:'."index.php?seccion=bol_invitacion&accion=lista&session_id=$this->session_id");

        return $qr;

    }

    public function genera_qrs(bool $header, bool $ws = false){
        $bol_invitaciones = (new bol_invitacion($this->link))->registros();
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al obtener qr',data:  $bol_invitaciones, header: $header,ws:  $ws);
        }
        foreach ($bol_invitaciones as $bol_invitacion){
            $qr = $this->inserta_qr(bol_invitacion_id: $bol_invitacion['bol_invitacion_id']);
            if(errores::$error){
                return $this->retorno_error(mensaje: 'Error al crear qr',data:  $qr, header: $header,ws:  $ws);
            }
            print_r($qr);
            echo '<br>';
        }
        exit;

    }

    public function genera_pdf(bool $header, bool $ws = false): array|string
    {


        $pdf = $this->pdf(bol_invitacion_id: $this->registro_id);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al obtener boleto',data:  $pdf, header: $header,ws:  $ws);
        }

        ob_clean();
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=$pdf->name");
        readfile($pdf->path);
        exit;


    }

    public function genera_pdfs(bool $header, bool $ws = false): array|string
    {

        $bol_invitaciones = (new bol_invitacion($this->link))->registros();
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al obtener qr',data:  $bol_invitaciones, header: $header,ws:  $ws);
        }
        $files = array();
        foreach ($bol_invitaciones as $bol_invitacion){
            $pdf = $this->pdf(bol_invitacion_id: $bol_invitacion['bol_invitacion_id']);
            if(errores::$error){
                return $this->retorno_error(mensaje: 'Error al crear pdf',data:  $pdf, header: $header,ws:  $ws);
            }
            //print_r($pdf);
            $files[] = $pdf;
            //echo '<br>';
        }


        $zip_tmp_name = mt_rand(1000000,99999999).'.zip';
        $zip = new ZipArchive();
        $zip->open($zip_tmp_name,ZipArchive::CREATE);


        foreach ($files as $file) {

            $zip->addFile($file->path, $file->name);
        }
        $zip->close();
        ob_clean();
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment;filename=$zip_tmp_name");
        readfile($zip_tmp_name);
        unlink($zip_tmp_name);

        exit;


    }

    private function genera_name_file_invitacion(array|stdClass $bol_invitacion): array|string
    {
        if(is_object($bol_invitacion)){
            $bol_invitacion = (array)$bol_invitacion;
        }
        $ruta_archivos_model = $this->genera_ruta_archivos_model();
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener ruta_archivos_model',data:  $ruta_archivos_model);
        }

        $name_file_bol_invitacion = $this->name_file_inv(bol_invitacion: $bol_invitacion,ruta_archivos_model:  $ruta_archivos_model);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener name_file_bol_invitacion',data:  $name_file_bol_invitacion);
        }
        return $name_file_bol_invitacion;
    }

    private function genera_ruta_archivos_model(): array|string
    {
        $ruta_archivos = $this->ruta_archivos();
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener ruta archivos',data:  $ruta_archivos);
        }

        $ruta_archivos_model = $this->ruta_archivos_model(ruta_archivos: $ruta_archivos);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener ruta_archivos_model',data:  $ruta_archivos_model);
        }

        return $ruta_archivos_model;
    }

    private function genera_ruta_archivos_model_pdfs(): array|string
    {
        $ruta_archivos = $this->ruta_archivos();
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener ruta archivos',data:  $ruta_archivos);
        }

        $ruta_archivos_model = $this->ruta_archivos_model(ruta_archivos: $ruta_archivos);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener ruta_archivos_model',data:  $ruta_archivos_model);
        }

        $ruta_archivos_model_pdfs = $ruta_archivos_model.'/pdfs/';

        if(!file_exists($ruta_archivos_model_pdfs)){
            mkdir($ruta_archivos_model_pdfs,0777,true);
        }
        if(!file_exists($ruta_archivos_model)){
            return $this->errores->error(mensaje: 'Error no existe '.$ruta_archivos_model_pdfs, data: $ruta_archivos_model_pdfs);
        }
        return $ruta_archivos_model_pdfs;



    }

    private function generacion(Fpdi $pdf, stdClass $bol_invitacion): Fpdi
    {
        $pdf->SetFont('Times','B', 29);

        $pdf->SetXY(0,43);
        $pdf->Multicell(w:215, h: 16,txt:  utf8_decode('Generación '.$bol_invitacion->bol_invitacion_generacion),align: 'C',  fill: true);
        return $pdf;

    }

    public function get_invitacion(bool $header, bool $ws = false): array|stdClass
    {
        $filtro = array();
        if(isset($_GET['bol_invitacion_codigo'])){
            $filtro['bol_invitacion.codigo'] = $_GET['bol_invitacion_codigo'];
        }
        if($this->registro_id > 0){
            $filtro['bol_invitacion.id'] = $this->registro_id;
        }


        $r_bol_invitacion = (new bol_invitacion($this->link))->filtro_and(columnas_en_bruto: true, filtro: $filtro);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al obtener boleto',data:  $r_bol_invitacion, header: $header,ws:  $ws);
        }

        $this->row_upd = $r_bol_invitacion->registros_obj[0];

        $resto = ($this->row_upd->n_boletos_extra + $this->row_upd->n_boletos) - $this->row_upd->n_ingresos;
        $this->row_upd->resto = $resto;

        $por_ingresar = $resto;
        if($resto<0){
            $por_ingresar = 0;
        }

        $this->row_upd->por_ingresar = $por_ingresar;


        $this->registro_id = $this->row_upd->id;

        $in_por_ingresar = (new bol_invitacion_html($this->html_base))->input_por_ingresar(cols:12, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_evento',data:  $in_por_ingresar, header: $header,ws:  $ws);
        }

        $in_evento = (new bol_invitacion_html($this->html_base))->input_evento(cols:12, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_evento',data:  $in_evento, header: $header,ws:  $ws);
        }

        $in_nombre = (new bol_invitacion_html($this->html_base))->input_nombre(cols:12, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_ap = (new bol_invitacion_html($this->html_base))->input_ap(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_ap',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_am = (new bol_invitacion_html($this->html_base))->input_am(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_nombre_completo = (new bol_invitacion_html($this->html_base))->input_nombre_completo(
            cols:12, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_licenciatura = (new bol_invitacion_html($this->html_base))->input_licenciatura(cols:6, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_generacion = (new bol_invitacion_html($this->html_base))->input_generacion(cols:6, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_domicilio = (new bol_invitacion_html($this->html_base))->input_domicilio(cols:12, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_fecha_hora = (new bol_invitacion_html($this->html_base))->input_fecha_hora(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_plantel = (new bol_invitacion_html($this->html_base))->input_plantel(cols:6, row_upd:$this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_n_boletos = (new bol_invitacion_html($this->html_base))->input_n_boletos(cols:6, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_n_boletos_extra = (new bol_invitacion_html($this->html_base))->input_n_boletos_extra(cols:6, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }
        $in_n_ingresos = (new bol_invitacion_html($this->html_base))->input_n_ingresos(cols:6, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_resto = (new bol_invitacion_html($this->html_base))->input_resto(cols:6, row_upd: $this->row_upd, value_vacio: false, disable: true);
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
        $this->inputs->n_ingresos = $in_n_ingresos;
        $this->inputs->resto = $in_resto;
        $this->inputs->por_ingresar = $in_por_ingresar;

        $link_bol_invitacion_modifica_bd = (new links_menu(registro_id: $this->registro_id))->link_con_id(
            accion:'modifica_bd',registro_id:  $this->registro_id,seccion:  $this->tabla);

        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar link',
                data:  $link_bol_invitacion_modifica_bd, header: $header,ws:  $ws);
        }

        $this->link_bol_invitacion_modifica_bd = $link_bol_invitacion_modifica_bd;

        return $r_bol_invitacion;
    }

    private function init_pdf(string $doc_tmp_name): Fpdi
    {
        $pdf_file = $this->path_base.'plantillas/boleto.pdf';
        $pdf = new Fpdi();

        $pdf->AddPage('P', 'Letter');
        $pdf->setSourceFile($pdf_file);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);
        $pdf->setSourceFile($doc_tmp_name);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(37,52,109);

        return $pdf;
    }

    private function inserta_qr(int $bol_invitacion_id): array|string
    {
        $bol_invitacion = (new bol_invitacion($this->link))->registro(registro_id: $bol_invitacion_id);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener boleto',data:  $bol_invitacion);
        }


        $qr = $this->ejecuta_qr_crea(bol_invitacion: $bol_invitacion);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al crear qr',data:  $qr);
        }
        return $qr;
    }

    public function leer_qr(bool $header, bool $ws = false){

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

            $row = $this->asigna_link_row(row: $row, accion: "genera_pdf",propiedad: "link_genera_pdf",
                estilo: "link_genera_pdf_style");
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

            $row = $this->asigna_link_row(row: $row, accion: "get_invitacion",propiedad: "link_get_invitacion",
                estilo: "link_get_invitacion_style");
            if(errores::$error){
                return $this->errores->error(mensaje: 'Error al maquetar row',data:  $row);
            }
            $registros[$indice] = $row;
        }
        return $registros;
    }

    public function modifica(bool $header, bool $ws = false, string $breadcrumbs = '', bool $aplica_form = true, bool $muestra_btn = true): array|string
    {
        $r_modifica =  parent::modifica(header: false,aplica_form:  false);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al generar template',data:  $r_modifica);
        }

        $in_evento = (new bol_invitacion_html($this->html_base))->input_evento(cols:12, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_evento',data:  $in_evento, header: $header,ws:  $ws);
        }

        $in_nombre = (new bol_invitacion_html($this->html_base))->input_nombre(cols:12, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_ap = (new bol_invitacion_html($this->html_base))->input_ap(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_ap',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_am = (new bol_invitacion_html($this->html_base))->input_am(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_nombre_completo = (new bol_invitacion_html($this->html_base))->input_nombre_completo(
            cols:12, row_upd: $this->row_upd, value_vacio: false, disable: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_licenciatura = (new bol_invitacion_html($this->html_base))->input_licenciatura(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_generacion = (new bol_invitacion_html($this->html_base))->input_generacion(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_domicilio = (new bol_invitacion_html($this->html_base))->input_domicilio(cols:12, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_fecha_hora = (new bol_invitacion_html($this->html_base))->input_fecha_hora(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_plantel = (new bol_invitacion_html($this->html_base))->input_plantel(cols:6, row_upd:$this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_n_boletos = (new bol_invitacion_html($this->html_base))->input_n_boletos(cols:6, row_upd: $this->row_upd, value_vacio: false);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al crear in_nombre',data:  $in_nombre, header: $header,ws:  $ws);
        }

        $in_n_boletos_extra = (new bol_invitacion_html($this->html_base))->input_n_boletos_extra(cols:6, row_upd: $this->row_upd, value_vacio: false);
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

        $link_bol_invitacion_modifica_bd = (new links_menu(registro_id: $this->registro_id))->link_con_id(
            accion:'modifica_bd',registro_id:  $this->registro_id,seccion:  $this->tabla);

        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al generar link',
                data:  $link_bol_invitacion_modifica_bd, header: $header,ws:  $ws);
        }

        $this->link_bol_invitacion_modifica_bd = $link_bol_invitacion_modifica_bd;

        return $r_modifica;
    }

    public function modifica_bd(bool $header, bool $ws): array|stdClass
    {
        if(isset($_POST['resto'])){
            unset($_POST['resto']);
        }
        $r_modifica_bd = parent::modifica_bd($header, $ws); // TODO: Change the autogenerated stub
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al modificar',
                data:  $r_modifica_bd, header: $header,ws:  $ws);
        }
        return $r_modifica_bd;
    }

    private function name_file_inv(array $bol_invitacion, string $ruta_archivos_model): string
    {
        $bol_invitacion_codigo = $bol_invitacion['bol_invitacion_codigo'];

        return $ruta_archivos_model."/$bol_invitacion_codigo.png";
    }

    private function name_pdf(stdClass $bol_invitacion): string
    {

        $bol_invitacion_plantel = $bol_invitacion->bol_invitacion_plantel;
        $bol_invitacion_plantel = trim($bol_invitacion_plantel);
        $bol_invitacion_plantel = str_replace('/','-',$bol_invitacion_plantel);
        $bol_invitacion_plantel = str_replace('Ó','O',$bol_invitacion_plantel);
        $bol_invitacion_plantel = str_replace('ó','o',$bol_invitacion_plantel);
        $bol_invitacion_plantel = str_replace(',',' ',$bol_invitacion_plantel);

        $bol_invitacion_licenciatura = $bol_invitacion->bol_invitacion_licenciatura;
        $bol_invitacion_licenciatura = trim($bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = str_replace('/','-',$bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = str_replace('Ó','O',$bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = str_replace('ó','o',$bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = str_replace(',',' ',$bol_invitacion_licenciatura);

        $bol_invitacion_nombre_completo = $bol_invitacion->bol_invitacion_nombre_completo;
        $bol_invitacion_nombre_completo = trim($bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = str_replace('/','-',$bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = str_replace('Ó','O',$bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = str_replace('ó','o',$bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = str_replace(',',' ',$bol_invitacion_nombre_completo);

        $name = $bol_invitacion_plantel.'.'.$bol_invitacion_licenciatura.'.'.$bol_invitacion_nombre_completo.'.pdf';
        return str_replace('/', '-', $name);
    }

    private function pdf(int $bol_invitacion_id): array|stdClass
    {
        $bol_invitacion = (new bol_invitacion($this->link))->registro(registro_id: $bol_invitacion_id,retorno_obj: true);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener boleto',data:  $bol_invitacion);
        }

        $file = $this->inserta_qr(bol_invitacion_id:$bol_invitacion_id);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener ruta_archivos_model',data:  $file);
        }


        $doc_tmp_name = $this->carga_dom_pdf();
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al cargar dom',data:  $doc_tmp_name);
        }


        $pdf = $this->init_pdf(doc_tmp_name: $doc_tmp_name);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al cargar pdf',data:  $pdf);
        }

        $pdf = $this->generacion(pdf: $pdf,bol_invitacion:  $bol_invitacion);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al cargar generacion',data:  $pdf);
        }

        $pdf->Image(file: $file,x: 65,y: 60,w: 83);

        $bol_invitacion_plantel = str_replace('  ', ' ', $bol_invitacion->bol_invitacion_plantel);
        $bol_invitacion_plantel = str_replace('  ', ' ', $bol_invitacion_plantel);
        $bol_invitacion_plantel = str_replace('  ', ' ', $bol_invitacion_plantel);
        $bol_invitacion_plantel = str_replace('  ', ' ', $bol_invitacion_plantel);
        $bol_invitacion_plantel = strtoupper($bol_invitacion_plantel);

        $pdf->SetXY(0,188);
        $pdf->Multicell(w: 215, h: 16, txt: utf8_decode('PLANTEL: '.$bol_invitacion_plantel), align: 'C', fill: true);


        $bol_invitacion_licenciatura = str_replace('  ', ' ', $bol_invitacion->bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = str_replace('  ', ' ', $bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = str_replace('  ', ' ', $bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = str_replace('  ', ' ', $bol_invitacion_licenciatura);
        $bol_invitacion_licenciatura = strtoupper($bol_invitacion_licenciatura);

        $pdf->SetXY(0,216);
        $pdf->SetFont(family: 'Times',size:  18);
        $pdf->Multicell(w: 215, h: 10, txt: utf8_decode($bol_invitacion_licenciatura), align: 'C');

        $pdf->SetXY(0,235);
        $pdf->SetFont(family: 'Times', style: 'B',size:  23);

        $bol_invitacion_nombre_completo = str_replace('  ', ' ', $bol_invitacion->bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = str_replace('  ', ' ', $bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = str_replace('  ', ' ', $bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = str_replace('  ', ' ', $bol_invitacion_nombre_completo);
        $bol_invitacion_nombre_completo = strtoupper($bol_invitacion_nombre_completo);

        $pdf->Multicell(w: 215, h: 16, txt:utf8_decode($bol_invitacion_nombre_completo), align: 'C');

        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);


        $file_pdf = $this->file_pdf(bol_invitacion: $bol_invitacion);
        if(errores::$error){
            return $this->errores->error(mensaje: 'Error al obtener ruta',data:  $file_pdf);
        }

        $pdf->Output(dest: 'F',name: $file_pdf->path);
        //$pdf->Output();
        unlink($doc_tmp_name);
        return $file_pdf;
    }

    private function ruta_archivos(): array|string
    {
        $ruta_archivos = $this->path_base.'archivos';
        if(!file_exists($ruta_archivos)){
            mkdir($ruta_archivos,0777,true);
        }
        if(!file_exists($ruta_archivos)){
            return $this->errores->error(mensaje: 'Error no existe '.$ruta_archivos, data: $ruta_archivos);
        }
        return $ruta_archivos;
    }

    private function ruta_archivos_model(string $ruta_archivos): array|string
    {
        $ruta_archivos_model = $ruta_archivos.'/'.$this->tabla;

        if(!file_exists($ruta_archivos_model)){
            mkdir($ruta_archivos_model,0777,true);
        }
        if(!file_exists($ruta_archivos_model)){
            return $this->errores->error(mensaje: 'Error no existe '.$ruta_archivos_model, data: $ruta_archivos_model);
        }
        return $ruta_archivos_model;
    }

    public function ver_qr(bool $header, bool $ws = false){
        $bol_invitacion = (new bol_invitacion($this->link))->registro(registro_id: $this->registro_id, retorno_obj: true);
        if(errores::$error){
            return $this->retorno_error(mensaje: 'Error al obtener boleto',data:  $bol_invitacion, header: $header,ws:  $ws);
        }

        $this->url_qr_code = (new generales())->url_base."archivos/$this->tabla/$bol_invitacion->bol_invitacion_codigo.png";

    }


}
