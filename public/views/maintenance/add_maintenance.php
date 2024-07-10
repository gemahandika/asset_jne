<?php
include '../../header.php';
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
                                        <label for="no_asset">Nomor asset :</label><br>
                                        <input class="form-control" type="text" id="no_asset" name="no_asset">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" name="approve" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
                                        <a href="add_asset.php" type="submit" name="approve" class="btn btn-warning"><i class="fa fa-refresh"></i>Refresh</a>
                                    </div>
                                </form>
                                <?php
                                // data sebelum memilih data no asset
                                $data1['nama_barang'] = "Data Belum dimasukan";
                                $data1['katagori'] = "Data Belum dimasukan";
                                $data1['branch'] = "Data Belum dimasukan";
                                $data1['unit'] = "Data Belum dimasukan";
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
                                        <input class="form-control" type="text" id="no_asset" name="no_asset" value=" <?= $no_asset ?>">
                                        <label for="nama_barang">Nama Barang :</label><br>
                                        <input class="form-control" type="text" id="nama_barang" name="nama_barang" value="<?= $data1['nama_barang']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="katagori">Katagori :</label><br>
                                        <input class="form-control" type="text" id="katagori" name="katagori" value="<?= $data1['katagori']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="branch">Branch :</label><br>
                                        <input class="form-control" type="text" id="branch" name="branch" value="<?= $data1['branch']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="unit">Unit :</label><br>
                                        <input class="form-control" type="text" id="unit" name="unit" value="<?= $data1['unit']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="pic_gait">PIC GA & IT :</label><br>
                                        <input class="form-control" type="text" id="pic_gait" name="pic_gait" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_req">TANGGAL REQUEST :</label><br>
                                        <input class="form-control" type="date" id="tgl_req" name="tgl_req" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pic_req">PIC REQUEST :</label><br>
                                        <input class="form-control" type="text" id="pic_req" name="pic_req" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="kendala">KENDALA :</label><br>
                                        <input class="form-control" type="text" id="kendala" name="kendala" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_solved">TANGGAL SOLVED :</label><br>
                                        <input class="form-control" type="date" id="tgl_solved" name="tgl_solved" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">STATUS :</label><br>
                                        <input class="form-control" type="text" id="status" name="status" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="file">IMAGE :</label><br>
                                        <input class="form-control" type="file" id="file" name="file" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="keterangan">KETERANGAN :</label><br>
                                        <input class="form-control" type="text" id="keterangan" name="keterangan" required>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="submit" name="add_maintenance">Submit</button>
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