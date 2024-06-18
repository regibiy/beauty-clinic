<?php
require_once("../bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $keterangan = "Buka";
    if (isset($_POST['keterangan'])) $keterangan = $_POST['keterangan'];
    if (!array_key_exists("jam_buka", $_POST) || !array_key_exists("jam_tutup", $_POST)) {
        $jam_buka = "00:00:00";
        $jam_tutup = "00:00:00";
    } else {
        $jam_buka = $_POST['jam_buka'];
        $jam_tutup = $_POST['jam_tutup'];
    }

    $nama = $conn->real_escape_string($_POST["nama"]);
    $hari_buka = $conn->real_escape_string($_POST["hari_buka"]);
    $final_jam_buka = $conn->real_escape_string($jam_buka);
    $final_jam_tutup = $conn->real_escape_string($jam_tutup);
    $final_keterangan = $conn->real_escape_string($keterangan);

    $sql = "INSERT INTO tbl_jam_operasional (id_klinik, hari_buka, jam_buka, jam_tutup, keterangan) VALUES ('$nama', '$hari_buka', '$final_jam_buka', '$final_jam_tutup', '$final_keterangan')";
    if ($conn->query($sql)) redirect_alert('Data Jam Operasional Klinik Kecantikan berhasil ditambahkan!', 'jam-operasional.php');
    else redirect_alert('Data Jam Operasional Klinik Kecantikan gagal ditambahkan!', 'jam-operasional.php');
}

$data = [
    "title" => "Klinik",
    "dashboard" => null,
    "data_klinik" => "active",
    "detail_klinik" => null,
    "jam_operasional" => "active",
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
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Jam Operasional Klinik Kecantikan</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isi data Jam Operasional klinik pada form di bawah ini!</h6>
        </div>
        <div class="card-body">
            <form action="" method="post" autocomplete="off" onsubmit="return validasiFormJamOp()">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <select class="custom-select" id="nama" name="nama" required>
                        <option value="0" selected hidden>Pilih Klinik</option>
                        <?php
                        $sql = "SELECT id, nama FROM tbl_klinik";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="hariBuka" class="form-label">Hari Buka</label>
                    <input type="text" class="form-control" id="hariBuka" name="hari_buka" placeholder="eg. Senin-Sabtu" required>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="keterangan" name="keterangan">
                    <label class="form-check-label user-select-none" for="keterangan">
                        Tutup
                    </label>
                </div>
                <div class="mb-3">
                    <label for="jamBuka" class="form-label">Jam Buka</label>
                    <input type="time" class="form-control" id="jamBuka" name="jam_buka">
                </div>
                <div class="mb-3">
                    <label for="jamTutup" class="form-label">Jam Tutup</label>
                    <input type="time" class="form-control" id="jamTutup" name="jam_tutup">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    <a href="jam-operasional.php" class="btn btn-outline-danger btn-block">Batal</a>
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