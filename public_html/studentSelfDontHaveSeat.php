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
        <div class="row">
          <?php 
            try {
              $allStudentSelf = getAllStudentSelfDontHaveSeat();
            }catch(Exception $e ) {
              echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
              echo nl2br($e->getTraceAsString());
              echo '<br>';
            }
            
            printf('<h3>ตารางนักเรียนที่ลงทะเบียน <span style="color:red">ด้วยตนเอง แต่ยังไม่ลงที่นั่ง</span></h3>');
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
              printf("<label style='color:red;'>ไม่มีนักเรียนที่ลงทะเบียนด้วยตนเอง แล้วไม่มีที่นั่ง</label>");
            }
          ?>
        </div>
      </div>
  </body>
</html>