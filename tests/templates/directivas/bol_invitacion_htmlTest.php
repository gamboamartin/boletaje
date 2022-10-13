<?php
namespace tests\controllers;

use gamboamartin\boletaje\models\bol_invitacion;
use gamboamartin\errores\errores;
use gamboamartin\template_1\html;
use gamboamartin\test\test;

use html\bol_invitacion_html;
use stdClass;

class bol_invitacion_htmlTest extends test {
    public errores $errores;
    private stdClass $paths_conf;
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->errores = new errores();
        $this->paths_conf = new stdClass();
        $this->paths_conf->generales = '/var/www/html/organigrama/config/generales.php';
        $this->paths_conf->database = '/var/www/html/organigrama/config/database.php';
        $this->paths_conf->views = '/var/www/html/organigrama/config/views.php';


    }

    /**
     */
    public function test_input_evento(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'org_empresa';
        $_GET['accion'] = 'ubicacion';

        $_SESSION['grupo_id'] = 1;
        $_GET['session_id'] = '1';
        $_SESSION['usuario_id'] = '2';
        $html_ = new html();
        $html = new bol_invitacion_html($html_);

        $cols = 11;
        $row_upd = new stdClass();
        $value_vacio = false;
        $resultado = $html->input_evento($cols, $row_upd, $value_vacio);

        $this->assertIsString($resultado);
        $this->assertNotTrue(errores::$error);
        $this->assertEquals("<div class='control-group col-sm-11'><label class='control-label' for='evento'>Evento</label><div class='controls'><input type='text' name='evento' value='' class='form-control'  required id='evento' placeholder='Evento' /></div></div>",$resultado);


        errores::$error = false;
    }


}

