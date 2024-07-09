<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="html5-qrcode.min.js"></script>
    <style>
        .result {
            background-color: green;
            color: #fff;
            padding: 20px;
        }

        .row {
            display: flex;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col">
            <div style="width:500px;" id="reader"></div>
        </div>
        <div class="col" style="padding:30px;">
            <div id="resultDisplay">Result Here</div>
            <div class="form-group">
                <label for="nama_anggota">Nama Anggota :</label><br>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota">
            </div>
            <div class="form-group">
                <label for="nama_anggota">Nama Anggota :</label><br>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota">
            </div>
            <div class="form-group">
                <label for="nama_anggota">Nama Anggota :</label><br>
                <input class="form-control" type="text" id="nama_anggota" name="nama_anggota">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function onScanSuccess(qrCodeMessage) {
            document.getElementById('resultDisplay').innerHTML = '<span class="result">' + qrCodeMessage + '</span>';
            document.getElementById('nama_anggota').value = qrCodeMessage;
        }

        function onScanError(errorMessage) {
            // handle scan error
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            }
        );
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
</body>

</html>