<?php
  header("Content-type: text/json");
  if(isset($_GET['seatRow'])){
      $seatRow =  $_GET['seatRow'];
  }
  if(isset($_GET['seatColumn'])){
      $seatColumn =  intval($_GET['seatColumn']);
  }
  
  include("db.php");
  include("settings.php");

  $mysqli = connectDB();
  $query = "SELECT * FROM `seats` WHERE `seatRow`='{$seatRow}' AND `seatColumn`='{$seatColumn}'";
  $rquery = $mysqli->query($query);
  if ($mysqli->error) {
    throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
  } else {
    while($row = $rquery->fetch_array(MYSQLI_ASSOC))
    {
      $results[] = $row;
    }
    if( isset($results) ){
      echo json_encode($results);
    } else {
      echo json_encode(null);
    }
  }
  
?>