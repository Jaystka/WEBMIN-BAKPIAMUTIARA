<?php

$server = "bgtw9c3c7rqy0stpszs7-mysql.services.clever-cloud.com";
$user = "uye8ttyab0rhjkhz";
$password = "iGwrMss6NbkkjkCFoLY7";
$nama_database = "bgtw9c3c7rqy0stpszs7";

$conn = mysqli_connect($server, $user, $password, $nama_database);


if( !$conn ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}


?>