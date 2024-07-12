<?php
require_once "../config/koneksi.php";
require_once "../assets/sweetalert/dist/func_sweetAlert.php";

if (isset($_POST['add_assessment'])) {
    $no_resi = trim(mysqli_real_escape_string($koneksi, $_POST['no_resi']));
    $katagori = trim(mysqli_real_escape_string($koneksi, $_POST['katagori']));
    $status_paket = trim(mysqli_real_escape_string($koneksi, $_POST['status_paket']));
    $tgl_sortir = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_sortir']));
    $lokasi = trim(mysqli_real_escape_string($koneksi, $_POST['lokasi']));
    $keterangan = trim(mysqli_real_escape_string($koneksi, $_POST['keterangan']));

    // Validasi NIK agar tidak ganda
    $check_query = "SELECT * FROM assessment WHERE resi = '$no_resi'";
    $check_result = $koneksi->query($check_query);
    if ($check_result->num_rows > 0) {
        showSweetAlert('warning', 'Oops...', $pesan, '#3085d6', $tujuan);
    } else {
        // Masukan data ke tabel anggota
        mysqli_query($koneksi, "INSERT INTO assessment ( resi, katagori, status, tgl_sortir, lokasi, keterangan) 
    VALUES( '$no_resi', '$katagori', '$status_paket', '$tgl_sortir', '$lokasi' ,'$keterangan')");
        showSweetAlert('success', 'Sukses', $pesan_ok, '#3085d6', '../../public/views/assessment/add_assessment.php');
    }
}
