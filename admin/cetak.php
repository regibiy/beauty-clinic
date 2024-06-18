<?php
require_once("bootstrap.php");
$id = $_GET["id"];

$sql = "SELECT * FROM tbl_klinik WHERE id = '$id'";
$result = $conn->query($sql);
$data_klinik = $result->fetch_assoc();

$sql = "SELECT * FROM tbl_jam_operasional WHERE id_klinik = '$id'";
$data_jam_op = $conn->query($sql);

$sql = "SELECT * FROM tbl_treatment WHERE id_klinik = '$id'";
$data_treatment = $conn->query($sql);

$sql = "SELECT * FROM tbl_sosmed WHERE id_klinik = '$id'";
$data_sosmed = $conn->query($sql);

?>
<title><?= $data_klinik["nama"] ?></title>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 12px;
    }
</style>
<h2 style="text-align:center;"><?= $data_klinik["nama"] ?></h2>
<div style="text-align: center;margin-bottom:32px">
    <img src="../assets/uploaded-file/<?= $data_klinik["gambar"] ?>" width="400" height="400" style="object-fit:cover">
</div>
<div style="padding: 0 12px;">
    <table style="width: 100%;">
        <tbody>
            <tr>
                <th>No. Telepon</th>
                <td><?= $data_klinik["no_telp"] ?></td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td><?= $data_klinik["alamat"] ?></td>
            </tr>
            <tr>
                <th>latitude</th>
                <td><?= $data_klinik["latitude"] ?></td>
            </tr>
            <tr>
                <th>Longitude</th>
                <td><?= $data_klinik["longitude"] ?></td>
            </tr>
            <tr>
                <th>Kecamatan</th>
                <?php
                $tampil_kecamatan = explode("-", $data_klinik["kecamatan"]);
                ?>
                <td><?= $tampil_kecamatan[1] ?></td>
            </tr>
            <tr>
                <th>Kelurahan</th>
                <td><?= $data_klinik["kelurahan"] ?></td>
            </tr>
            <tr>
                <th>Jam Operasional</th>
                <td>
                    <?php
                    while ($row = $data_jam_op->fetch_assoc()) {
                        if ($row["keterangan"] == "Buka") {
                            echo "<p>" . $row["hari_buka"] . ", " . $row["jam_buka"] . " sampai " . $row["jam_tutup"] . "</p>";
                        } else {
                            echo "<p>" . $row["hari_buka"] . ", " .  $row["keterangan"] . "</p=>";
                        }
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Treatment yang Tersedia</th>
                <td>
                    <?php
                    while ($row = $data_treatment->fetch_assoc()) {
                        echo "<p>" . $row["nama"] . ", " . rupiah_currency($row["harga"]) . "</p>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <th>Sosial Media</th>
                <td>
                    <?php
                    while ($row = $data_sosmed->fetch_assoc()) {
                        echo "<p> " . $row["nama"] . " dengan link <a href='" . $row["link"] . "' target='_blank'>" . $row["link"] . "</a></p>";
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        window.print();
    });
</script>