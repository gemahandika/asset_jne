<?php
include '../../header.php';
// include 'modal2.php';
if (!has_access($allowed_it)) {
    $eror = "Ooopss!! Kamu Tidak Punya Akses";
} else {
    $eror = ""; // Kosongkan variabel error jika user memiliki akses
}

?>

<div class="container">
    <div class="page-inner">
        <div class="row">
            <h5 class="btn ">
                <?php if ($eror) : ?>
                    <h5><?= $eror ?></h5>
                    <?php exit(); ?>
                <?php endif; ?>
                <strong>- DATA MAINTENANCE IT -</strong>
            </h5>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" style="width:100%" id="mauexport">
                                <thead>
                                    <tr class="btn-success text-white">
                                        <th class="btn-sm">NO</th>
                                        <th class="btn-sm">PIC IT</th>
                                        <th class="btn-sm">NO ASSET</th>
                                        <th class="btn-sm">TANGGAL REQUEST</th>
                                        <th class="btn-sm">NAMA BARANG</th>
                                        <th class="btn-sm">KATAGORI</th>
                                        <th class="btn-sm">BRANCH</th>
                                        <th class="btn-sm">UNIT</th>
                                        <th class="btn-sm">PIC REQUEST</th>
                                        <th class="btn-sm">KENDALA</th>
                                        <th class="btn-sm">TANGGAL SOLVED</th>
                                        <th class="btn-sm">IMAGE</th>
                                        <th class="btn-sm">KETERANGAN</th>
                                        <th class="btn-sm">ACTION</th>
                                    </tr>
                                </thead>

                                <?php
                                $no = 0;
                                $sql = mysqli_query($koneksi, "SELECT * FROM maintenance WHERE status = 'IT' ORDER BY id_maintenance DESC") or die(mysqli_error($koneksi));
                                $result = array();
                                while ($data = mysqli_fetch_array($sql)) {
                                    $result[] = $data;
                                }
                                foreach ($result as $data) {
                                    $no++;
                                    $gambar = $data['image'];
                                    if ($gambar == null) {
                                        $img1 = 'No Photo';
                                    } else {
                                        $img1 = '<img src="../../../app/assets/img_maintenance/' . $gambar . '" class="zoomable" style="width: 100%; height: 100%; ">';
                                        // $img = '<img src="../../../app/assets/img_maintenance/' . $gambar . '" class="zoomable">';
                                    }
                                ?>
                                    <tr>
                                        <td class="btn-sm text-center"><?= $no; ?></td>
                                        <td class="btn-sm text-center"><?= $data['pic_gait'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['no_asset'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['tgl_req'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['nama_barang'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['katagori'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['branch'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['unit'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['pic_req'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['kendala'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['tgl_solved'] ?></td>
                                        <td><a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id_maintenance'] ?>">Photo</a></td>
                                        <td class="btn-sm text-center"><?= $data['keterangan'] ?></td>
                                        <td class="btn-sm text-center">
                                            <a href="edit.php?id=<?= $data['id_maintenance'] ?>" class="btn btn-danger btn-sm">EDIT</a>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?= $data['id_maintenance'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header btn btn-dark">
                                                    <h5 class="modal-title fs-5" id="exampleModalLabel">Detail Photo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="report-it">
                                                        <!-- <h2><?= $data['id_maintenance'] ?></h2> -->
                                                        <h1><?= $img1 ?></h1>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
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