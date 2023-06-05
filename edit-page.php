<?php
session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
require_once './includes/db.php';

$username = $_SESSION["username"];

$id_content=$_GET['id_content'];

$query= mysqli_query($conn,"SELECT c.id_content, c.title, c.content, c.img , ca.category, ca.id_category FROM content c JOIN category ca using(id_category) WHERE id_content = '$id_content'");
$category = mysqli_query($conn, "SELECT * FROM category");
?>

<div class="container-fluid">
<!-- Content Update -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">EDIT KONTEN</h6>
  </div>
  <div class="card-body">
    <form method="POST" action="includes/scripts.php" enctype="multipart/form-data" onclick="return ">
    <input type="hidden" name="id_update" value="<?= $id_content ?>">
      <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <?php
        foreach ($query as $rows){
        ?>
        <input type="text" class="form-control" value="<?= $rows['title'] ?>" name="editTitle" id="editTitle" placeholder="Judul" style="width: 50%;"/>

      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Kategori</label>
        <select class="form-control"  style="width: 50%;" name="category" id="category" aria-label="Default select example">
          <option value="<?= $rows['id_category'] ?>" selected><?= $rows['category'] ?></option>
          <?php 
          foreach ($category as $rowss) {
            ?>
          <option value="<?= $rowss['id_category'] ?>"><?= $rowss['category'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      <div class="mb-3">
        <label for="uploadimage" class="form-label">Upload Gambar</label>
        <input class="form-control" type="file" name="uploadfile[]" value="<?= $rows['img'] ?>" id="uploadfile" accept="image/*" multiple style="width: 50%;">
        <img src="<?= $rows['img'] ?>" alt="">
      </div>
      <div class="mb-3">
      <label for="description" class="form-label">Deskripsi</label>
      <textarea class="form-control"  name="description" id="description"><?= $rows['content'] ?></textarea>
      </div>
        <?Php
        }
        ?>
              <a href="index.php" id="btnCancle" type="button" class="btn btn-secondary">Batal</a>
      <button id="btnUpdate" type="submit" class="btn btn-primary">Update</button>
    </form>

  </div>
</div>
<!-- End Content Upload -->

    </div>
<?php
include('includes/footer.php');
?>
<script src="vendor/ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'description' );
</script>