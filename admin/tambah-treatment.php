<?php
require_once("../bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $conn->real_escape_string($_POST["nama"]);
    $treatment = $conn->real_escape_string($_POST["treatment"]);
    $harga = $conn->real_escape_string($_POST["harga"]);

    $sql = "INSERT INTO tbl_treatment (id_klinik, nama, harga) VALUES ('$nama', '$treatment', '$harga')";
    if ($conn->query($sql)) redirect_alert('Data Treatment Klinik Kecantikan berhasil ditambahkan!', 'treatment.php');
    else redirect_alert('Data Treatment Klinik Kecantikan gagal ditambahkan!', 'treatment.php');
}

$data = [
    "title" => "Treatment",
    "dashboard" => null,
    "data_klinik" => "active",
    "detail_klinik" => null,
    "jam_operasional" => null,
    "sosmed" => null,
    "data_ulasan" => null,
    "treatment" => "active",
];
require_once("views/header.php");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Treatment Klinik Kecantikan</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isi data Treatment klinik pada form di bawah ini!</h6>
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
                    <label for="treatment" class="form-label">Nama Treatment</label>
                    <input type="text" class="form-control" id="treatment" name="treatment" placeholder="eg. Laser CO2" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="eg. 500000">
                    <p class="m-0 text-danger font-italic">Isi field Harga tanpa pemisah ribuan! Contoh terlampir.</p>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    <a href="treatment.php" class="btn btn-outline-danger btn-block">Batal</a>
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