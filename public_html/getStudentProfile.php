<!DOCTYPE html>
<?php
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
            $student = getStudentAllProfile($studentId);
            $studentSelf = getStudentProfileSelf($studentId);
            $emergencyContact = getStudentProfileSelfEmergencyContact($studentId);
            $studentSeat = getStudentSeat($studentId);
          }catch(Exception $e ) {
            echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
            echo nl2br($e->getTraceAsString());
            echo '<br>';
          }
          
          print('<H1>ข้อมูลจากระบบ</H1>');
          if( isset($student) ){
            foreach($student as $key => $value){
              printf("<label>เลขประจำตัว:</label> <span>%s</span><br>",$value['studentId']);
              printf("<label>ชื่อจริง:</label> <span>%s</span><br>",$value['firstname']);
              printf("<label>นามสกุล:</label> <span>%s</span><br>",$value['lastname']);
              printf("<label>ห้อง:</label> <span>%s</span><br>",$value['room']);
              printf("<label>เลขที่:</label> <span>%s</span><br>",$value['no']);
            }
          } else {
            print '<hr>';
            printf("<label style='color:red;'>ไม่มีนักเรียนเลขประจำตัว %s</label><br>",$studentId);
          }
          
          print('<H1>ที่นั่งสตาฟเช็ค</H1>');
          if( isset($studentSeat) ){
            foreach($studentSeat as $key => $value){
              print '<hr>';
              printf("<label>เลขประจำตัว:</label> <span>%s</span><br>",$value['studentId']);
              printf("<label>ที่นั่ง:</label> <span>%s</span><br>",$value['seatRow'].$value['seatColumn']);
              printf("<label>created_at:</label> <span>%s</span><br>",$value['created_at']);
            }
          } else {
            print '<hr>';
            printf("<label style='color:red;'>ไม่มีนักเรียนเลขประจำตัว %s</label><br>",$studentId);
          }

          print('<H1>ข้อมูลที่นักเรียนกรอกเอง</H1>');
          if( isset($studentSelf) ){
            foreach($studentSelf as $key => $value){
              print '<hr>';
              printf("<label>ที่นั่ง:</label> <span>%s</span><br>",$value['seatRow'].$value['seatColumn']);
              printf("<label>ชื่อจริง:</label> <span>%s</span><br>",$value['firstname']);
              printf("<label>เลขประจำตัว:</label> <span>%s</span><br>",$value['studentId']);
              printf("<label>ชื่อเล่น:</label> <span>%s</span><br>",$value['nickname']);
              printf("<label>ระดับชั้น:</label> <span>%s</span><br>",$value['room']);
              printf("<label>เบอร์โทรศัพท์:</label> <span>%s</span><br>",$value['tel']);
              printf("<label>LineId:</label> <span>%s</span><br>",$value['lineId']);
              printf("<label>facebook:</label> <span>%s</span><br>",$value['facebook']);
              printf("<label>IG:</label> <span>%s</span><br>",$value['ig']);
              printf("<label>created_at:</label> <span>%s</span><br>",$value['created_at']);
              printf("<label>updated_at:</label> <span>%s</span><br>",$value['updated_at']);
            }
          } else {
            print '<hr>';
            printf("<label style='color:red;'>ไม่มีข้อมูลที่นักเรียนกรอกเอง นักเรียนเลขประจำตัว %s</label><br>",$studentId);
          }
          print('<H1>ข้อมูลผู้ติดต่อฉุกเฉิน</H1>');
          if( isset($emergencyContact) ){
            foreach($emergencyContact as $key => $value){
              print '<hr>';
              printf("<label>นักเรียนเลขประจำตัว:</label> <span>%s</span><br>",$value['studentId']);
              printf("<label>ชื่อจริงผู้ปกครอง:</label> <span>%s</span><br>",$value['firstname']);
              printf("<label>นามสกุลผู้ปกครอง:</label> <span>%s</span><br>",$value['lastname']);
              printf("<label>ความสัมพันธ์:</label> <span>%s</span><br>",$value['relation']);
              printf("<label>เบอร์โทรศัพท์:</label> <span>%s</span><br>",$value['tel']);
              printf("<label>LineId:</label> <span>%s</span><br>",$value['lineId']);
              printf("<label>created_at:</label> <span>%s</span><br>",$value['created_at']);
            }
          } else {
            print '<hr>';
            printf("<label style='color:red;'>ไม่มีข้อมูลที่นักเรียนกรอกเอง นักเรียนเลขประจำตัว %s</label><br>",$studentId);
          }
          printf('<a class="btn btn-primary" href="javascript:history.back()">ย้อนกลับ</a>');
          // printf('<a class="btn btn-primary" href="/standLookup.php">กลับหน้าแรก</a>');
        ?>
      </div>
  </body>
</html>