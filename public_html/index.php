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

          opacity: 1;

        }

      </style>

  </head>

  <body>

    <div class="my-container">

      <img src="bg02.jpg">

      <div class="container" id="maincontainer" style="text-align:center; padding:0;">

        <br><br>

        <a class="btn btn-primary" href="/genBarcode.php">รับ Barcode</a>

        <br><br>

        <!-- <a class="btn btn-primary" href="/chooseRoomCheckSelfStatus.php">ตรวจสอบการกรอกข้อมูล</a> -->

        <a class="btn btn-primary" href="/saveStudentSelf.php">กรอกข้อมูลจำเป็น</a>
        
        <br><br>
        
        <a class="btn btn-primary" href="/saveStudentSeat.php">กรอกที่นั่ง</a>

        <a class="btn btn-primary" href="/helpRequest.php">ส่งข้อความถึงพี่</a>

        <!-- <br><br><br>

        <div class="row" style="text-align:center; color:red;">

          <h2>เปล่งเสียงเชียร์ดังก้องทั่วแผ่นฟ้า ประกาศกล้าให้โลกรู้ความยิ่งใหญ่</h2>

          <br>

          <h2>อัสสัมชัญไม่เคยท้อต่อผู้ใด สานน้ำใจสานศรัทธาเป็นเสียงเชียร์</h2>

        </div> -->

      </div>

    </div>

      

  </body>

</html>

