<?php
  
  include("db.php");
  include("settings.php");
  include("api.php");

  try {
    $result = getShowNoticeMessage();
  }catch(Exception $e) {
    $saveStatus = "error";
    $errorMessage = "<div>Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br/></div>".nl2br($e->getTraceAsString())."<br/>";
  }
  if(isset($result)) {
    $saveStatus = "success";
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