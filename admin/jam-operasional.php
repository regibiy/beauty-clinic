<?php
require_once("bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

$data = [
    "title" => "Jam Operasional",
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
        <h1 class="h3 mb-0 text-gray-800">Data Jam Operasional Klinik Kecantikan</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Olah data jam operasional klinik pada tabel di bawah ini!</h6>
            <a href="tambah-jam-op.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Jam Operasional</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Klinik</th>
                            <th>Hari</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $sql = "SELECT tbl_jam_operasional.id AS id_tbl_jam_op, tbl_klinik.id AS id_tbl_klinik, nama, hari_buka, jam_buka, jam_tutup, keterangan FROM tbl_jam_operasional INNER JOIN tbl_klinik ON tbl_jam_operasional.id_klinik = tbl_klinik.id";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['hari_buka'] . "</td>";
                            echo "<td>" . $row['jam_buka'] . "</td>";
                            echo "<td>" . $row['jam_tutup'] . "</td>";
                            echo "<td>" . $row['keterangan'] . "</td>";
                            echo "<td>
                                    <a href='edit-jam-op.php?id=" . $row['id_tbl_jam_op'] . "' class='btn btn-sm btn-primary mb-1'>Ubah</a>
                                    <button type='button' class='btn btn-sm btn-outline-danger mb-1' data-id='" . $row['id_tbl_jam_op'] . "' data-nama='" . $row['nama'] . "' id='deleteDataJamOp'>Hapus</button>
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