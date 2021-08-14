<?php
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Jakarta');
ini_set('memory_limit', '1024M');
session_start();
$date = date("Y-m-d");
$time = date("H:i:s");
$httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

$yaz = mysqli_connect('localhost', 'root', '', 'db_ingtiaz');
if (!$yaz) {
    die("Koneksi Gagal " . mysqli_connect_error());
    error_log("Koneksi Gagal ");
}


function base_url($x = '')
{
    global $_SERVER;
    return 'http://' . $_SERVER['SERVER_NAME'] . '/10119274_UAS/' . $x;
}

function filter($data)
{
    global $yaz;
    return $yaz->real_escape_string(trim(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)))));
}
function notif($status, $msg)
{
    if ($status == true) {
        $_SESSION['notif'] = "<script>Swal.fire(
            'Good job!',
            '$msg',
            'success'
          )</script>";
    } else {
        $_SESSION['notif'] = "<script>Swal.fire(
            'Something Wrong!',
            '$msg',
            'error'
          )</script>";
    }
}

function notif_check()
{
    if (isset($_SESSION['notif'])) {
        echo $_SESSION['notif'];
        unset($_SESSION['notif']);
    }
}

function departemen($data)
{
    global $yaz;
    return $yaz->query("SELECT * FROM departemen WHERE Kd_departemen='$data'")->fetch_assoc()['Nm_departemen'];
}

function jabatan($data)
{
    global $yaz;
    return $yaz->query("SELECT * FROM jabatan WHERE Kd_jabatan='$data'")->fetch_assoc()['Nm_Jabatan'];
}
