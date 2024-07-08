<?php
include '../../header.php';
include 'modal.php';
?>

<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Tambah Asset
                            </button>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr class="btn-info">
                                        <th class="btn-sm">NO</th>
                                        <th class="btn-sm">NO ASSET</th>
                                        <th class="btn-sm">BRANCH</th>
                                        <th class="btn-sm">NAMA BARANG</th>
                                        <th class="btn-sm">TGL PEMBELIAN</th>
                                        <th class="btn-sm">UNIT</th>
                                        <th class="btn-sm">PIC</th>
                                        <th class="btn-sm">KATAGORI</th>
                                        <th class="btn-sm">KONDISI</th>
                                        <th class="btn-sm">TGL PENDATAAN</th>
                                        <th class="btn-sm">STATUS</th>
                                    </tr>
                                </thead>

                                <?php
                                $no = 0;
                                $sql = mysqli_query($koneksi, "SELECT * FROM asset ORDER BY id_asset DESC") or die(mysqli_error($koneksi));
                                $result = array();
                                while ($data = mysqli_fetch_array($sql)) {
                                    $result[] = $data;
                                }
                                foreach ($result as $data) {
                                    $no++;
                                ?>
                                    <tr>
                                        <td class="btn-sm text-center"><?= $no; ?></td>
                                        <td class="btn-sm text-center"><?= $data['no_asset'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['branch'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['nama_barang'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['tgl_pembelian'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['unit'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['pic'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['katagori'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['kondisi'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['tgl_pendataan'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['status'] ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include '../../footer.php';
?>