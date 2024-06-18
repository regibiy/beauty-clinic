<?php
require_once("bootstrap.php");
unset($_SESSION["login_user"], $_SESSION["id_user"], $_SESSION["username"], $_SESSION["nama"]);
redirect_alert("Terima kasih sudah berkunjung!", "index.php");
