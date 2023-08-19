<!DOCTYPE html>
<?php
  if(isset($_GET['seatRow'])){
      $seatRow =  $_GET['seatRow'];
  }
  if(isset($_GET['seatColumn'])){
      $seatColumn =  $_GET['seatColumn'];
  }
  if(isset($_GET['studentId'])){
      $studentId =  $_GET['studentId'];
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
            $results = saveStudentSeat($seatRow, $seatColumn, $studentId);
            $student = getStudentProfileSelf($studentId);
          }catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
            echo '<br>';
          }
          if( isset($results) && $results ){
            printf("<label>ที่นั่ง:</label> <span>%s%d</span>",$seatRow,$seatColumn);
            if( isset($student) ){
              foreach($student as $key => $value){
                printf("<label style='color:green;'>บันทึกข้อมูลสำเร็จ</label><br>");
                print '<hr>';
                printf("<label>ชื่อจริง:</label> <span>%s</span><br>",$value['firstname']);
                printf("<label>เลขประจำตัว:</label> <span>%s</span><br>",$value['studentId']);
                printf("<label>ชื่อเล่น:</label> <span>%s</span><br>",$value['nickname']);
                printf("<label>ระดับชั้น:</label> <span>%s</span><br>",$value['room']);
                printf("<label>เบอร์โทรศัพท์:</label> <span>%s</span><br>",$value['tel']);
                printf("<label>LineId:</label> <span>%s</span><br>",$value['lineId']);
                printf("<label>facebook:</label> <span>%s</span><br>",$value['facebook']);
                printf("<label>IG:</label> <span>%s</span><br>",$value['ig']);
              }
            } else {
              printf("<label style='color:red;'>บันทึกข้อมูลไม่สำเร็จ</label><br>");
              print '<hr>';
              printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนเลขประจำตัว %s</label><br>",$studentId);
              printf("<label style='color:red;'>กรุณากรอกข้อมูลผู้ติดต่อฉุกเฉินก่อน </label><button onclick=\"location.href='/saveStudentSelf.php';\" class=\"btn btn-default\" autofocus>กรอกข้อมูลผู้ติดต่อฉุกเฉินที่นี่</button><br>");
            }
            printf("<button onclick=\"location.href='/';\" class=\"btn btn-info\" autofocus>กลับหน้าหลัก</button>");
          }
          else{
            printf("<label style='color:red;'>บันทึกผิดพลาด</label><br>");
            printf("<button onclick=\"location.href='/saveStudentSeat.php';\" class=\"btn btn-info\" autofocus>กรอกข้อมูลใหม่</button>");
          }
        ?>
      </div>
  </body>
</html>