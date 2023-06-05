<?php 

require_once 'db.php';
$data = mysqli_query($conn,"SELECT c.id_content, u.id_upload, c.title, c.content, c.img, u.date FROM content c JOIN uploadlogs u on c.id_content = u.id_content ORDER BY `u`.`date` DESC");
$category = mysqli_query($conn,"Select * from category");

?>
<!-- Include TinyMCE TextEditor -->

<script src="vendor/ckeditor/ckeditor.js"></script>



<!-- Content Row -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">POSTING KONTEN</h6>
  </div>
  <div class="card-body">
    <form method="POST" action="includes/scripts.php" enctype="multipart/form-data" onclick="return ">
      <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Judul" style="width: 50%;">
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Kategori</label>
        <select class="form-control "  style="width: 50%;" name="category" id="category" aria-label="Default select example">
          <option selected>Pilih</option>
          <?php 
          foreach ($category as $rows) {
            ?>
          <option value="<?= $rows['id_category'] ?>"><?= $rows['category'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="uploadimage" class="form-label">Upload Gambar</label>
        <input class="form-control" type="file" name="uploadfile[]" value="" id="uploadfile" accept="image/*" multiple style="width: 50%;">
      </div>
      <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea class="form-control" name="description" id="description"></textarea>
      </div>
      <button id="btnUpload" type="submit" class="btn btn-primary">Unggah</button>
    </form>
  </div>
</div>
<!-- End Content Row -->

<!-- Modal View-->
<div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content" name="modal-content" id="modal-content">

    </div>
  </div>
</div>
<!-- End Modal View-->


<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DAFTAR KONTEN</h6>
  </div>
  <div class="card-body" id="card-content">
    <div class="table-responsive page">
      <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Gambar</th>
            <th>Aksi</th>
            <th>Tanggal Upload</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
           <th>ID</th>
           <th>Judul</th>
           <th>Deskripsi</th>
           <th>Gambar</th>
           <th>Aksi</th>
           <th>Tanggal Upload</th>
         </tr>
       </tfoot>
       <tbody style="color: black;">
        <?php 
        foreach ($data as $rows) {
          ?>
          <tr>
            <td><?= $rows['id_content'] ?></td>
            <td><?= $rows['title'] ?></td>
            <td><?= substr($rows['content'], 0, 25) ?></td>
            <td><?= $rows['img'] ?></td>
            <td>
              <a class="btn btn-warning" href="edit-page.php?id_content=<?= $rows['id_content'] ?>" ><svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg></a>
              <a class="btn btn-danger" onclick="deleteData('<?= $rows['id_content'] ?>', '<?= $rows['id_upload'] ?>')" ><svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a></td>
            <td><?= $rows['date'] ?></td>
            </tr>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  CKEDITOR.replace( 'description' );
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  function addData() {
    
  }

  function showData(id) {
    //onclick="showData('<?= $rows['id_content'] ?>')" data-bs-toggle="modal" data-bs-target="#Modal1"
    //$('.modal-content').load("session/show-content-session.php?id_content="+ id);
  }

  // $(document).ready(function () {
  //   $('editbtn').on('click', function () {
      
  //     $('#editmodal').modal('show');

  //     $tr = $(this).closest('tr');

  //     var data = $tr.children('td').map(function () {
  //       return $(this).text();
  //     }).get();


  //     $('update_id').val(data[0]);
  //     $('update_id').val(data[0]);
  //     $('update_id').val(data[0]);
  //     $('update_id').val(data[0]);
  //     $('update_id').val(data[0]);

  //   })
  // })

  function deleteData(idc, idu){
    Swal.fire({
      title: 'Hapus Konten',
      text: "Data Tidak Dapat Dikembalikan Lagi!!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Iya, Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
          );
        $.ajax({
         type:"POST",
         url:"includes/scripts.php",
         data: {del_content:idc, del_upload:idu},
         success: function() {
           $("#card-content").load(" #card-content > *");
           $("#card-count-content").load(" #card-count-content > *");
         }
       });
      }
    })

  }

</script>
