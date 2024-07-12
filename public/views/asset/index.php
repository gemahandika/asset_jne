<?php
include '../../header.php';
// include 'modal2.php';
?>

<div class="container">
    <div class="page-inner">
        <div class="row">
            <h5 class="btn">
                <strong>- DATA ASSET -</strong>
            </h5>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr class="btn-info">
                                        <th class="btn-sm">NO</th>
                                        <th class="btn-sm">NO ASSET</th>
                                        <th class="btn-sm">BRANCH</th>
                                        <th class="btn-sm text-center">NAMA BARANG</th>
                                        <th class="btn-sm text-center">TGL PEMBELIAN</th>
                                        <th class="btn-sm">UNIT</th>
                                        <th class="btn-sm">PIC</th>
                                        <th class="btn-sm">KATAGORI</th>
                                        <th class="btn-sm">KONDISI</th>
                                        <th class="btn-sm text-center">TGL PENDATAAN</th>
                                        <th class="btn-sm">STATUS</th>
                                        <th class="btn-sm">ACTION</th>
                                    </tr>
                                </thead>

                                <?php
                                $no = 0;
                                $sql = mysqli_query($koneksi, "SELECT * FROM asset WHERE destroy = 'NO' ORDER BY id_asset DESC") or die(mysqli_error($koneksi));
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
                                        <td class="btn-sm text-center">
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id_asset'] ?>">DESTROY</button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?= $data['id_asset'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="../../../app/controller/Asset.php" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header btn btn-danger">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">DESTROY ASSET</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="report-it">
                                                            <input type="hidden" name="id_asset" value="<?= $data['id_asset'] ?>">
                                                            <div class="form-group">
                                                                <label for="nama_barang">Apakah Anda Ingin Mendestroy Barang : <strong><?= $data['nama_barang'] ?></strong> </label>
                                                                <input type="hidden" name="delete" value="YA" readonly>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">CLOSE</button>
                                                        <button type="submit" class="btn btn-danger" id="demoNotify" name="destroy">DESTROY</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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