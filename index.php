<?php
require_once("bootstrap.php");

require_once("views/header.php");
?>
<!-- Services section-->
<section id="services">
  <div class="container px-4">
    <div class="row gx-4 justify-content-center">
      <div class="col-lg-12">
        <h2 class="poppins-semibold fs-3 text-center mb-4">Klinik Kecantikan di Kota Pontianak</h2>
        <!-- <p class="lead poppins-light">
          Temukan berbagai <span class="fw-semibold">Klinik Kecantikan</span> yang berada di wilayah <span class="fw-semibold">Kota Pontianak</span>. Menyajikan berbagai macam <span class="fw-semibold">informasi</span> Klinik Kecantikan dan <span class="fw-semibold">ulasan</span> yang diberikan oleh pengunjung sebelumnya. Juga menyajikan <span class="fw-semibold">data perbandingan</span> antara dua Klinik Kecantikan.
        </p> -->
        <div class="row justify-content-around">
          <?php
          $sql = "SELECT * FROM tbl_klinik";
          $result = $conn->query($sql);
          while ($row = $result->fetch_assoc()) {
            echo "<div class='col d-flex justify-content-center'>";
            echo "<div class='card shadow' style='width: 18rem;'>";
            echo "<img src='assets/uploaded-file/" . $row['gambar'] . "' class='card-img-top' width='200' height='200' style='object-fit:cover;'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title poppins-semibold'>" . $row["nama"] . "</h5>";
            echo "<p class='card-text'>" . $row["alamat"] . "</p>";
            echo "<a href='detail-klinik.php?id=" . $row["id"] . "#services' class='btn btn-on-hover text-white' style='background-color:var(--magenta);'>Lihat Detail</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About section-->
<section class="bg-light" id="about">
  <div class="container-fluid">
    <div class="row gx-4 justify-content-center">
      <div class="col-lg-12">
        <h2 class="poppins-semibold fs-3 text-center mb-5">Peta Sebaran Klinik Kecantikan di Wilayah Kota Pontianak</h2>
        <div id="map" style="height: 500px; width: 100%;"></div>
        <script type="text/javascript">
          function initialize() {
            var mapOptions = {
              zoom: 15,
              center: new google.maps.LatLng(-0.026174575275255126, 109.34524986747627),
              disableDefaultUI: false
            };

            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);
            setMarkers(map, officeLocations);
          }

          var officeLocations = [
            <?php
            //WARNING! UBAH URL KETIKA WEB DIHOSTING
            $data = file_get_contents('http://localhost/beauty-clinic/api/ambil-data.php');
            if (json_decode($data, true)) {
              $obj = json_decode($data);
              foreach ($obj->results as $item) {
            ?>[<?= $item->id ?>, '<?= $item->nama ?>', '<?= $item->alamat ?>', <?= $item->longitude ?>, <?= $item->latitude ?>, '<?= $item->gambar ?>'],
            <?php
              }
            }
            ?>
          ];

          function setMarkers(map, locations) {
            for (var i = 0; i < locations.length; i++) {
              var office = locations[i];
              var myLatLng = new google.maps.LatLng(office[4], office[3]);
              var infowindow = new google.maps.InfoWindow({
                content: contentString
              });

              var contentString =
                '<div id="content">' +
                '<div id="siteNotice">' +
                '</div>' +
                '<h5 id="firstHeading" class="firstHeading poppins-medium">' + office[1] + '</h5>' +
                '<div id="bodyContent">' +
                '<img src="assets/uploaded-file/' + office[5] + '" width="200" height="200">' +
                '<p class="poppins-regular">' + office[2] + '</p>' +
                '<a href="detail-klinik.php?id=' + office[0] + '#services" class="poppins-medium">Info Detail</a>' +
                '</div>' +
                '</div>';

              var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: office[1],
                icon: 'img/markermap.png'
              });

              google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));
            }
          }

          function getInfoCallback(map, content) {
            var infowindow = new google.maps.InfoWindow({
              content: content
            });
            return function() {
              infowindow.setContent(content);
              infowindow.open(map, this);
            };
          }

          initialize();
        </script>
      </div>
    </div>
  </div>
