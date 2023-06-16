
<?php
// memanggil library FPDF
require('fpdf/fpdf.php');
include 'db.php';
session_start();
$level = $_SESSION["level"];

if (isset($_GET['exportTabel']) && ($level == "100" || $level == "2")) {
   $export = $_GET['exportTabel'];
   if ($export == 'karyawan' ) {
    // intance object dan memberikan pengaturan halaman PDF
        $pdf=new FPDF('P','mm','A4');
        $pdf->AddPage();
        
        $pdf->SetFont('Times','B',13);
        $pdf->Cell(200,10,'DATA KARYAWAN',0,0,'C');
        
        $pdf->Cell(10,15,'',0,1);
        $pdf->SetFont('Times','B',9);
        $pdf->Cell(10,7,'NO',1,0,'C');
        $pdf->Cell(50,7,'NAMA' ,1,0,'C');
        $pdf->Cell(75,7,'ALAMAT',1,0,'C');
        $pdf->Cell(55,7,'EMAIL',1,0,'C');
        
        
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Times','',10);
        $no=1;
                    if(isset($_GET['search'])){
              $search = ($_GET['search']);
              $data = mysqli_query($conn, "select * from editor where name like '%".$search."%'");
            }else{
              $data = mysqli_query($conn,"Select * from editor");
            }
        while($d = mysqli_fetch_array($data)){
        $pdf->Cell(10,6, $no++,1,0,'C');
        $pdf->Cell(50,6, $d['id_admin'],1,0);
        $pdf->Cell(75,6, $d['name'],1,0);  
        $pdf->Cell(55,6, $d['username'],1,1);
        }
        
        $pdf->Output();
   }

}   else{
    header("Location:../index.php");
   }
?>
