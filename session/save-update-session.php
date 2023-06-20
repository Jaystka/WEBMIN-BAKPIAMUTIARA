<?php
include("../includes/db.php");

if (isset($_POST['updateAdmin'])) {

    $id = $_POST['updateAdmin'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $level =  $_POST['level'];

    $query = "UPDATE `admin` SET `name`='$name',`username`='$username',`email`='$email',`password`='$password',`level`='$level' WHERE id_admin = '$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $request["valid"] = "success";
    } else {
        $request["valid"] = "failed";
    }
    echo json_encode($request);
}
