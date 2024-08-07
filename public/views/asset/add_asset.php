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
                                        <a href="add_asset.php" type="submit" name="approve" class="btn btn-warning"><i class="fa fa-refresh"></i>Refresh</a>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">BRANCH <strong class="text-danger">*</strong></label>
                                        <select class="form-control" id="branch" name="branch" aria-label="Default select example" required>
                                            <option value="">- Pilih Cabang -</option>
                                            <?php
                                            $no = 1;
                                            $sql = mysqli_query($koneksi, "SELECT * FROM tb_cabang") or die(mysqli_error($koneksi));
                                            $result = array();
                                            while ($data = mysqli_fetch_array($sql)) {
                                                $result[] = $data;
                                            }
                                            foreach ($result as $data) {
                                            ?>
                                                <option value="<?= $data['nama_cabang'] ?>"><?= $no++; ?>. <?= $data['nama_cabang'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_barang">NAMA BARANG <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="nama_barang" name="nama_barang" required style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_pembelian">TANGGAL PEMBELIAN :</label><br>
                                        <input class="form-control" type="date" id="tgl_pembelian" name="tgl_pembelian" value="<?= $date ?>">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">UNIT <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="unit" type="text" id="unit" required>
                                            <option value="OUTBOUND">OUTBOUND</option>
                                            <option value="INBOUND">INBOUND</option>
                                            <option value="GA">GA</option>
                                            <option value="HC">HC</option>
                                            <option value="CS">CS</option>
                                            <option value="SALES">SALES</option>
                                            <option value="HEAVY CARGO">HEAVY CARGO</option>
                                            <option value="JTR">JTR</option>
                                            <option value="CCC">CCC</option>
                                            <option value="IT">IT</option>
                                            <option value="FINANCE">FINANCE</option>
                                            <option value="FULLFILMENT">FULLFILMENT</option>
                                            <option value="CR3">CR3</option>
                                            <option value="PICKUP">PICKUP</option>
                                            <option value="KP ATC">KP ATC</option>
                                            <option value="KP MEDAN BARAT">KP MEDAN BARAT</option>
                                            <option value="KP MEDAN TIMUR">KP MEDAN TIMUR</option>
                                            <option value="KP PELANGI">KP PELANGI</option>
                                            <option value="KP JUANDA">KP JUANDA</option>
                                            <option value="KP WAHID HASYM">KP WAHID HASYM</option>
                                            <option value="KP TOMANG">KP TOMANG</option>
                                            <option value="KP MARELAN">KP MARELAN</option>
                                            <option value="KP THAMRIN">KP THAMRIN</option>
                                            <option value="LAINNYA">LAINNYA</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="pic">PIC <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="pic" name="pic" required style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">KATAGORI <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="katagori" type="text" id="katagori" required>
                                            <option value="FURNITURE">FURNITURE</option>
                                            <option value="MACH&EQUIP">MACH & EQUIP</option>
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
                                            <option value="RUSAK">RUSAK</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_data">TANGGAL PENDATAAN <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="date" id="tgl_data" name="tgl_data" value="<?= $date ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">STATUS <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="status" type="text" id="status" required>
                                            <option value="GA">GA</option>
                                            <option value="IT">IT</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="destroy" value="NO" required readonly>
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