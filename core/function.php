<?php
function upload_image($file_name, $file_size, $temp_loc, $target_loc)
{
    $valid_ext = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($ext, $valid_ext)) return false;
    else {
        if ($file_size > 3000000) return false;
        else {
            $new_file_name = uniqid() . "." . $ext;
            move_uploaded_file($temp_loc, $target_loc . $new_file_name);
            return $new_file_name;
        }
    }
}

function redirect_alert($message, $url)
{
    echo "
    <script>
    alert('" . $message   . "')
    location.href = '" . $url . "'
    </script>
    ";
}

function rupiah_currency($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
