<!DOCTYPE html>
<?php  
  if(isset($_GET['type'])){
    $type =  $_GET['type'];
  }
  if(isset($_GET['grade'])){
    $grade =  $_GET['grade'];
  }
  if(isset($_GET['room'])){
    $room = $_GET['room'];
  }

  include("db.php");
  include("settings.php");
  include("api.php");

  $status = "normal";
  
  try {
    $results = getAllStudentsInRoomSelfStatus($type, $grade, $room);
  }catch(Exception $e) {
    $status = "error";
    $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
  }
  if(isset($results)) {
    $status = "success";
  }
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
    <style>
      .check-column{
        text-align: center;
      }
    </style>
  </head>
  <body>
      <div class="container" id="maincontainer">
        <?php
          if($status == "error" && isset($errorMessage)){
            print('<h2 style="color:red">การเรียกห้องผิดพลาด</h2>');
            print($errorMessage);
          }
        ?>
        <a class="btn btn-primary" href="/chooseRoomCheckSelfStatus.php">กลับไปเลือกห้อง</a>
        <H1><?php print($type.'.'.$grade.'/'.$room); ?></H1>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>เลขที่</th>
                <th>เลขประจำตัว</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th class="check-column">สถานะ</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0;$i<count($results);$i++) {
                  print("<tr>");
                  print("<td>".$results[$i]['no']."</td>");
                  print("<td>".$results[$i]['studentId']."</td>");
                  print("<td>".$results[$i]['firstname']."</td>");
                  print("<td>".$results[$i]['lastname']."</td>");
                  print('<input type="hidden" name="studentId" value="'.$results[$i]['studentId'].'">');
                  $status = $results[$i]['status']!="" && $results[$i]['status']!=null
                  ?"<label style='color:green;'>บันทึกข้อมูลสำเร็จ <a href='/saveStudentSelf.php' style='text-decoration: underline;'>กรอกข้อมูลใหม่เพื่อแก้ไขที่นี่</a></label>"
                  :"<label><a href='/saveStudentSelf.php' style='color:red; text-decoration: underline;'>ยังไม่กรอก กรอกข้อมูลที่นี่</a></label>";
                  print('<td class="check-column">'.$status.'</td>');
                  print("</tr>");
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
  </body>
</html>