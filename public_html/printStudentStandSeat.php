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
          width: 120px;
          min-width: 120px;
          /* height: 80px;
          min-height: 80px; */
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
      
  </head>
  <body>
      <div class="container" id="maincontainer" style="padding:0px; margin:0px;">
        <div class="container">
          <table>
            <tbody>
            <?php
                print "<tr><td></td>";
                for($column=1;$column<=25;$column++){
                  $c = chr($column+64);
                  print "<td class='lookupTable'><b>".$c."</td>";
                }
                print "</tr>";
                for($row=1;$row<=50;$row++){
                  print "<tr>";
                  print "<td><b>".$row."</b></td>";
                  for($column=1;$column<=25;$column++){
                    $c = chr($column+64);
                    print "<td class='lookupTable'>";
                    // print "<b>".$c.$row."</b>";
                    if(isset($studentTable_formatedData[$c][$row])){
                      print 
                      explode(' ', $studentTable_formatedData[$c][$row]['firstname'])[0].
                      // <a id="selfProfileText'.$studentTable_formatedData[$c][$row]['studentId'].'" href="/getStudentProfile.php?studentId='.$studentTable_formatedData[$c][$row]['studentId'].'">'.$studentTable_formatedData[$c][$row]['firstname'].'</a>'.
                      ' '.$studentTable_formatedData[$c][$row]['room'];
                      // '<br>'.$studentTable_formatedData[$c][$row]['studentId'];
                    }
                    print "</td>";
                  }
                  print "</tr>";
                }
              ?>
              <?php
                // for($row=1;$row<=25;$row++){
                //   $r = chr($row+64);
                //   print "<tr>";
                //   for($column=1;$column<=50;$column++){
                //     print "<td class='lookupTable'><b>".$r.$column."</b>";
                //     if(isset($studentTable_formatedData[$r][$column])){
                //       print '<br>
                //       <a id="selfProfileText'.$studentTable_formatedData[$r][$column]['studentId'].'" href="/getStudentProfile.php?studentId='.$studentTable_formatedData[$r][$column]['studentId'].'">'.$studentTable_formatedData[$r][$column]['firstname'].'</a>'.
                //       '<br>'.$studentTable_formatedData[$r][$column]['room'].
                //       '<br>'.$studentTable_formatedData[$r][$column]['studentId'].
                //       "<div id='X".$r.$column."' style='width:40px; height:5px; margin-left:20px;'></div>";
                //       // "<div id='selfProfile".$studentTable_formatedData[$r][$column]['studentId']."' class='selfProfileBar' style='width:40px; height:5px; margin-left:20px;'></div>";
                //     }
                //     print "</td>";
                //   }
                //   print "</tr>";
                // }
              ?>
            </tbody>
          </table>
        </div>

      </div>
  </body>
</html>