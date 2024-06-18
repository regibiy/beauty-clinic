<?php
require_once("bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

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
        <h1 class="h3 mb-0 text-gray-800">Data Sosial Media Klinik Kecantikan</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Olah data Sosial Media klinik pada tabel di bawah ini!</h6>
            <a href="tambah-sosmed.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Sosial Media</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Klinik</th>
                            <th>Nama Sosial Media</th>
                            <th>Username Sosial Media</th>
                            <th>Link Sosial Media</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $sql = "SELECT tbl_sosmed.id AS id_sosmed, tbl_klinik.id AS id_tbl_klinik, tbl_klinik.nama AS nama_klinik, tbl_sosmed.nama AS nama_sosmed, username, link FROM tbl_sosmed INNER JOIN tbl_klinik ON tbl_sosmed.id_klinik = tbl_klinik.id";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_klinik'] . "</td>";
                            echo "<td>" . $row['nama_sosmed'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['link'] . "</td>";
                            echo "<td>
                                    <a href='edit-sosmed.php?id=" . $row['id_sosmed'] . "' class='btn btn-sm btn-primary mb-1'>Ubah</a>
                                    <button type='button' class='btn btn-sm btn-outline-danger mb-1' data-id='" . $row['id_sosmed'] . "' data-nama-sosmed='" . $row['nama_sosmed'] . "' data-nama-klinik='" . $row['nama_klinik'] . "' id='deleteDataSosmed'>Hapus</button>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php
require_once("views/footer.php");
?>