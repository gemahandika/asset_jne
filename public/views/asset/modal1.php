<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div id="resultDisplay">Silahkan Discan qr code nya</div>
                    <div style="width:300px;" id="reader"></div>
                    <label for="no_asset">Nomor asset :</label><br>
                    <input class="form-control" type="text" id="no_asset" name="no_asset">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="../../../app/assets/js/html5-qrcode.min.js"></script>
<script type="text/javascript">
    function onScanSuccess(qrCodeMessage) {
        document.getElementById('resultDisplay').innerHTML = '<span class="result">' + qrCodeMessage + '</span>';
        document.getElementById('no_asset').value = qrCodeMessage;
    }

    function onScanError(errorMessage) {
        // handle scan error
    }

    var html5QrcodeScanner;

    document.getElementById('exampleModal').addEventListener('shown.bs.modal', function() {
        html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            }
        );
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    });

    document.getElementById('exampleModal').addEventListener('hidden.bs.modal', function() {
        if (html5QrcodeScanner) {
            html5QrcodeScanner.clear();
            html5QrcodeScanner = null;
        }
    });
</script>