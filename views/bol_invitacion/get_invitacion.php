<?php /** @var gamboamartin\boletaje\controllers\controlador_bol_invitacion $controlador */; ?>
<?php use config\views; ?>
<main class="main section-color-primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="widget  widget-box box-container form-main widget-form-cart" id="form">
                    <form method="post" action="<?php echo $controlador->link_bol_invitacion_modifica_bd; ?>" class="form-additional">

                        <?php include (new views())->ruta_templates."head/title.php"; ?>
                        <?php include (new views())->ruta_templates."head/subtitulo.php"; ?>
                        <?php include (new views())->ruta_templates."mensajes.php"; ?>

                        <div style="display: inline-block">
                        <?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>
                        </div>

                        <div class="control-group btn-modifica" style="display: inline-block;">
                            <div class="controls">
                                <a href="index.php?seccion=bol_invitacion&accion=ingreso&session_id=<?php echo $controlador->session_id; ?>" class="btn btn-info ">Lector QR</a>
                            </div>
                        </div>

                        <?php echo $controlador->inputs->por_ingresar; ?>
                        <?php echo $controlador->inputs->resto; ?>
                        <?php echo $controlador->inputs->n_ingresos; ?>
                        <?php echo $controlador->inputs->nombre_completo; ?>
                        <?php echo $controlador->inputs->licenciatura; ?>
                        <?php echo $controlador->inputs->generacion; ?>

                        <?php echo $controlador->inputs->plantel; ?>
                        <?php echo $controlador->inputs->n_boletos; ?>
                        <?php echo $controlador->inputs->n_boletos_extra; ?>

                        <?php include (new views())->ruta_templates.'botons/submit/modifica_bd.php';?>
                        <div class="control-group btn-modifica">
                            <div class="controls">
                                <a href="index.php?seccion=bol_invitacion&accion=ingreso&session_id=<?php echo $controlador->session_id; ?>" class="btn btn-info ">Lector QR</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

</main>
