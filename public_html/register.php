<!DOCTYPE html>
<?php
  if(isset($_GET['seatRow'])){
      $seatRow =  $_GET['seatRow'];
  }
  if(isset($_GET['seatColumn'])){
      $seatColumn =  intval($_GET['seatColumn']);
  }
  if(isset($_GET['studentId'])){
      $studentId =  intval($_GET['studentId']);
  }
  
  include("db.php");
  include("settings.php");
  include("api.php");
?>
<html>
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109766055-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109766055-1');
    </script>
      <title>AC CHEER | Register</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css"/>
      <link rel="stylesheet" href="style.css"/>
      <script src="jquery/jquery-1.12.4.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="script.js"></script>
  </head>
  <body>
      <div class="container" id="maincontainer">
        <?php 
          try {
            $results = saveStudent($seatRow, $seatColumn, $studentId);
          }catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
            echo '<br>';
          }
          if( isset($results) && $results ){
            printf("<label>บันทึกข้อมูลสำเร็จ</label><br>");
            if($seatColumn <= 50)
              $seatColumn = $seatColumn + 1;
            else
              $seatRow = chr(intVal($seatRow+1));
            printf("<button onclick=\"location.href='/saveStudent.php?seatRow=%s&seatColumn=%d';\" class=\"btn btn-info\" autofocus>กรอกข้อมูลต่อ</button>",$seatRow,$seatColumn);
          }
          else{
            printf("<label style='color:red;'>บันทึกผิดพลาด</label><br>");
            printf("<button onclick=\"location.href='/saveStudent.php?seatRow=%s&seatColumn=%d';\" class=\"btn btn-info\" autofocus>กรอกข้อมูลใหม่</button>",$seatRow,$seatColumn);
          }
        ?>
      </div>
  </body>
</html>