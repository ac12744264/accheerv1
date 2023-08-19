<!DOCTYPE html>
<?php
  if(isset($_GET['seatRow'])){
      $seatRow =  $_GET['seatRow'];
  }
  if(isset($_GET['seatColumn'])){
      $seatColumn =  intval($_GET['seatColumn']);
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
        <H1>Find student</H1>
        <div class="row">
          <div class="form-group col-xs-12">
            <div class="col-sm-5">
              <form action="/getStudent.php">
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
                  </select>
                </div>
                <div class="row pull-right">
                  <button type="submit" class="btn btn-primary">Find</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <?php 
            if( isset($seatRow) && isset($seatColumn) ){
              try {
                $student = getStudent($seatRow, $seatColumn);
                $studentDetail = getStudentDetail($seatRow, $seatColumn);
              }catch(Exception $e ) {
                echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
                echo nl2br($e->getTraceAsString());
                echo '<br>';
              }
              printf('<h3>ตารางรายละเอียดนักเรียนที่นั่ง %s%d</h3>',$seatRow,$seatColumn);
              if( isset($studentDetail) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                printf('<th>แถว</th>');
                printf('<th>หลัก</th>');
                printf('<th>เลขประจำตัว</th>');
                printf('<th>ชื่อ</th>');
                printf('<th>นามสกุล</th>');
                printf('<th>ชื่อเล่น</th>');
                printf('<th>ห้อง</th>');
                printf('<th>เบอร์โทรศัพท์</th>');
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($studentDetail as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                    // print "<td>".$k." ".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$seatRow,$seatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              
              printf('<br><hr><br>');

              printf('<h3>ตารางนักเรียนที่ลงทะเบียนที่นั่ง %s%d</h3>',$seatRow,$seatColumn);
              if( isset($student) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                printf('<th>แถว</th>');
                printf('<th>หลัก</th>');
                printf('<th>เลขประจำตัว</th>');
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($student as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                    // print "<td>".$k." ".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
                
              } else {
                printf("<label style='color:red;'>ไม่มีนักเรียนที่ลงทะเบียนลงที่นั่ง %s%d</label>",$seatRow,$seatColumn);
              }
            }
          ?>
        </div>
      </div>
  </body>
</html>