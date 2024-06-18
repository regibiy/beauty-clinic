<?php
require_once("../bootstrap.php");

$sql = "SELECT * FROM tbl_klinik";
$result = $conn->query($sql);
if ($result) {
    $posts = array();
    if ($result->num_rows) {
        while ($post = $result->fetch_assoc()) {
            $posts[] = $post;
        }
    }
    $data = json_encode(array('results' => $posts));
    echo $data;
}
