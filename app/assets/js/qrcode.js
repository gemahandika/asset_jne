window.addEventListener('load', function() {
    const qrResult = document.getElementById('qr-input');
    const html5QrCode = new Html5Qrcode("reader");

    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Scan result: ${decodedText}`);
        qrResult.value = decodedText;

        // Stop scanning after successful scan
        html5QrCode.stop().then((ignore) => {
            console.log('QR Code scanning stopped.');
        }).catch((err) => {
            console.error('Unable to stop scanning.', err);
        });

        // Close the modal after scan
        $('#qrModal').modal('hide');
    }

    function onScanFailure(error) {
        console.warn(`QR Code scan error: ${error}`);
    }

    const config = { fps: 10, qrbox: 250 };

    // Initialize QR Code Scanner when the modal is shown
    $('#qrModal').on('shown.bs.modal', function (e) {
        html5QrCode.start({ facingMode: "environment" }, config, onScanSuccess, onScanFailure)
        .catch((err) => {
            console.error('Unable to start the QR Code scanner.', err);
        });
    });

    // Stop the QR Code scanner when the modal is hidden
    $('#qrModal').on('hidden.bs.modal', function (e) {
        html5QrCode.stop().then((ignore) => {
            console.log('QR Code scanning stopped.');
        }).catch((err) => {
            console.error('Unable to stop scanning.', err);
        });
    });

    document.getElementById('asset-form').addEventListener('submit', function(event) {
        event.preventDefault();
        alert(`QR Code submitted: ${qrResult.value}`);
    });
});
