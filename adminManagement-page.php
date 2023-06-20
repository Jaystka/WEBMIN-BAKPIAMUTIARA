<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php');
require_once './includes/db.php';
?>

<!-- Modal Add Data -->
<div class="modal fade" id="modalAddData" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content text-black">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddDataLabel">Tambah Data</h1>
      </div>
      <form class="formAdd" method="POST">
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
          <div class="mb-3">
            <label class="form-label" for="level">Level</label>
            <input class="form-control" name="level" id="level" type="number" min="1" max="100" required>
          </div>
          <p class="text-danger" id="message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" id="btnFormAdd">Save
            changes</button>
        </div>
        <input name="addAdmin" type="hidden">
      </form>
    </div>
  </div>
</div>
<!-- Modal Add Data End-->

<!-- Modal Edit Data -->
<div class="modal fade" id="modalEditData" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content text-black">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddDataLabel">Tambah Data</h1>
      </div>
      <form class="formEdit" method="POST">
        <div class="modal-body ">
          <div class="mb-3">
            <label class="form-label" for="name">Nama</label>
            <input class="form-control" name="name" id="nameE" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="username">Nama Pengguna</label>
            <input class="form-control" name="username" id="usernameE" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input class="form-control" name="email" id="emailE" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="password">Kata Sandi</label>
            <input class="form-control" name="password" id="passwordE" type="password" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="passwordConf">Konfirmasi Kata Sandi</label>
            <input class="form-control" name="passwordConf" id="passwordConfE" type="password" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="level">Level</label>
            <input class="form-control" name="level" id="levelE" type="number" min="1" max="100" required>
          </div>
          <p class="text-danger" id="message"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" id="btnFormEdit">Save
            changes</button>
        </div>
        <input name="updateAdmin" id="updateAdmin" type="hidden">
      </form>
    </div>
  </div>
