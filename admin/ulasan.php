<?php
require_once("bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

$data = [
    "title" => "Ulasan",
    "dashboard" => null,
    "data_klinik" => null,
    "data_ulasan" => "active",
    "detail_klinik" => null,
    "jam_operasional" => null,
    "sosmed" => null,
    "treatment" => null,
];
require_once("views/header.php");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Ulasan Klinik Kecantikan</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Olah data ulasan klinik pada tabel di bawah ini!</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nama Klinik</th>
                            <th>Tanggal</th>
                            <th>Ulasan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $sql = "SELECT tbl_ulasan.id AS id_ulasan, tbl_user.nama, tbl_klinik.nama AS nama_klinik, tanggal, ulasan, status FROM tbl_ulasan INNER JOIN tbl_user ON tbl_ulasan.id_user = tbl_user.id INNER JOIN tbl_klinik ON tbl_ulasan.id_klinik = tbl_klinik.id";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['nama_klinik'] . "</td>";
                            echo "<td>" . $row['tanggal'] . "</td>";
                            echo "<td>" . $row['ulasan'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            if ($row["status"] == "Menunggu") {
                                echo "<td>
                                <button type='button' class='btn btn-sm btn-primary mb-1' data-id='" . $row['id_ulasan'] . "' data-nama='" . $row["nama"] . "' id='approveUlasan'>Setujui</button>
                                <button type='button' class='btn btn-sm btn-outline-danger mb-1' data-id='" . $row['id_ulasan'] . "' data-nama='" . $row["nama"] . "' id='rejectUlasan'>Tolak</button>
                                </td>";
                            } elseif ($row["status"] == "Disetujui") {
                                echo "<td>
                                <button type='button' class='btn btn-sm btn-outline-danger mb-1' data-id='" . $row['id_ulasan'] . "' data-nama='" . $row["nama"] . "' id='rejectUlasan'>Tolak</button>
                                </td>";
                            } elseif ($row["status"] == "Ditolak") {
                                echo "<td>
                                <button type='button' class='btn btn-sm btn-primary mb-1' data-id='" . $row['id_ulasan'] . "' data-nama='" . $row["nama"] . "' id='approveUlasan'>Setujui</button>";
                            }
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