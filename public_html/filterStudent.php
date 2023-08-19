<!DOCTYPE html>
<?php  
  if(isset($_GET['seatRow'])){
    $seatRow =  $_GET['seatRow'];
  } else {
    $seatRow =  "";
  }
  if(isset($_GET['seatColumn'])){
    $seatColumn =  $_GET['seatColumn'];
  } else {
    $seatColumn =  "";
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
        <form action="/filterStudent.php">
          <div class="row">
            <label for="seatRow">Row:</label>
            <select id="seatRow" name="seatRow" class="form-control">
              <option value="">ไม่กรอก</option>
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
              <option value="">ไม่กรอก</option>
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
            <button type="submit" class="btn btn-primary">find</button>
          </div>
        </form>
        <hr>
        <H1>Students <?php if(isset($seatRow)&&$seatRow!=""){print " Row:".$seatRow;} if(isset($seatColumn)&&$seatColumn!=""){print " Column:".$seatColumn;}?></H1>
        <div class="row">
          <?php 
            try {
              $allStudent = filterAllSeatStudent($seatRow,$seatColumn);
              $allStudentDetail = filterAllSeatStudentDetail($seatRow,$seatColumn);
              $allStudentSelf = filterAllSeatStudentSelf($seatRow,$seatColumn);
            }catch(Exception $e ) {
              echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
              echo nl2br($e->getTraceAsString());
              echo '<br>';
            }

            printf('<h3>ตารางนักเรียนที่ลงทะเบียนแต่ละที่นั่ง <span style="color:red">ด้วยตนเอง</span></h3>');
            if( isset($allStudentSelf) ){
              printf('<table class="table table-striped">');
              printf('<thead>');
              printf('<tr>');
              printf('<th></th>');
              foreach($allStudentSelf[0] as $key => $value)
              {
                print "<th>".$key."</th>";
              }
              printf('</tr>');
              printf('</thead>');
              printf('<tbody>');
              foreach($allStudentSelf as $key => $value)
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
              printf("<label style='color:red;'>ไม่มีนักเรียนที่ลงทะเบียนแต่ละที่นั่ง ด้วยตนเอง</label>");
            }
            
            printf('<br><hr><br>');


            printf('<h3>ตารางรายละเอียดนักเรียนในแต่ละที่นั่ง</h3>');
            if( isset($allStudentDetail) ){
              printf('<table class="table table-striped">');
              printf('<thead>');
              printf('<tr>');
              printf('<th></th>');
              foreach($allStudentDetail[0] as $key => $value)
              {
                print "<th>".$key."</th>";
              }
              printf('</tr>');
              printf('</thead>');
              printf('<tbody>');
              foreach($allStudentDetail as $key => $value)
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
              printf("<label style='color:red;'>ไม่มีรายละเอียดข้อมูลนักเรียนในแต่ละที่นั่ง</label><br>");
              printf("<label style='color:red;'>หากมีนักเรียนที่ลงทะเบียนไว้ แปลว่าเลขประจำตัวไม่ถูกต้อง</label>");
            }
            
            printf('<br><hr><br>');

            printf('<h3>ตารางนักเรียนที่ลงทะเบียนแต่ละที่นั่ง</h3>');
            if( isset($allStudent) ){
              printf('<table class="table table-striped">');
              printf('<thead>');
              printf('<tr>');
              printf('<th></th>');
              foreach($allStudent[0] as $key => $value)
              {
                print "<th>".$key."</th>";
              }
              printf('</tr>');
              printf('</thead>');
              printf('<tbody>');
              foreach($allStudent as $key => $value)
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
              printf("<label style='color:red;'>ไม่มีนักเรียนที่ลงทะเบียนแต่ละที่นั่ง</label>");
            }
          ?>
        </div>
      </div>
  </body>
</html>