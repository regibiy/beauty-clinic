<?php
require_once("../bootstrap.php");
$username = $conn->real_escape_string($_POST["username"]);
$nama = $conn->real_escape_string($_POST["nama"]);
$email = $conn->real_escape_string($_POST["email"]);
$password = $conn->real_escape_string($_POST["password"]);
$final_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO tbl_user (username, nama, email, password) VALUES ('$username', '$nama', '$email', '$final_password')";
if ($conn->query($sql)) echo 1;
else echo 0;
