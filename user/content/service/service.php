<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '../../../') . $ds;
require_once("{$base_dir}user{$ds}core{$ds}header.php");
$token = uniqid();
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Service</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../dashboard/dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Service</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Start Ngoding Disini -->

      <div class="wrap">
        <div class="judul">
          <h2>Jelaskan Masalah Anda Secara Detail</h2>
          <p>Ceritakan masalah anda secara lengkap, dan jelaskan kebutuhan anda kepada kami.</p>
        </div>
        <div class="kebutuhan-form">

          <br>
          <form action="/recovery/user/core/service.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="ahlRzgSuTJKWi9t4KnEl2h37hRVZcGQf4ITULPHM">
            <div class="form-group">
              <label for="">Merk Alat Elektronik Anda: </label>
              <select name="merk" class="merk" id="" style="width:100%;">

                <option value="acer">Acer</option>

                <option value="advan">Advan</option>

                <option value="asus">Asus</option>

                <option value="dell">Dell</option>

                <option value="hp">HP</option>

                <option value="lenovo">Lenovo</option>

                <option value="msi">MSI</option>

                <option value="samsung">Samsung</option>

              </select>
            </div>
            <br>
            <div class="form-group">
              <label for="">Ceritakan Masalah Kerusakan Anda Secara Detail: </label>
              <textarea name="detail" id="" cols="30" rows="5" class="form-control" required></textarea>
            </div><br>
            <div class="wrap">
              <div class="judul">
                <h2>Buat Janji</h2>
                <p>Tentukan hari dan lokasi agar teknisi kami bisa menjemput alat elektronik anda.</p>
              </div> <br>
              <input type="hidden" name="token" value="<?php echo $token; ?>">
              <b>
                <p class="text-center">Tentukan Tanggal dan Jam: </p>
              </b>
              <div class="row">
                <input type="hidden" name="id_pesan">
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <input type="date" name="tanggal" class="form-control" id="datepicker" placeholder="Tanggal" value="">
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <select class="form-control" name="jam">
                      <option value="06.00 - 09.00">06.00 - 09.00</option>
                      <option value="09.00 - 12.00">09.00 - 12.00</option>
                      <option value="12.00 - 15.00">12.00 - 15.00</option>
                      <option value="15.00 - 18.00">15.00 - 18.00</option>
                      <option value="18.00 - 21.00">18.00 - 21.00</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-2"></div>
              </div>
              <br>
              <div class="form-group">
                <b>
                  <p class="text-center">Data Pribadi: </p>
                </b>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="" required redo>
              </div>
              <br>
              <div class="row">
                <div class="form-group">
                  <input type="number" name="telepon" class="form-control" placeholder="Nomor Telepon" value="">
                </div>
              </div>
              <br>

              <div class="form-group">
                <input type="submit" value="kirim" class="btn btn-warning">
              </div>
          </form>

        </div>
      </div>


      <!-- End Ngoding Disini -->

    </div>
  </section>

</main><!-- End #main -->
<style>
  input[type="submit"] {
    width: 100%;
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ccc;
    margin-bottom: 10px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    background-color: #ffc107;
    color: #fff;
    border: none;
    cursor: pointer;
    font-weight: bold;
  }

  input[type="submit"]:hover {
    background-color: #ff9800;
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
require_once("{$base_dir}user{$ds}core{$ds}footer.php");
?>