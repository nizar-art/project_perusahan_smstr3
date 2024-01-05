<?php
session_start();

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

if (!isset($_SESSION['admin_name'])) {
    header('Location: /login.php'); // Ubah ini sesuai dengan halaman login yang seharusnya
    exit();
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Create</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>

            <body>
                <div class="judul">
                    <h1>Add Products</h1>
                </div>
                <form action="/recovery/pages/core/create.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="input nama produk"> <br><br>
                    <input type="number" name="price" placeholder="input harga produk"> <br><br>
                    <input type="file" name="image">
                    <input type="submit" value="simpan" name="submit">
                </form>
            </body>

            </html>
</main><!-- End #main -->

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
    }

    .main {
        padding: 20px;
    }

    .pagetitle {
        margin-bottom: 20px;
    }

    .section.dashboard {
        margin: 20px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    /* Customize form input and button styles */
    input[type="text"],
    input[type="number"],
    input[type="file"],
    input[type="submit"] {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Center the form elements */
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    .judul {
        text-align: center;
        margin-bottom: 20px;
    }
</style>
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
<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>