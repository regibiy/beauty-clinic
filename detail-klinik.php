<?php
require_once("bootstrap.php");

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["login_user"])) {
        redirect_alert("Anda harus masuk untuk memberikan ulasan!", "index.php#contact");
        exit();
    } else {
        $id_user = $_SESSION["id_user"];
        $id_klinik = $id;
        $tanggal = date("Y-m-d H:i:s");
        $ulasan = $conn->real_escape_string($_POST["ulasan"]);
        $status = "Menunggu";
        $sql = "INSERT INTO tbl_ulasan (id_user, id_klinik, tanggal, ulasan, status) VALUES ('$id_user', '$id_klinik', '$tanggal', '$ulasan', '$status')";
        if ($conn->query($sql)) {
            redirect_alert("Ulasan berhasil disimpan dan menunggu persetujuan!", "index.php#about");
        } else {
            redirect_alert("Ulasan gagal disimpan!", "index.php#about");
        }
    }
}


$sql = "SELECT * FROM tbl_klinik WHERE id = '$id'";
$result = $conn->query($sql);
$data_klinik = $result->fetch_assoc();

$sql = "SELECT * FROM tbl_jam_operasional WHERE id_klinik = '$id'";
$data_jam_op = $conn->query($sql);

$sql = "SELECT * FROM tbl_treatment WHERE id_klinik = '$id'";
$data_treatment = $conn->query($sql);

$sql = "SELECT * FROM tbl_sosmed WHERE id_klinik = '$id'";
$data_sosmed = $conn->query($sql);

$sql = "SELECT tanggal, ulasan, tbl_user.nama AS nama_user FROM tbl_ulasan INNER JOIN tbl_user ON tbl_ulasan.id_user = tbl_user.id WHERE id_klinik = '$id' AND status NOT IN ('Menunggu', 'Ditolak')";
$data_ulasan = $conn->query($sql);

