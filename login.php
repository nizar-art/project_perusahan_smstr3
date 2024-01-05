<?php
@include './pages/core/connection.php';
session_start();

if (isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
   $result = mysqli_query($conn, $select);

   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_array($result);

      if ($row['is_logged_in'] == 1) {
         $error = 'Pengguna dengan email ini sudah login.';
      } else {
         // Set session untuk pengguna yang berhasil login
         $_SESSION['user_id'] = $row['id']; // Ganti dengan nama kolom yang sesuai
         $_SESSION['user_name'] = $row['name'];

         // Tandai pengguna sebagai sudah login di database
         $updateQuery = "UPDATE user_form SET is_logged_in = 1 WHERE id = " . $row['id'];
         mysqli_query($conn, $updateQuery);

         // Redirect ke halaman dashboard
         if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:./pages/content/dashboard/dashboard.php');
            exit();
         } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location:./user/content/dashboard/dashboard.php');
            exit();
         }
      }
   } else {
      $error = 'Email dan password yang Anda masukkan tidak benar!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">

   <title>Pages / Login - Recovery Computer</title>
   <meta content="" name="description">
   <meta content="" name="keywords">

   <!-- Favicons -->
   <link href="assets/img/icon.png" rel="icon">
   <link href="assets/img/icon.png" rel="apple-touch-icon">


   <!-- Google Fonts -->
   <link href="https://fonts.gstatic.com" rel="preconnect">
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
   <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

   <!-- Vendor CSS Files -->
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
   <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
   <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
   <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
   <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

   <!-- Template Main CSS File -->
   <link href="./assets/css/login.css" rel="stylesheet">

   <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


   <div class="form-container">
      <form action="" method="post">
         <h3>Login</h3>
         <?php
         if (isset($error)) {
            echo '<span class="error-msg">' . $error . '</span>';
         }
         ?>
         <input type="email" name="email" required placeholder="Masukkan email anda">
         <input type="password" name="password" required placeholder="Masukkan password anda">
         <input type="submit" name="submit" value="login" class="form-btn">
         <p><a href="lupa_password.php">Lupa Password</a>
         <p>Belum punya akun? <a href="register.php">Daftar sekarang!</a></p>
      </form>

   </div>

   <div id="loading" class="loading">
      <div class="spinner"></div>
   </div>

   <style>
      .loading {
         display: none;
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(255, 255, 255, 0.8);
         z-index: 9999;
         justify-content: center;
         align-items: center;
      }

      .spinner {
         border: 4px solid rgba(0, 0, 0, 0.1);
         border-left: 4px solid #3498db;
         border-radius: 50%;
         width: 50px;
         height: 50px;
         animation: spin 1s linear infinite;
      }

      @keyframes spin {
         0% {
            transform: rotate(0deg);
         }

         100% {
            transform: rotate(360deg);
         }
      }
   </style>

   <script>
      function showLoading() {
         document.getElementById("loading").style.display = "flex";
         setTimeout(hideLoading, 3000); // Mengatur waktu tampilan loading selama 3 detik (3000 milidetik)
      }

      function hideLoading() {
         document.getElementById("loading").style.display = "none";
      }

      document.addEventListener("DOMContentLoaded", function() {
         const form = document.querySelector("form");
         form.addEventListener("submit", function() {
            showLoading();
         });
      });
   </script>





   <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <!-- Vendor JS Files -->
   <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/chart.js/chart.umd.js"></script>
   <script src="assets/vendor/echarts/echarts.min.js"></script>
   <script src="assets/vendor/quill/quill.min.js"></script>
   <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
   <script src="assets/vendor/tinymce/tinymce.min.js"></script>
   <script src="assets/vendor/php-email-form/validate.js"></script>

   <!-- Template Main JS File -->
   <script src="assets/js/main.js"></script>

</body>

</html>