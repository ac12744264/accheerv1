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
    // print strlen($studentId);
    // print $studentId[1].$studentId[3].$studentId[5].$studentId[7].$studentId[9];
    if(strlen($studentId) > 10){
      $studentId = $studentId[1].$studentId[3].$studentId[5].$studentId[7].$studentId[9];
    }
  }
  if(isset($_GET['register'])){
    $register =  intval($_GET['register']);
  } else {
    $register = false;
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
  <body
    <?php
      if($register=='true'){
        try {
          $results = saveStudent($seatRow, $seatColumn, $studentId);
        }catch(Exception $e ) {
          printf("style='background-Color:#ff000061;'>");
          echo "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>";
          echo nl2br($e->getTraceAsString());
          echo '<br/>';
        }
        if( isset($results) && $results){
          try {
            $name = getStudentProfile($studentId);
          }catch(Exception $e ) {
            printf("style='background-Color:#ff000061;'>");
            echo "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>";
            echo nl2br($e->getTraceAsString());
            echo '<br/>';
          }
          if(isset($name)){
            printf("style='background-Color:#00800061;'");
          } else {            
            printf("style='background-Color:#ff000061;'");
          }
        } else {
          printf("style='background-Color:#ff000061;'");
        }
      }
    ?>
  >
      <div class="container" id="maincontainer">
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a>
        <H1>Save student</H1>
        <?php 
          if($register=='true'){
            if( isset($results) && $results ){
              printf("<label style='color:green;'>บันทึกข้อมูลสำเร็จ %s%d - %s </label>",$seatRow,$seatColumn,$studentId);
              if(isset($name)){
                foreach($name as $key => $value)
                {
                  foreach($value as $k => $v){
                    print "<label style='color:green;'>&nbsp;&nbsp;".$v."</label><br>";
                  }
                }
              }
              else{
                printf("<label style='color:red;'>ไม่มีนักเรียนเลขประจำตัว %s</label><br>",$studentId);
              }
              if($seatRow == "สำรอง" || $seatColumn == "สำรอง"){
                $seatRow = "สำรอง";
                $seatColumn = "สำรอง";
              } else if($seatColumn < 50) {
                $seatColumn = $seatColumn + 1;
              } else {
                $seatRow = chr(ord($seatRow)+1);
                $seatColumn = 1;
              }
            }
            else{
              printf("<label style='color:red;'>บันทึกผิดพลาด</label><br>");
            }
          }
        ?>
        <div class="form-group">
          <div class="col-sm-5">
            <form action="/saveStudentReverse.php">
              <input type="hidden" name="register" value="true">
              <div class="row">
                <label for="seatRow">Row:</label>
                <select id="seatRow" name="seatRow" class="form-control">
                  <?php
                    for($i=0; $i<25; $i++) {
                      $r = chr($i+65);
                      print '<option value="'.$r.'"';
                      if(isset($seatRow) && $seatRow == $r){
                        print 'selected="selected"';
                      }
                      print '>'.$r.'</option>';
                    }
                  ?>
                  <option value="สำรอง" <?php if(isset($seatRow) && $seatRow == "สำรอง"){print 'selected="selected"';} ?>>สำรอง</option>
                </select>
              </div>
              <div class="row">
                <label for="seatColumn">Column:</label>
                <select id="seatColumn" name="seatColumn" class="form-control">
                  <?php
                    for($i=1; $i<=50; $i++) {
                      print '<option value="'.$i.'"';
                      if(isset($seatColumn) && $seatColumn == $i){
                        print 'selected="selected"';
                      }
                      print '>'.$i.'</option>';
                    }
                  ?>
                  <option value="สำรอง" <?php if(isset($seatColumn) && $seatColumn == "สำรอง"){print 'selected="selected"';} ?>>สำรอง</option>
                </select>
              </div>
              <div class="row">
                <label for="studentId">Student ID: </label>
                <input id="studentId" name="studentId" type="tel" class="form-control" autofocus minlength=5 required>
              </div>
              <div class="row pull-right">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </body>
</html>