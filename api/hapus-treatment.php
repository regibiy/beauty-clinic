<?php
require_once("../bootstrap.php");

$id = $_POST['id'];
$sql = "DELETE FROM tbl_treatment WHERE id = '$id'";
if ($conn->query($sql)) echo 1;
else echo 0;
