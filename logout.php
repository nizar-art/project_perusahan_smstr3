<?php
session_start();
@include './pages/core/connection.php';

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Reset status login ke 0 di database
    $updateQuery = "UPDATE user_form SET is_logged_in = 0 WHERE id = $userId";
    mysqli_query($conn, $updateQuery);

    // Hapus semua session
    session_destroy();
}

header("Location: index.php"); // Ganti dengan halaman utama setelah logout
exit();
