<!DOCTYPE html>
<?php
  include("db.php");
  include("settings.php");
  include("api.php");
?>
<html>
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109766055-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-109766055-1');
    </script>
      <title>AC CHEER | Register</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css"/>
      <script src="jquery/jquery-1.12.4.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/dayjs"></script>
      <style>
        td {
          border: solid 1px black;
          text-align: center;
          vertical-align: center;
          cursor: pointer;
        }
        .lookupTable {
          width: 80px;
          min-width: 80px;
          height: 80px;
          min-height: 80px;
        }
        .even-column {
          background-color: #80808061;
        }
        .five-bar {
          border-right: solid 3px red;
        }
        .cover-bar {
          border-right: solid 5px black;
        }
        .cover-bar-top {
          border-top: solid 5px black;
        }
        .wrong {
          background-color: red;
        }
        .corrected {
          background-color: green;
        }
      </style>

  </head>
  <body>
      <div class="container" id="maincontainer" style="padding:0px; margin:0px;">
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a>
        <!-- <H1>Staff Check</H1> -->
        <div class="container" id="stop-container">
          <div class="row">
            <div class="col-md-3">
              <label for="code-label">Code: </label>
              <h2 id="code-label"></h2>
            </div>
            <div class="col-md-3">
              <label for="duration">Duration: </label>
              <h2><span id="timer"></span><span id="max-time"></span></h2>
            </div>
            <!-- <div class="col-md-1">
              <button id="stop" class="btn btn-primary" style="margin-top:24px;">Stop</button>
            </div> -->
            <div class="col-md-2">
              <label for="status">Status: </label>
              <h2 id="status" style="color: red">waiting</h2>
            </div>
            <!-- <div class="col-md-3">
              <button id="waiting-button" class="btn btn-danger" style="margin-top:24px;">waiting</button>
              <button id="finish-button" class="btn btn-success" style="margin-top:24px;">finish</button>
            </div> -->
          </div>
          <div id="stop-error-message-row" class="row" hidden>
            <p id="stop-error-message"></p>
          </div>
        </div>
        <br/>
        <div class="container" id="table-container">
          <table>
            <tbody>
              <?php
                for($row=1;$row<=25;$row++){
                  $r = chr($row+64);
                  print "<tr>";
                  for($column=1;$column<=50;$column++){
                    // print "<td id='P".$r.$column."'>".$r.$column."<br>ชื่อจริง<br>ม.5/2"."</td>";
                    $even_column = '';
                    $five_bar = '';
                    $cover_bar = '';
                    $cover_bar_top = '';
                    if ($column%2==0) {
                      $even_column = 'even-column ';
                    }
                    if ($column%5==0) {
                      $five_bar = 'five-bar ';
                    }
                    // if ( ($r == 'T' || $r == 'U' || $r == 'V' || $r == 'W' || $r == 'X' || $r == 'Y') && $column == 43) {
                    if ( ($r == 'T' || $r == 'U' || $r == 'V' || $r == 'W' || $r == 'X' || $r == 'Y') && $column == 16) {
                      $cover_bar = 'cover-bar ';
                    }
                    // if ( ($r == 'N' || $r == 'O' || $r == 'P' || $r == 'Q' || $r == 'R' || $r == 'S') && ($column == 39 || $column == 47)) {
                    if ( ($r == 'N' || $r == 'O' || $r == 'P' || $r == 'Q' || $r == 'R' || $r == 'S') && ($column == 12 || $column == 20)) {
                      $cover_bar = 'cover-bar ';
                    }
                    // if ( $r == 'N' && ($column > 39 && $column < 48)) {
                    if ( $r == 'N' && ($column > 12 && $column < 21)) {
                      $cover_bar_top = 'cover-bar-top ';
                    }                    
                    print "<td id='".$r.$column."' class='seat normal ".
                    $even_column.
                    $five_bar.
                    $cover_bar.
                    $cover_bar_top.
                    "' status='normal' row='".$r."' column='".$column."'>".$r.$column."</td>";
                  }
                  print "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
        

      </div>
  </body>
  <script>
    function clearTable() {
      $('.seat').removeClass('normal');
      $('.seat').removeClass('wrong');
      $('.seat').removeClass('corrected');
      $('.seat').addClass('normal');
      $('.seat').attr('status', 'normal');
    }

    var imageId = null;
    var imageDuration = null;
    var code = null;
    var x = null;

    $( document ).ready(function() {
      $.ajax({
        type: 'GET',
        url: "getLatestImage.php",
        data: {
        },
        success: function(results){
          results = JSON.parse(results);
          console.log(results);
          imageId = results[0].id;
          imageDuration = results[0].duration;
          countDownDate = dayjs(results[0].start_time).valueOf();
          code = results[0].code;
          $('#code-label').html(code);
          startTimer();
          getImageSeatOfImageAllOnlySeat();
        },
        error: function(error) {
          console.log(error);
          $('#stop-error-message').html(error.responseText);
          $('#stop-error-message-row').show();
        }
      });
    });

    function getImageSeatOfImageAllOnlySeat() {
      $('.seat').removeClass('wrong');
      $('.seat').removeClass('corrected');
      $('.seat').removeClass('normal');
      $.ajax({
        type: 'GET',
        url: "getImageSeatOfImageAllOnlySeat.php",
        data: {
          imageId: imageId
        },
        success: function(results){
          results = JSON.parse(results);
          console.log(results);
          // $('#code-label').html(code);
          // startTimer();

              if(results){
                results.forEach(function(item, index){
                  // console.log(item);
                    let seatRow = item.seatRow || '';
                    let seatColumn = item.seatColumn || '';
                    let status = item.status || '';
                    // console.log('seatRow => '+seatRow+' ');
                    // console.log('seatColumn => '+seatColumn+' ');
                    // console.log('status => '+status+' ');
                    $("#"+seatRow+seatColumn).addClass(status);
                    $("#"+seatRow+seatColumn).attr('status', status);
                    // let status_class = null;
                    // if (status=='wrong') {
                    //   status_class = 'wrong';
                    // } else if (status=='corrected') {
                    //   status_class = 'corrected';
                    // } else {
                    //   status_class = '';
                    // }
                });
              }
        },
        error: function(error) {
          console.log(error);
          $('#stop-error-message').html(error.responseText);
          $('#stop-error-message-row').show();
        }
      });
    }
/*
    $('#start').click(function(){
      let code = $('#code').val();
      let duration = $('#duration').val();
      console.log(code, duration);
      $.ajax({
        type: 'GET',
        url: "startCurrentImage.php",
        data: { 
          "code": code,
          "duration": duration,
          "status": 'waiting'
        },
        success: function(result){
          $('#start-error-message').html('');
          $('#start-error-message-row').hide();

          $('#start-container').hide();
          $('#stop-container').show();
          $('#table-container').show();
          $('#code').val('');
          $('#duration').val('');
          result = JSON.parse(result);
          imageId = result[0].id;
          console.log('result', result);
          console.log('result[0]', result[0]);
          console.log('imageId', imageId);
          countDownDate = dayjs(result[0].start_time).valueOf();
          imageDuration = result[0].duration;
          console.log('imageDuration', imageDuration);
          $('#code-label').html(code);
          startTimer();
        },
        error: function(error) {
          console.log(error);
          $('#start-error-message').html(error.responseText);
          $('#start-error-message-row').show();
        }
      });
    });

    $('#waiting-button').click(function(){
      $.ajax({
        type: 'GET',
        url: "setStatusCurrentImage.php",
        data: { 
          "id": imageId,
          "status": 'waiting'
        },
        success: function(result){
          $('#stop-error-message').html('');
          $('#stop-error-message-row').hide();

          $('#status').html('waiting');
          $('#status').css('color', 'red');
        },
        error: function(error) {
          console.log(error);
          $('#stop-error-message').html(error.responseText);
          $('#stop-error-message-row').show();
        }
      });
    });

    $('#finish-button').click(function(){
      $.ajax({
        type: 'GET',
        url: "setStatusCurrentImage.php",
        data: { 
          "id": imageId,
          "status": 'finish'
        },
        success: function(result){
          $('#stop-error-message').html('');
          $('#stop-error-message-row').hide();

          $('#status').html('finish');
          $('#status').css('color', 'green');
        },
        error: function(error) {
          console.log(error);
          $('#stop-error-message').html(error.responseText);
          $('#stop-error-message-row').show();
        }
      });
    });

    $('#stop').click(function(){
      $.ajax({
        type: 'GET',
        url: "stopCurrentImage.php",
        data: { 
          "id": imageId
        },
        success: function(result){
          $('#stop-error-message').html('');
          $('#stop-error-message-row').hide();

          $('#start-container').show();
          $('#stop-container').hide();
          $('#table-container').hide();
          clearTable();
          
          clearInterval(x);
          document.getElementById("timer").innerHTML = "";
          document.getElementById("max-time").innerHTML = "";
          document.getElementById("timer").style.color = 'black';
          x = null;
        },
        error: function(error) {
          console.log(error);
          $('#stop-error-message').html(error.responseText);
          $('#stop-error-message-row').show();
        }
      });
    });
*/


    $('.seat').click(function(){
      let id = this.id;
      // console.log(id);
      let row = $(this).attr('row');
      let column = $(this).attr('column');
      let status = $(this).attr('status');
      console.log('row = ', row, ' column = ', column);
      console.log('before', $(this).attr('status'));
      let nextStatus = null;
      if(status == 'normal') {
        nextStatus = 'wrong';
      } else if (status == 'wrong') {
        nextStatus = 'corrected';
      } else if (status == 'corrected') {
        nextStatus = 'normal';
      }
      $(this).attr('status', nextStatus);
      $(this).removeClass('normal');
      $(this).removeClass('wrong');
      $(this).removeClass('corrected');
      // $(this).removeClass(status);
      // $(this).addClass(nextStatus);
      $.ajax({
        type: 'GET',
        url: "getImageSeat.php",
        data: { 
          "imageId": imageId,
          "seatRow": row,
          "seatColumn": column,
          "status": nextStatus
        },
        success: function(result){
          result = JSON.parse(result);
          nextStatus = result[0].status;
          // console.log('result', result);
          // console.log('result[0]', result[0]);
          // console.log('nextStatus', nextStatus);
          $(this).attr('status', nextStatus);
          // $(this).removeClass(status);
          $(this).removeClass('normal');
          $(this).removeClass('wrong');
          $(this).removeClass('corrected');
          $(this).addClass(nextStatus);
          // console.log('after', $(this).attr('status'));
          getImageSeatOfImageAllOnlySeat();
        },
        error: function(error) {
          console.log(error);
          $('#stop-error-message').html(error.responseText);
          $('#stop-error-message-row').show();
        }
      });
    });
  </script>
  <script>
    // Set the date we're counting down to
    // var countDownDate = new Date("Nov 14, 2019 00:00:00").getTime();
    var countDownDate = null;

    // Update the count down every 1 second
    function startTimer() {
      x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();
          
        // Find the distance between now and the count down date
        // var distance = countDownDate - now;
        var distance = now - countDownDate;
          
        // Time calculations for days, hours, minutes and seconds
        // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        // var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        // var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var minutes = Math.floor((distance / (1000 * 60)));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          
        // Output the result in an element with id="demo"
        // document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        // + minutes + "m " + seconds + "s ";
        document.getElementById("timer").innerHTML = minutes + " m " + seconds + " s ";
        document.getElementById("max-time").innerHTML = " / " + imageDuration + " m";
        if (minutes >= imageDuration) {
          document.getElementById("timer").style.color = 'red';
        }
          
        // If the count down is over, write some text 
        // if (distance < 0) {
        //   clearInterval(x);
        //   document.getElementById("timer").innerHTML = "EXPIRED";
        // }
      }, 1000);
    }
    
  </script>
</html>