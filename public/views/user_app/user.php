<?php
include '../../header.php';
include 'modal_user.php';
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
            <h5 class="btn">
                <?php if ($eror) : ?>
                    <h5><?= $eror ?></h5>
                    <?php exit(); ?>
                <?php endif; ?>
                <strong>- DATA USER APLIKASI -</strong>
            </h5>
            <div class="col-md-12">
                <div class="tile">
                    <section class="invoice">
                        <button type="button" class="btn btn-primary icon-btn mr-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-user-plus"></i> Tambah Data </button>
                        <a href="aktivasi.php" type="submit" name="approve" class="btn btn-success icon-btn mr-2"><i class="fas fa-user-edit"></i> Aktivasi User</a>
                        <table class="display" style="width:100%" id="example">
                            <thead>
                                <tr class="btn-black">
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
                                $sql = mysqli_query($koneksi, "SELECT * FROM user ORDER BY login_id ASC") or die(mysqli_error($koneksi));
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
                                            <a href="edit_asset.php?id=<?= $data['login_id'] ?>" class="btn btn-danger btn-sm">EDIT</a>
                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#aksesModal<?= $data['login_id'] ?>">Nonaktif User</a>
                                        </td>
                                    </tr>
                                    <!-- Modal NON AKtif 111 -->
                                    <div class="modal fade" id="aksesModal<?= $data['login_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="../../../app/controller/User_app.php" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header btn btn-success">
                                                        <h5 class="modal-title fs-5" id="exampleModalLabel">Nonaktif User</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="report-it">

                                                            <h6>Apakah Anda ingin menon-aktifkan user atas nama <?= $data['nama_user'] ?> ?</h6>

                                                            <input type="hidden" name="id" value="<?= $data['login_id'] ?>" readonly>
                                                            <input type="hidden" id="user_id" name="user_id" value="<?= $data['username'] ?>" readonly>
                                                            <input type="hidden" id="password" name="password" value="123" readonly>
                                                            <input class="dept-1" name="role" type="hidden" value="NON AKTIF" readonly>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <input type="submit" name="nonaktif_user" class="btn btn-primary" value="Non Aktif">
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