<?php
namespace html;


use gamboamartin\boletaje\models\bol_invitacion;
use gamboamartin\errores\errores;
use gamboamartin\system\html_controler;
use PDO;
use stdClass;


class bol_invitacion_html extends html_controler {

    public function input_am(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'am',place_holder:  'AM',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }

        return $div;
    }

    public function input_ap(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'ap',place_holder:  'AP',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_domicilio(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'domicilio',place_holder:  'Domicilio',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    /**
     * Genera un input de tipo evento
     * @param int $cols N col css
     * @param stdClass $row_upd Registro en proceso
     * @param bool $value_vacio si vacio no ingresa datos
     * @param bool $disable si disable aplica atributo disabled
     * @return array|string
     * @version 0.40.2
     */
    public function input_evento(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'evento',place_holder:  'Evento',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_fecha_hora(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'fecha_hora',place_holder:  'Fecha Hora',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_generacion(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'generacion',place_holder:  'Generacion',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_licenciatura(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'licenciatura',place_holder:  'Licenciatura',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_n_boletos(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'n_boletos',place_holder:  'N Boletos',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_n_boletos_extra(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'n_boletos_extra',place_holder:  'N Boletos Extra',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_n_ingresos(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'n_ingresos',place_holder:  'N Ingresos',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_nombre(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'nombre',place_holder:  'Nombre',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_nombre_completo(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'nombre_completo',place_holder:  'Nombre Completo',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_plantel(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'plantel',place_holder:  'Plantel',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_por_ingresar(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'por_ingresar',place_holder:  'Por Ingresar',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function input_resto(int $cols, stdClass $row_upd, bool $value_vacio, bool $disable = false): array|string
    {
        $valida = $this->directivas->valida_cols(cols: $cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar columnas', data: $valida);
        }

        $div = $this->input_text_required(cols: $cols,disabled:  $disable,name:  'resto',place_holder:  'Resto',
            row_upd: $row_upd, value_vacio: $value_vacio);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al integrar div', data: $div);
        }
        return $div;
    }

    public function select_bol_invitacion_id(int $cols,bool $con_registros,int $id_selected, PDO $link,
                                          bool $disabled = false): array|string
    {
        $valida = (new \gamboamartin\template\directivas(html: $this->html_base))->valida_cols(cols:$cols);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al validar cols', data: $valida);
        }

        $modelo = new bol_invitacion($link);

        $extra_params_keys = array();
        $extra_params_keys[] = 'bol_invitacion_codigo';
        $extra_params_keys[] = 'bol_invitacion_n_boletos';
        $extra_params_keys[] = 'bol_invitacion_n_ingresos';
        $extra_params_keys[] = 'bol_invitacion_n_boletos_extra';

        $select = $this->select_catalogo(cols:$cols,con_registros:$con_registros,id_selected:$id_selected,
            modelo: $modelo, disabled: $disabled,extra_params_keys: $extra_params_keys, label: "Invitado",
            required: true);
        if(errores::$error){
            return $this->error->error(mensaje: 'Error al generar select', data: $select);
        }
        return $select;
    }


}
