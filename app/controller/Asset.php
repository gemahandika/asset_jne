<?php
require_once "../config/koneksi.php";
require_once "../assets/sweetalert/dist/func_sweetAlert.php";

if (isset($_POST['add_asset'])) {
    $no_asset = trim(mysqli_real_escape_string($koneksi, $_POST['no_asset']));
    $branch = trim(mysqli_real_escape_string($koneksi, $_POST['branch']));
    $nama_barang = trim(mysqli_real_escape_string($koneksi, $_POST['nama_barang']));
    $tgl_pembelian = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_pembelian']));
    $unit = trim(mysqli_real_escape_string($koneksi, $_POST['unit']));
    $pic = trim(mysqli_real_escape_string($koneksi, $_POST['pic']));
    $katagori = trim(mysqli_real_escape_string($koneksi, $_POST['katagori']));
    $kondisi = trim(mysqli_real_escape_string($koneksi, $_POST['kondisi']));
    $tgl_data = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_data']));
    $status = (mysqli_real_escape_string($koneksi, $_POST['status']));
    $destroy = (mysqli_real_escape_string($koneksi, $_POST['destroy']));

    // Validasi NIK agar tidak ganda
    $check_query = "SELECT * FROM asset WHERE no_asset = '$no_asset'";
    $check_result = $koneksi->query($check_query);
    if ($check_result->num_rows > 0) {
        showSweetAlert('warning', 'Oops...', $pesan, '#3085d6', $tujuan);
    } else {
        // Masukan data ke tabel anggota
        mysqli_query($koneksi, "INSERT INTO asset ( no_asset, branch, nama_barang, tgl_pembelian, unit, pic, katagori, kondisi, tgl_pendataan, status, destroy ) 
    VALUES( '$no_asset', '$branch', '$nama_barang', '$tgl_pembelian', '$unit', '$pic' ,'$katagori' , '$kondisi' , '$tgl_data' , '$status' , '$destroy')");
        showSweetAlert('success', 'Sukses', $pesan_ok, '#3085d6', $tujuan);
    }
} else if (isset($_POST['destroy'])) {
    $id_asset = trim(mysqli_real_escape_string($koneksi, $_POST['id_asset']));
    $delete = trim(mysqli_real_escape_string($koneksi, $_POST['delete']));

    // Update status tb daftar
    mysqli_query($koneksi, "UPDATE asset SET destroy ='$delete' WHERE id_asset='$id_asset'");
    showSweetAlert('success', 'Success', $pesan_destroy, '#3085d6', $destroy);
} else if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $branch = trim(mysqli_real_escape_string($koneksi, $_POST['branch']));
    $nama_barang = trim(mysqli_real_escape_string($koneksi, $_POST['nama_barang']));
    $tgl_pembelian = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_pembelian']));
    $unit = trim(mysqli_real_escape_string($koneksi, $_POST['unit']));
    $pic = trim(mysqli_real_escape_string($koneksi, $_POST['pic']));
    $katagori = trim(mysqli_real_escape_string($koneksi, $_POST['katagori']));
    $kondisi = trim(mysqli_real_escape_string($koneksi, $_POST['kondisi']));
    $tgl_data = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_data']));
    $status = (mysqli_real_escape_string($koneksi, $_POST['status']));
    // $destroy = (mysqli_real_escape_string($koneksi, $_POST['destroy']));

    mysqli_query($koneksi, "UPDATE asset SET branch='$branch', nama_barang='$nama_barang', tgl_pembelian='$tgl_pembelian', unit='$unit', pic='$pic',
    katagori='$katagori', kondisi='$kondisi', tgl_pendataan='$tgl_data', status='$status'WHERE id_asset='$id'");

    showSweetAlert('success', 'Success', $pesan_update, '#3085d6', $tujuan);
}

//  else if (isset($_POST['ambil'])) {
//     $id = $_POST['id'];
//     $saldo_update = trim(mysqli_real_escape_string($koneksi, $_POST['saldo_update']));

//     $jenis_bukubesar = trim(mysqli_real_escape_string($koneksi, $_POST['jenis_bukubesar']));
//     $tgl_bukubesar = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_bukubesar']));
//     $keterangan = trim(mysqli_real_escape_string($koneksi, $_POST['keterangan']));
//     $debit_bukubesar = trim(mysqli_real_escape_string($koneksi, $_POST['debit_bukubesar']));
//     $kredit_bukubesar = trim(mysqli_real_escape_string($koneksi, $_POST['kredit_bukubesar']));

//     mysqli_query($koneksi, "UPDATE tb_anggota SET saldo='$saldo_update' WHERE id_anggota='$id'");
//     // Masukan data ke table bukubesar
//     mysqli_query($koneksi, "INSERT INTO tb_bukubesar(jenis_bukubesar, tgl_bukubesar, keterangan, debit_bukubesar, kredit_bukubesar) 
//     VALUES('$jenis_bukubesar', '$tgl_bukubesar', '$keterangan', '$debit_bukubesar', '$kredit_bukubesar')");
//     showSweetAlert('success', 'Success', $pesan_ambil, '#3085d6', $tujuan_3);
