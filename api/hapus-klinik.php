<?php
require_once("../bootstrap.php");

$id = $_POST['id'];
$gambar = $_POST['gambar'];
unlink("../assets/uploaded-file/" . $gambar);
$sql = "DELETE FROM tbl_klinik WHERE id = '$id'";
if ($conn->query($sql)) echo 1;
else echo 0;
