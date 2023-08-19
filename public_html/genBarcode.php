<!DOCTYPE html>
<?php  
  // https://github.com/davidscotttufts/php-barcode/
  if(isset($_GET['studentId'])){
    $studentId =  $_GET['studentId'];
  }
  include("db.php");
  include("settings.php");
  include("api.php");
  
  $status = "normal";
  
  if(isset($studentId)){
    try {
      $result = getStudentAllProfile($studentId);
    }catch(Exception $e) {
      $status = "error";
      $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
    }
    if(isset($result)) {
      $status = "success";
    }
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

    </style>
  </head>
  <body>
      <div class="container" id="maincontainer">
        <a class="btn btn-primary" href="/">กลับหน้าแรก</a>
        <?php
          if($status == "error" && isset($errorMessage)){
            print('<h2 style="color:red">การเรียกห้องผิดพลาด</h2>');
            print($errorMessage);
          }
        ?>
        <div class="form-group">
          <div class="row">
              <div class="col-xs-12 text-center" style="margin-bottom:15px;">
                <H1  style="margin-bottom:15px;">กรอกเลขประจำตัว</H1>
                <label for="studentId">เลขประจำตัว:</label>
                <input id="studentId" type="number"/>
              </div>
              <div class="col-xs-12 text-center">    
                <a id="createBarcode" class="btn btn-primary">รับ Barcode</a>
              </div>
          </div>
          <br />
          <div class="row text-center">                
            <?php
              if(isset($studentId) && isset($result)) {
                $text = $result[0]["firstname"].'  '.$result[0]["lastname"].'  '.$result[0]["room"].'  เลขที่'.$result[0]['no'];
                print('<div class="col-xs-12 text-center">');
                print('<img alt="testing" src="createBarcode.php?size=120&sizefactor=2.5&text='.$studentId.'"/>');
                print('</div>');
                print('<div class="col-xs-12 text-center">');
                print('<span>'.$text.'</span>');
                print('<br/>');
                print('<span style="color:red; font-size:25px;">'.$studentId.'</span>');
                print('</div>');
              } else if(isset($studentId)) {
                print('<h2 style="color:red;">เลขประจำตัวไม่ถูกต้อง<br/>กรุณาลองใหม่อีกครั้ง</h2>');
              }
            ?>
          </div>
        </div>
      </div>  
  </body>
  <script>
    $('#createBarcode').click(function() {
      var studentId = $('#studentId').val();
      var url= "/genBarcode.php?studentId="+studentId;
      window.location.href = url;
    });
  </script>
</html>