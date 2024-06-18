<?php
require_once("../bootstrap.php");

$id = $_POST['id'];
$sql = "UPDATE tbl_ulasan SET status = 'Disetujui' WHERE id = '$id'";
if ($conn->query($sql)) echo 1;
else echo 0;
