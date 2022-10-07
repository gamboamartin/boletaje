let url = getAbsolutePath();

let session_id = getParameterByName('session_id');

let bol_invitacion_codigo = '';
let bol_invitacion_id_sl = $('#bol_invitacion_id');


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
            bol_invitacion_codigo = decodedText;
            alert(bol_invitacion_codigo);
            // Handle on success condition with the decoded message.
            //console.log(`Scan result ${decodedText}`, decodedResult);
            //document.write(decodedText);
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
});




