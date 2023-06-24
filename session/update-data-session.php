<?php
include("../includes/db.php");

if (isset($_POST['idAdmin'])) {
    $id = $_POST['idAdmin'];
    $sql = "SELECT * FROM admin WHERE id_admin = '$id' ";
    $editor = mysqli_query($conn, $sql);
    foreach ($editor as $rows) {
    }
} else if (isset($_POST['idKaryawan'])) {
    $id = $_POST['idKaryawan'];
    $sql = "SELECT * FROM karyawan WHERE id_karyawan = '$id' ";
    $editor = mysqli_query($conn, $sql);
    foreach ($editor as $rows) {
    }
}
echo json_encode($rows);
