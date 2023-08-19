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
    $results = getAllStudentsInRoom($type, $grade, $room);
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
        <a class="btn btn-primary" href="/checkAtRoom.php">กลับไปเลือกห้อง</a>
        <H1>Room <?php print($type.'.'.$grade.'/'.$room); ?></H1>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>เลขที่</th>
                <th>เลขประจำตัว</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th class="check-column">ซ้อมเชียร์</th>
                <th class="check-column">AC band</th>
                <th class="check-column">กองร้อย</th>
                <th class="check-column">พยาบาล</th>
                <th class="check-column">ลาป่วย</th>
                <th class="check-column">ลากิจ</th>
                <th class="check-column">ที่นั่ง</th>
                <th class="check-column">ดูข้อมูล</th>
              </tr>
            </thead>
            <tbody>
              <?php
                for($i=0;$i<count($results);$i++) {
                  print("<tr>");
                  print('<form action="/roomCheckSave.php">');
                  print("<td>".$results[$i]['no']."</td>");
                  print("<td>".$results[$i]['studentId']."</td>");
                  print("<td>".$results[$i]['firstname']."</td>");
                  print("<td>".$results[$i]['lastname']."</td>");
                  print('<input type="hidden" name="studentId" value="'.$results[$i]['studentId'].'">');
                  $cheerStatus = $results[$i]['status']=="cheer"?'checked':null;
                  $acbandStatus = $results[$i]['status']=="acband"?'checked':null;
                  $scoutStatus = $results[$i]['status']=="scout"?'checked':null;
                  $doctorStatus = $results[$i]['status']=="doctor"?'checked':null;
                  $sickLeaveStatus = $results[$i]['status']=="sickLeave"?'checked':null;
                  $personalLeaveStatus = $results[$i]['status']=="personalLeave"?'checked':null;
                  print('<td class="check-column"><input class="check-radio" studentId="'.$results[$i]['studentId'].'" type="radio" name="status" '.$cheerStatus.' disabled value="cheer"/></td>');
                  print('<td class="check-column"><input class="check-radio" studentId="'.$results[$i]['studentId'].'" type="radio" name="status" '.$acbandStatus.' disabled value="acband"/></td>');
                  print('<td class="check-column"><input class="check-radio" studentId="'.$results[$i]['studentId'].'" type="radio" name="status" '.$scoutStatus.' disabled value="scout"/></td>');
                  print('<td class="check-column"><input class="check-radio" studentId="'.$results[$i]['studentId'].'" type="radio" name="status" '.$doctorStatus.' disabled value="doctor"/></td>');
                  print('<td class="check-column"><input class="check-radio" studentId="'.$results[$i]['studentId'].'" type="radio" name="status" '.$sickLeaveStatus.' disabled value="sickLeave"/></td>');
                  print('<td class="check-column"><input class="check-radio" studentId="'.$results[$i]['studentId'].'" type="radio" name="status" '.$personalLeaveStatus.' disabled value="personalLeave"/></td>');
                  print("<td>".$results[$i]['seatRow'].' '.$results[$i]['seatColumn']."</td>");
                  print('<td><a class="btn btn-primary" href="/getStudentProfile.php?studentId='.$results[$i]['studentId'].'">ดูข้อมูล</a></td>');
                  
                  print('</form>');
                  print("</tr>");
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
  </body>
</html>