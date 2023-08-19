<?php

//

// require('/fpdfFunction/WriteHTML.php');

// $pdf=new PDF_HTML();
// $pdf->AddPage();
// $pdf->SetFont('Arial');
// $pdf->WriteHTML('You can<br><p align="center">center a line</p>and add a horizontal rule:<br><hr>');
// $pdf->Output();

//
// require('/fpdfFunction/mc_table.php');

// function GenerateWord()
// {
//     //Get a random word
//     $nb=rand(3,10);
//     $w='';
//     for($i=1;$i<=$nb;$i++)
//         $w.=chr(rand(ord('a'),ord('z')));
//     return $w;
// }

// function GenerateSentence()
// {
//     //Get a random sentence
//     $nb=rand(1,10);
//     $s='';
//     for($i=1;$i<=$nb;$i++)
//         $s.=GenerateWord().' ';
//     return substr($s,0,-1);
// }

// $pdf=new PDF_MC_Table();
// $pdf->AddPage();
// $pdf->SetFont('Arial','',14);
// //Table with 20 rows and 4 columns
// $pdf->SetWidths(array(30,50,30,40));
// srand(microtime()*1000000);
// for($i=0;$i<20;$i++)
//     $pdf->Row(array(GenerateSentence(),GenerateSentence(),GenerateSentence(),GenerateSentence()));
// $pdf->Output();


//

require('/fpdfFunction/html_table.php');

$pdf=new PDF();
// $pdf->Write(10, iconv('TIS-620','UTF-8','รายการขายสินค้าประจำเดือน'));
$pdf->AddPage();
// $pdf->AddFont('angsa','','angsa.php');
// $pdf->SetFont('angsa','',12);
$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
$pdf->SetFont('THSarabunNew','',12);
// $pdf->SetFont('Arial','',12);
$pdf->SetMargins(5,0);

$studentId = iconv('UTF-8','TIS-620', "52748");
$fisrtName = iconv('UTF-8','TIS-620', "ชื่อจริง");
$lastname = iconv('UTF-8','TIS-620', "นามสกุลจริง");
$room = iconv('UTF-8','TIS-620', "ม.1/1");
$no = iconv('UTF-8','TIS-620', "เลขที่ 1");

// $html='<table border="1">
// <tr>
// <td width="200" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
// </tr>
// <tr>
// <td width="200" height="30">cell 3</td><td width="200" height="30">cell 4</td>
// </tr>
// </table>';


// <tr>
// <td width="200">
//   &nbsp;
// </td>
// <td width="200">
//   <img src="./img/52748.png" width="150" height="50">
// </td>
// </tr>

$test='
<h1>aaaaaaa<h1><br><br>
<table border="1" marginLeft="10">
<tbody>
<tr>
<td width="200" height="200"><img src="./img/52748.png" width="150" height="40">'
.$studentId.' '.$fisrtName.' '.$lastname.' 
'.$room.' '.$no.' '.'</td>
<td width="200" height="200">
<img src="./img/52748.png" width="150" height="50">
'.$studentId.' '.$fisrtName.' '.$lastname.' '.$room.' '.$no.' '.'
</td>
<td width="200" height="200">
<img src="./img/52748.png" width="150" height="50">
'.$studentId.' '.$fisrtName.' '.$lastname.' '.$room.' '.$no.' '.'
</td>
<td width="200" height="200">
<img src="./img/52748.png" width="150" height="50">
'.$studentId.' '.$fisrtName.' '.$lastname.' '.$room.' '.$no.' '.'
</td>
</tr>
</tbody>
</table>
';

$pdf->WriteHTML($test);
$pdf->Output();
?>