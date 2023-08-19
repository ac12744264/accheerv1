<?php
  
	// $query = "SELECT * FROM `students`";
  // $query = "SELECT * FROM `seats` WHERE `seatRow`='{$seatRow}' AND `seatColumn`='{$seatColumn}'";
  // INSERT INTO `seats` (`seatRow`, `seatColumn`, `studentID`) VALUES ('A', '1', '111111');
  // UPDATE `seats` SET `seatRow`= 'B',`seatColumn`=2,`studentID`=2 WHERE `seatRow` = 'A' AND `seatColumn` = 1
  // DELETE FROM `seats` WHERE `seats`.`seatRow` = \'B\' AND `seats`.`seatColumn` = 2

  // $query = "INSERT INTO `seats` (`seatRow`, `seatColumn`, `studentID`) VALUES ('{$seatRow}', '{$seatColumn}', '{$studentId}');";
  //INSERT INTO `students` (`seatRow`, `seatColumn`, `studentID`, `firstname`, `lastname`, `nickname`, `room`, `tel`) VALUES ('A', '3', '11113', 'ทดสอบ3', 'นามสกล3', 'ชื่อเล่น3', 'ม.1/3', '083-333-3333');
	// $query = "SELECT * FROM `students` WHERE `pid`='{$_COOKIE["debug_pid"]}'";

  function saveStudent($seatRow, $seatColumn, $studentId) {
    // include("db.php");
    // include("settings.php");
    $mysqli = connectDB();
    $query = "INSERT INTO `seats` (`seatRow`, `seatColumn`, `studentID`) VALUES ('{$seatRow}', '{$seatColumn}', '{$studentId}');";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      return true;
    }
    return false;
  }

  function saveStudentSelf($studentId, $firstname, $nickname, $room, $tel, $lineId, $facebook, $ig, $emer_firstname, $emer_lastname, $emer_relation, $emer_tel, $emer_lineId) {
    // include("db.php");
    // include("settings.php");
    $mysqli = connectDB();
    $query = "INSERT INTO `students_self` (`seatRow`, `seatColumn`, `studentID`, `firstname`, `nickname`, `room`, `tel`, `lineId`, `facebook`, `ig`, `created_at`) VALUES (null, null, '{$studentId}', '{$firstname}', '{$nickname}', '{$room}', '{$tel}', '{$lineId}', '{$facebook}', '{$ig}', CURRENT_TIMESTAMP);";
    $rquery = $mysqli->query($query);
    $query2 = "INSERT INTO `emergency_contact` (`studentID`, `firstname`, `lastname`, `relation`, `tel`, `lineId`, `created_at`) VALUES ('{$studentId}', '{$emer_firstname}', '{$emer_lastname}', '{$emer_relation}', '{$emer_tel}', '{$emer_lineId}', CURRENT_TIMESTAMP);";
    $rquery2 = $mysqli->query($query2);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery && $rquery2){
      return true;
    }
    return false;
  }

  function saveStudentSeat($seatRow, $seatColumn, $studentId) {
    $mysqli = connectDB();
    $query = "UPDATE `students_self` SET `seatRow`='{$seatRow}',`seatColumn`='{$seatColumn}' WHERE `studentId`='{$studentId}';";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      return true;
    }
    return false;
  }

  function getStudentProfile($studentId) {
    $mysqli = connectDB();
    $query = "SELECT firstname FROM `students` WHERE `studentId` = {$studentId};";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      return $results;
    }
    return false;
  }

  function getStudentProfileSelf($studentId) {
    $mysqli = connectDB();
    $query = "SELECT * FROM `students_self` WHERE `studentId` = {$studentId};";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      // foreach($results as $key => $value){
      //   echo $key.'<br>';
      //   foreach($value as $k => $v){
      //     echo $k.' '.$v.'<br>';
      //   }
      // }
      if( isset($results) ) {
        return $results;
      } else {
        return null;
      }
    }
    return false;
  }

  function getStudentProfileSelfEmergencyContact($studentId) {
    $mysqli = connectDB();
    $query = "SELECT * FROM `emergency_contact` WHERE `studentId` = {$studentId};";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ) {
        return $results;
      } else {
        return null;
      }
    }
    return false;
  }

  function getStudentDetail($seatRow, $seatColumn) {
    // include("db.php");
    // include("settings.php");
    $mysqli = connectDB();
    $query = "SELECT * FROM `seats` t1 JOIN `students` t2 ON t1.`studentId` = t2.`studentId` WHERE `seatRow`='{$seatRow}' AND `seatColumn`='{$seatColumn}'";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }   
  }

  function getStudentSeat($studentId) {
    $mysqli = connectDB();
    $query = "SELECT * FROM `seats` WHERE `studentId`='{$studentId}'";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function getStudent($seatRow, $seatColumn) {
    // include("db.php");
    // include("settings.php");
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
        return $results;
      } else {
        return null;
      }
    }
  }
  
  function getStudentSelf($seatRow, $seatColumn) {
    $mysqli = connectDB();
    $query = "SELECT * FROM `students_self` WHERE `seatRow`='{$seatRow}' AND `seatColumn`='{$seatColumn}'";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function getAllStudentSelf() {
    $mysqli = connectDB();
    $query = "SELECT * FROM `students_self`;";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function getAllSeatStudent() {
    $mysqli = connectDB();
    $query = "SELECT * FROM `seats`";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function getAllSeatStudentDetail() {
    $mysqli = connectDB();
    $query = "SELECT * FROM `seats` t1 JOIN `students` t2 ON t1.`studentId` = t2.`studentId`";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }
  
  function getAllStudent() {
    $mysqli = connectDB();
    $query = "SELECT * FROM `students`";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  
  function filterAllSeatStudent($seatRow,$seatColumn) {
    if(isset($seatRow) && $seatRow=="") $seatRow = null;
    if(isset($seatColumn) && $seatColumn=="") $seatColumn = null;
    if(isset($seatRow) && isset($seatColumn) && $seatRow != null && $seatRow != "" && $seatColumn != null && $seatColumn != "")
      $query = "SELECT * FROM `seats` WHERE `seatRow` = '{$seatRow}' AND `seatColumn` = '{$seatColumn}'";
    else if(isset($seatRow) && $seatRow != null && $seatRow != "")
      $query = "SELECT * FROM `seats` WHERE `seatRow` = '{$seatRow}'";
    else if(isset($seatColumn) && $seatColumn != null && $seatColumn != "")
      $query = "SELECT * FROM `seats` WHERE `seatColumn` = '{$seatColumn}'";
    else
      $query = "SELECT * FROM `seats`";
      
    $mysqli = connectDB();
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function filterAllSeatStudentDetail($seatRow,$seatColumn) {
    if(isset($seatRow) && $seatRow=="") $seatRow = null;
    if(isset($seatColumn) && $seatColumn=="") $seatColumn = null;
    if(isset($seatRow) && isset($seatColumn) && $seatRow != null && $seatRow != "" && $seatColumn != null && $seatColumn != "")
      $query = "SELECT * FROM `seats` t1 JOIN `students` t2 ON t1.`studentId` = t2.`studentId` WHERE `seatRow` = '{$seatRow}' AND `seatColumn` = '{$seatColumn}'";
    else if(isset($seatRow) && $seatRow != null && $seatRow != "")
      $query = "SELECT * FROM `seats` t1 JOIN `students` t2 ON t1.`studentId` = t2.`studentId` WHERE `seatRow` = '{$seatRow}'";
    else if(isset($seatColumn) && $seatColumn != null && $seatColumn != "")
      $query = "SELECT * FROM `seats` t1 JOIN `students` t2 ON t1.`studentId` = t2.`studentId` WHERE `seatColumn` = '{$seatColumn}'";
    else
      $query = "SELECT * FROM `seats` t1 JOIN `students` t2 ON t1.`studentId` = t2.`studentId`";
      
    $mysqli = connectDB();
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function filterAllSeatStudentSelf($seatRow,$seatColumn) {
    if(isset($seatRow) && $seatRow=="") $seatRow = null;
    if(isset($seatColumn) && $seatColumn=="") $seatColumn = null;
    if(isset($seatRow) && isset($seatColumn) && $seatRow != null && $seatRow != "" && $seatColumn != null && $seatColumn != "")
      $query = "SELECT * FROM `students_self` WHERE `seatRow` = '{$seatRow}' AND `seatColumn` = '{$seatColumn}'";
    else if(isset($seatRow) && $seatRow != null && $seatRow != "")
      $query = "SELECT * FROM `students_self` WHERE `seatRow` = '{$seatRow}'";
    else if(isset($seatColumn) && $seatColumn != null && $seatColumn != "")
      $query = "SELECT * FROM `students_self` WHERE `seatColumn` = '{$seatColumn}'";
    else
      $query = "SELECT * FROM `students_self`";
      
    $mysqli = connectDB();
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }  


  function getRegisteredSeatByStaff() {      
    $mysqli = connectDB();
    $query = "SELECT count(*),concat(seatRow,seatColumn) as seat FROM `seats` GROUP BY seat";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }  
  function getRegisteredSeatByStaffHaveStudent() {      
    $mysqli = connectDB();
    $query = "SELECT count(*),concat(seatRow,seatColumn) as seat FROM `seats` INNER JOIN `students` on `seats`.`studentId` = `students`.`studentId` GROUP BY seat";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }  

  function getRegisteredSeatBySelf() {      
    $mysqli = connectDB();
    $query = "SELECT count(*),concat(seatRow,seatColumn) as seat FROM `students_self` GROUP BY seat";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }  

  function getRegisteredSeatCrossCheckSelfMayBeWrong() {      
    $mysqli = connectDB();
    $query = "SELECT `staff`.`seat` FROM (SELECT count(*),concat(seatRow,seatColumn) as seat FROM `seats` INNER JOIN `students` on `seats`.`studentId` = `students`.`studentId` GROUP BY seat) AS staff INNER join (SELECT count(*),concat(seatRow,seatColumn) as seat FROM `students_self` GROUP BY seat) AS self ON `staff`.`seat` = `self`.`seat`";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }  

  function getRegisteredSeatCrossCheckHaveStudent() {      
    $mysqli = connectDB();
    $query = "SELECT count(*), concat(`students_self`.`seatRow`,`students_self`.`seatColumn`) AS `seat` FROM `students_self` INNER JOIN (SELECT `students`.`studentId` FROM `seats` INNER JOIN `students` on `seats`.`studentId` = `students`.`studentId`) AS staff ON `students_self`.`studentId` = `staff`.`studentId` GROUP by `seat`";
    // $query = "SELECT count(*), concat(`seats`.`seatRow`,`seats`.`seatColumn`) AS seat FROM `students_self` INNER JOIN `seats` ON `students_self`.`studentId` = `seats`.`studentId` GROUP BY seat";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }  

  function getAllStudentSelfDontHaveSeat() {
    $mysqli = connectDB();
    $query = "SELECT * FROM `students_self` WHERE `seatRow` IS NULL OR `seatColumn` IS NULL;";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }


  function getAllStudentsInRoom($type, $grade, $room) {
    // $type is 'EP','ม'
    // $grade is '1','2','3'
    // $room is '1','2','3','4','5','6','7','8','9','10'
    $mysqli = connectDB();
    // $query = "SELECT `studentId`,`no`,`firstname`,`lastname` FROM `students` WHERE `room` = '".$type.".".$grade."/".$room."'";
    // $query = "SELECT `students`.`studentId`,`no`,`firstname`,`lastname`,`status` FROM `students` LEFT JOIN `check_room` ON `students`.`studentId` = `check_room`.`studentId` WHERE `room` = '".$type.".".$grade."/".$room."'";
    $query = "SELECT `students`.`studentId`,`no`,`firstname`,`lastname`,`status`,`seatRow`,`seatColumn` FROM `students` LEFT JOIN `check_room` ON `students`.`studentId` = `check_room`.`studentId` LEFT JOIN `seats` ON `students`.`studentId` = `seats`.`studentId` WHERE `room` = '".$type.".".$grade."/".$room."' ORDER BY `no`";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function getAllStudentsInRoomAll() {
    $mysqli = connectDB();
    $query = "SELECT `students`.`studentId`,`no`,`firstname`,`lastname`,`status`,`seatRow`,`seatColumn`, `room` FROM `students` LEFT JOIN `check_room` ON `students`.`studentId` = `check_room`.`studentId` LEFT JOIN `seats` ON `students`.`studentId` = `seats`.`studentId` ORDER BY `room`,`no`";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  function checkStudentInRoom($studentId, $status) {
    $mysqli = connectDB();
    // $query = "REPLACE INTO check_room SET `studentId` = '{$studentId}', `status` = '{$status}', `createdAt` = CURRENT_TIMESTAMP";
    $query = "INSERT INTO `check_room` (`studentId`,`status`) VALUES ('{$studentId}','{$status}') ON DUPLICATE KEY UPDATE `status` = '{$status}';";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      return true;
    }
    return false;
  }

  function getStudentAllProfile($studentId) {
    $mysqli = connectDB();
    $query = "SELECT * FROM `students` WHERE `studentId` = {$studentId};";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      return $results;
    }
    return false;
  }

  function getStudentCheckSummarize() {
    $mysqli = connectDB();
    $query = "SELECT `status`, COUNT(studentId) as count FROM `check_room` GROUP BY `status`;";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      return $results;
    }
    return false;
  }

  function getStudentLookupSeatTable() {
    $mysqli = connectDB();
    $query = "SELECT `seatRow`, `seatColumn`, `seats`.`studentId`, `firstname`, `room` FROM `seats` INNER JOIN `students` ON `seats`.`studentId` = `students`.`studentId` ORDER BY `seatRow`, `seatColumn`;";
    $rquery = $mysqli->query($query);
    
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    }
    if($rquery){
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      return $results;
    }
    return false;
  }

  function getAllStudentsInRoomSelfStatus($type, $grade, $room) {
    // $type is 'EP','ม'
    // $grade is '1','2','3'
    // $room is '1','2','3','4','5','6','7','8','9','10'
    $mysqli = connectDB();
    // $query = "SELECT `studentId`,`no`,`firstname`,`lastname` FROM `students` WHERE `room` = '".$type.".".$grade."/".$room."'";
    // $query = "SELECT `students`.`studentId`,`no`,`firstname`,`lastname`,`status` FROM `students` LEFT JOIN `check_room` ON `students`.`studentId` = `check_room`.`studentId` WHERE `room` = '".$type.".".$grade."/".$room."'";
    // $query = "SELECT `students`.`studentId`,`no`,`firstname`,`lastname`,`status`,`seatRow`,`seatColumn` FROM `students` LEFT JOIN `check_room` ON `students`.`studentId` = `check_room`.`studentId` LEFT JOIN `seats` ON `students`.`studentId` = `seats`.`studentId` WHERE `room` = '".$type.".".$grade."/".$room."' ORDER BY `no`";
    $query = "SELECT `students`.`studentId`, `students`.`room`, `students`.`no`, `students`.`firstname`, `lastname`, `students_self`.`studentId` as `status` FROM `students` LEFT JOIN `students_self` ON `students`.`studentId` = `students_self`.`studentId` WHERE `students`.`room` = '".$type.".".$grade."/".$room."' GROUP BY `students`.`studentId` ORDER BY `no`";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  // checkStandImage

  //startCurrentImage.php
  function startCurrentImage($code, $duration, $status) {
    $mysqli = connectDB();
    // $query = "SELECT * FROM `seats` WHERE `studentId`='{$studentId}'";
    $query = "INSERT INTO `check_image`(`code`, `status`, `duration`) VALUES ('{$code}', '{$status}', '{$duration}')";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      return $rquery;
      // while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      // {
      //   $results[] = $row;
      // }
      // if( isset($results) ){
      //   return $results;
      // } else {
      //   return null;
      // }
    }
  }
  function getLatestImage() {
    $mysqli = connectDB();
    $query = "SELECT * FROM `check_image` ORDER BY `id` DESC LIMIT 1";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  //stopCurrentImage.php
  function stopCurrentImage($id) {
    $mysqli = connectDB();
    $query = "UPDATE `check_image` SET `end_time`= CURRENT_TIMESTAMP WHERE `id` = '{$id}'";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      return $rquery;
    }
  }

  //setStatusCurrentImage.php
  function setStatusCurrentImage($id, $status) {
    $mysqli = connectDB();
    $query = "UPDATE `check_image` SET `status`= '{$status}' WHERE `id` = '{$id}'";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      return $rquery;
    }
  }

  //setImageSeat.php
  function setImageSeat($imageId, $seatRow, $seatColumn, $status) {
    $mysqli = connectDB();
    $query = "INSERT INTO `check_image_seat`(`imageId`, `seatRow`, `seatColumn`, `status`) VALUES ('{$imageId}', '{$seatRow}', '{$seatColumn}', '{$status}')";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      return $rquery;
    }
  }
  function getLatestImageSeat($imageId, $seatRow, $seatColumn) {
    $mysqli = connectDB();
    $query = "SELECT * FROM `check_image_seat` ORDER BY `created_at` DESC LIMIT 1";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }


  // lookStandImage.php
  function getImageSeatOfImage($imageId) {
    $mysqli = connectDB();
    $query = "
      SELECT
      `t4`.`imageId` AS `imageId`,
      `t4`.`seatRow` AS `seatRow`, 
      `t4`.`seatColumn` AS `seatColumn`, 
      `t4`.`status` AS `status`,
      `t4`.`studentId` AS `studentId`,
      `t4`.`room` AS `room`,
      `t4`.`no` AS `no`,
      `t4`.`firstname` AS `firstname`,
      `t4`.`lastname` AS `lastname`,
      `students_self`.`studentId` AS `self_studentId`,
      `students_self`.`room` AS `self_room`,
      `students_self`.`firstname` AS `self_firstname`,
      `students_self`.`nickname` AS `self_nickname`,
      `students_self`.`tel` AS `self_tel`,
      `students_self`.`facebook` AS `self_facebook`,
      `students_self`.`ig` AS `self_ig`
      FROM
      `students_self`
      RIGHT JOIN
      (
      SELECT
      `t3`.`imageId` AS `imageId`,
      `t3`.`seatRow` AS `seatRow`, 
      `t3`.`seatColumn` AS `seatColumn`, 
      `t3`.`status` AS `status`,
      `t3`.`studentId` AS `studentId`,
      `students`.`room` AS `room`,
      `students`.`no` AS `no`,
      `students`.`firstname` AS `firstname`,
      `students`.`lastname` AS `lastname`
      FROM
      `students`
      RIGHT JOIN
      (
      SELECT
      `t2`.`imageId` AS `imageId`,
      `t2`.`seatRow` AS `seatRow`, 
      `t2`.`seatColumn` AS `seatColumn`, 
      `t2`.`status` AS `status`,
      `seats`.`studentId` AS `studentId`
      FROM
      `seats`
      RIGHT JOIN (
      SELECT 
      `check_image_seat`.`imageId` AS `imageId`,
      `check_image_seat`.`seatRow` AS `seatRow`, 
      `check_image_seat`.`seatColumn` AS `seatColumn`, 
      `check_image_seat`.`status` AS `status`
      FROM `check_image_seat`
      WHERE `check_image_seat`.`imageId` = '{$imageId}' AND `check_image_seat`.`created_at` IN ( SELECT MAX(created_at) FROM `check_image_seat` GROUP BY `check_image_seat`.`seatRow`, `check_image_seat`.`seatColumn` )
      ) t2
      ON t2.`seatRow` = `seats`.`seatRow` AND t2.`seatColumn` = `seats`.`seatColumn`
      WHERE `seats`.`created_at` IN ( SELECT MAX(created_at) FROM `seats` GROUP BY `seats`.`seatRow`, `seats`.`seatColumn` ) OR `seats`.`created_at` IS NULL
      ) t3
      ON t3.`studentId` = `students`.`studentId`
      ) t4
      ON t4.`seatRow` = `students_self`.`seatRow` AND t4.`seatColumn` = `students_self`.`seatColumn`
      WHERE `students_self`.`updated_at` IN ( SELECT MAX(updated_at) FROM `students_self` GROUP BY `students_self`.`seatRow`, `students_self`.`seatColumn` ) OR `students_self`.`updated_at` IS NULL
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }
  function getImageSeatOfImageAll() {
    $mysqli = connectDB();
    $query = "
      SELECT
      `t4`.`imageId` AS `imageId`,
      `t4`.`seatRow` AS `seatRow`, 
      `t4`.`seatColumn` AS `seatColumn`, 
      `t4`.`status` AS `status`,
      `t4`.`studentId` AS `studentId`,
      `t4`.`room` AS `room`,
      `t4`.`no` AS `no`,
      `t4`.`firstname` AS `firstname`,
      `t4`.`lastname` AS `lastname`,
      `students_self`.`studentId` AS `self_studentId`,
      `students_self`.`room` AS `self_room`,
      `students_self`.`firstname` AS `self_firstname`,
      `students_self`.`nickname` AS `self_nickname`,
      `students_self`.`tel` AS `self_tel`,
      `students_self`.`facebook` AS `self_facebook`,
      `students_self`.`ig` AS `self_ig`
      FROM
      `students_self`
      RIGHT JOIN
      (
      SELECT
      `t3`.`imageId` AS `imageId`,
      `t3`.`seatRow` AS `seatRow`, 
      `t3`.`seatColumn` AS `seatColumn`, 
      `t3`.`status` AS `status`,
      `t3`.`studentId` AS `studentId`,
      `students`.`room` AS `room`,
      `students`.`no` AS `no`,
      `students`.`firstname` AS `firstname`,
      `students`.`lastname` AS `lastname`
      FROM
      `students`
      RIGHT JOIN
      (
      SELECT
      `t2`.`imageId` AS `imageId`,
      `t2`.`seatRow` AS `seatRow`, 
      `t2`.`seatColumn` AS `seatColumn`, 
      `t2`.`status` AS `status`,
      `seats`.`studentId` AS `studentId`
      FROM
      `seats`
      RIGHT JOIN (
      SELECT 
      `check_image_seat`.`imageId` AS `imageId`,
      `check_image_seat`.`seatRow` AS `seatRow`, 
      `check_image_seat`.`seatColumn` AS `seatColumn`, 
      `check_image_seat`.`status` AS `status`
      FROM `check_image_seat` 
      INNER JOIN (SELECT `check_image`.`id` AS imageId FROM `check_image` ORDER BY `check_image`.`id` DESC LIMIT 1) t
      ON `check_image_seat`.`imageId` = t.`imageId`
      WHERE `check_image_seat`.`created_at` IN ( SELECT MAX(created_at) FROM `check_image_seat` GROUP BY `check_image_seat`.`seatRow`, `check_image_seat`.`seatColumn` )
      ) t2
      ON t2.`seatRow` = `seats`.`seatRow` AND t2.`seatColumn` = `seats`.`seatColumn`
      WHERE `seats`.`created_at` IN ( SELECT MAX(created_at) FROM `seats` GROUP BY `seats`.`seatRow`, `seats`.`seatColumn` ) OR `seats`.`created_at` IS NULL
      ) t3
      ON t3.`studentId` = `students`.`studentId`
      ) t4
      ON t4.`seatRow` = `students_self`.`seatRow` AND t4.`seatColumn` = `students_self`.`seatColumn`
      WHERE `students_self`.`updated_at` IN ( SELECT MAX(updated_at) FROM `students_self` GROUP BY `students_self`.`seatRow`, `students_self`.`seatColumn` ) OR `students_self`.`updated_at` IS NULL
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }
  function getImageSeatOfImageAllOnlySeat($imageId) {
    $mysqli = connectDB();
    $query = "
      SELECT 
      `check_image_seat`.`imageId` AS `imageId`,
      `check_image_seat`.`seatRow` AS `seatRow`, 
      `check_image_seat`.`seatColumn` AS `seatColumn`, 
      `check_image_seat`.`status` AS `status`
      FROM `check_image_seat`
      WHERE `imageId` = '{$imageId}' AND `check_image_seat`.`created_at` IN ( SELECT MAX(created_at) FROM `check_image_seat` GROUP BY `check_image_seat`.`seatRow`, `check_image_seat`.`seatColumn` )
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }
  function getStudentAtSeat($seatRow, $seatColumn) {
    $mysqli = connectDB();
    $query = "
      SELECT
      `t3`.`seatRow` AS `seatRow`, 
      `t3`.`seatColumn` AS `seatColumn`,
      `t3`.`studentId` AS `studentId`,
      `t3`.`room` AS `room`,
      `t3`.`no` AS `no`,
      `t3`.`firstname` AS `firstname`,
      `t3`.`lastname` AS `lastname`,
      `students_self`.`studentId` AS `self_studentId`,
      `students_self`.`room` AS `self_room`,
      `students_self`.`firstname` AS `self_firstname`,
      `students_self`.`nickname` AS `self_nickname`,
      `students_self`.`tel` AS `self_tel`,
      `students_self`.`facebook` AS `self_facebook`,
      `students_self`.`ig` AS `self_ig`
      FROM
      `students_self`
      RIGHT JOIN
      (
      SELECT
      `t2`.`created_at` AS `created_at`,
      `t2`.`seatRow` AS `seatRow`,
      `t2`.`seatColumn` AS `seatColumn`,
      `t2`.`studentId` AS `studentId`,
      `students`.`room` AS `room`,
      `students`.`no` AS `no`,
      `students`.`firstname` AS `firstname`,
      `students`.`lastname` AS `lastname`
      FROM
      `students`
      RIGHT JOIN
      (
      SELECT
      *
      FROM
      `seats`
      WHERE `seats`.`seatRow` = '{$seatRow}' AND `seats`.`seatColumn` = '$seatColumn'
      AND `seats`.`created_at` IN ( SELECT MAX(created_at) FROM `seats` GROUP BY `seats`.`seatRow`, `seats`.`seatColumn` ) OR `seats`.`created_at` IS NULL
      ) t2
      ON t2.`studentId` = `students`.`studentId`
      ) t3
      ON t3.`seatRow` = `students_self`.`seatRow` AND t3.`seatColumn` = `students_self`.`seatColumn`
      WHERE `students_self`.`updated_at` IN ( SELECT MAX(updated_at) FROM `students_self` GROUP BY `students_self`.`seatRow`, `students_self`.`seatColumn` ) OR `students_self`.`updated_at` IS NULL
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

  // notice
  function getNoticeMessage() {
    $mysqli = connectDB();
    $query = "
      SELECT * FROM `notice` WHERE `deleted` = 0 ORDER BY updated_at DESC LIMIT 20
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }
  function createNoticeMessage($message, $status, $show_status) {
    $mysqli = connectDB();
    if($show_status == 'true'){
      $show_status = 1;
    } else {
      $show_status = 0;
    }
    $query = "
      INSERT INTO `notice`(`message`, `status`, `show_status`) VALUES ('{$message}','{$status}', '{$show_status}')
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      return $rquery;
    }
  }
  function toggleShowStatus($id, $show_status) {
    $mysqli = connectDB();
    if($show_status == 'true'){
      $show_status = 1;
    } else {
      $show_status = 0;
    }
    $query = "
      UPDATE `notice` SET `show_status`='{$show_status}' WHERE `id`='{$id}'
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      return $rquery;
    }
  }
  function removeNotice($id) {
    $mysqli = connectDB();
    $query = "
      UPDATE `notice` SET `deleted`='1' WHERE `id`='{$id}'
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      return $rquery;
    }
  }
  function getShowNoticeMessage() {
    $mysqli = connectDB();
    $query = "
      SELECT * FROM `notice` WHERE `deleted` = 0 AND `show_status` = 1 ORDER BY updated_at DESC LIMIT 20
    ";
    $rquery = $mysqli->query($query);
    if ($mysqli->error) {
      throw new Exception("MySQL error $mysqli->error <br> Query: $query", $mysqli->errno);    
    } else {
      while($row = $rquery->fetch_array(MYSQLI_ASSOC))
      {
        $results[] = $row;
      }
      if( isset($results) ){
        return $results;
      } else {
        return null;
      }
    }
  }

?>