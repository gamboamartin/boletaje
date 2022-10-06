<?php /** @var gamboamartin\boletaje\controllers\controlador_bol_invitacion $controlador */; ?>
<?php use config\views; ?>

<html>
<head>
    <title>Html-Qrcode Demo</title>
<body>

<div class="widget-box box-container form-main widget-form-cart">
    <H1>Lector de Codigo QR</H1>
    <div id="qr-reader" style="width:500px"></div>
    <div id="qr-reader-results"></div>
</div>

<div class="widget-box box-container form-main widget-form-cart">
    <form method="POST" >
        <H1>Generador de Codigo QR</H1>
        <input type="text" name="data">
        <br><br>
        <input type="submit" name="submit" value="Generar QR">
    </form>
</div>

</body>

<!--<script src="/js/html5-qrcode.min.js"></script>-->
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>
</head>
</html>