</section>
<!-- Compare section-->
<section id="compare">
  <div class="container px-4">
    <div class="row gx-4 justify-content-center mb-4">
      <div class="col-lg-8">
        <h2 class="poppins-semibold fs-3 text-center mb-4">Bandingkan Klinik Kecantikan</h2>
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-6 mb-4">
            <select class="form-select" name="klinik_satu" id="klinikSatu">
              <option value="0" selected hidden>Pilih Klinik Satu</option>
              <?php
              $sql = "SELECT id, nama FROM tbl_klinik";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["nama"] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="col-sm-12 col-md-12 col-lg-6 mb-4">
            <select class="form-select" name="klinik_dua" id="klinikDua">
              <option value="0" selected hidden>Pilih Klinik Dua</option>
              <?php
              $sql = "SELECT id, nama FROM tbl_klinik";
              $result = $conn->query($sql);
              while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["id"] . "'>" . $row["nama"] . "</option>";
              }
              ?>
            </select>
          </div>
          <div class="d-grid">
            <button type="button" class="btn btn-on-hover text-white poppins-medium" id="buttonBanding" style="background-color: var(--magenta);">Bandingkan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Contact section-->
<?php
if (!isset($_SESSION["login_user"])) {
?>
  <section class="bg-light" id="contact">
    <div class="container px-4">
      <div class="row gx-4 justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="poppins-semibold fs-3">Masuk</h2>
          <p class="lead poppins-light">untuk <span class="fw-semibold">memberikan ulasan</span></p>
        </div>
        <div class="col-lg-6 shadow rounded p-4 bg-white">
          <form action="handler.php" method="post" id="formLogin">
            <div class="mb-3">
              <label for="username" class="form-label poppins-medium">Username</label>
              <input type="text" class="form-control form-control-sm poppins-regular" id="username" name="username" placeholder="eg. beata123" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label poppins-medium">Password</label>
              <input type="password" class="form-control form-control-sm poppins-regular" id="password" name="password" required autocomplete="off">
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="showPassword">
              <label class="form-check-label user-select-none" for="showPassword">Lihat Password</label>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-on-hover text-white poppins-medium" id="buttonLogin" style="background-color: var(--magenta);"><span id="spinnerLogin" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Masuk</button>
              <p class="poppins-regular mt-3 mb-0">Belum memiliki akun? <button type="button" class="btn btn-sm btn-on-hover text-white poppins-medium" style="background-color: var(--magenta);" id="btnRegister">Klik di sini!</button></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php
}
?>
<!-- Modal Auth -->
<form action="" method="post" id="formRegister">
  <div class=" modal" data-bs-backdrop="static" data-bs-keyboard="false" id="modalRegister" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Daftar Akun</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="usernameRegister" class="form-label poppins-medium">Username</label>
            <input type="text" class="form-control form-control-sm poppins-regular" id="usernameRegister" name="username_register" placeholder="eg. beata123" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="namaRegister" class="form-label poppins-medium">Nama</label>
            <input type="text" class="form-control form-control-sm poppins-regular" id="namaRegister" name="nama_register" placeholder="eg. Beata" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="emailRegister" class="form-label poppins-medium">Email</label>
            <input type="text" class="form-control form-control-sm poppins-regular" id="emailRegister" name="email_register" placeholder="eg. beata@yahoo.co.id" required autocomplete="off">
          </div>
          <div class="mb-2">
            <label for="passwordRegister" class="form-label poppins-medium">Password</label>
            <input type="password" class="form-control form-control-sm poppins-regular" id="passwordRegister" name="password_register" required autocomplete="off">
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="showPasswordRegister">
            <label class="form-check-label user-select-none" for="showPasswordRegister">Lihat Password</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-on-hover text-white" id="btnRegisterModal" style="background-color:var(--magenta)"><span id="spinnerRegister" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Daftar</button>
        </div>
      </div>
    </div>
  </div>
</form>
<?php
require_once("views/footer.php");
?>