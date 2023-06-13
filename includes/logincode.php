<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    $username   = $_POST["username"];
    $pass    = $_POST['password'];

    include 'db.php';

    $user = mysqli_query($conn,"select * from editor where username='$username' and password='$pass'");
    $chek = mysqli_num_rows($user);

    if($chek>0)
    {
        $row = mysqli_fetch_assoc($user);
        $_SESSION['id_admin'] = $row['id_admin'];
        $_SESSION["username"] = $row["username"];
        $_SESSION['password'] = $row['password'];
        // $_SESSION["nama"] = $row["nama_admin"];
        // $_SESSION['level'] = $row['level'];

        // if ($_SESSION["level"]=$row["level"]==1)
        // {
             header("Location:../index.php");
        // } else if ($_SESSION["level"]=$row["level"]==2)
        // {
        //     header("Location:penjual.php");
        // }else if ($_SESSION["level"]=$row["level"]==3){
        //     header("Location:pembeli.php");
        // }
    }else
    {
        header("Location:../login.php");
    }

}

?>

