<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
include 'db.php';
session_start();
$level = $_SESSION["level"];

if (isset($_GET['exportTabel']) && ($level == "100" || $level == "2")) {
  $export = $_GET['exportTabel'];
  if ($export == 'admin') {
    // intance object dan memberikan pengaturan halaman PDF
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(200, 10, 'DATA ADMIN', 0, 0, 'C');

    $pdf->Cell(10, 15, '', 0, 1);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'NO', 1, 0, 'C');
    $pdf->Cell(50, 7, 'ID ADMIN', 1, 0, 'C');
    $pdf->Cell(75, 7, 'NAMA', 1, 0, 'C');
    $pdf->Cell(55, 7, 'EMAIL', 1, 0, 'C');


    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);
    $no = 1;
    if (isset($_GET['search'])) {
      $search = ($_GET['search']);
      $data = mysqli_query($conn, "select * from admin where name like '%" . $search . "%'");
    } else {
      $data = mysqli_query($conn, "Select * from admin");
    }
    while ($d = mysqli_fetch_array($data)) {
      $pdf->Cell(10, 6, $no++, 1, 0, 'C');
      $pdf->Cell(50, 6, $d['id_admin'], 1, 0);
      $pdf->Cell(75, 6, $d['name'], 1, 0);
      $pdf->Cell(55, 6, $d['username'], 1, 1);
    }
  }elseif ($export == "karyawan") {
    // intance object dan memberikan pengaturan halaman PDF
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(200, 10, 'DATA KARYAWAN', 0, 0, 'C');

    $pdf->Cell(10, 15, '', 0, 1);
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'NO', 1, 0, 'C');
    $pdf->Cell(20, 7, 'ID', 1, 0, 'C');
    $pdf->Cell(50, 7, 'NAMA', 1, 0, 'C');
    $pdf->Cell(30, 7, 'TANGGAL LAHIR', 1, 0, 'C');
    $pdf->Cell(40, 7, 'ALAMAT', 1, 0, 'C');
    $pdf->Cell(40, 7, 'POSISI', 1, 0, 'C');


    $pdf->Cell(10, 7, '', 0, 1);
    $pdf->SetFont('Times', '', 10);
    $no = 1;
    if (isset($_GET['search'])) {
      $search = ($_GET['search']);
      $data = mysqli_query($conn, "select * from karyawan where name like '%" . $search . "%'");
    } else {
      $data = mysqli_query($conn, "Select * from karyawan");
    }
    while ($d = mysqli_fetch_array($data)) {
      $pdf->Cell(10, 6, $no++, 1, 0, 'C');
      $pdf->Cell(20, 6, $d['id_karyawan'], 1, 0);
      $pdf->Cell(50, 6, $d['nama'], 1, 0);
      $pdf->Cell(30, 6, $d['tanggal_lahir'], 1, 0);
      $pdf->Cell(40, 6, $d['alamat'], 1, 0);
      $pdf->Cell(40, 6, $d['posisi'], 1, 0);
    }
  }
      $pdf->Output();
} else {
  header("Location:../index.php");
}
?>