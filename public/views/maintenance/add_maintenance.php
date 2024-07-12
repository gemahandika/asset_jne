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
                        <div class="card-title">Tambah Data Maintenance</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4">
                                <form action="" method="get">
                                    <div class="form-group has-success">
                                        <div id="resultDisplay">Scan Disini</div>
                                        <div style="width:300px;" id="reader"></div><br>
                                        <label for="no_asset">CARI NO ASSET :</label><br>
                                        <input class="form-control" type="text" id="no_asset" name="no_asset" style="text-transform: uppercase;">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="approve" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                        <a href="add_maintenance.php" type="submit" name="approve" class="btn btn-warning"><i class="fa fa-refresh"></i>Refresh</a>
                                    </div>
                                </form>
                                <?php
                                // data sebelum memilih data no asset
                                $no_asset = "";
                                $data1['nama_barang'] = "";
                                $data1['katagori'] = "";
                                $data1['branch'] = "";
                                $data1['unit'] = "";
                                // end
                                if (isset($_GET['no_asset'])) {
                                    $no_asset = $_GET['no_asset'];
                                    $sql = mysqli_query($koneksi, "SELECT * FROM asset WHERE no_asset = '$no_asset'") or die(mysqli_error($koneksi));
                                    if (mysqli_num_rows($sql) > 0) {
                                        $data1 = $sql->fetch_array();
                                    } else {
                                        $data1['nama_barang'] = "Data not found";
                                        $data1['katagori'] = "Data not found";
                                        $data1['branch'] = "Data not found";
                                        $data1['unit'] = "Data not found";
                                    }
                                }
                                ?>
                                <form action="../../../app/controller/Maintenance.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nama_barang">NO ASSET <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="no_asset" name="no_asset" value=" <?= $no_asset ?>" style="text-transform: uppercase;" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_barang">NAMA BARANG <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="nama_barang" name="nama_barang" value="<?= $data1['nama_barang']; ?>" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">KATAGORI <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="katagori" type="text" id="katagori" required>
                                            <option value="<?= $data1['katagori']; ?>"><?= $data1['katagori']; ?></option>
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
                                        <label for="branch">BRANCH <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="branch" name="branch" value="<?= $data1['branch']; ?>" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="unit">UNIT <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="unit" name="unit" value="<?= $data1['unit']; ?>" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pic_gait">PIC GA & IT <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="pic_gait" name="pic_gait" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_req">TANGGAL REQUEST <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="date" id="tgl_req" name="tgl_req" value="<?= $date; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pic_req">PIC REQUEST <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="pic_req" name="pic_req" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kendala">KENDALA <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="text" id="kendala" name="kendala" style="text-transform: uppercase;" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_solved">TANGGAL SOLVED <strong class="text-danger">*</strong></label><br>
                                        <input class="form-control" type="date" id="tgl_solved" name="tgl_solved" value="<?= $date; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">STATUS <strong class="text-danger">*</strong></label>
                                        <select class="form-control" name="status" type="text" id="status" required>
                                            <option value="IT">IT</option>
                                            <option value="GA">GA</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="file">IMAGE :</label><br>
                                        <input class="form-control" type="file" id="file" name="file">
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">KETERANGAN :</label><br>
                                        <input class="form-control" type="text" id="keterangan" name="keterangan" style="text-transform: uppercase;" required>
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