require_once("views/header.php");
?>
<!-- Services section-->
<section id="services">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-12">
                <h2 class="poppins-semibold fs-3 mb-3 text-center">Detail Klinik Kecantikan <?= $data_klinik["nama"] ?></h2>
                <hr>
                <h3 class="poppins-semibold fs-4 mb-3 text-center">Informasi Klinik</h3>
                <p class="poppins-regular"> Berikut adalah gambar dari klinik kecantikan <span class="poppins-semibold"><?= $data_klinik["nama"] ?>:</span></p>
                <div class="mb-3" style="width:400px; height:400px;">
                    <img src="assets/uploaded-file/<?= $data_klinik["gambar"] ?>" class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
                <p class="poppins-regular"><?= $data_klinik["nama"] ?> dapat dihubungi melalui nomor telepon di <span class="poppins-semibold"><?= $data_klinik["no_telp"] ?></span>.</p>
                <hr>
                <h3 class="poppins-semibold fs-4 mb-3 text-center">Alamat</h3>
                <?php
                $tampil_kecamatan = explode("-", $data_klinik["kecamatan"]);
                ?>
                <p class="poppins-regular"> <span class="poppins-semibold"><?= $data_klinik["nama"] ?></span> beralamat di <span class="poppins-semibold"><?= $data_klinik["alamat"] ?></span>, kecamatan <span class="poppins-semibold"><?= $tampil_kecamatan[1] ?></span>, kelurahan <span class="poppins-semibold"><?= $data_klinik["kelurahan"] ?></span>.</p>

                <div id="map" class="mb-3" style="height: 500px; width: 100%;"></div>
                <script type="text/javascript">
                    function initialize() {
                        var mapOptions = {
                            zoom: 17,
                            center: new google.maps.LatLng(<?= $data_klinik["latitude"] ?>, <?= $data_klinik["longitude"] ?>),
                            disableDefaultUI: false
                        };

                        var mapElement = document.getElementById('map');
                        var map = new google.maps.Map(mapElement, mapOptions);
                        setMarkers(map, officeLocations);
                    }

                    var officeLocations = [<?= $data_klinik["id"] ?>, "<?= $data_klinik["nama"] ?>", "<?= $data_klinik["alamat"] ?>", <?= $data_klinik["latitude"] ?>, <?= $data_klinik["longitude"] ?>];

                    function setMarkers(map, locations) {
                        var myLatLng = new google.maps.LatLng(locations[3], locations[4]);
                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        var contentString =
                            '<div id="content">' +
                            '<div id="siteNotice">' +
                            '</div>' +
                            '<h5 id="firstHeading" class="firstHeading poppins-medium">' + locations[1] + '</h5>' +
                            '<div id="bodyContent">' +
                            '<p class="poppins-regular">' + locations[2] + '</p>' +
                            '</div>' +
                            '</div>';

                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            title: locations[1],
                            icon: 'img/markermap.png'
                        });

                        google.maps.event.addListener(marker, 'click', getInfoCallback(map, contentString));

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
                <hr>
                <h3 class="poppins-semibold fs-4 mb-3 text-center">Jam Operasional</h3>
                <p class="poppins-regular">Berikut adalah jam operasional <span class="poppins-semibold"><?= $data_klinik["nama"] ?></span>:</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-white text-center" style="background-color: var(--magenta);">
                            <tr>
                                <th class="poppins-semibold">Hari</th>
                                <th class="poppins-semibold">Jam Buka</th>
                                <th class="poppins-semibold">Jam Tutup</th>
                                <th class="poppins-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $data_jam_op->fetch_assoc()) {
                                echo "<tr class='poppins-regular'>";
                                echo "<td>" . $row["hari_buka"] . "</td>";
                                echo "<td>" . $row["jam_buka"] . "</td>";
                                echo "<td>" . $row["jam_tutup"] . "</td>";
                                echo "<td>" . $row["keterangan"] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h3 class="poppins-semibold fs-4 mb-3 text-center">Treatment</h3>
                <p class="poppins-regular">Berikut adalah treatment yang tersedia di <span class="poppins-semibold"><?= $data_klinik["nama"] ?></span>:</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-white text-center" style="background-color: var(--magenta);">
                            <tr>
                                <th class="poppins-semibold">Nama Treatment</th>
                                <th class="poppins-semibold">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $data_treatment->fetch_assoc()) {
                                echo "<tr class='poppins-regular'>";
                                echo "<td>" . $row["nama"] . "</td>";
                                echo "<td>" . rupiah_currency($row["harga"]) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h3 class="poppins-semibold fs-4 mb-3 text-center">Sosial Media</h3>
                <p class="poppins-regular">Berikut adalah sosial media yang dimiliki oleh <span class="poppins-semibold"><?= $data_klinik["nama"] ?></span>:</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-white text-center" style="background-color: var(--magenta);">
                            <tr>
                                <th class="poppins-semibold">Nama Sosial Media</th>
                                <th class="poppins-semibold">Username Sosial Media</th>
                                <th class="poppins-semibold">Link</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $data_sosmed->fetch_assoc()) {
                                echo "<tr class='poppins-regular'>";
                                echo "<td>" . $row["nama"] . "</td>";
                                echo "<td>" . $row["username"] . "</td>";
                                echo "<td><a href='" . $row["link"] . "' target='_blank'>Kunjungi Sosial Media</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr>
                <h3 class="poppins-semibold fs-4 mb-3 text-center">Ulasan Pengunjung</h3>
                <form action="" method="post" autocomplete="off">
                    <div class="mb-2">
                        <textarea class="form-control poppins-regular" name="ulasan" id="ulasan" placeholder="Masukkan Ulasan Anda!" required></textarea>
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-on-hover text-white poppins-regular" style="background-color: var(--magenta);">Kirim Ulasan!</button>
                    </div>
                </form>
                <?php
                while ($row = $data_ulasan->fetch_assoc()) {
                    echo "<div class='card mb-3'>";
                    echo "<div class='card-header d-flex justify-content-between'>";
                    echo "<p class='mb-0 poppins-semibold'>" . $row["nama_user"] . "</p>";
                    echo "<p class='mb-0 poppins-semibold'>" . $row["tanggal"] . "</p>";
                    echo "</div>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text poppins-regular'>" . $row["ulasan"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</section>
<?php
require_once("views/footer.php");
