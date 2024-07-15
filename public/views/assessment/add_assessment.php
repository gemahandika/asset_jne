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
                        <div class="card-title">Tambah Data ASM</div>
                    </div>
                    <form action="../../../app/controller/Assessment.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-4">
                                    <div class="form-group has-success">
                                        <div id="resultDisplay">Scan Disini</div>
                                        <div style="width:300px;" id="reader"></div><br>
                                        <label for="no_resi">NOMOR RESI :</label><br>
                                        <input class="form-control" type="text" id="no_resi" name="no_resi" style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <!-- <button type="submit" name="approve" class="btn btn-primary"><i class="fa fa-search"></i>Cari</button> -->
                                        <a href="add_asset.php" type="submit" name="approve" class="btn btn-warning"><i class="fa fa-refresh"></i>Refresh</a>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">KATAGORI <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="katagori" type="text" id="katagori" required>
                                            <option value="ACCESSOORIES">ACCESSOORIES</option>
                                            <option value="FHASION">FHASION</option>
                                            <option value="PERLENGKAPAN RT">PERLENGKAPAN RT</option>
                                            <option value="ELECTRONIK">ELECTRONIK</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">STATUS PAKET <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="status_paket" type="text" id="status_paket" required>
                                            <option value="BAGUS">BAGUS</option>
                                            <option value="PENYOK">PENYOK</option>
                                            <option value="RUSAK">RUSAK</option>
                                            <option value="ISI KOSONG">ISI KOSONG</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">MARKET PLACE <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="market" type="text" id="market" required>
                                            <option value="SHOPEE">SHOPEE</option>
                                            <option value="LAZADA">LAZADA</option>
                                            <option value="TOKOPEDIA">TOKOPEDIA</option>
                                            <option value="BLIBLI">BLIBLI</option>
                                            <option value="LAINYA">LAINYA</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_sortir">TANGGAL SORTIR :</label><br>
                                        <input class="form-control" type="date" id="tgl_sortir" name="tgl_sortir" value="<?= $date ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="lokasi">STAGING / LOKASI <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="lokasi" name="lokasi" required style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">KETERANGAN <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="keterangan" name="keterangan" required style="text-transform: uppercase;">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <button class="btn btn-success" type="submit" name="add_assessment">CREATE</button>
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
        document.getElementById('no_resi').value = qrCodeMessage;
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