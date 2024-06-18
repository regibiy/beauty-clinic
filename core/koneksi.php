<?php
define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASENAME", "db_beauty_clinic");

$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASENAME);

if ($conn->connect_error) {
    die($conn->connect_error);
}
