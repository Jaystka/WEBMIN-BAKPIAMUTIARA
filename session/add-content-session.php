<?php 
session_start();
include "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST['addAdmin'])){

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['passwordConf'];


    if($password === $passwordConf)
    {
        // Ambil data id_content terakhir dari database
        $sqlEditor = "SELECT id_admin FROM editor ORDER BY id_admin DESC LIMIT 1";
        $result = $conn->query($sqlEditor);

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $last_ide = intval(substr($row["id_admin"], 1));
        } else {
          $last_ide = 0;
        }

        // Tambahkan 1 pada data id_admin terakhir dan tambahkan nol di depan hingga menjadi 4 digit angka
       $new_ide = str_pad($last_ide + 1, 4, "0", STR_PAD_LEFT);

       // Gabungkan awalan kode content dan data id_content yang telah dihasilkan
      $id_admin = "A" . $new_ide;

        $query = "INSERT INTO editor (id_admin,username,name,email,password) VALUES ('$id_admin','$username','$name','$email','$password')";
        $query_run = mysqli_query($conn, $query);
    
        if($query_run)
        {
            echo "done";
            $_SESSION['success'] =  "Admin is Added Successfully";
            header('Location: ../adminManagement-page.php');
        }
        else 
        {
            echo "not done";
            $_SESSION['status'] =  "Admin is Not Added";
            header('Location: ../adminManagement-page.php');
        }
    }
    else 
    {
        echo "pass no match";
        $_SESSION['status'] =  "Password and Confirm Password Does not Match";
        header('Location: adminManagement-page.php');
    }
}
}
?>