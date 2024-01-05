<?php

// process_reset_password.php
include './pages/core/connection.php';
require './assets/PHPMailer-master/src/PHPMailer.php';
require './assets/PHPMailer-master/src/SMTP.php';
require './assets/PHPMailer-master/src/Exception.php';

// PHPMailer/src/PHPMailer.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateRandomCode($length = 6)
{
    return bin2hex(random_bytes($length / 2));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid");
    }

    // Cek keberadaan email di database
    $query = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Jika query berhasil dieksekusi
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Jika email ditemukan
        if ($row) {

            // Buat token reset password
            $token = bin2hex(random_bytes(32));

            // Set waktu kadaluwarsa (misalnya, 1 hari dari sekarang)
            $expiryTime = date('Y-m-d H:i:s', strtotime('+1 day'));

            // Simpan kode verifikasi dan waktu kadaluwarsa di database
            $verificationCode = generateRandomCode(6);
            $updateQuery = "UPDATE user_form SET verification = '$verificationCode', exp_code = '$expiryTime' WHERE email = '$email'";
            mysqli_query($conn, $updateQuery);

            // Kirim email reset password ke pengguna menggunakan PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Konfigurasi SMTP untuk Gmail
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'amirramadhan768@gmail.com'; // Ganti dengan alamat email Anda
                $mail->Password = 'nogs cobl znzt zkvx'; // Ganti dengan kata sandi email Anda
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Pengaturan email
                $mail->setFrom('amirramadhan768@gmail.com', 'RecoveryuComputer'); // Ganti dengan alamat email Anda
                $mail->addAddress($email);
                $mail->Subject = 'Reset Password';
                $mail->Body = 'Anda telah mengajukan reset password. Silakan masukkan kode berikut untuk verifikasi: ' . $verificationCode . PHP_EOL .
                PHP_EOL .

                    'Kode verifikasi ini memiliki jangka waktu kadaluwarsa selama 1 hari sejak saat pembuatan.';

                // Kirim email
                $mail->send();
                echo "<script>window.location.href = 'reset_password.php?berhasil=add_berhasil';</script>";
            } catch (Exception $e) {
                echo "Gagal mengirim email. Pesan error: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>window.location.href = 'lupa_password.php?gagal=add_gagal';</script>";
        }
    } else {
        // Handle kesalahan eksekusi query
        echo "Error: " . mysqli_error($conn);
    }
}
?>