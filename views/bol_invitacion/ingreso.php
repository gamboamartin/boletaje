<?php
include('vendor/autoload.php');
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if(isset($_POST["submit"]) && !empty($_POST["submit"])) {
    $nombre = $_POST["nombre"];
    $qr = QrCode::create($nombre);
    $writer = new PngWriter();
    $writer->write($qr)->saveToFile("QR.PNG");
}
?>

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
    <form method="POST">
        <H1>Generador de Codigo QR</H1>
        <input type="text" name="nombre">
        <br><br>
        <input type="submit" name="submit" value="Enviar Formulario">
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
