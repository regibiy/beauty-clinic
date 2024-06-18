<?php
require_once("bootstrap.php");
$username = $conn->real_escape_string($_POST["username"]);

$sql = "SELECT id, username, nama FROM tbl_user WHERE username = '$username'";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

$_SESSION["login_user"] = true;
$_SESSION["id_user"] = $data["id"];
$_SESSION["username"] = $data["username"];
$_SESSION["nama"] = $data["nama"];

redirect_alert("Selamat Datang!", "index.php");
