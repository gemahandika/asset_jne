<?php
// koneksi public
$koneksi = mysqli_connect('localhost', 'u568977811_assetjne', 'Asset1234@', 'u568977811_assetjne');
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}


// koneksi local
// $koneksi = mysqli_connect('localhost', 'root', '', 'db_asset');
// if (mysqli_connect_errno()) {
//     echo mysqli_connect_error();
// }
