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
            <form action="/saveStudentSelfPut.php">
              <input type="hidden" name="register" value="true">
              <div class="row">
                <label for="studentId">เลขประจำตัว<span style="color:red;">*</span>: </label>
                <input id="studentId" name="studentId" type="text" class="form-control" minlength=5 maxlength=5 required>
              </div>
              <div class="row">
                <label for="firstname">ชื่อจริง<span style="color:red;">*</span>: </label>
                <input id="firstname" name="firstname" type="text" class="form-control" required>
              </div>
              <div class="row">
                <label for="nickname">ชื่อเล่น<span style="color:red;">*</span>: </label>
                <input id="nickname" name="nickname" type="text" class="form-control" required>
              </div>
              <div class="row">
                <label for="grade">ระดับชั้น<span style="color:red;">*</span>: </label>
                <select id="grade" name="grade" class="form-control" required>
                  <?php
                    for($i=1; $i<=4; $i++) {
                      print '<option value="ม.'.$i.'">ม.'.$i.'</option>';
                    }
                    for($i=1; $i<=4; $i++) {
                      print '<option value="EP.'.$i.'">EP.'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="row">
                <label for="room">ห้อง<span style="color:red;">*</span>: </label>
                <select id="room" name="room" class="form-control" required>
                  <?php
                    for($i=1; $i<=10; $i++) {
                      print '<option value="'.$i.'">'.$i.'</option>';
                    }
                  ?>
                </select>
              </div>
              <div class="row">
                <label for="tel">เบอร์โทรศัพท์<span style="color:red;">*</span>: <span style="color:#888;">ไม่ต้องมีขีด เช่น0888888888</span></label>
                <input id="tel" name="tel" type="tel" class="form-control" minlength=10 maxlength=10 placeHolder="0XXXXXXXXX" required>
              </div>
              <div class="row">
                <label for="lineId">Line ID: </label>
                <input id="lineId" name="lineId" type="text" class="form-control">
              </div>
              <div class="row">
                <label for="facebook">facebook: </label>
                <input id="facebook" name="facebook" type="text" class="form-control">
              </div>
              <div class="row">
                <label for="facebook">IG: </label>
                <input id="facebook" name="ig" type="text" class="form-control">
              </div>
              
              <div class="row">
                <H1>ผู้ติดต่อฉุกเฉิน</H1>
              </div>
              <div class="row">
                <label for="emer_firstname">ชื่อ<span style="color:red;">*</span>: </label>
                <input id="emer_firstname" name="emer_firstname" type="text" class="form-control" required>
              </div>
              <div class="row">
                <label for="emer_lastname">นามสกุล<span style="color:red;">*</span>: </label>
                <input id="emer_lastname" name="emer_lastname" type="text" class="form-control" required>
              </div>
              <div class="row">
                <label for="emer_relation">ความสัมพันธ์ (เช่น บิดา มารดา)<span style="color:red;">*</span>: </label>
                <input id="emer_relation" name="emer_relation" type="text" class="form-control" required>
              </div>
              <div class="row">
                <label for="emer_tel">เบอร์โทรศัพท์<span style="color:red;">*</span>: <span style="color:#888;">ไม่ต้องมีขีด เช่น0888888888</span></label>
                <input id="emer_tel" name="emer_tel" type="tel" class="form-control" minlength=10 maxlength=10 placeHolder="0XXXXXXXXX" required>
              </div>
              <div class="row">
                <label for="emer_lineId">Line ID: </label>
                <input id="emer_lineId" name="emer_lineId" type="text" class="form-control">
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