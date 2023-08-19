<!DOCTYPE html>
<?php  
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
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a>
        <H1>กรอกเลขประจำตัว</H1>
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="studentId">เลขประจำตัว<span style="color:red;">*</span>: </label>
              <input id="studentId" name="studentId" type="text" class="form-control" minlength=5 maxlength=5 required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-offset-6 col-xs-6 text-center">    
            <a id="getStudentProfile" class="btn btn-primary">ดูข้อมูล</a>
          </div>
        </div>
      </div>
  </body>
  <script>
    $('#getStudentProfile').click(function() {
      var studentId = $('#studentId').val();
      var url= "/getStudentProfile.php?studentId="+studentId;
      window.location.href = url;
    });
  </script>
</html>