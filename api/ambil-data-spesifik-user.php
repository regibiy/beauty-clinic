<?php
require_once("../bootstrap.php");
$username = $_GET["username"];
$password = $_GET["password"];
$sql = "SELECT * FROM tbl_user WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $verify_result = password_verify($password, $data[0]["password"]);
    $data[0]["verify"] = $verify_result;
    echo json_encode($data);
} else {
    echo 0;
}
