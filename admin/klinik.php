<?php
require_once("bootstrap.php");

if (!isset($_SESSION["login_admin"])) header("Location: login.php");

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
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Klinik Kecantikan</h1>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Olah data klinik pada tabel di bawah ini!</h6>
            <a href="tambah-klinik.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Klinik</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Klinik</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Gambar</th>
                            <th>Longitude</th>
                            <th>Latitude</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $sql = "SELECT * FROM tbl_klinik";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['no_telp'] . "</td>";
                            echo "<td>" . $row['alamat'] . "</td>";
                            echo "<td><button type='button' class='btn btn-sm btn-outline-primary' id='viewImage' data-gambar='" . $row['gambar'] . "' data-nama='" . $row['nama'] . "'>Lihat Gambar</button></td>";
                            echo "<td>" . $row['longitude'] . "</td>";
                            echo "<td>" . $row['latitude'] . "</td>";
                            echo "<td>
                                    <a href='edit-klinik.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary mb-1'>Ubah</a>
                                    <button type='button' class='btn btn-sm btn-outline-danger mb-1' data-id='" . $row['id'] . "' data-nama='" . $row['nama'] . "' data-gambar='" . $row['gambar'] . "' id='deleteData'>Hapus</button>
                                    <a href='cetak.php?id=" . $row["id"] . "' target='_blank' class='btn btn-sm btn-outline-secondary mb-1'>Cetak</a>
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
<!-- Modal View Image -->
<div class="modal" id="viewImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewImageModalLabel"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="imgTag" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<?php
require_once("views/footer.php");
?>