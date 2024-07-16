<?php
include '../../../app/config/koneksi.php';

function has_access($roles)
{
    foreach ($roles as $role) {
        if (in_array($role, $_SESSION['admin_akses'])) {
            return true;
        }
    }
    return false;
}

$allowed_roles = ["super_admin", "admin", "ga", "it"];
$allowed_ga = ["super_admin", "admin", "ga"];
$allowed_it = ["super_admin", "admin", "it"];
$allowed_asm = ["super_admin", "admin", "asm"];


if (!has_access($allowed_roles)) {
    $eror = "Ooopss!! Kamu Tidak Punya Akses";
} else {
    $eror = ""; // Kosongkan variabel error jika user memiliki akses
}
