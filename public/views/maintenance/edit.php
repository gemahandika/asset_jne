<?php
include '../../header.php';
$date = date("Y-m-d");
$time = date("H:i");

$id_maintenance = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM maintenance WHERE id_maintenance = '$id_maintenance'") or die(mysqli_error($koneksi));
$data = mysqli_fetch_array($sql);
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
                        <div class="card-title">Edit Data Maintenance</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                <form action="../../../app/controller/Maintenance.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nama_barang">NO ASSET <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="no_asset" name="no_asset" value=" <?= $data['no_asset'] ?>" style="text-transform: uppercase;" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_barang">NAMA BARANG <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="nama_barang" name="nama_barang" value="<?= $data['nama_barang']; ?>" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">KATAGORI <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="katagori" type="text" id="katagori" required>
                                            <option value="<?= $data['katagori']; ?>"><?= $data['katagori']; ?></option>
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
                                        <label class="control-label">BRANCH <strong class="text-danger">*</strong></label>
                                        <select class="form-control" id="branch" name="branch" aria-label="Default select example" required>
                                            <option value="<?= $data['branch']; ?>"><?= $data['branch']; ?></option>
                                            <?php
                                            $no = 1;
                                            $sql1 = mysqli_query($koneksi, "SELECT * FROM tb_cabang") or die(mysqli_error($koneksi));
                                            $result = array();
                                            while ($data1 = mysqli_fetch_array($sql1)) {
                                                $result1[] = $data1;
                                            }
                                            foreach ($result1 as $data1) {
                                            ?>
                                                <option value="<?= $data1['nama_cabang'] ?>"><?= $no++; ?>. <?= $data1['nama_cabang'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">UNIT <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="unit" type="text" id="unit" required>
                                            <option value="<?= $data['unit']; ?>"> <?= $data['unit']; ?></option>
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
                                            <option value="AGEN">AGEN</option>
                                            <option value="ADMIN DELIVERY">ADMIN DELIVERY</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="pic_gait">PIC GA & IT <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="pic_gait" name="pic_gait" value="<?= $data['pic_gait']; ?>" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_req">TANGGAL REQUEST <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="date" id="tgl_req" name="tgl_req" value="<?= $data['tgl_req']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pic_req">PIC REQUEST <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="pic_req" name="pic_req" value="<?= $data['pic_req']; ?>" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kendala">KENDALA <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="kendala" name="kendala" value="<?= $data['kendala']; ?>" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_solved">TANGGAL SOLVED <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="date" id="tgl_solved" name="tgl_solved" value="<?= $data['tgl_solved']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">GA / IT <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="status" type="text" id="status" required>
                                            <option value="<?= $data['status']; ?>"><?= $data['status']; ?></option>
                                            <option value="IT">IT</option>
                                            <option value="GA">GA</option>
                                        </select>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for="file">IMAGE :</label><br>
                                        <input class="form-control" type="file" id="file" name="file">
                                    </div> -->

                                    <div class="form-group">
                                        <label for="keterangan">KETERANGAN :</label><br>
                                        <input class="form-control" type="text" id="keterangan" name="keterangan" value="<?= $data['keterangan']; ?>" style="text-transform: uppercase;" required>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="submit" name="add_maintenance">CREATE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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