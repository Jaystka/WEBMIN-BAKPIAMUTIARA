<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
require_once './includes/db.php';
?>

<!-- Modal -->
<div class="modal fade" id="modalAddData" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content text-black">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
      </div>
      <form class="formAdd" action="session/add-data-session.php" method="POST">
        <div class="modal-body ">
          <div class="mb-3">
            <label class="form-label" for="name">Nama</label>
            <input class="form-control" name="name" id="name" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="date">Tanggal Lahir</label>
            <input class="form-control" name="date" id="date" type="date" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="address">Alamat</label>
            <input class="form-control" name="address" id="address" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="salary">Gaji</label>
            <input class="form-control" name="salary" id="salary" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="position">Posisi</label>
            <select class="custom-select" id="position" name="position">
              <option value="Produksi">Produksi</option>
              <option value="Penjualan">Penjualan</option>
              <option value="Pembelian">Pembelian</option>
              <option value="Gudang">Gudang</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" id="btnFormAdd">Save
            changes</button>
        </div>
        <input name="addEmployee" id="addEmployee" type="hidden">
      </form>
    </div>
  </div>
</div>
<!-- Modal End-->

<!-- Modal Edit-->
<div class="modal fade" id="modalEditData" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content text-black">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
      </div>
      <form class="formEdit" action="session/add-data-session.php" method="POST">
        <div class="modal-body ">
          <div class="mb-3">
            <label class="form-label" for="name">Nama</label>
            <input class="form-control" name="name" id="nameE" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="date">Tanggal Lahir</label>
            <input class="form-control" name="date" id="dateE" type="date" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="address">Alamat</label>
            <input class="form-control" name="address" id="addressE" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="salary">Gaji</label>
            <input class="form-control" name="salary" id="salaryE" type="text" required>
          </div>
          <div class="mb-3">
            <label class="form-label" for="position">Posisi</label>
            <select class="custom-select" id="positionE" name="position">
              <option value="Produksi">Produksi</option>
              <option value="Penjualan">Penjualan</option>
              <option value="Pembelian">Pembelian</option>
              <option value="Gudang">Gudang</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger" id="btnFormEdit">Save
            changes</button>
        </div>
        <input name="updateEmployee" id="updateEmpolyee" type="hidden">
      </form>
    </div>
  </div>
