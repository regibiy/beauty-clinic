<?php
require_once("bootstrap.php");

$id_satu = $_GET["id-satu"];
$id_dua = $_GET["id-dua"];

$sql = "SELECT * FROM tbl_klinik WHERE id = '$id_satu'";
$result = $conn->query($sql);
$data_klinik_satu = $result->fetch_assoc();

$sql = "SELECT * FROM tbl_klinik WHERE id = '$id_dua'";
$result = $conn->query($sql);
$data_klinik_dua = $result->fetch_assoc();

$sql = "SELECT * FROM tbl_jam_operasional WHERE id_klinik = '$id_satu'";
$data_jam_op_satu = $conn->query($sql);

$sql = "SELECT * FROM tbl_jam_operasional WHERE id_klinik = '$id_dua'";
$data_jam_op_dua = $conn->query($sql);

$sql = "SELECT * FROM tbl_treatment WHERE id_klinik = '$id_satu'";
$data_treatment_satu = $conn->query($sql);

$sql = "SELECT * FROM tbl_treatment WHERE id_klinik = '$id_dua'";
$data_treatment_dua = $conn->query($sql);

$sql = "SELECT * FROM tbl_sosmed WHERE id_klinik = '$id_satu'";
$data_sosmed_satu = $conn->query($sql);

$sql = "SELECT * FROM tbl_sosmed WHERE id_klinik = '$id_dua'";
$data_sosmed_dua = $conn->query($sql);

require_once("views/header.php");
?>
<section id="compare">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center" id="compare">
            <div class="col-lg-8">
                <h3 class="text-center fs-5 poppins-medium mb-4">Hasil Perbandingan Antara <?= $data_klinik_satu["nama"] ?> dan <?= $data_klinik_dua["nama"] ?> </h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-white text-center" style="background-color: var(--magenta);">
                            <tr>
                                <th width="50%" class="poppins-semibold"><?= $data_klinik_satu["nama"] ?></th>
                                <th width="50%" class="poppins-semibold"><?= $data_klinik_dua["nama"] ?> </th>
                        </thead>
                        </tr>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Gambar</td>
                            </tr>
                            <tr>
                                <td><img src="assets/uploaded-file/<?= $data_klinik_satu["gambar"] ?>" class="img-fluid"></td>
                                <td><img src="assets/uploaded-file/<?= $data_klinik_dua["gambar"] ?>" class="img-fluid"></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Alamat</td>
                            </tr>
                            <tr>
                                <td class="poppins-regular"><?= $data_klinik_satu["alamat"] ?></td>
                                <td class="poppins-regular"><?= $data_klinik_dua["alamat"] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Nomor Telepon</td>
                            </tr>
                            <tr>
                                <td class="poppins-regular"><?= $data_klinik_satu["no_telp"] ?></td>
                                <td class="poppins-regular"><?= $data_klinik_dua["no_telp"] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Kecamatan</td>
                            </tr>
                            <tr>
                                <?php
                                $tampil_kecamatan_satu = explode("-", $data_klinik_satu["kecamatan"]);
                                $tampil_kecamatan_dua = explode("-", $data_klinik_dua["kecamatan"]);
                                ?>
                                <td class="poppins-regular"><?= $tampil_kecamatan_satu[1] ?></td>
                                <td class="poppins-regular"><?= $tampil_kecamatan_dua[1] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Kelurahan</td>
                            </tr>
                            <tr>
                                <td class="poppins-regular"><?= $data_klinik_satu["kelurahan"] ?></td>
                                <td class="poppins-regular"><?= $data_klinik_dua["kelurahan"] ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Jam Operasional</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    while ($row = $data_jam_op_satu->fetch_assoc()) {
                                        if ($row["keterangan"] == "Buka") {
                                            echo "<p class='poppins-regular m-1'>" . $row["hari_buka"] . ", " . $row["jam_buka"] . " sampai " . $row["jam_tutup"] . "</p>";
                                        } else {
                                            echo "<p class='poppins-regular m-1'>" . $row["hari_buka"] . ", " .  $row["keterangan"] . "</p>";
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    while ($row = $data_jam_op_dua->fetch_assoc()) {
                                        if ($row["keterangan"] == "Buka") {
                                            echo "<p class='poppins-regular m-1'>" . $row["hari_buka"] . ", " . $row["jam_buka"] . " sampai " . $row["jam_tutup"] . "</p>";
                                        } else {
                                            echo "<p class='poppins-regular m-1'>" . $row["hari_buka"] . ", " .  $row["keterangan"] . "</p>";
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Treatment</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    while ($row = $data_treatment_satu->fetch_assoc()) {
                                        echo "<p class='poppins-regular m-1'>" . $row["nama"] . ", " . rupiah_currency($row["harga"]) . "</p>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    while ($row = $data_treatment_dua->fetch_assoc()) {
                                        echo "<p class='poppins-regular m-1'>" . $row["nama"] . ", " . rupiah_currency($row["harga"]) . "</p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center poppins-medium">Sosial Media</td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    while ($row = $data_sosmed_satu->fetch_assoc()) {
                                        echo "<p class='poppins-regular mb-1'> Kunjungi <a href='" . $row["link"] . "' target='_blank'>" . $row["nama"] . "</a></p>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    while ($row = $data_sosmed_dua->fetch_assoc()) {
                                        echo "<p class='poppins-regular mb-1'> Kunjungi <a href='" . $row["link"] . "' target='_blank' >" . $row["nama"] . "</a></p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once("views/footer.php");
?>