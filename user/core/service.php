<?php
require_once("connection.php");
$conn = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $_POST['merk'];
    $detail = $_POST['detail'];
    $token = $_POST['token'];
    $idPesan = $_POST['id_pesan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $telepon = $_POST['telepon'];
    $price = $_POST['price'];

    $sql = "INSERT INTO service_requests (merk, detail, token, id_pesan, tanggal, jam, nama_lengkap, telepon, price) VALUES ('$merk', '$detail', '$token', '$idPesan', '$tanggal', '$jam', '$nama_lengkap', '$telepon', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "<h1>pengiriman anda telah diterima</h1>";
        echo '<h1><a href="/recovery/user/content/service/service.php">Kembali Kehalaman Awal</a></h1>';

        // Setelah berhasil menyimpan ke database, eksekusi SweetAlert
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script>';
        echo 'Swal.fire({';
        echo '  position: "center",';
        echo '  icon: "success",';
        echo '  title: "Your work has been saved",';
        echo '  showConfirmButton: false,';
        echo '  timer: 1500';
        echo '});';
        echo '</script>';

        // Redirect setelah SweetAlert selesai ditampilkan
        echo '<script>';
        echo 'setTimeout(function() {';
        echo '  window.location.href = "/recovery/user/content/service/service.php?success=1";';
        echo '}, 1500);';
        echo '</script>';

        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Pesan error jika terjadi masalah pada query
    }
}
?>
