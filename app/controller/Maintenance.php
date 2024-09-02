<?php
require_once "../config/koneksi.php";
require_once "../assets/sweetalert/dist/func_sweetAlert.php";

$allowed_extension = array('png', 'jpg', 'jpeg');
$image = '';

if (!empty($_FILES['file']['name'])) {
    $nama = $_FILES['file']['name'];
    $dot = explode('.', $nama);
    $ekstensi = strtolower(end($dot));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi;

    if (in_array($ekstensi, $allowed_extension) === true) {
        if ($ukuran < 15000000) {
            if (!move_uploaded_file($file_tmp, '../assets/img_maintenance/' . $image)) {
                echo '<script> alert("Gagal mengunggah file.") </script>';
                $image = ''; // Set to empty if upload fails
            }
        } else {
            echo '<script> alert("Ukuran Terlalu Besar") </script>';
            $image = ''; // Set to empty if size is too large
        }
    } else {
        echo '<script> alert("File Harus png, jpg, atau jpeg") </script>';
        $image = ''; // Set to empty if invalid extension
    }
}

if (isset($_POST['add_maintenance'])) {
    $no_asset = trim(mysqli_real_escape_string($koneksi, $_POST['no_asset']));
    $nama_barang = trim(mysqli_real_escape_string($koneksi, $_POST['nama_barang']));
    $katagori = trim(mysqli_real_escape_string($koneksi, $_POST['katagori']));
    $branch = trim(mysqli_real_escape_string($koneksi, $_POST['branch']));
    $unit = trim(mysqli_real_escape_string($koneksi, $_POST['unit']));
    $pic_gait = trim(mysqli_real_escape_string($koneksi, $_POST['pic_gait']));
    $tgl_req = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_req']));
    $pic_req = trim(mysqli_real_escape_string($koneksi, $_POST['pic_req']));
    $kendala = trim(mysqli_real_escape_string($koneksi, $_POST['kendala']));
    $tgl_solved = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_solved']));
    $status = trim(mysqli_real_escape_string($koneksi, $_POST['status']));
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    $image_value = !empty($image) ? "'$image'" : "'Data Not Found'"; // Default image value

    $query = "INSERT INTO maintenance (pic_gait, no_asset, tgl_req, nama_barang, katagori, branch, unit, pic_req, kendala, tgl_solved, status, image, keterangan) 
              VALUES ('$pic_gait', '$no_asset', '$tgl_req', '$nama_barang', '$katagori', '$branch', '$unit', '$pic_req', '$kendala', '$tgl_solved', '$status', $image_value, '$keterangan')";

    if (mysqli_query($koneksi, $query)) {
        showSweetAlert('success', 'Sukses',  $pesan_ok, '#3085d6', $tujuan_maintenance);
    } else {
        echo '<script> alert("Gagal menyimpan data.") </script>';
    }
} else if (isset($_POST['edit_maintenance'])) {
    $id = trim(mysqli_real_escape_string($koneksi, $_POST['id_maintenance']));
    $no_asset = trim(mysqli_real_escape_string($koneksi, $_POST['no_asset']));
    $nama_barang = trim(mysqli_real_escape_string($koneksi, $_POST['nama_barang']));
    $katagori = trim(mysqli_real_escape_string($koneksi, $_POST['katagori']));
    $branch = trim(mysqli_real_escape_string($koneksi, $_POST['branch']));
    $unit = trim(mysqli_real_escape_string($koneksi, $_POST['unit']));
    $pic_gait = trim(mysqli_real_escape_string($koneksi, $_POST['pic_gait']));
    $tgl_req = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_req']));
    $pic_req = trim(mysqli_real_escape_string($koneksi, $_POST['pic_req']));
    $kendala = trim(mysqli_real_escape_string($koneksi, $_POST['kendala']));
    $tgl_solved = trim(mysqli_real_escape_string($koneksi, $_POST['tgl_solved']));
    $status = trim(mysqli_real_escape_string($koneksi, $_POST['status']));
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);


    mysqli_query($koneksi, "UPDATE maintenance SET pic_gait='$pic_gait', no_asset='$no_asset', tgl_req='$tgl_req', nama_barang='$nama_barang', katagori='$katagori',
    branch='$branch', unit='$unit', pic_req='$pic_req', kendala='$kendala', tgl_solved='$tgl_solved', status='$status' , keterangan='$keterangan' WHERE id_maintenance='$id'");

    // mysqli_query($koneksi, "UPDATE asset SET branch='$branch', nama_barang='$nama_barang', tgl_pembelian='$tgl_pembelian', unit='$unit', pic='$pic',
    // katagori='$katagori', kondisi='$kondisi', tgl_pendataan='$tgl_data', status='$status'WHERE id_asset='$id'");

    showSweetAlert('success', 'Success', $pesan_update, '#3085d6', $tujuan_maintenance);
}
