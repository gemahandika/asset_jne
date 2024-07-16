<?php

include '../../../app/config/koneksi.php';
if (!isset($_SESSION['admin_akses'])) {
    $eror = "Ooopss!! Erorr";
} else if (!in_array("super_admin", $_SESSION['admin_akses'])) {
    $eror = "Ooopss!! Erorr";
} else {
    $eror = ""; // Kosongkan variabel error jika user memiliki akses
}
$date = date("Y-m-d");
$time = date("H:i");
?>
<!-- Modal Create -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="../../../app/controller/User_app.php" method="post">
            <div class="modal-content">
                <div class="modal-header btn btn-primary">
                    <h5 class="modal-title fs-5" id="exampleModalLabel"><?php if ($eror) : ?>
                            <h5><?= $eror ?></h5>
                            <?php exit(); ?>
                        <?php endif; ?>
                        Tambah Data User App
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="report-it">
                        <div class="form-group">
                            <label for="nip"><strong>NIK</strong> <strong class="text-danger">*</strong></label><br>
                            <input type="text" class="form-control" name="nip" required style="text-transform: uppercase;">
                        </div>
                        <div class="form-group">
                            <label for="fullname"><strong>Fullname</strong> <strong class="text-danger">*</strong></label><br>
                            <input type="text" class="form-control" id="report2" name="fullname" required style="text-transform: uppercase;">
                        </div>
                        <div class="form-group">
                            <label for="user_id"><strong>User ID</strong> <strong class="text-danger">*</strong></label><br>
                            <input type="text" class="form-control" id="report" name="user_id" required style="text-transform: uppercase;">
                        </div>
                        <div class="form-group">
                            <label for="password"><strong>Password</strong> <strong class="text-danger">*</strong></label><br>
                            <input type="text" class="form-control" id="report1" name="password" required style="text-transform: uppercase;">
                        </div>
                        <input type="hidden" id="status" name="status" value="NON AKTIF" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>