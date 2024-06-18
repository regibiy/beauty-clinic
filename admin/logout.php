<?php
require_once("bootstrap.php");
unset($_SESSION["login_admin"], $_SESSION["nama_admin"]);
header("Location: login.php");
