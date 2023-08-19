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
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJa.php">กลับหน้าแรก</a>
        <H1>เลือกห้อง</H1>
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="type">ประเภท:</label>
              <select class="form-control" id="type">
                <option>ม</option>
                <option>EP</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="grade">ระดับชั้น:</label>
              <select class="form-control" id="grade">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="room">ห้อง:</label>
              <select class="form-control" id="room">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">      
          <div class="col-xs-6 text-center">    
            <a id="goRoomStatus" class="btn btn-primary">ดูผลการเช็ค</a>
          </div>
          <div class="col-xs-6 text-center">    
            <a id="goRoomCheck" class="btn btn-primary">เช็คชื่อ</a>
          </div>
        </div>
      </div>
  </body>
  <script>
    $('#goRoomCheck').click(function() {
      console.log('aaa');
      var type = $('#type').val();
      var grade = $('#grade').val();
      var room = $('#room').val();
      console.log(type + grade + room);
      var url= "/roomCheck.php?type="+type+"&grade="+grade+"&room="+room;
      window.location.href = url;
    });
    $('#goRoomStatus').click(function() {
      console.log('aaa');
      var type = $('#type').val();
      var grade = $('#grade').val();
      var room = $('#room').val();
      console.log(type + grade + room);
      var url= "/roomStatus.php?type="+type+"&grade="+grade+"&room="+room;
      window.location.href = url;
    });
  </script>
</html>