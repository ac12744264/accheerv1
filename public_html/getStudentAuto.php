<!DOCTYPE html>
<?php
  if(isset($_GET['seatRow'])){
      $seatRow =  $_GET['seatRow'];
  }
  if(isset($_GET['seatColumn'])){
      $seatColumn =  $_GET['seatColumn'];
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
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a>
        <H1>Find student</H1>
        <div class="row">
          <div class="form-group col-xs-12">
            <div class="col-sm-5">
              <form action="/getStudentAuto.php">
                <div class="row">
                  <label for="seatRow">Row:</label>
                  <select id="seatRow" name="seatRow" class="form-control" onchange="getStudent()">
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
                  <select id="seatColumn" name="seatColumn" class="form-control" onchange="getStudent()">
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
                <div class="row pull-right">
                  <button type="submit" class="btn btn-primary">Reload</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="row">
          <?php 
            if( isset($seatRow) && isset($seatColumn) ){
              try {
                $topSeatRow = chr(ord($seatRow)-1);
                $bottomSeatRow = chr(ord($seatRow)+1);
                $rigthSeatColumn = $seatColumn+1;
                $leftSeatColumn = $seatColumn-1;

                $student = getStudent($seatRow, $seatColumn);
                $studentDetail = getStudentDetail($seatRow, $seatColumn);
                
                $topStudentDetail = getStudentDetail($topSeatRow, $seatColumn);
                $bottomStudentDetail = getStudentDetail($bottomSeatRow, $seatColumn);
                $rightStudentDetail = getStudentDetail($seatRow, $rigthSeatColumn);
                $leftStudentDetail = getStudentDetail($seatRow, $leftSeatColumn);

                $studentsSelf = getStudentSelf($seatRow, $seatColumn);
                $topStudentSelf = getStudentSelf($topSeatRow, $seatColumn);
                $bottomStudentSelf = getStudentSelf($bottomSeatRow, $seatColumn);
                $rightStudentSelf = getStudentSelf($seatRow, $rigthSeatColumn);
                $leftStudentSelf = getStudentSelf($seatRow, $leftSeatColumn);


              }catch(Exception $e ) {
                echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
                echo nl2br($e->getTraceAsString());
                echo '<br>';
              }
     
              //studentSelf
              printf('<h3>รายละเอียดที่น้องกรอกเอง <b style="color:red;">น้องกรอกเอง</b> %s%d</h3>',$seatRow,$seatColumn);
              if( isset($studentsSelf) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($studentsSelf[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($studentsSelf as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$seatRow,$seatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าไม่มีน้องลงที่นั่งนี้</label>");
              }
              printf('<br><hr><br>');

              //TOP
              printf('<h3>รายละเอียดที่น้องกรอกเอง <b style="color:red;">ด้านบน</b> %s%d</h3>',$seatRow,$seatColumn);
              if( isset($topStudentSelf) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($topStudentSelf[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($topStudentSelf as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$topSeatRow,$seatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');

              //BOTTOM
              printf('<h3>รายละเอียดที่น้องกรอกเอง <b style="color:red;">ด้านล่าง</b> %s%d</h3>',$seatRow,$seatColumn);
              if( isset($bottomStudentSelf) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($bottomStudentSelf[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($bottomStudentSelf as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$bottomSeatRow,$seatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');

              //RIGHT
              printf('<h3>รายละเอียดที่น้องกรอกเอง <b style="color:red;">ด้านขวา</b> %s%d</h3>',$seatRow,$seatColumn);
              if( isset($rightStudentSelf) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($rightStudentSelf[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($rightStudentSelf as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$seatRow,$rigthSeatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');

              //LEFT
              printf('<h3>รายละเอียดที่น้องกรอกเอง <b style="color:red;">ด้านซ้าย</b> %s%d</h3>',$seatRow,$seatColumn);
              if( isset($leftStudentSelf) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($leftStudentSelf[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($leftStudentSelf as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$seatRow,$leftSeatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');

              # Staff check
              printf('<h3>ตารางรายละเอียดนักเรียนที่นั่ง %s%d</h3>',$seatRow,$seatColumn);
              if( isset($studentDetail) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($studentDetail[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
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
              
              //TOP
              printf('<h3>ตารางรายละเอียดนักเรียนที่นั่ง <b style="color:red;">ด้านบน</b> %s%d</h3>',$topSeatRow,$seatColumn);
              if( isset($topStudentDetail) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($topStudentDetail[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($topStudentDetail as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$topSeatRow,$seatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');
              
              //BOTTOM
              printf('<h3>ตารางรายละเอียดนักเรียนที่นั่ง <b style="color:red;">ด้านล่าง</b> %s%d</h3>',$bottomSeatRow,$seatColumn);
              if( isset($bottomStudentDetail) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($bottomStudentDetail[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($bottomStudentDetail as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$bottomSeatRow,$seatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');
              
              //RIGHT
              printf('<h3>ตารางรายละเอียดนักเรียนที่นั่ง <b style="color:red;">ด้านขวา</b> %s%d</h3>',$seatRow,$rigthSeatColumn);
              if( isset($rightStudentDetail) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($rightStudentDetail[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($rightStudentDetail as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$seatRow,$rigthSeatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');
              
              //LEFT
              printf('<h3>ตารางรายละเอียดนักเรียนที่นั่ง <b style="color:red;">ด้านซ้าย</b> %s%d</h3>',$seatRow,$leftSeatColumn);
              if( isset($leftStudentDetail) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($leftStudentDetail[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
                printf('</tr>');
                printf('</thead>');
                printf('<tbody>');
                foreach($leftStudentDetail as $key => $value)
                {
                  printf('<tr>');
                  print "<td>".($key+1)."</br>";
                  foreach($value as $k => $v){
                    print "<td>".$v."</td>";
                  }
                  printf('</tr>');
                }
                printf('</tbody>');
                printf('</table>');
              } else {
                printf("<label style='color:red;'>ไม่มีข้อมูลนักเรียนที่นั่ง %s%d</label><br>",$seatRow,$leftSeatColumn);
                printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
              }
              printf('<br><hr><br>');

              printf('<h3>ตารางนักเรียนที่ลงทะเบียนที่นั่ง %s%d</h3>',$seatRow,$seatColumn);
              if( isset($student) ){
                printf('<table class="table table-striped">');
                printf('<thead>');
                printf('<tr>');
                printf('<th></th>');
                foreach($student[0] as $key => $value)
                {
                  print "<th>".$key."</th>";
                }
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
          <br><br><br><br><br>
        </div>
      </div>
  </body>
</html>
<script>
  function getStudent(){
    var seatRow = $('#seatRow').val();
    var seatColumn = $('#seatColumn').val();
    window.location = "/getStudentAuto.php?seatRow="+seatRow+"&seatColumn="+seatColumn;
  }
</script>