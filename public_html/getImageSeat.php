<?php

  $imageId = '';
  $seatRow = '';
  $seatColumn = '';
  $status = 'normal';
  // statue = ['normal', 'wrong', 'corrected']

  if(isset($_GET['imageId'])){
    $imageId =  $_GET['imageId'];
  }
  if(isset($_GET['seatRow'])){
    $seatRow =  $_GET['seatRow'];
  }
  if(isset($_GET['seatColumn'])){
    $seatColumn =  $_GET['seatColumn'];
  }
  if(isset($_GET['status'])){
    $status =  $_GET['status'];
  }
  
  include("db.php");
  include("settings.php");
  include("api.php");

  try {
    $result = setImageSeat($imageId, $seatRow, $seatColumn, $status);
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
      $result = getLatestImageSeat($imageId, $seatRow, $seatColumn);
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