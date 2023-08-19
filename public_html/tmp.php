<!DOCTYPE html>
<?php
  if(isset($_GET['seatRow'])){
      $seatRow =  $_GET['seatRow'];
  }
  if(isset($_GET['seatColumn'])){
      $seatColumn =  intval($_GET['seatColumn']);
  }
  if(isset($_GET['studentId'])){
      $studentId =  intval($_GET['studentId']);
  }

	include("db.php");
  include("settings.php");
	$mysqli = connectDB();
	// $query = "SELECT * FROM `students`";
  $query = "SELECT * FROM `seats` WHERE `seatRow`='{$seatRow}' AND `seatColumn`='{$seatColumn}'";
  // INSERT INTO `seats` (`seatRow`, `seatColumn`, `studentID`) VALUES ('A', '1', '111111');
  // UPDATE `seats` SET `seatRow`= 'B',`seatColumn`=2,`studentID`=2 WHERE `seatRow` = 'A' AND `seatColumn` = 1
  // DELETE FROM `seats` WHERE `seats`.`seatRow` = \'B\' AND `seats`.`seatColumn` = 2

  // $query = "INSERT INTO `seats` (`seatRow`, `seatColumn`, `studentID`) VALUES ('{$seatRow}', '{$seatColumn}', '{$studentId}');";
  //INSERT INTO `students` (`seatRow`, `seatColumn`, `studentID`, `firstname`, `lastname`, `nickname`, `room`, `tel`) VALUES ('A', '3', '11113', 'ทดสอบ3', 'นามสกล3', 'ชื่อเล่น3', 'ม.1/3', '083-333-3333');
	// $query = "SELECT * FROM `students` WHERE `pid`='{$_COOKIE["debug_pid"]}'";
  $rquery = $mysqli->query($query);
  
  if($mysqli->error) {
    print $mysqli->error;
  } else {
    //print '<br>count '.count($rquery);
    // print '<br>fetch '.$rquery->fetch_array();
/*
    if($rquery){
      foreach($rquery as $key => $value){
        print "<br>".$key;
        foreach($value as $k => $v){
          print "<br>".$k."->".$v;
        }
      }
    }
*/  
    // print "<br>===> ".$rquery['0']['seatRow'].'<br>';
    // $user_data = $rquery->fetch_array();
    /*
    while($row = $rquery->fetch_array(MYSQLI_ASSOC))
    {
      $rows[] = $row;
    }
    // echo count($rows).'<br>';
    echo count($rows[0]).'<br>';
    // echo $rows[0]['seatRow'].'<br>';
    echo $rows[0][0].'<br>';
    // echo $rows[0]['seatColumn'].'<br>';
    echo $rows[0][1].'<br>';
    // echo $rows[0]['studentID'].'<br>';
    echo $rows[0][2].'<br>';
    
    // foreach($rows as $row)
    // {
    //   echo $row['seatRow'];
    //   echo $row['seatColumn'];
    //   echo $row['studentID'];
    // }
    foreach($rows as $key => $value)
    {
      print "<br>".$key."<br>";
      foreach($value as $k => $v){
        print $k." ".$v."====";
      }
    }*/
    
    $row = $rquery->fetch_array(MYSQLI_NUM);
    printf ("%s (%s)\n", $row[0], $row[1]);
    
    $row = $rquery->fetch_array(MYSQLI_ASSOC);
    printf ("%d\n", count($row));
    // printf ("%s (%s)\n", $row['seatRow'], $row['seatColumn']);
    
    // $row = $rquery->fetch_array(MYSQLI_BOTH);
    // // printf ("%s (%s)\n", $row[0], $row["seatRow"]);
    // printf ("(%s)\n", $row["seatRow"]);
    // printf ("%s\n", $row[0]);

    // print $user_data['seatRow'];
    // foreach($row as $key => $value){
    //   print "<br>".$key.'=>'.$value;
    //   // foreach($value as $k => $v){
    //   //   print "<br>".$k."->".$v;
    //   // }
    // }
    
    // print '<br>normal '.$rquery[0];
  }
  // $user_data = $rquery->fetch_array();
?>
<html>
  <head>
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
        <?php 
          print $seatRow.' ' .$seatColumn.' '.$studentId.'<br>';
          if ($mysqli->error) {
            try {    
              throw new Exception("MySQL error $mysqli->error <br> Query:<br> $query", $msqli->errno);    
            } catch(Exception $e ) {
              echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
              echo nl2br($e->getTraceAsString());
            }
            print "<br>";
          } else {
            print "finish <br>";
            if($seatColumn <= 50)
              $seatColumn = $seatColumn + 1;
            else
              $seatRow = chr(intVal($seatRow+1));
          }
          print '<a href="/?seatRow='.$seatRow.'&seatColumn='.$seatColumn.'">กรอกข้อมูลต่อ</a>';
        ?>
      </div>
  </body>
</html>





<?php
include("db.php");
  include("settings.php");
	$rquery = $mysqli->query($query);

  
  if ($mysqli->error) {
    try {    
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $msqli->errno);    
    } catch(Exception $e ) {
      echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
      echo nl2br($e->getTraceAsString());
    }
    print "<br>";
  } else {
    print "finish <br>";
    if($seatColumn <= 50)
      $seatColumn = $seatColumn + 1;
    else
      $seatRow = chr(intVal($seatRow+1));
  }
  
  if($mysqli->error) {
    print $mysqli->error;
  } else {

    $query = "INSERT INTO `seats` (`seatRow`, `seatColumn`, `studentID`) VALUES ('{$seatRow}', '{$seatColumn}', '{$studentId}');";
    $rquery = $mysqli->query($query);
    
    if($mysqli->error) {
      print "error";
    } else {
      print $rquery;
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      foreach($results as $key => $value)
      {
        print "<br>".$key."<br>";
        foreach($value as $k => $v){
          print $k." ".$v."====";
        }
      }
    }
  }
?>