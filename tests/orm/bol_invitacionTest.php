<?php
namespace tests\controllers;

use gamboamartin\boletaje\models\bol_invitacion;
use gamboamartin\errores\errores;
use gamboamartin\boletaje\controllers\controlador_adm_session;
use gamboamartin\test\test;

use stdClass;

class bol_invitacionTest extends test {
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
    public function test_alta_bd(): void
    {
        errores::$error = false;

        $_GET['seccion'] = 'org_empresa';
        $_GET['accion'] = 'ubicacion';

        $_SESSION['grupo_id'] = 1;
        $_GET['session_id'] = '1';
        $_SESSION['usuario_id'] = '2';
        $modelo = new bol_invitacion(link: $this->link);

        $modelo->registro['nombre_completo'] = 'Juan de los camotes prietos';
        $modelo->registro['evento'] = 'Mi primera comunion';
        $modelo->registro['licenciatura'] = 'Plastilina';
        $modelo->registro['generacion'] = 'De la chingada';
        $modelo->registro['domicilio'] = 'De la chingada';
        $modelo->registro['fecha_hora'] = '2021-01-01 01:01:01';
        $modelo->registro['plantel'] = '2021-01-01 01:01:01';

        $i = 0;
        while($i<=10) {
            unset($modelo->registro['codigo']);
            unset($modelo->registro['codigo_bis']);
            $resultado = $modelo->alta_bd();
            if(errores::$error){
                print_r($resultado);
                exit;
            }
            $i++;
        }


        $this->assertIsObject($resultado);
        $this->assertNotTrue(errores::$error);

        errores::$error = false;
    }


}

