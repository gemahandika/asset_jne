<?php
include '../../header.php';
// include 'modal2.php';
if (!has_access($allowed_asm)) {
    $eror = "Ooopss!! Kamu Bukan User ASM";
} else {
    $eror = ""; // Kosongkan variabel error jika user memiliki akses
}
?>

<div class="container">
    <div class="page-inner">
        <div class="row">
            <h5 class="btn">
                <?php if ($eror) : ?>
                    <h5><?= $eror ?></h5>
                    <?php exit(); ?>
                <?php endif; ?>
                <strong>- DATA ASM -</strong>
            </h5>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" style="width:100%" id="mauexport">
                                <thead>
                                    <tr class="btn-primary text-white">
                                        <th class="btn-sm">NO</th>
                                        <th class="btn-sm">RESI</th>
                                        <th class="btn-sm">KATAGORI</th>
                                        <th class="btn-sm">STATUS</th>
                                        <th class="btn-sm">MARKET</th>
                                        <th class="btn-sm">TGL SORTIR</th>
                                        <th class="btn-sm">LOKASI</th>
                                        <th class="btn-sm">KETERANGAN</th>
                                        <th class="btn-sm">ACTION</th>
                                    </tr>
                                </thead>

                                <?php
                                $no = 0;
                                $sql = mysqli_query($koneksi, "SELECT * FROM assessment ORDER BY id_assessment DESC") or die(mysqli_error($koneksi));
                                $result = array();
                                while ($data = mysqli_fetch_array($sql)) {
                                    $result[] = $data;
                                }
                                foreach ($result as $data) {
                                    $no++;
                                ?>
                                    <tr>
                                        <td class="btn-sm text-center"><?= $no; ?></td>
                                        <td class="btn-sm text-center"><?= $data['resi'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['katagori'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['status'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['market'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['tgl_sortir'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['lokasi'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['keterangan'] ?></td>
                                        <td class="btn-sm text-center">
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['id_assessment'] ?>">EDIT</button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModal<?= $data['id_assessment'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="../../../app/controller/Assessment.php" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header btn btn-success">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">EDIT DATA ASSESSMENT</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id_assessment" name="id_assessment" value="<?= $data['id_assessment'] ?>" required>
                                                        <div class="form-group">
                                                            <label for="no_resi">NO RESI :</label><br>
                                                            <input class="form-control" type="text" id="no_resi" name="no_resi" value="<?= $data['resi'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">KATAGORI <strong class="text-danger">*</strong></label>
                                                            <select class="form-control" name="katagori" type="text" id="katagori" required>
                                                                <option value="<?= $data['katagori'] ?>"><?= $data['katagori'] ?></option>
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
                                                                <option value="<?= $data['status'] ?>"><?= $data['status'] ?></option>
                                                                <option value="PENYOK">PENYOK</option>
                                                                <option value="RUSAK">RUSAK</option>
                                                                <option value="ISI KOSONG">ISI KOSONG</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">MARKET PLACE <strong class="text-danger">*</strong></label>
                                                            <select class="form-control" name="market" type="text" id="market" required>
                                                                <option value="<?= $data['market'] ?>"><?= $data['market'] ?></option>
                                                                <option value="SHOPEE">SHOPEE</option>
                                                                <option value="LAZADA">LAZADA</option>
                                                                <option value="TOKOPEDIA">TOKOPEDIA</option>
                                                                <option value="BLIBLI">BLIBLI</option>
                                                                <option value="LAINYA">LAINYA</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="tgl_sortir">TANGGAL SORTIR :</label><br>
                                                            <input class="form-control" type="date" id="tgl_sortir" name="tgl_sortir" value="<?= $data['tgl_sortir'] ?>" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="lokasi">STAGING / LOKASI <strong class="text-danger">*</strong></label><br>
                                                            <input class="form-control" type="text" id="lokasi" name="lokasi" value="<?= $data['lokasi'] ?>" required style="text-transform: uppercase;">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="keterangan">KETERANGAN <strong class="text-danger">*</strong></label><br>
                                                            <input class="form-control" type="text" id="keterangan" name="keterangan" value="<?= $data['keterangan'] ?>" required style="text-transform: uppercase;">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" id="demoNotify" name="edit">UPDATE</button>
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