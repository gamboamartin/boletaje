<?php /** @var gamboamartin\boletaje\controllers\controlador_bol_invitacion $controlador */; ?>
<?php use config\views; ?>

<div class="widget-box box-container form-main widget-form-cart" style="text-align: center;">
    <H1>Lector de Codigo QR</H1>
    <div id="qr-reader" style="width:66vh;margin: 0 auto;text-align: center;border: 0 !important;"></div>
    <div id="qr-reader-results"></div>
    <br>
    <div class="col-sm-2 "></div>
    <?php echo $controlador->inputs->select; ?>
    <br>
</div>

<script src="<?php echo $controlador->url_qr_js; ?>"></script>

