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
            <form class="formAdd" action="session/add-data-session.php" method="POST">
                <div class="modal-body ">
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama</label>
                        <input class="form-control" name="name" id="name" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="date">Tanggal Lahir</label>
                        <input class="form-control" name="date" id="date" type="text" required>
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
                        <input class="form-control" name="position" id="position" type="text" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="addAdmin" onclick=" return adData();">Save
                        changes</button>
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
            <h6 class="m-0 font-weight-bold">Karyawan
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
            if(isset($_GET['search'])){
              $search = ($_GET['search']);
              $editor = mysqli_query($conn, "select * from karyawan where name like '%".$search."%'");
            }else{
              $editor = mysqli_query($conn,"Select * from karyawan");
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
                <button style="height: 52.5px; font-weight: bold;padding:0 1.5rem" class="btn btn-warning "
                    data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="img/mdi_edit-box.svg" alt="">
                    Tambah Data</button>
            </div>
            <div style="display: inline-block">
                <a href="includes/export.php?exportTabel=karyawan<?php if (isset($_GET['search'])) {
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
    function addData() {
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
                    Swal.fire('Tersimpan!', '', 'Berhasil')
                } else if (result.isDenied) {
                    Swal.fire('Data batal disimpan', '', 'info')
                }
            });
        }
    }
</script>