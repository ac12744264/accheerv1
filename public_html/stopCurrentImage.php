<?php

  $id = '';

  if(isset($_GET['id'])){
    $id =  $_GET['id'];
  }
  
  include("db.php");
  include("settings.php");
  include("api.php");

  try {
    $result = stopCurrentImage($id);
  }catch(Exception $e) {
    $saveStatus = "error";
    $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
  }
  if(isset($result)) {
    $saveStatus = "success";
  }
  if($saveStatus == "success") {
    http_response_code(200);
    // show products data in json format
    // echo json_encode($products_arr);
    echo $result;
  } else {
    http_response_code(400);
    echo $errorMessage;
  }
?>