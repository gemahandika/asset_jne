<?php
include '../../header.php';
$date = date("Y-m-d");
$time = date("H:i");
if (!isset($_SESSION['admin_akses'])) {
    $eror = "Ooopss!! Kamu Tidak Punya Akses";
} else if (!in_array("super_admin", $_SESSION['admin_akses'])) {
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
                <strong>- AKTIVASI USER -</strong>
            </h5>
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <table class="display" style="width:100%" id="example">
                            <thead>
                                <tr class="btn-secondary text-white">
                                    <th class="btn-sm text-center">NO</th>
                                    <th class="btn-sm text-center">NIK</th>
                                    <th class="btn-sm text-center">NAMA USER</th>
                                    <th class="btn-sm text-center">USERNAME</th>
                                    <th class="btn-sm text-center">ROLE</th>
                                    <th class="btn-sm text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE status = 'NON AKTIF' ORDER BY login_id ASC") or die(mysqli_error($koneksi));
                                $result = array();
                                while ($data = mysqli_fetch_array($sql)) {
                                    $result[] = $data;
                                }
                                foreach ($result as $data) {
                                    $no++;
                                ?>
                                    <tr>
                                        <td class="btn-sm text-center"><?= $no; ?></td>
                                        <td class="btn-sm text-center"><?= $data['nip'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['nama_user'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['username'] ?></td>
                                        <td class="btn-sm text-center"><?= $data['status'] ?></td>
                                        <td class="btn-sm text-center">
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?= $data['login_id'] ?>">AKTIFKAN USER</a>
                                        </td>
                                    </tr>
                                    <!-- Modal Aktivasi User -->
                                    <div class="modal fade" id="editModal<?= $data['login_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="../../../app/controller/User_app.php" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header btn-secondary text-white">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">AKTIFKAN USER</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="report-it">
                                                            <input type="hidden" name="id" value="<?= $data['login_id'] ?>">
                                                            <input type="text" name="password" value="<?= $data['password'] ?>">
                                                            <h6>Apakah Anda ingin mengaktifkan user atas nama <strong><?= $data['nama_user'] ?></strong> ?</h6>
                                                            <div class="form-group">
                                                                <label class="control-label"><strong>- ROLE</strong> <strong class="text-danger">*</strong></label>
                                                                <select class="form-control" name="role" type="text" id="role" required>
                                                                    <option value="ga">GA</option>
                                                                    <option value="it">IT</option>
                                                                    <option value="asm">ASM</option>
                                                                </select>
                                                            </div><br>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
                                                            <input type="submit" name="aktif_user" class="btn btn-secondary" value="Aktifkan">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../../footer.php';
?>