<?php
session_start();

// Jika sudah login, redirect ke halaman index
if (isset($_SESSION['admin_username'])) {
  header("location:../index.php");
  exit();
}

include '../../../app/config/koneksi.php';

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Validasi input kosong
  if (empty($username) || empty($password)) {
    $err = "Silahkan Masukan Username dan Password";
  } else {
    // Query untuk mendapatkan user berdasarkan username
    $sql1 = "SELECT * FROM user WHERE username = ?";
    $stmt1 = mysqli_prepare($koneksi, $sql1);

    if ($stmt1) {
      mysqli_stmt_bind_param($stmt1, "s", $username);
      mysqli_stmt_execute($stmt1);

      $result1 = mysqli_stmt_get_result($stmt1);

      // Validasi akun ditemukan dan password sesuai
      if ($result1->num_rows === 0) {
        $err = "Akun Tidak ditemukan";
      } else {
        $row = $result1->fetch_assoc();

        // Periksa password menggunakan md5
        if ($row['password'] !== md5($password)) {
          $err = "Password Salah";
        } else {
          // Query untuk mendapatkan akses user
          $login_id = $row['login_id'];
          $sql2 = "SELECT akses_id FROM admin_akses WHERE login_id = ?";
          $stmt2 = mysqli_prepare($koneksi, $sql2);

          if ($stmt2) {
            mysqli_stmt_bind_param($stmt2, "s", $login_id);
            mysqli_stmt_execute($stmt2);

            $result2 = mysqli_stmt_get_result($stmt2);

            $akses = [];
            while ($row2 = $result2->fetch_assoc()) {
              $akses[] = $row2['akses_id'];
            }

            // Validasi akses tidak kosong
            if (empty($akses)) {
              $err = "Kamu Tidak Punya Akses";
            } else {
              // Set session dan redirect
              $_SESSION['admin_username'] = $username;
              $_SESSION['admin_akses'] = $akses;
              header("location:../index.php");
              exit();
            }
          } else {
            $err = "Kesalahan pada prepared statement 2";
          }
        }
      }
    } else {
      $err = "Kesalahan pada prepared statement 1";
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Login #8</title>
</head>

<body>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8 border p-4 rounded">
              <div class="mb-4">
                <h3>Login <strong>Asset & Maintenance</strong></h3>
              </div>
              <form action="" method="post">
                <label for="username">Username</label>
                <div class="form-group first">
                  <input class="form-control" id="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>" type="text" name="username" autofocus>
                </div>
                <label for="password">Password</label>
                <div class="form-group last mb-4">
                  <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="d-flex mb-5 align-items-center">
                  <?php
                  if ($err) {
                    echo "<h6 style='color: red;'>$err</h6>";
                  }
                  ?>
                  <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> -->
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block"><strong>LOGIN</strong></button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>