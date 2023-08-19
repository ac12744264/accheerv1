<!DOCTYPE html>
<?php
// header('Location: /saveStudent.php');
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
        .my-container {
          position: relative;
          overflow: hidden;
        }
        .my-container div {
          position: relative;
          z-index: 2;
        } 
        .my-container>img {
          /* position: absolute;
          left: 0;
          top: 0;
          width: 100%;
          height: auto;
          opacity: 0.6;
          z-index: 0; */
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          opacity: 0.5;
        }
      </style>
  </head>
  <body>
    <div class="my-container">
      <img src="bg01.jpg">
      <div class="container" id="maincontainer" style="text-align:center;">
        <br><br>
        <a class="btn btn-primary" href="/checkAtRoom.php">เช็คชื่อบนห้อง</a>
        <br><br>
        <a class="btn btn-primary" href="/saveStudent.php">บันทึกนักเรียนลงที่นั่ง 50 - 1</a>
        <a class="btn btn-info" href="/saveStudentSelf.php">บันทึกนักเรียนด้วยตนเอง</a>
        <a class="btn btn-primary" href="/saveStudentReverse.php">บันทึกนักเรียนลงที่นั่ง 1 - 50</a>
        <br>
        <a class="btn btn-primary" href="/saveStudentSpecial.php">บันทึกนักเรียนลงที่นั่งช่องอุด 20 - 1</a>
        <a class="btn btn-primary" href="/saveStudentSpecial2.php">บันทึกนักเรียนลงที่นั่งช่องอุด 16 - 1</a>
        <br>
        <a class="btn btn-primary" href="/getStudentAuto.php?seatRow=A&seatColumn=1">ดูนักเรียนรายที่นั่ง</a>
        <br>
        <a class="btn btn-primary" href="/allSeatStudent.php">ดูข้อมูลนักเรียนบนแสตนด์</a>
        <a class="btn btn-primary" href="/filterStudent.php">กรองนักเรียนบนแสตนด์</a>
        <br>
        <a class="btn btn-primary" href="/standLookup.php">ดูการกรอกข้อมูลลงแสตนด์</a>
        <a class="btn btn-primary" href="/studentSelfDontHaveSeat.php">ดูนักเรียนที่กรอกด้วยตนเองยังไม่ลงที่นั่ง</a>
        <br>
        <a class="btn btn-primary" href="/allStudent.php">รายชื่อนักเรียน</a>
        <a class="btn btn-primary" href="/findStudent.php">ดูข้อมูลนักเรียนจากเลขประจำตัว</a>
        <br>
        <br>
        <a class="btn btn-primary" href="/notice.php">ประกาศ</a>
        <a class="btn btn-primary" href="/printStudentStandSeat.php">พิมพ์ข้อมูลนักเรียนบนสแตนของธูป</a>
        <br>
        <br>
        <a class="btn btn-primary" href="/checkStandImage.php">เช็คภาพ (หน้าแม่)</a>
        <a class="btn btn-primary" href="/checkStandImage2.php">เช็คภาพ (หน้าลูก)</a>
        <br>
        <a class="btn btn-primary" href="/lookStandImage3.php">ดูผลการเช็คภาพ</a>
        <a class="btn btn-primary" href="/lookStandImage4.php">ดูผลการเช็คภาพ (โหลดใหม่อัตโนมัติ)</a>
        <br><br>
        <a class="btn btn-info" href="/helpRequest.php">แจ้งข้อความถึงพี่</a>
        <a class="btn btn-primary" href="/helpResponse.php">ดูข้อความจากน้อง</a>
        <br><br>
        <a class="btn btn-primary" href="/genSticker.php">พิมพ์สติกเกอร์</a>
        <br><br>
        <a class="btn btn-primary" href="/lightCode.php">โค้ดแสง</a>
      </div>
    </div>
      
  </body>
</html>
