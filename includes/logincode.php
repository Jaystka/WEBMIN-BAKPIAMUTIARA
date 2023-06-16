<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    session_start();
    include 'db.php';
    $username   = $_POST["username"];
    $pass    = $_POST['password'];
    
    if ($_POST['loginType'] == "adm") {
    $user = mysqli_query($conn,"select * from editor where username='$username' and password='$pass'");
    $chek = mysqli_num_rows($user);

    if($chek>0)
    {
        $row = mysqli_fetch_assoc($user);
        $_SESSION['id_admin'] = $row['id_admin'];
        $_SESSION["username"] = $row["username"];
        $_SESSION['password'] = $row['password'];
        // $_SESSION["nama"] = $row["nama_admin"];
        $_SESSION['level'] = $row['level'];

        header("Location:../index.php");
    }else
    {
        header("Location:../login.php");
    }

    
    }elseif($_POST['loginType'] == "dept"){
    include 'db.php';
    $username   = $_POST["username"];
    $pass    = $_POST['password'];
    
    $user = mysqli_query($conn,"select * from departement");
    $chek = mysqli_num_rows($user);

    if($chek>0)
    {
        $row = mysqli_fetch_assoc($user);
        $_SESSION['id_admin'] = $row['id_admin'];
        $_SESSION["username"] = $row["username"];
        $_SESSION['password'] = $row['password'];
        // $_SESSION["nama"] = $row["nama_admin"];
        $_SESSION['level'] = $row['level'];

        header("Location:../index.php");
    }else
    {
        header("Location:../login.php");
    }

    }else
    {
        header("Location:../login.php");
    }

}

?>

