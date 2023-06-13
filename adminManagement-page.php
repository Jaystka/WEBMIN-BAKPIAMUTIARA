<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
require_once './includes/db.php';
$editor = mysqli_query($conn,"Select * from editor");
$_SESSION['accsNow'] = "a";
?>

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold">Admin Management
      </h6>
    </div>

    <div class="card-body">

      <div class="table-responsive">

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
        </table>

      </div>
      <button style="height: 50px; font-weight: bold;" class="btn btn-warning "><img src="img/pVector.svg" alt="">
        Export
        PDF</button>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>