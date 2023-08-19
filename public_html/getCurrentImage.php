<?php

  if(isset($_GET['id'])){
    $id =  $_GET['id'];
  } else {
    $id = '';
  }
  echo 'aa'.$id;
?>