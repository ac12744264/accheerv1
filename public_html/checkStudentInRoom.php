<?php
  if(isset($_GET['studentId'])){
    $studentId =  $_GET['studentId'];
  }
  if(isset($_GET['status'])){
    $status =  $_GET['status'];
  }

  include("db.php");
  include("settings.php");
  include("api.php");
  
  $saveStatus = "normal";

  try {
    $result = checkStudentInRoom($studentId, $status);
  }catch(Exception $e) {
    $saveStatus = "error";
    $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
  }
  if(isset($result)) {
    $saveStatus = "success";
  }
  if($saveStatus == "success") {
    echo $result;
  } else {
    echo $errorMessage;
  }
?>