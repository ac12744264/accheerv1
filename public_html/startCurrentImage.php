<?php

  $code = '';
  $duration = '';
  $status = 'waiting';

  if(isset($_GET['code'])){
    $code =  $_GET['code'];
  }
  if(isset($_GET['duration'])){
    $duration =  $_GET['duration'];
  }
  if(isset($_GET['status'])){
    $status =  $_GET['status'];
  }
  
  include("db.php");
  include("settings.php");
  include("api.php");

  try {
    $result = startCurrentImage($code, $duration, $status);
  }catch(Exception $e) {
    $saveStatus = "error";
    $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
  }
  if(isset($result)) {
    $saveStatus = "success";
  }
  if($saveStatus == "success") {
    http_response_code(200);
    try {
      $result = getLatestImage();
    }catch(Exception $e) {
      $saveStatus = "error";
      $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
    }
    if(isset($result)) {
      $saveStatus = "success";
    } 
    if($saveStatus == "success") {
      // echo $result;
      echo json_encode($result);
    } else {
      http_response_code(400);
      echo $errorMessage;
    }
    // show products data in json format
    // echo json_encode($products_arr);
    // echo $result;
  } else {
    http_response_code(400);
    echo $errorMessage;
  }
?>