<?php /** @var gamboamartin\boletaje\controllers\controlador_bol_invitacion $controlador */; ?>
<?php use config\views; ?>

<style>
    .text_align{
        text-align: center;
    }
    .qr_div{
        margin: 0 auto;
        width:66vh;
        border: 0px; !important;
    }
    @media only screen and (max-width: 1101px) {
        .qr_div{
            width: 100%;
        }
    }
</style>

<div class="widget-box box-container form-main widget-form-cart text_align">
    <H1>Lector de Codigo QR</H1>
    <div id="qr-reader" class="qr_div text_align"></div>
    <div id="qr-reader-results"></div>
    <br>
    <div class="col-sm-2 "></div>
    <?php echo $controlador->inputs->select; ?>
    <br>
</div>

<script src="<?php echo $controlador->url_qr_js; ?>"></script>

