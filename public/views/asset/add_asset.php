<?php
include '../../header.php';
$date = date("Y-m-d");
$time = date("H:i");
?>
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
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Tambah Data Asset</div>
                    </div>
                    <form action="../../../app/controller/Asset.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group has-success">
                                        <div id="resultDisplay">Scan Disini</div>
                                        <div style="width:300px;" id="reader"></div><br>
                                        <label for="no_asset">NOMOR ASSET :</label><br>
                                        <input class="form-control" type="text" id="no_asset" name="no_asset" style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <!-- <button type="submit" name="approve" class="btn btn-primary"><i class="fa fa-search"></i>Cari</button> -->
                                        <a href="add_asset.php" type="submit" name="approve" class="btn btn-warning"><i class="fa fa-refresh"></i>Refresh</a>
                                    </div>

                                    <div class="form-group">
                                        <label for="branch">BRANCH <strong class="text-danger">*</strong> </label><br>
                                        <input class="form-control" type="text" id="branch" name="branch" required style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_barang">NAMA BARANG <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="nama_barang" name="nama_barang" required style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_pembelian">TANGGAL PEMBELIAN :</label><br>
                                        <input class="form-control" type="date" id="tgl_pembelian" name="tgl_pembelian" value="<?= $date ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit">UNIT <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="unit" name="unit" required style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <label for="pic">PIC <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="pic" name="pic" required style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">KATAGORI <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="katagori" type="text" id="katagori" required>
                                            <option value="FURNITURE">FURNITURE</option>
                                            <option value="MACH & EQUIP">MACH & EQUIP</option>
                                            <option value="LAND">LAND</option>
                                            <option value="LSDVEHICLE">LSDVEHICLE</option>
                                            <option value="NOPSBUILDING">NOPSBUILDING</option>
                                            <option value="NOPSVEHICLE">NOPSVEHICLE</option>
                                            <option value="OPSVEHICLE">OPSVEHICLE</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">KONDISI <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="kondisi" type="text" id="kondisi" required>
                                            <option value="BAIK">BAIK</option>
                                            <option value="BURUK">BURUK</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_data">TANGGAL PENDATAAN <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="date" id="tgl_data" name="tgl_data" value="<?= $date ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">STATUS <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="status" name="status" required style="text-transform: uppercase;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit" name="add_asset">CREATE</button>
                            <!-- <button class="btn btn-danger">Cancel</button> -->
                        </div>
                    </form>
                </div>
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

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", {
            fps: 10,
            qrbox: 250
        }
    );
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>



<?php include '../../footer.php'; ?>