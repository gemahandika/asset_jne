<?php
// asset
if (isset($_GET['dari']) && isset($_GET['ke'])) {
    $sql1 = mysqli_query($koneksi, "SELECT * FROM asset WHERE tgl_pendataan BETWEEN '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'") or die(mysqli_error($koneksi));
    $asset = mysqli_num_rows($sql1);
} else {
    $sql1 = mysqli_query($koneksi, "SELECT * FROM asset ") or die(mysqli_error($koneksi));
    $asset = mysqli_num_rows($sql1);
}
// end

// maintenance GA
if (isset($_GET['dari']) && isset($_GET['ke'])) {
    $sql2 = mysqli_query($koneksi, "SELECT * FROM maintenance WHERE status = 'GA' AND tgl_req BETWEEN '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'") or die(mysqli_error($koneksi));
    $maintenance_ga = mysqli_num_rows($sql2);
} else {
    $sql2 = mysqli_query($koneksi, "SELECT * FROM maintenance WHERE status = 'GA' ") or die(mysqli_error($koneksi));
    $maintenance_ga = mysqli_num_rows($sql2);
}
// IT
if (isset($_GET['dari']) && isset($_GET['ke'])) {
    $sql3 = mysqli_query($koneksi, "SELECT * FROM maintenance WHERE status = 'IT' AND tgl_req BETWEEN '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'") or die(mysqli_error($koneksi));
    $maintenance_it = mysqli_num_rows($sql3);
} else {
    $sql3 = mysqli_query($koneksi, "SELECT * FROM maintenance WHERE status = 'IT' ") or die(mysqli_error($koneksi));
    $maintenance_it = mysqli_num_rows($sql3);
}
// end

// destroy
if (isset($_GET['dari']) && isset($_GET['ke'])) {
    $destroy = mysqli_query($koneksi, "SELECT * FROM asset WHERE destroy = 'YA' AND tgl_pendataan BETWEEN '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'") or die(mysqli_error($koneksi));
    $asset_destroy = mysqli_num_rows($destroy);
} else {
    $destroy = mysqli_query($koneksi, "SELECT * FROM asset WHERE destroy = 'YA' ") or die(mysqli_error($koneksi));
    $asset_destroy = mysqli_num_rows($destroy);
}
// end

// assessment
if (isset($_GET['dari']) && isset($_GET['ke'])) {
    $assessment = mysqli_query($koneksi, "SELECT * FROM assessment tgl_pendataan BETWEEN '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'") or die(mysqli_error($koneksi));
    $asset_assessment = mysqli_num_rows($assessment);
} else {
    $assessment = mysqli_query($koneksi, "SELECT * FROM assessment  ") or die(mysqli_error($koneksi));
    $asset_assessment = mysqli_num_rows($assessment);
}
// end

// BAR CHART 
// Fungsi untuk mengambil data dari database
function getDataForBarChart($koneksi, $dari = '', $ke = '')
{
    $data = array();

    // Menambahkan klausa WHERE jika rentang tanggal diberikan
    $where_clause = "";
    if ($dari != '' && $ke != '') {
        $where_clause = "WHERE tgl_pendataan BETWEEN '$dari' AND '$ke'";
    }

    // Query untuk mengambil jumlah anggota yang bergabung pada setiap bulan tahun
    $query = "SELECT DATE_FORMAT(tgl_pendataan, '%Y-%m') AS bulan, COUNT(*) AS jumlah_asset FROM asset $where_clause GROUP BY DATE_FORMAT(tgl_pendataan, '%Y-%m')";
    $result = mysqli_query($koneksi, $query);

    // Memproses hasil query
    while ($row = mysqli_fetch_assoc($result)) {
        $bulan = $row['bulan'];
        $jumlah_asset = $row['jumlah_asset'];

        // Menambahkan data ke dalam array
        $data[] = array(
            'bulan' => $bulan,
            'jumlah_asset' => $jumlah_asset
        );
    }

    return $data;
}

// Mengambil parameter dari form (jika ada)
$dari = isset($_GET['dari']) ? $_GET['dari'] : '';
$ke = isset($_GET['ke']) ? $_GET['ke'] : '';

// Panggil fungsi untuk mendapatkan data
$data_asset = getDataForBarChart($koneksi, $dari, $ke);

// Convert data ke dalam format JSON
$json_data_asset = json_encode($data_asset);


// PIE CHART==========================================================================================================
// Mengambil parameter dari form (jika ada)
$dari = isset($_GET['dari']) ? $_GET['dari'] : '';
$ke = isset($_GET['ke']) ? $_GET['ke'] : '';

