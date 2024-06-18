<?php
require_once("../bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

$id = $_GET["id"];

$sql = "SELECT * FROM tbl_klinik WHERE id = '$id'";
$result = $conn->query($sql);
$data_klinik = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $conn->real_escape_string($_POST["nama"]);
    $alamat = $conn->real_escape_string($_POST["alamat"]);
    $no_telp = $conn->real_escape_string($_POST["no_telp"]);
    $longitude = $conn->real_escape_string($_POST["longitude"]);
    $latitude = $conn->real_escape_string($_POST["latitude"]);
    $kecamatan = $conn->real_escape_string($_POST["kecamatan"]);
    $kelurahan = $conn->real_escape_string($_POST["kelurahan"]);
    if ($_FILES['gambar']['error'] == 4) {
        $sql = "UPDATE tbl_klinik SET nama = '$nama', alamat = '$alamat', no_telp = '$no_telp', longitude = '$longitude', latitude = '$latitude', kecamatan = '$kecamatan', kelurahan = '$kelurahan' WHERE id = '$id'";

        if ($conn->query($sql)) redirect_alert('Data Klinik Kecantikan berhasil diedit!', 'klinik.php');
        else redirect_alert('Data Klinik Kecantikan gagal diedit!', 'klinik.php');
    } else {
        $final_gambar = upload_image($_FILES['gambar']['name'], $_FILES['gambar']['size'], $_FILES['gambar']['tmp_name'], "../assets/uploaded-file/");
        if (!$final_gambar) {
            redirect_alert('Ekstensi file tidak diizinkan atau lebih dari 3 MB!', 'edit-klinik.php?id=' . $id);
            exit();
        }
        unlink("../assets/uploaded-file/" . $data_klinik['gambar']);
        $sql = "UPDATE tbl_klinik SET nama = '$nama', alamat = '$alamat', no_telp = '$no_telp', longitude = '$longitude', latitude = '$latitude', kecamatan = '$kecamatan', kelurahan = '$kelurahan', gambar = '$final_gambar' WHERE id = '$id'";

        if ($conn->query($sql)) redirect_alert('Data Klinik Kecantikan berhasil diedit!', 'klinik.php');
        else redirect_alert('Data Klinik Kecantikan gagal diedit!', 'klinik.php');
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
        <h1 class="h3 mb-0 text-gray-800">Ubah Data Klinik Kecantikan</h1>
    </div>
    <div class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isi data klinik pada form di bawah ini!</h6>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data" onsubmit="return validasiForm()" autocomplete="off">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="eg. Klinik Cantik" value="<?= $data_klinik['nama'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="eg. 0561-123123" value="<?= $data_klinik['no_telp'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="eg. Jalan Ahmad Yani" value="<?= $data_klinik['alamat'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="editKecamatan" class="form-label">Kecamatan</label>
                    <select class="custom-select" id="editKecamatan" name="kecamatan" required>
                        <?php
                        $tampil_kecamatan = explode("-", $data_klinik["kecamatan"]);
                        ?>
                        <?= "<option value='" . $data_klinik['kecamatan'] . "' hidden>" . $tampil_kecamatan[1] . "</option>" ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="editKelurahan" class="form-label">Kelurahan</label>
                    <select class="custom-select" id="editKelurahan" name="kelurahan" required>
                        <?= "<option value='" . $data_klinik['kelurahan'] . "' hidden>" . $data_klinik['kelurahan'] . "</option>" ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="latitude" name="latitude" placeholder="eg. -0.029631200479829065" value="<?= $data_klinik['latitude'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="longitude" name="longitude" placeholder="eg. 109.32154251651706" value="<?= $data_klinik['longitude'] ?>" required>
                </div>
                <div class="mb-3">
                    <p class="form-label m-0">Gambar Saat Ini</p>
                    <img src="../assets/uploaded-file/<?= $data_klinik['gambar'] ?>" alt="" class="img-fluid">
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="custom-file" id="gambar" name="gambar">
                    <p class="font-italic text-danger">Kosongkan Data Gambar Jika Tidak Berubah!</p>
                </div>
                <div class="mb-3">
                    <button type="submit" name="edit_klinik" class="btn btn-primary btn-block">Simpan</button>
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