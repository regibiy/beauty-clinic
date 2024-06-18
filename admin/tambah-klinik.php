<?php
require_once("../bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $final_gambar = upload_image($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], "../assets/uploaded-file/");
    if (!$final_gambar) redirect_alert('Ekstensi file tidak diizinkan atau lebih dari 3 MB!', 'tambah-klinik.php');
    else {
        $nama = $conn->real_escape_string($_POST["nama"]);
        $alamat = $conn->real_escape_string($_POST["alamat"]);
        $no_telp = $conn->real_escape_string($_POST["no_telp"]);
        $longitude = $conn->real_escape_string($_POST["longitude"]);
        $latitude = $conn->real_escape_string($_POST["latitude"]);
        $kecamatan = $conn->real_escape_string($_POST["kecamatan"]);
        $kelurahan = $conn->real_escape_string($_POST["kelurahan"]);

        $sql = "INSERT INTO tbl_klinik (nama, alamat, no_telp, latitude, longitude, kecamatan, kelurahan, gambar) VALUES ('$nama', '$alamat', '$no_telp', '$longitude', '$latitude', '$kecamatan', '$kelurahan', '$final_gambar')";
        if ($conn->query($sql)) redirect_alert('Data Klinik Kecantikan berhasil ditambahkan!', 'klinik.php');
        else redirect_alert('Data Klinik Kecantikan gagal ditambahkan!', 'klinik.php');
    }
}

$data = [
    "title" => "Klinik",
    "dashboard" => null,
    "data_klinik" => "active",
    "detail_klinik" => "active",
    "jam_operasional" => null,
    "sosmed" => null,
    "data_ulasan" => null,
    "treatment" => null,
];
require_once("views/header.php");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Klinik Kecantikan</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isi data klinik pada form di bawah ini!</h6>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validasiForm()" autocomplete="off">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="eg. Klinik Cantik" required>
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="eg. 0561-123123" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="eg. Jalan Ahmad Yani" required>
                </div>
                <div class="mb-3">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <select class="custom-select" id="kecamatan" name="kecamatan" required>
                        <option value="0" hidden>Mohon tunggu! Sedang Memuat Data</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <select class="custom-select" id="kelurahan" name="kelurahan" required>
                        <option value="0">Silakan Pilih Kecamatan Terlebih Dahulu!</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="lotitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="eg. -0.029631200479829065" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="eg. 109.32154251651706" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="custom-file" id="gambar" name="gambar" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    <a href="klinik.php" class="btn btn-outline-danger btn-block">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<?php
require_once("views/footer.php");
?>