<?php
require_once("../bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

$id = $_GET["id"];

$sql = "SELECT * FROM tbl_sosmed WHERE id = '$id'";
$result = $conn->query($sql);
$data_sosmed = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $conn->real_escape_string($_POST["nama"]);
    $sosmed = $conn->real_escape_string($_POST["sosmed"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $link = $conn->real_escape_string($_POST["link"]);

    $sql = "UPDATE tbl_sosmed SET id_klinik = '$nama', nama = '$sosmed', username = '$username', link = '$link' WHERE id = '$id'";
    if ($conn->query($sql)) redirect_alert('Data Sosial Media Klinik Kecantikan berhasil diubah!', 'sosmed.php');
    else redirect_alert('Data Sosial Media Klinik Kecantikan gagal diubah!', 'sosmed.php');
}

$data = [
    "title" => "Sosial Media",
    "dashboard" => null,
    "data_klinik" => "active",
    "detail_klinik" => null,
    "jam_operasional" => null,
    "sosmed" => "active",
    "data_ulasan" => null,
    "treatment" => null,
];
require_once("views/header.php");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ubah Data Sosial Media Klinik Kecantikan</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isi data Sosial Media klinik pada form di bawah ini!</h6>
        </div>
        <div class="card-body">
            <form action="" method="post" autocomplete="off" onsubmit="return validasiFormJamOp()">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <select class="custom-select" id="nama" name="nama" required>
                        <?php
                        $sql = "SELECT id, nama FROM tbl_klinik";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'" . ($row['id'] == $data_sosmed['id_klinik'] ? "selected" : null) . ">" . $row['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sosmed" class="form-label">Sosial Media</label>
                    <input type="text" class="form-control" id="sosmed" name="sosmed" placeholder="eg. Tiktok" value="<?= $data_sosmed['nama'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username Sosial Media</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="eg. @KlinikCantik" value="<?= $data_sosmed['username'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="link" class="form-label">Link Sosial Media</label>
                    <input type="text" class="form-control" id="link" name="link" placeholder="eg. https://www.instagram.com/bclinicofficial" value="<?= $data_sosmed['link'] ?>" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    <a href="sosmed.php" class="btn btn-outline-danger btn-block">Batal</a>
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