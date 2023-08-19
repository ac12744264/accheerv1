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
  <body>
      <div class="container" id="maincontainer">
        <a class="btn btn-primary" href="/">กลับหน้าแรก</a>
        <H1>Save student</H1>
        <div class="form-group">
          <div class="col-sm-5">
            <form action="/saveStudentSeatPut.php">
              <input type="hidden" name="register" value="true">
              <div class="row">
                <label for="seatRow">Row:</label>
                <select id="seatRow" name="seatRow" class="form-control" required>
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
                  <option value="สำรอง">สำรอง</option>
                </select>
              </div>
              <div class="row">
                <label for="seatColumn">Column:</label>
                <select id="seatColumn" name="seatColumn" class="form-control" required>
                  <?php
                    for($i=1; $i<=50; $i++) {
                      print '<option value="'.$i.'"';
                      if(isset($seatColumn) && $seatColumn == $i){
                        print 'selected="selected"';
                      }
                      print '>'.$i.'</option>';
                    }
                  ?>
                  <option value="สำรอง">สำรอง</option>
                </select>
              </div>
              <div class="row">
                <label for="studentId">เลขประจำตัว: </label>
                <input id="studentId" name="studentId" type="tel" class="form-control" minlength=5 maxlength=5 required>
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