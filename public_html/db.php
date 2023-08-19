<?php
// $mysqli = new mysqli('149.28.132.39', 'krit', 'ahd&A#(*j0R$da', 'krit');
//     if ($mysqli->connect_error) {
//         die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
//     } else {
//         echo 'Connect Success krit... ' . $mysqli->host_info . "\n";
//         exit();
//     }
    
  function setVar(&$sqlHost, &$sqlUser, &$sqlPass, &$sqlDBName) {
    include("settings.php");
    $sqlHost = $config["db_host"];
    $sqlUser = $config["db_username"];
    $sqlPass = $config["db_password"];
    $sqlDBName = $config["db_dbname"];
  }
  function connectDB()
  {
    setVar($sqlHost, $sqlUser, $sqlPass, $sqlDBName);
    $mysqli = new mysqli($sqlHost, $sqlUser, $sqlPass, $sqlDBName);
    
    if(!$mysqli)
    {
      echo "Database connection/selection error.";
      exit();
    }
    $mysqli->query("SET NAMES 'utf8'");
    return $mysqli;
  }
  function connectDBAjax()
  {
    setVar($sqlHost, $sqlUser, $sqlPass, $sqlDBName);
    $mysqli = new mysqli($sqlHost, $sqlUser, $sqlPass, $sqlDBName);
    if(!$mysqli) return false;
    $mysqli->query("SET NAMES 'utf8'");
    return $mysqli;
  }
?>