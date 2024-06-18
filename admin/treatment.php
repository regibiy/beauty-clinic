<?php
require_once("bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

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
        <h1 class="h3 mb-0 text-gray-800">Data Treatment yang Tersedia pada Klinik Kecantikan</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Olah data Treatment klinik pada tabel di bawah ini!</h6>
            <a href="tambah-treatment.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Treatment</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Klinik</th>
                            <th>Nama Treatment</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $sql = "SELECT tbl_treatment.id AS id_treatment, tbl_klinik.id AS id_tbl_klinik, tbl_klinik.nama AS nama_klinik, tbl_treatment.nama AS nama_treatment, harga FROM tbl_treatment INNER JOIN tbl_klinik ON tbl_treatment.id_klinik = tbl_klinik.id";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama_klinik'] . "</td>";
                            echo "<td>" . $row['nama_treatment'] . "</td>";
                            echo "<td>" . rupiah_currency($row['harga']) . "</td>";
                            echo "<td>
                                    <a href='edit-treatment.php?id=" . $row['id_treatment'] . "' class='btn btn-sm btn-primary mb-1'>Ubah</a>
                                    <button type='button' class='btn btn-sm btn-outline-danger mb-1' data-id='" . $row['id_treatment'] . "' data-nama-treatment='" . $row['nama_treatment'] . "' data-nama-klinik='" . $row['nama_klinik'] . "' id='deleteDataTreatment'>Hapus</button>
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