</div>
<!-- Modal End-->

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold">Produksi
      </h6>
    </div>

    <div class="card-body">

      <div class="table-responsive" id="tabel-content">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead style="background: #E33035; color: white;">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Tanggal Lahir</th>
              <th>Alamat</th>
              <th>Gaji</th>
              <th>EDIT</th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody style="color: black;">
            <?php
            if (isset($_GET['search'])) {
              $search = ($_GET['search']);
              $editor = mysqli_query($conn, "select * from karyawan where name like '%" . $search . "%'");
            } else {
              $editor = mysqli_query($conn, "Select * from karyawan");
            }

            foreach ($editor as $rows) {
            ?>
              <tr>
                <td>
                  <?= $rows['id_karyawan'] ?>
                </td>
                <td>
                  <?= $rows['nama'] ?>
                </td>
                <td>
                  <?= $rows['tanggal_lahir'] ?>
                </td>
                <td>
                  <?= $rows['alamat'] ?>
                </td>
                <td>
                  <?= $rows['gaji'] ?>
                </td>
                <td>
                  <button type="submit" name="edit_btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalEditData" onclick="editData(`<?= $rows['id_karyawan'] ?>`);"> EDIT</button>
                </td>
                <td>
                  <button type="submit" name="delete_btn" class="btn btn-danger" onclick="deleteData(`<?= $rows['id_karyawan'] ?>`);"> DELETE</button>
                </td>
              <?php
            }
              ?>
              </tr>

          </tbody>
        </table>

      </div>
      <div style="display: inline-block;padding-right: 1rem">
        <button style="height: 52.5px; font-weight: bold;padding:0 1.5rem" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#modalAddData"><img src="img/mdi_edit-box.svg" alt="">
          Tambah Data</button>
      </div>
      <div style="display: inline-block">
        <a href="includes/export.php?exportTabel=karyawan<?php if (isset($_GET['search'])) {
                                                            echo " &search=" . $_GET['search'];
                                                          } ?>" target="_blank" style="padding: 10px; font-weight: bold;" class="btn btn-danger "><img src="img/pVector.svg" alt="">
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
  $(document).on('click', '#btnFormAdd', function(e) {
    e.preventDefault();
    var name = document.getElementById("name").value;
    var date = document.getElementById("date").value;
    var salary = document.getElementById("salary").value;
    var address = document.getElementById("address").value;
    var position = document.getElementById("position").value;

    if (name.length != 0 && date.length != 0 && salary.length != 0 && address.length != 0 && position.length != 0) {
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
            success: function(data) {
              var validate = JSON.parse(data);
              if (validate.valid == "success")
                window.location.href = "/employee-page.php";
              else
                Swal.fire({
                  title: 'Gagal Menyimpan Data !',
                  text: 'Periksa Koneksi atau Data yang dimasukkan !!',
                  icon: 'error',
                  confirmButtonText: 'OK',
                  confirmButtonColor: 'red'
                });
            }
          });
          Swal.fire('Tersimpan!', '', 'Berhasil');
        } else if (result.isDenied) {
          Swal.fire('Data batal disimpan', '', 'info');
        }
      });
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
    var name = document.getElementById("nameE").value = "";
    var date = document.getElementById("dateE").value = "";
    var salary = document.getElementById("salaryE").value = "";
    var address = document.getElementById("addressE").value = "";
    var position = document.getElementById("positionE").value = "";

    $.ajax({
      type: "POST",
      url: "session/update-data-session.php",
      data: {
        idKaryawan: id
      },
      success: function(data) {
        var data = JSON.parse(data);
        var name = document.getElementById("nameE").value = data.nama;
        var date = document.getElementById("dateE").value = data.tanggal_lahir;
        var salary = document.getElementById("salaryE").value = data.gaji;
        var address = document.getElementById("addressE").value = data.alamat;
        var position = document.getElementById("positionE").value = data.posisi;
      }
    });
  }

  //End Get Data From Database For Edit

  //Edit Data Form
  $(document).on('click', '#btnFormEdit', function(e) {
    e.preventDefault();
    var name = document.getElementById("nameE").value;
    var date = document.getElementById("dateE").value;
    var salary = document.getElementById("salaryE").value;
    var address = document.getElementById("addressE").value;
    var position = document.getElementById("positionE").value;

    if (name.length != 0 && date.length != 0 && salary.length != 0 && address.length != 0 && position.length != 0) {
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
            success: function(data) {
              var validate = JSON.parse(data);
              if (validate.valid == "success")
                window.location.href = "/employee-page.php";
              else
                Swal.fire({
                  title: 'Gagal Menyimpan Data !',
                  text: 'Periksa Koneksi atau Data yang dimasukkan !!',
                  icon: 'error',
                  confirmButtonText: 'OK',
                  confirmButtonColor: 'red'
                });
            }
          });
          Swal.fire('Tersimpan!', '', 'Data Berhasil Diubah');
        } else if (result.isDenied) {
          Swal.fire('Data Batal Diubah', '', 'info');
        }
      });
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
          data: {
            idKaryawan: id
          },
          success: function(data) {
            var validate = JSON.parse(data);
            if (validate.valid == "success")
              window.location.href = "/employee-page.php";
            else
              Swal.fire({
                title: 'Gagal Melakukan Tindakan !',
                text: 'Periksa Koneksi !!',
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: 'red'
              });
          }
        });
        Swal.fire('Tersimpan!', '', 'Data Berhasil Dihapus');
      } else if (result.isDenied) {
        Swal.fire('Data Batal Dihapus', '', 'info');
      }
    });
  }
</script>