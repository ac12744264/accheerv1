<?php

  if(isset($_GET['message'])){
    $message =  $_GET['message'];
  }
  if(isset($_GET['status'])){
    $status =  $_GET['status'];
  }
  if(isset($_GET['show_status'])){
    $show_status =  $_GET['show_status'];
  }
  
  include("db.php");
  include("settings.php");
  include("api.php");

  try {
    $result = createNoticeMessage($message, $status, $show_status);
  }catch(Exception $e) {
    $saveStatus = "error";
    $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
  }
  if(isset($result)) {
    $saveStatus = "success";
  } else {
    $saveStatus = "null";
  }
  if($saveStatus == "success") {
    http_response_code(200);
    // echo $result;
    echo json_encode($result);
  } else {
    http_response_code(400);
    echo $errorMessage;
  }
?>