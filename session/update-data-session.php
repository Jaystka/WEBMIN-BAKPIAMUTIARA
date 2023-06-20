<?php 
include ("../includes/db.php");

if(isset($_POST['idAdmin'])){
$idAdmin = $_POST['idAdmin'];
$sql = "SELECT * FROM admin WHERE id_admin = '$idAdmin' ";
$editor = mysqli_query($conn,$sql);
foreach ($editor as $rows) {
}}
echo json_encode($rows);
?>