</div>
<!-- Modal Edit Data End-->

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
              $editor = mysqli_query($conn, "select * from admin where name like '%".$search."%'");
            }else{
              $editor = mysqli_query($conn,"Select * from admin");
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
                <button type="submit" name="edit_btn" class="btn btn-success" data-bs-toggle="modal"
                  data-bs-target="#modalEditData" onclick="editData(`<?= $rows['id_admin'] ?>`);"> EDIT</button>
              </td>
              <td>
                <button type="submit" name="delete_btn" class="btn btn-danger"
                  onclick="deleteData(`<?= $rows['id_admin'] ?>`);"> DELETE</button>
              </td>
              <?php
        }
        ?>
            </tr>

          </tbody>
        </table>

      </div>
      <div style="display: inline-block;padding-right: 1rem">
        <button style="height: 52.5px; font-weight: bold;padding:0 1.5rem" class="btn btn-warning "
          data-bs-toggle="modal" data-bs-target="#modalAddData"><img src="img/mdi_edit-box.svg" alt="">
          Tambah Data</button>
      </div>
      <div style="display: inline-block">
        <a href="includes/export.php?exportTabel=admin<?php if (isset($_GET['search'])) {
          echo " &search=".$_GET['search'] ;
        }?>" target="_blank" style="padding: 10px; font-weight: bold;" class="btn btn-danger "><img
            src="img/pVector.svg" alt="">
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

  //Add Data Form
  $(document).on('click', '#btnFormAdd', function (e) {
    e.preventDefault();
    var pw1 = document.getElementById("password").value;
    var pw2 = document.getElementById("passwordConf").value;
    var name = document.getElementById("name").value;
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var level = document.getElementById("level").value;

    if (name.length != 0 && username.length != 0 && email.length != 0 && pw1.length != 0 && pw2.length != 0 && level.length != 0) {
      if (pw1 != pw2) {
        message.textContent = "Kata Sandi Tidak Sesuai";
        return false;
      } else {
        Swal.fire({
          title: 'Apakah anda yakin untuk menambahkan data?',
          showDenyButton: true,
          confirmButtonText: 'Simpan',
          denyButtonText: `Batal`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: "session/add-data-session.php",
              data: $(".formAdd").serialize(),
              success: function (data) {
                var validate = JSON.parse(data);
                if (validate.valid == "success")
                  window.location.href = "/adminManagement-page.php";
                else
                  Swal.fire({
                    title: 'Gagal Menyimpan Data !',
                    text: 'Periksa Koneksi atau Data yang dimasukkan !!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'red'
                  }
                  );
              }
            });
            Swal.fire('Tersimpan!', '', 'Berhasil');
          } else if (result.isDenied) {
            Swal.fire('Data batal disimpan', '', 'info');
          }
        });
      }
    } else {
      Swal.fire({
        icon: 'error',
        text: 'Lengkapi Data!',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    }
  });

  //Get Data From Database For Edit
  function editData(id) {
    document.getElementById("updateAdmin").value = "";
    document.getElementById("nameE").value = "";
    document.getElementById("usernameE").value = "";
    document.getElementById("emailE").value = "";
    document.getElementById("levelE").value = "";
    document.getElementById("passwordE").value = "";
    document.getElementById("passwordConfE").value = "";
    $.ajax({
      type: "POST",
      url: "session/update-data-session.php",
      data: { idAdmin: id },
      success: function (data) {
        var data = JSON.parse(data);
        document.getElementById("updateAdmin").value = data.id_admin;
        document.getElementById("nameE").value = data.name;
        document.getElementById("usernameE").value = data.username;
        document.getElementById("emailE").value = data.email;
        document.getElementById("levelE").value = data.level;
        document.getElementById("passwordE").value = data.password;
        document.getElementById("passwordConfE").value = data.password;
      }
    });
  }

  //End Get Data From Database For Edit

  //Edit Data Form
  $(document).on('click', '#btnFormEdit', function (e) {
    e.preventDefault();
    var pw1 = document.getElementById("passwordE").value;
    var pw2 = document.getElementById("passwordConfE").value;
    var name = document.getElementById("nameE").value;
    var username = document.getElementById("usernameE").value;
    var email = document.getElementById("emailE").value;
    var level = document.getElementById("levelE").value;

    if (name.length != 0 && username.length != 0 && email.length != 0 && pw1.length != 0 && pw2.length != 0 && level.length != 0) {
      if (pw1 != pw2) {
        message.textContent = "Kata Sandi Tidak Sesuai";
        return false;
      } else {
        Swal.fire({
          title: 'Apakah anda yakin untuk mengubah data?',
          showDenyButton: true,
          confirmButtonText: 'Simpan',
          denyButtonText: `Batal`,
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: "session/save-update-session.php",
              data: $(".formEdit").serialize(),
              success: function (data) {
                var validate = JSON.parse(data);
                if (validate.valid == "success")
                  window.location.href = "/adminManagement-page.php";
                else
                  Swal.fire({
                    title: 'Gagal Menyimpan Data !',
                    text: 'Periksa Koneksi atau Data yang dimasukkan !!',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'red'
                  }
                  );
              }
            });
            Swal.fire('Tersimpan!', '', 'Data Berhasil Diubah');
          } else if (result.isDenied) {
            Swal.fire('Data Batal Diubah', '', 'info');
          }
        });
      }
    } else {
      Swal.fire({
        icon: 'error',
        text: 'Lengkapi Data!',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
    }
  });

  //Delete Data Form
  function deleteData(id) {
    Swal.fire({
      title: 'Apakah anda yakin untuk menghapus data?',
      showDenyButton: true,
      confirmButtonText: 'Simpan',
      denyButtonText: `Batal`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "session/delete-data-session.php",
          data: { idAdmin: id },
          success: function (data) {
            var validate = JSON.parse(data);
            if (validate.valid == "success")
              window.location.href = "/adminManagement-page.php";
            else
              Swal.fire({
                title: 'Gagal Melakukan Tindakan !',
                text: 'Periksa Koneksi !!',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: 'red'
              }
              );
          }
        });
        Swal.fire('Tersimpan!', '', 'Data Berhasil Dihapus');
      } else if (result.isDenied) {
        Swal.fire('Data Batal Dihapus', '', 'info');
      }
    });
  }
</script>