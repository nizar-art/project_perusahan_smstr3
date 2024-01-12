<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}pages{$ds}core{$ds}header.php");

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Toko</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Beranda</a></li>
        <li class="breadcrumb-item active">Toko</li>
      </ol>
    </nav>
  </div><!-- Akhir Judul Halaman -->
  <section class="section dashboard">
    <div class="row">
      <div class="product-list">
        <?php
        require_once("../../core/connection.php");
        if (isset($_GET['delete_id'])) {
          $deleteId = $_GET['delete_id'];
          $deleteQuery = "DELETE FROM products WHERE id = $deleteId";
          mysqli_query($conn, $deleteQuery);
        }
        // Pastikan koneksi database berhasil
        if (!$conn) {
          die("Koneksi gagal: " . mysqli_connect_error());
        }

        // Ambil produk dari database
        $products = mysqli_query($conn, "SELECT * FROM products");

        // Tampilkan produk
        if (mysqli_num_rows($products) > 0) {
          $counter = 0; // Inisialisasi penghitung untuk setiap dua produk
          while ($row = mysqli_fetch_assoc($products)) {
            if ($counter % 3 == 0) {
              echo '<div class="row">';
            }
            // var_dump( $base_dir . '/recovery/pages/core/path/to/upload/directory/' . $row['image']); die();
        ?>
            <div class="col-12 col-md-4 mb-4">
              <div class="card h-100">
                <a href="#">
                  <img src="<?= '../../core/' . $row['image']; ?>" class="card-img-top" alt="<?= $row['name']; ?>">
                </a>
                <div class="card-body">
                  <a href="#" class="h5 text-decoration-none text-dark"><?= $row['name']; ?></a>
                  <ul class="list-unstyled d-flex justify-content-between">
                    <li class="text-muted text-right">Rp.<?= $row['price']; ?></li>
                  </ul>
                  <p class="card-text">
                    <a class="delete-link" href="?delete_id=<?= $row['id']; ?>" onclick="return confirm('Apakah Anda ingin menghapus produk ini?')">Hapus</a>
                  </p>
                </div>
              </div>
            </div>
        <?php
            $counter++;
            if ($counter % 3 == 0) {
              echo '</div>'; // Tutup tag div setelah dua produk ditampilkan
            }
          }
          if ($counter % 3 != 0) {
            echo '</div>'; // Tutup tag div jika jumlah produk ganjil
          }
        } else {
          echo "Tidak ada produk ditemukan";
        }

        // Tutup koneksi database
        mysqli_close($conn);
        ?>
      </div>
    </div>
  </section>
</main>
<?php
require_once("{$base_dir}pages{$ds}core{$ds}footer.php");
?>s