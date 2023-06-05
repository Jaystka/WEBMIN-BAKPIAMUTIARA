<?php 

$connection = mysqli_connect("localhost","root","","bio");

$id_content = $_GET['id_content'];

$show = mysqli_query($connection, "SELECT content FROM `content` WHERE id_content= '$id_content'");



?>
<script src="/SC/asset/tinymce/tinymce.min.js"></script>
<script>
	tinymce.init({
		selector: '#deskrips'
	});
</script>

<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLabel">EDIT KONTEN WISATA</h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
	<div class="mb-3">
		<form id="formEdit" method="POST" action="includes/scripts.php"  onsubmit="return editData(this);">
			<textarea class="form-control" name="deskripsi" id="deskripsi" rows="20" ><?php 	foreach ($show as $rows) {
				echo $rows['content'];
			} ?></textarea>
			<input type="hidden" name="id_update" value="<?= $id_content ?>">
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
	<button type="submit" class="btn btn-primary" form="formEdit">Edit</button>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
	function editData(form) {
		Swal.fire({
			title: 'Apakah Anda Yakin Mengubah Deskripsi?',
			showDenyButton: true,
			confirmButtonText: 'Simpan',
			denyButtonText: `Batal`,
		}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				form.submit();
			} else if (result.isDenied) {
				return false;
			}else{
				return false;
			}
		});
		return false;
	}
</script>