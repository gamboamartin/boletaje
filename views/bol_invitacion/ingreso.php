<?php /** @var gamboamartin\boletaje\controllers\controlador_bol_invitacion $controlador */; ?>
<?php use config\views; ?>

<div class="widget-box box-container form-main widget-form-cart">
    <H1>Lector de Codigo QR</H1>
    <div id="qr-reader" style="width:500px"></div>
    <div id="qr-reader-results"></div>
    <br><br>
    <?php echo $controlador->inputs->select; ?>
    <br>
</div>

<script src="<?php echo $controlador->url_qr_js; ?>"></script>

