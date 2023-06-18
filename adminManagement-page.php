<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php');
require_once './includes/db.php';
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content text-black">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
      </div>
      <form action="session/add-content-session.php" method="POST">
      <div class="modal-body ">
        <div class="mb-3">
        <label class="form-label" for="name">Nama</label>
        <input class="form-control" name="name" id="name" type="text" required>
        </div>
        <div class="mb-3">
        <label class="form-label" for="username">Nama Pengguna</label>
        <input class="form-control" name="username" id="username" type="text" required>
        </div>
        <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input class="form-control" name="email" id="email" type="text" required>
        </div>
        <div class="mb-3">
        <label class="form-label" for="password">Kata Sandi</label>
        <input class="form-control" name="password" id="password" type="password" required>
        </div>
        <div class="mb-3">
        <label class="form-label" for="passwordConf">Konfirmasi Kata Sandi</label>
        <input class="form-control" name="passwordConf" id="passwordConf" type="password" required>
        </div>
        <p class="text-danger" id="message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="addAdmin" onclick=" return matchPassword();">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
  <!-- Modal End-->

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold">Admin Management
      </h6>
    </div>

    <div class="card-body">

      <div class="table-responsive" id="tabel-content">

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
            if(isset($_GET['search'])){
              $search = ($_GET['search']);
              $editor = mysqli_query($conn, "select * from editor where name like '%".$search."%'");
            }else{
              $editor = mysqli_query($conn,"Select * from editor");
            }

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
      <div style="display: inline-block;padding-right: 1rem">
        <button style="height: 50px; font-weight: bold;padding:0 1.5rem" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#exampleModal"><img
            src="img/mdi_edit-box.svg" alt="">
          Tambah Data</button>
      </div>
      <div style="display: inline-block">
        <a href="includes/export.php?exportTabel=karyawan<?php if (isset($_GET['search'])) {
          echo "&search=".$_GET['search'] ;
        }?>" target="_blank" style="padding: 10px; font-weight: bold;"
          class="btn btn-danger "><img src="img/pVector.svg" alt="">
          Export PDF</a>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<script>
  function matchPassword() {
  var pw1 = document.getElementById("password").value;
  var pw2 = document.getElementById("passwordConf").value;
  let message =  document.getElementById("message");
  console.log(pw1);
  if(pw1 != pw2)
  {	
    message.textContent = "Kata Sandi Tidak Sesuai";
    return false;
  } else {
    Swal.fire({
  title: 'Do you want to save the changes?',
  showDenyButton: true,
  confirmButtonText: 'Save',
  denyButtonText: `Don't save`,
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Saved!', '', 'success')
  } else if (result.isDenied) {
    Swal.fire('Changes are not saved', '', 'info')
  }
})
  }
}
</script>