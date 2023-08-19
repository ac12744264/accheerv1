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
      <style>
        td {
          border: solid 1px black;
          text-align: center;
          vertical-align: center;
        }
        .lookupTable {
          width: 80px;
          min-width: 80px;
          height: 80px;
          min-height: 80px;
        }
        .selfProfileBar {
          background-color:red;
        }
      </style>
      
      <?php // getStudentLookupSeatTable
        try {
          $StudentLookupSeatTable = getStudentLookupSeatTable();
        }catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
          echo '<br>';
        }
        

        if(isset($StudentLookupSeatTable)){
          $studentTable_formatedData = [];
          foreach($StudentLookupSeatTable as $key => $value){
            if(!isset($studentTable_formatedData[$value['seatRow']])) {
              $studentTable_formatedData[$value['seatRow']] = [];
            }
            if(!isset($studentTable_formatedData[$value['seatRow']][$value['seatColumn']])) {
              $studentTable_formatedData[$value['seatRow']][$value['seatColumn']] = [];
            }
            $studentTable_formatedData[$value['seatRow']][$value['seatColumn']] = $value;
          }
          // foreach($studentTable_formatedData as $row => $row_value){
          //   print $row.'<br>';
          //   foreach($row_value as $column => $column_value){
          //     print $row.$column.'<br>';
          //     foreach($column_value as $k => $v){
          //       print $k.' '.$v.'<br>';
          //     }
          //   }
          // }
        }
      ?>
      
      <?php // staff but don't have that student in db
        try {
          $staffCheck = getRegisteredSeatByStaff();
        }catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
          echo '<br>';
        }
        if(isset($staffCheck)){
          print "<style>#PA0";
          foreach($staffCheck as $key => $value){
            print ',#P'.$value['seat'];
          }
          print "{background-color:yellow;}</style>";

          print "<style>#XA0";
          foreach($staffCheck as $key => $value){
            print ',#X'.$value['seat'];
          }
          print "{background-color:yellow;}</style>";
        }
      ?>
      <?php // Staff have that student in db
        try {
          $staffCheckHaveStudent = getRegisteredSeatByStaffHaveStudent();
        }catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
          echo '<br>';
        }
        if(isset($staffCheckHaveStudent)){
          print "<style>#PA0";
          foreach($staffCheckHaveStudent as $key => $value){
            print ',#P'.$value['seat'];
          }
          print "{background-color:green;}</style>";

          print "<style>#XA0";
          foreach($staffCheckHaveStudent as $key => $value){
            print ',#X'.$value['seat'];
          }
          print "{background-color:orange;}</style>";
        }
      ?>


      <?php //Self all
        try {
          $selfCheck = getRegisteredSeatBySelf();
        }catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
          echo '<br>';
        }
        if(isset($selfCheck)){
          print "<style>#NA0";
          foreach($selfCheck as $key => $value){
            print ',#N'.$value['seat'];
          }
          print "{background-color:green;}</style>";

          print "<style>#XA0";
          foreach($selfCheck as $key => $value){
            print ',#X'.$value['seat'];
          }
          print "{background-color:pink;}</style>";
        }
      ?>
      <?php //Self same as staff but don't have that student in db
        try {
          $selfMayBeWrongCheck = getRegisteredSeatCrossCheckSelfMayBeWrong();
        }catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
          echo '<br>';
        }
        if(isset($selfMayBeWrongCheck)){
          print "<style>#XA0";
          foreach($selfMayBeWrongCheck as $key => $value){
            print ',#X'.$value['seat'];
          }
          print "{background-color:purple;}</style>";
        }
      ?>

      <?php // cross check all done
        try {
          $crossCheck = getRegisteredSeatCrossCheckHaveStudent();
        }catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
          echo '<br>';
        }
        if(isset($crossCheck)){
          print "<style>#XA0";
          foreach($crossCheck as $key => $value){
            print ',#X'.$value['seat'];
          }
          print "{background-color:green;}</style>";
        }
      ?>

      <?php //Self Profile
        try {
          $selfProfile = getAllStudentSelf();
        }catch(Exception $e ) {
          echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
          echo nl2br($e->getTraceAsString());
          echo '<br>';
        }
        if(isset($selfProfile)){
          print "<style>#NA0";
          foreach($selfProfile as $key => $value){
            print ',#selfProfile'.$value['studentId'];
          }
          print "{background-color:green;}</style>";
        }
        if(isset($selfProfile)){
          print "<style>#NA0";
          foreach($selfProfile as $key => $value){
            print ',#selfProfileText'.$value['studentId'];
          }
          print "{color:green;}</style>";
        }
      ?>
  </head>
  <body>
      <div class="container" id="maincontainer" style="padding:0px; margin:0px;">
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a>
        <div class="container">
          <div class="row">
            <?php
              try {
                $studentCheckSummarize = getStudentCheckSummarize();
              }catch(Exception $e ) {
                echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
                echo nl2br($e->getTraceAsString());
                echo '<br>';
              }
              printf('<h3>สรุปผลการเช็คชื่อจากบนห้อง</h3>');
              printf('<table class="table table-striped"  style="width:30px;">');
              printf('<thead><tr><th>ประเภท</th><th>จำนวน</th></tr></thead><tbody>');
              if( isset($studentCheckSummarize) ) {
                foreach($studentCheckSummarize as $key => $value)
                {
                  printf('<tr>');
                  foreach($value as $k => $v){
                    printf('<td style="text-align: right;">'.$v.'</td>');
                  }
                  printf('</tr>');
                }
              }
              printf('</tbody></table>');
            ?>
          </div>
        </div>
        <H1>Staff Check</H1>
        <label><span style="background-color:yellow;">Yellow</span> => ไม่มีนักเรียนเลขประจำตัวนี้</label><br>
        <label><span style="background-color:green;">green</span> => ลงทะเบียนเสร็จสิ้น</label>
        <div class="container">
          <table>
            <tbody>
              <?php
                for($row=1;$row<=25;$row++){
                  $r = chr($row+64);
                  print "<tr>";
                  for($column=1;$column<=50;$column++){
                    // print "<td id='P".$r.$column."'>".$r.$column."<br>ชื่อจริง<br>ม.5/2"."</td>";
                    print "<td id='P".$r.$column."'>".$r.$column."</td>";
                  }
                  print "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        
        <hr>
        <H1>รายชื่อ</H1>
        <div class="container">
          <table>
            <tbody>
              <?php
                for($row=1;$row<=25;$row++){
                  $r = chr($row+64);
                  print "<tr>";
                  for($column=1;$column<=50;$column++){
                    print "<td class='lookupTable'><b>".$r.$column."</b>";
                    if(isset($studentTable_formatedData[$r][$column])){
                      print '<br>
                      <a id="selfProfileText'.$studentTable_formatedData[$r][$column]['studentId'].'" href="/getStudentProfile.php?studentId='.$studentTable_formatedData[$r][$column]['studentId'].'">'.$studentTable_formatedData[$r][$column]['firstname'].'</a>'.
                      '<br>'.$studentTable_formatedData[$r][$column]['room'].
                      '<br>'.$studentTable_formatedData[$r][$column]['studentId'].
                      "<div id='X".$r.$column."' style='width:40px; height:5px; margin-left:20px;'></div>";
                      // "<div id='selfProfile".$studentTable_formatedData[$r][$column]['studentId']."' class='selfProfileBar' style='width:40px; height:5px; margin-left:20px;'></div>";
                    }
                    print "</td>";
                  }
                  print "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>

        <hr>
        <H1>Student Check by themselves</H1>
        <div class="container">
          <table>
            <tbody>
              <?php
                for($row=1;$row<=25;$row++){
                  $r = chr($row+64);
                  print "<tr>";
                  for($column=1;$column<=50;$column++){
                    print "<td id='N".$r.$column."'>".$r.$column."</td>";
                  }
                  print "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        <hr>
        <H1>Cross Check</H1>
        <label><span style="background-color:yellow;">Yellow</span> => สตาฟกรอก <span style='color:red;'>ไม่มี</span>นักเรียนเลขประจำตัวนี้ | นักเรียน<span style='color:red;'>ไม่</span>กรอก </label><br>
        <label><span style="background-color:orange;">orange</span> => สตาฟกรอก มีนักเรียนเลขประจำตัวนี้ | นักเรียน<span style='color:red;'>ไม่</span>กรอก</label><br>
        <label><span style="background-color:pink;">pink</span> => สตาฟกรอก <span style='color:red;'>ไม่มี</span>นักเรียนเลขประจำตัวนี้ หรือ สตาฟ<span style='color:red;'>ไม่</span>กรอก | นักเรียนกรอก ข้อมูล<span style='color:red;'>ไม่ตรงกัน</span></label><br>
        <label><span style="background-color:purple;">purple</span> => สตาฟกรอก มีนักเรียนเลขประจำตัวนี้ | นักเรียนกรอก ข้อมูล<span style='color:red;'>ไม่ตรงกัน</span></label><br>
        <label><span style="background-color:green;">green</span> => ข้อมูลตรงกัน ตรงกับในระบบ เสร็จสิ้น</label><br>
        <div class="container">
          <table>
            <tbody>
              <?php
                for($row=1;$row<=25;$row++){
                  $r = chr($row+64);
                  print "<tr>";
                  for($column=1;$column<=50;$column++){
                    print "<td id='X".$r.$column."'>".$r.$column."</td>";
                  }
                  print "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        <br><br><br>
      </div>
  </body>
</html>