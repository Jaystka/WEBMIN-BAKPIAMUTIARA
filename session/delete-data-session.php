<?php
include("../includes/db.php");

if (isset($_POST['idAdmin'])) {

    $id = $_POST['idAdmin'];


    $query = "DELETE FROM admin WHERE id_admin = '$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $request["valid"] = "success";
    } else {
        $request["valid"] = "failed";
    }
    echo json_encode($request);
} else if (isset($_POST['idKaryawan'])) {

    $id = $_POST['idKaryawan'];


    $query = "DELETE FROM karyawan WHERE id_karyawan = '$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $request["valid"] = "success";
    } else {
        $request["valid"] = "failed";
    }
    echo json_encode($request);
}
