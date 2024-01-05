<?php
include './pages/core/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verificationCode = $_POST['verification'];
    $password = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['password']);

    // Validasi apakah password cocok
    if ($password !== $confirmPassword) {
        echo "<script>window.location.href = 'reset_password.php?gagal=tidak_cocok';</script>";
        exit();
    }

    // Validasi panjang minimal password
    if (strlen($password) < 8) {
        echo "<script>window.location.href = 'reset_password.php?gagal=password_pendek';</script>";
        exit();
    }

    $hashedPassword = md5($password);


    $query = $conn->prepare("SELECT * FROM user_form WHERE verification = ?");
    $query->bind_param("s", $verificationCode);
    $query->execute();
    $result = $query->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $expiryTime = $row['exp_code'];
            $update_password = $row['update_password'];
            $currentTime = date('Y-m-d H:i:s');

            if ($expiryTime >= $currentTime) {
               
                $updateQuery = $conn->prepare("UPDATE user_form SET password = ? WHERE verification = ?");
                $updateQuery->bind_param("ss", $hashedPassword, $verificationCode);
                $updateQuery->execute();

                echo "<script>window.location.href = 'login.php?berhasil=ubah_password';</script>";
                exit();
            } else {
                echo "<script>window.location.href = 'reset_password.php?gagal=kadaluarsa';</script>";
            }
        } else {
            echo "<script>window.location.href = 'reset_password.php?gagal=add_gagal';</script>";
        }
    } else {
        die("Query error: " . mysqli_error($conn));
    }
}