<?php
include("db.php");
include("settings.php");
include("api.php");

$status = "normal";

try {
  $results = getAllStudent();
}catch(Exception $e) {
  $status = "error";
  $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
}
if(isset($results)) {
  $status = "success";
}

include('./fpdfFunction/code39.php');
$pdf=new PDF_Code39();
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->SetFont('THSarabunNew','',12);
$pdf->SetMargins(0,0,0);
$pdf->SetAutoPageBreak(false, 0);

$studentId = iconv('UTF-8','TIS-620', "52748");
$fisrtName = iconv('UTF-8','TIS-620', "ชื่อจริง");
$lastname = iconv('UTF-8','TIS-620', "นามสกุลจริง");
$room = iconv('UTF-8','TIS-620', "ม.1/1");
$no = iconv('UTF-8','TIS-620', "เลขที่ 1");

$initStartTop = 15;
$initStartLeft = 5;
$startTop = $initStartTop;
$startLeft = $initStartLeft;
$width = 50;
$height = 22;
$barcodeHeight = 9;
$studentIdHeight = 4;
$nameHeight = 4;
$roomHeight = 4;

$p = 0;

$formatedData = [];

for($i=0;$i<count($results);$i++) {
  if(!isset($formatedData[$results[$i]['room']])) {
    $formatedData[$results[$i]['room']] = [];
  }
  $formatedData[$results[$i]['room']][] = $results[$i];
}

foreach ($formatedData as $roomKey => $roomValue) {
  $room = iconv('UTF-8','TIS-620', $roomKey);
  $i = 0;
  $j = 0;
  $startTop = $initStartTop;
  $startLeft = $initStartLeft;
  $pdf->AddPage();
  $pdf->SetXY(5,5);
  $pdf->SetFont('THSarabunNew','',24);
  $pdf->Cell(200,10,$room,1,2,'C');
  foreach ($roomValue as $studentKey => $studentValue) {
    $studentId = iconv('UTF-8','TIS-620', $studentValue['studentId']);
    $firstname = iconv('UTF-8','TIS-620', $studentValue['firstname']);
    $lastname = iconv('UTF-8','TIS-620//IGNORE', str_replace(" ","",$studentValue['lastname']));
    $no = iconv('UTF-8','TIS-620', 'เลขที่ '.$studentValue['no']);
    $pdf->SetXY($startLeft,$startTop + 1);
    $pdf->Code39($startLeft + 7,$startTop + 1,$studentId,1,$barcodeHeight - 1);
    $pdf->SetXY($startLeft,$startTop);
    $pdf->Cell($width,$height,'',1,0,'C');
    $pdf->SetXY($startLeft,$startTop + $barcodeHeight + 1);
    $pdf->SetFont('THSarabunNew','',16);
    $pdf->Cell($width,$studentIdHeight ,$studentId,0,2,'C');
    $pdf->SetFont('THSarabunNew','',10);
    $pdf->Cell($width,$nameHeight ,$firstname.' '.$lastname,0,2,'C');
    $pdf->Cell($width,$roomHeight,$room.' '.$no,0,2,'C');
    $startLeft = $startLeft + $width;
    if($i < 12) {
      if ($j < 3) {
        $j = $j + 1;
      } else {
        $j = 0;
        $startTop = $startTop + $height;
        $startLeft = $initStartLeft; 
        $i = $i + 1;
      }
    } else {
      $i = 0;
      $startTop = $initStartTop;
      $startLeft = $initStartLeft;
      $pdf->AddPage();
      $pdf->SetXY(5,5);
      $pdf->SetFont('THSarabunNew','',24);
      $pdf->Cell(200,10,$room,1,2,'C');
    }
  }
}

$pdf->Output();

?>