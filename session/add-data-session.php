<?php
session_start();
include "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['addAdmin'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];
    $level =  $_POST['level'];


    if ($password === $passwordConf) {
      // Ambil data id_content terakhir dari database
      $sqlEditor = "SELECT id_admin FROM admin ORDER BY id_admin DESC LIMIT 1";
      $result = $conn->query($sqlEditor);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_ide = intval(substr($row["id_admin"], 2));
      } else {
        $last_ide = 0;
      }

      // Tambahkan 1 pada data id_admin terakhir dan tambahkan nol di depan hingga menjadi 4 digit angka
      $new_ide = str_pad($last_ide + 1, 3, "0", STR_PAD_LEFT);

      // Gabungkan awalan kode content dan data id_content yang telah dihasilkan
      $id_admin = "AD" . $new_ide;

      $query = "INSERT INTO admin (id_admin,username,name,email,password,level) VALUES ('$id_admin','$username','$name','$email','$password','$level')";
      $query_run = mysqli_query($conn, $query);

      if ($query_run) {
        $request["valid"] = "success";
      } else {
        $request["valid"] = "failed";
      }
    } else {
      $request["valid"] = "failed";
    }

    echo json_encode($request);
  } else if (isset($_POST['addEmployee'])) {

    $name = $_POST['name'];
    $date = $_POST['date'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    $position = $_POST['position'];


    // Ambil data id_content terakhir dari database
    $sqlEditor = "SELECT id_karyawan FROM karyawan ORDER BY id_karyawan DESC LIMIT 1";
    $result = $conn->query($sqlEditor);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $last_ide = intval(substr($row["id_karyawan"], 2));
    } else {
      $last_ide = 0;
    }

    // Tambahkan 1 pada data id_admin terakhir dan tambahkan nol di depan hingga menjadi 4 digit angka
    $new_ide = str_pad($last_ide + 1, 4, "0", STR_PAD_LEFT);

    // Gabungkan awalan kode content dan data id_content yang telah dihasilkan
    $id = "K" . $new_ide;

    $query = "INSERT INTO `karyawan`(`id_karyawan`, `nama`, `tanggal_lahir`, `alamat`, `posisi`, `gaji`) VALUES ('$id','$name','$date','$address','$position','$salary')";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
      $request["valid"] = "success";
    } else {
      $request["valid"] = "failed";
    }

    echo json_encode($request);
  }
}
