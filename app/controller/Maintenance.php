<?php
require_once "../config/koneksi.php";
require_once "../assets/sweetalert/dist/func_sweetAlert.php";


$allowed_extension = array('png', 'jpg', 'jpeg');
$nama = $_FILES['file']['name'];
$dot = explode('.', $nama);
$ekstensi = strtolower(end($dot));
$ukuran = $_FILES['file']['size'];
$file_tmp = $_FILES['file']['tmp_name'];
$image = md5(uniqid($nama, true) . time()) . '.' . $ekstensi;
if (in_array($ekstensi, $allowed_extension) === true) {
    if ($ukuran < 15000000) {
        move_uploaded_file($file_tmp, '../assets/img_maintenance/' . $image);
    } else {
        echo '<script> alert("Ukuran Terlalu Besar") <script>';
    }
} else {
    echo '<script> alert("File Harus png") <script>';
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
    // $image = trim(mysqli_real_escape_string($koneksi, $_POST['image']));
    $keterangan = (mysqli_real_escape_string($koneksi, $_POST['keterangan']));

    // Validasi NIK agar tidak ganda
    // $check_query = "SELECT * FROM maintenance WHERE no_asset = '$no_asset'";
    // $check_result = $koneksi->query($check_query);
    // if ($check_result->num_rows > 0) {
    //     showSweetAlert('warning', 'Oops...', $pesan, '#3085d6', $tujuan2);
    // } else {
    // Masukan data ke tabel anggota
    mysqli_query($koneksi, "INSERT INTO maintenance ( pic_gait, no_asset, tgl_req, nama_barang, katagori, branch, unit, pic_req, kendala, tgl_solved, status, image, keterangan ) 
    VALUES( '$pic_gait', '$no_asset', '$tgl_req', '$nama_barang', '$katagori', '$branch' ,'$unit' , '$pic_req' , '$kendala' , '$tgl_solved' , '$status' , '$image' , '$keterangan')");
    showSweetAlert('success', 'Sukses', $pesan_ok, '#3085d6', $tujuan2);
}
