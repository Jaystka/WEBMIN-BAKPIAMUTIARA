  <!-- Bootstrap core JavaScript-->
  <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <?php


include 'db.php';

if(isset($_POST['addUser']))
{
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmpassword'];

    if($password === $confirm_password)
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

        $query = "INSERT INTO editor (id_admin,username,name,email,password) VALUES ('$id_admin','$username','name','$email','$password')";
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

if(isset($_POST['title'])){

  session_start();
    $title = $_POST['title'];
    $id_category = $_POST["category"];
    $jumlahFile = count($_FILES['uploadfile']['name']);

    for($x=0; $x<$jumlahFile; $x++){
      $image = $_FILES['uploadfile']['name'][$x];
      $folder = "../img/" . $image;
    }

    $description = $_POST['description'];
    $date = date("Y-m-d H:i:s");
    $editor = $_SESSION['id_admin'];

    // $sqlinsert = "INSERT INTO `content` (`id_content`, `id_category`, `title`, `content`, `img`) VALUES ('C0002','$category','$title','$description','$folder')";
    // mysqli_query($conn, $sqlinsert);

    // Ambil data id_content terakhir dari database
    $sqlContent = "SELECT id_content FROM content ORDER BY id_content DESC LIMIT 1";
    $result = $conn->query($sqlContent);

    // Ambil data id_upload terakhir dari database
    $sqlUpload = "SELECT id_upload FROM uploadlogs ORDER BY id_upload DESC LIMIT 1";
    $result1 = $conn->query($sqlUpload);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $last_idc = intval(substr($row["id_content"], 1));
    } else {
      $last_idc = 0;
    }
    
    if ($result1->num_rows > 0) {
      $row = $result1->fetch_assoc();
      $last_idu = intval(substr($row["id_upload"], 1));
    } else {
      $last_idu = 0;
    }

    // Tambahkan 1 pada data id_content terakhir dan tambahkan nol di depan hingga menjadi 4 digit angka
    $new_idc = str_pad($last_idc + 1, 4, "0", STR_PAD_LEFT);

    // Tambahkan 1 pada data id_upload terakhir dan tambahkan nol di depan hingga menjadi 4 digit angka
    $new_idu = str_pad($last_idu + 1, 4, "0", STR_PAD_LEFT);
    
    // Gabungkan awalan kode content dan data id_content yang telah dihasilkan
    $id_content = "C" . $new_idc;

    // Gabungkan awalan kode content dan data id_content yang telah dihasilkan
    $id_upload = "U" . $new_idu;

    if(empty($title)){
      echo "<p>Nama belum diisi</p>";
    }else if (empty($id_category)){
      echo "<p>kategori belum diisi</p>";
    }else if (empty($description)){
      echo "<p>deskripsi belum diisi</p>";
    }else{
    // Simpan kode content ke database
    $sql = "INSERT INTO `content` (`id_content`, `id_category`, `title`, `content`, `img`) VALUES ('$id_content','$id_category','$title','$description','$folder')"; 
    $sql2 = "INSERT INTO `uploadlogs` (`id_upload`,`id_content`,`id_admin`, `date`) VALUES ('$id_upload','$id_content','$editor',current_timestamp())";
    $query_run = mysqli_query($conn, $sql);
    $query_run2 = mysqli_query($conn, $sql2);
    
    if($query_run &&  $query_run2)
    {
      echo "done";
      $_SESSION['success'] =  "Admin is Added Successfully";
      header('Location: ../index.php');
    }
    else 
    {
        echo "not done";
        $_SESSION['status'] =  "Admin is Not Added";
        header('Location: ../index.php');
    }
  }
}

if(isset($_POST['del_content'])){
  $id_content=$_POST['del_content'];
  $id_upload=$_POST['del_upload'];
  mysqli_query($conn, "DELETE FROM `uploadlogs` WHERE id_upload= '$id_upload'");
  mysqli_query($conn, "DELETE FROM `content` WHERE id_content= '$id_content'");
}

if(isset($_POST['id_update'])){
  $id_content=$_POST['id_update'];
  $title=$_POST['editTitle'];
  $content=$_POST['description'];
  $id_category=$_POST['category'];
  mysqli_query($conn, "UPDATE `content` SET `content`='$content', `title`='$title', `id_category`='$id_category' WHERE id_content = '$id_content'");
  header('Location: ../index.php');
}

?>