$where_clause = "";
if ($dari != '' && $ke != '') {
    $where_clause = "AND tgl_pendataan BETWEEN '$dari' AND '$ke'";
}

// Query untuk mengambil data dari database
$sql = "SELECT 'FURNITURE' AS katagori, COUNT(*) AS total FROM asset WHERE katagori = 'FURNITURE' $where_clause
        UNION 
        SELECT 'MACH & EQUIP' AS katagori, COUNT(*) AS total FROM asset WHERE katagori = 'MACH&EQUIP' $where_clause
        UNION 
        SELECT 'LAND' AS katagori, COUNT(*) AS total FROM asset WHERE katagori = 'LAND' $where_clause
        UNION 
        SELECT 'LSDVEHICLE' AS katagori, COUNT(*) AS total FROM asset WHERE katagori = 'LSDVEHICLE' $where_clause
        UNION 
        SELECT 'NOPSBUILDING' AS katagori, COUNT(*) AS total FROM asset WHERE katagori = 'NOPSBUILDING' $where_clause
        UNION 
        SELECT 'NOPSVEHICLE' AS katagori, COUNT(*) AS total FROM asset WHERE katagori = 'NOPSVEHICLE' $where_clause
        UNION 
        SELECT 'OPSVEHICLE' AS katagori, COUNT(*) AS total FROM asset WHERE katagori = 'OPSVEHICLE' $where_clause";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
}

// Siapkan array untuk menyimpan data dinamis
$pdata = array();

// Loop melalui hasil query dan tambahkan data ke array $pdata
while ($row = mysqli_fetch_assoc($result)) {
    $katagori = $row['katagori'];
    $total = $row['total'];

    // Tentukan warna berdasarkan kategori
    $color = '';
    $highlight = '';
    if ($katagori == 'FURNITURE') {
        $color = '#4CAF50';
        $highlight = '#81C784';
    } elseif ($katagori == 'MACH & EQUIP') {
        $color = '#FF9800';
        $highlight = '#FFB74D';
    } elseif ($katagori == 'LAND') {
        $color = '#F44336';
        $highlight = '#EF5350';
    } elseif ($katagori == 'LSDVEHICLE') {
        $color = '#9C27B0';
        $highlight = '#BA68C8';
    } elseif ($katagori == 'NOPSBUILDING') {
        $color = '#3F51B5';
        $highlight = '#7986CB';
    } elseif ($katagori == 'NOPSVEHICLE') {
        $color = '#00BCD4';
        $highlight = '#4DD0E1';
    } elseif ($katagori == 'OPSVEHICLE') {
        $color = '#FFC107';
        $highlight = '#FFD54F';
    }

    // Tambahkan data ke array $pdata
    $pdata[] = [
        'value' => $total,
        'color' => $color,
        'highlight' => $highlight,
        'label' => ucfirst(strtolower($katagori)) // Menggunakan ucfirst() untuk membuat huruf pertama dari status menjadi kapital
    ];
}

// Konversi array $pdata menjadi format JSON
$json_data = json_encode($pdata);

$furniture = mysqli_query($koneksi, "SELECT * FROM asset WHERE katagori = 'furniture' $where_clause") or die(mysqli_error($koneksi));
$jumlah_furniture = mysqli_num_rows($furniture);
$mach = mysqli_query($koneksi, "SELECT * FROM asset WHERE katagori = 'mach&equip' $where_clause") or die(mysqli_error($koneksi));
$jumlah_mach = mysqli_num_rows($mach);
$land = mysqli_query($koneksi, "SELECT * FROM asset WHERE katagori = 'land' $where_clause") or die(mysqli_error($koneksi));
$jumlah_land = mysqli_num_rows($land);
$lsdvehicle = mysqli_query($koneksi, "SELECT * FROM asset WHERE katagori = 'lsdvehicle' $where_clause") or die(mysqli_error($koneksi));
$jumlah_lsdvehicle = mysqli_num_rows($lsdvehicle);
$nopsbuilding = mysqli_query($koneksi, "SELECT * FROM asset WHERE katagori = 'nopsbuilding' $where_clause") or die(mysqli_error($koneksi));
$jumlah_nopsbuilding = mysqli_num_rows($nopsbuilding);
$nopsvehicle = mysqli_query($koneksi, "SELECT * FROM asset WHERE katagori = 'nopsvehicle' $where_clause") or die(mysqli_error($koneksi));
$jumlah_nopsvehicle = mysqli_num_rows($nopsvehicle);
$opsvehicle = mysqli_query($koneksi, "SELECT * FROM asset WHERE katagori = 'opsvehicle' $where_clause") or die(mysqli_error($koneksi));
$jumlah_opsvehicle = mysqli_num_rows($opsvehicle);
