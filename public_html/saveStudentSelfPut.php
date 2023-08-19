<!DOCTYPE html>
<?php
  if(isset($_GET['studentId'])){
      $studentId =  $_GET['studentId'];
  }
  if(isset($_GET['firstname'])){
      $firstname =  $_GET['firstname'];
  }
  if(isset($_GET['nickname'])){
      $nickname = $_GET['nickname'];
  }
  if(isset($_GET['grade'])){
      $grade =  $_GET['grade'];
  }
  if(isset($_GET['room'])){
      $room =  $_GET['room'];
  }
  if(isset($_GET['tel'])){
      $tel =  $_GET['tel'];
  }
  if(isset($_GET['lineId'])){
      $lineId =  $_GET['lineId'];
  }
  if(isset($_GET['facebook'])){
      $facebook =  $_GET['facebook'];
  }
  if(isset($_GET['ig'])){
      $ig =  $_GET['ig'];
  }
  if(isset($_GET['emer_firstname'])){
      $emer_firstname =  $_GET['emer_firstname'];
  }
  if(isset($_GET['emer_lastname'])){
      $emer_lastname =  $_GET['emer_lastname'];
  }
  if(isset($_GET['emer_relation'])){
      $emer_relation =  $_GET['emer_relation'];
  }
  if(isset($_GET['emer_tel'])){
      $emer_tel =  $_GET['emer_tel'];
  }
  if(isset($_GET['emer_lineId'])){
      $emer_lineId =  $_GET['emer_lineId'];
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
            $class = $grade.'/'.$room;
            // echo $seatRow.'<br>';
            // echo $seatColumn.'<br>';
            // echo $studentId.'<br>';
            // echo $firstname.'<br>';
            // echo $nickname.'<br>';
            // echo $class.'<br>';
            // echo $tel.'<br>';
            // echo $lineId.'<br>';
            $results = saveStudentSelf($studentId, $firstname, $nickname, $class, $tel, $lineId, $facebook, $ig, $emer_firstname, $emer_lastname, $emer_relation, $emer_tel, $emer_lineId);
          }catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
            echo '<br>';
          }
          if( isset($results) && $results ){
            printf("<label style='color:green;'>บันทึกข้อมูลสำเร็จ</label><br>");
            printf("<label>ชื่อจริง:</label> <span>%s</span><br>",$firstname);
            printf("<label>เลขประจำตัว:</label> <span>%s</span><br>",$studentId);
            printf("<label>ชื่อเล่น:</label> <span>%s</span><br>",$nickname);
            printf("<label>ระดับชั้น:</label> <span>%s</span><br>",$class);
            printf("<label>เบอร์โทรศัพท์:</label> <span>%s</span><br>",$tel);
            printf("<label>LineId:</label> <span>%s</span><br>",$lineId);
            printf("<label>facebook:</label> <span>%s</span><br>",$facebook);
            printf("<label>IG:</label> <span>%s</span><br>",$ig);
            printf("<label>ผู้ติดต่อฉุกเฉิน</label><br>");
            printf("<label>ชื่อ:</label> <span>%s</span><br>",$emer_firstname);
            printf("<label>นามสกุล:</label> <span>%s</span><br>",$emer_lastname);
            printf("<label>ความสัมพันธ์:</label> <span>%s</span><br>",$emer_relation);
            printf("<label>เบอร์โทรศัพท์:</label> <span>%s</span><br>",$emer_tel);
            printf("<label>LineId:</label> <span>%s</span><br>",$emer_lineId);
            printf("<button onclick=\"location.href='/';\" class=\"btn btn-info\" autofocus>กลับหน้าหลัก</button>");
          }
          else{
            printf("<label style='color:red;'>บันทึกผิดพลาด</label><br>");
            printf("<button onclick=\"location.href='/saveStudentSelf.php';\" class=\"btn btn-info\" autofocus>กรอกข้อมูลใหม่</button>");
          }
        ?>
      </div>
  </body>
</html>