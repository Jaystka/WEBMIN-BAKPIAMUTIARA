<?php 
include 'db.php';

if(isset($_POST['accsNow'])){
    $accsNow = $_POST['accsNow'];
    $search = $_POST['search'];

        $sqlSearch = "select * from editor where name = 'Lutpa' ";
        $editor = mysqli_query($conn, "select * from editor where name = 'Lutpa' ");
    
}
?>


        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead style="background: #E33035; color: white;">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Nama Pengguna</th>
              <th>Email</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody style="color: black;">
            <?php 
        foreach ($editor as $rows) {
          ?>
            <tr>
              <td>
                <?= $rows['id_admin'] ?>
              </td>
              <td>
                <?= $rows['name'] ?>
              </td>
              <td>
                <?= $rows['username'] ?>
              </td>
              <td>
                <?= $rows['email'] ?>
              </td>
              <td>
                <form action="" method="post">
                  <input type="hidden" name="edit_id" value="">
                  <button type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
              </td>
              <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
              </td>
              <?php
        }
        ?>
            </tr>

          </tbody>