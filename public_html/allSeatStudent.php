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
        <H1>All student</H1>
        <div class="row">
          <?php 
            try {
              $allStudent = getAllSeatStudent();
              $allStudentDetail = getAllSeatStudentDetail();
              $allStudentSelf = getAllStudentSelf();
              $studentCheckSummarize = getStudentCheckSummarize();
            }catch(Exception $e ) {
              echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
              echo nl2br($e->getTraceAsString());
              echo '<br>';
            }
            printf('<div>');
            printf('<h3>สรุปผลการเช็คชื่อจากบนห้อง</h3>');
            printf('<table class="table table-striped"  style="width:30px;">');
            printf('<thead><tr><th>ประเภท</th><th>จำนวน</th></tr></thead><tbody>');
            if( isset($studentCheckSummarize) ) {
              foreach($studentCheckSummarize as $key => $value)
              {
                printf('<tr>');
                // print "<td>".($key+1)."</br>";
                foreach($value as $k => $v){
                  printf('<td style="text-align: right;">'.$v.'</td>');
                  // print "<td>".$k." ".$v."</td>";
                }
                printf('</tr>');
              }
            }
            printf('</tbody></table>');
            printf('</div>');
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

            
            printf('<br><hr><br>');
            
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
          ?>
        </div>
      </div>
  </body>
</html>