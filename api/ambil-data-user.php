<?php
require_once("../bootstrap.php");
$sql = 'SELECT * FROM tbl_user';
$result = $conn->query($sql);
$data = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);
