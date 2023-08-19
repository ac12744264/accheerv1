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

    <?php
      try {
        $image = getLatestImage();
        if(isset($image)){
          $imageId = $image[0]['id'];
          $code = $image[0]['code'];
          $status = $image[0]['status'];
          $start_time = $image[0]['start_time'];
          $duration = $image[0]['duration'];
          $end_time = $image[0]['end_time'];
        }
        $results = getImageSeatOfImage($imageId);
        // $results = getImageSeatOfImageAll();
      }catch(Exception $e ) {
        echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
        echo nl2br($e->getTraceAsString());
        echo '<br>';
      }
      // if(isset($image)){
      //   $imageId = $image[0]['id'];
      //   $code = $image[0]['code'];
      //   $status = $image[0]['status'];
      //   $start_time = $image[0]['start_time'];
      //   $duration = $image[0]['duration'];
      //   $end_time = $image[0]['end_time'];

      //   // print($imageId);
      //   // print($code);
      //   // print($status);
      //   // print($start_time);
      //   // print($duration);
      //   // print($end_time);

      //   // foreach($image as $key => $value){
      //   //   print($value['id']);
      //   //   print($value['code']);
      //   //   print($value['status']);
      //   //   print($value['start_time']);
      //   //   print($value['duration']);
      //   //   print($value['end_time']);
      //   //   foreach($value as $k => $v){
      //   //     print($v);
      //   //   }
      //   //   print('<br/>');
      //   // }
      // }
      // if(isset($results)){
      //   foreach($results as $key => $value){
      //     foreach($value as $k => $v){
      //       print($v);
      //     }
      //     print('<br/>');
      //   }
      // }

      // `t4`.`imageId` AS `imageId`,
      // `t4`.`seatRow` AS `seatRow`,
      // `t4`.`seatColumn` AS `seatColumn`,
      // `t4`.`status` AS `status`,
      // `t4`.`studentId` AS `studentId`,
      // `t4`.`room` AS `room`,
      // `t4`.`no` AS `no`,
      // `t4`.`firstname` AS `firstname`,
      // `t4`.`lastname` AS `lastname`,
      // `students_self`.`firstname` AS `self_firstname`,
      // `students_self`.`nickname` AS `self_nickname`,
      // `students_self`.`tel` AS `self_tel`,
      // `students_self`.`facebook` AS `self_facebook`,
      // `students_self`.`ig` AS `self_ig`

    ?>
    <style>
      .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        border-radius: 10px;
        padding: 10px;
        padding-top: 0px;
        margin-bottom: 15px;
      }
      .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      }
      .card-wrong {
        background-color: yellow;
      }
      .card-corrected {
        background-color: green;
      }
      hr {
        border-top: 1px solid black;
      }
    </style>

  </head>
  <body>
      <div class="" id="maincontainer">
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a>
        <H1>ดูสถานะการเปิดภาพ</H1>
        <div class="container" id="stop-container">
          <div class="row">
            <div class="col-md-3">
              <label for="code-label">Code: </label>
              <h2 id="code-label"><?php print($code); ?></h2>
            </div>
            <div class="col-md-3">
              <label for="duration">Duration: </label>
              <h2><span id="timer"></span><span id="max-time"></span></h2>
            </div>
            <div class="col-md-2">
              <label for="status">Status: </label>
              <?php if($status == 'waiting') {$status_color = 'red';} else {$status_color = 'green';}?>
              <h2 id="status" style="color: <?php print($status_color); ?>"><?php print($status); ?></h2>
            </div>
          </div>
          <div id="stop-error-message-row" class="row" hidden>
            <p id="stop-error-message"></p>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-4 left-container" style="border-right: solid 1px black; padding: 15px;">
            <?php
              if(isset($results)){
                foreach($results as $key => $value){
                  if($value['seatColumn']<=25) {
                    $seatRow = $value['seatRow'];
                    $seatColumn = $value['seatColumn'];
                    $status = $value['status'];
                    $studentId = $value['studentId'];
                    $room = $value['room'];
                    $no = $value['no'];
                    $firstname = $value['firstname'];
                    $lastname = $value['lastname'];
                    $self_studentId = $value['self_studentId'];
                    $self_room = $value['self_room'];
                    $self_firstname = $value['self_firstname'];
                    $self_nickname = $value['self_nickname'];
                    $self_tel = $value['self_tel'];
                    $self_facebook = $value['self_facebook'];
                    $self_ig = $value['self_ig'];
                    // print('seatRow => '.$seatRow.' ');
                    // print('seatColumn => '.$seatColumn.' ');
                    // print('status => '.$status.' ');
                    // print('studentId => '.$studentId.' ');
                    // print('room => '.$room.' ');
                    // print('no => '.$no.' ');
                    // print('firstname => '.$firstname.' ');
                    // print('lastname => '.$lastname.' ');
                    // print('self_studentId => '.$self_studentId.' ');
                    // print('self_room => '.$self_room.' ');
                    // print('self_firstname => '.$self_firstname.' ');
                    // print('self_nickname => '.$self_nickname.' ');
                    // print('self_tel => '.$self_tel.' ');
                    // print('self_facebook => '.$self_facebook.' ');
                    // print('self_ig => '.$self_ig.' ');
                    if ($status=='wrong') {
                      $status_class = 'card-wrong';
                    } else if ($status=='corrected') {
                      $status_class = 'card-corrected';
                    } else {
                      $status_class = '';
                    }
                    $under_html = '';
                    if ($seatRow != 'Y') {
                      try {
                        $under_seat = getStudentAtSeat(chr(ord($seatRow)+1), $seatColumn);
                        if(isset($under_seat)){
                          $under_seat_seatRow = $under_seat[0]['seatRow'];
                          $under_seat_seatColumn = $under_seat[0]['seatColumn'];
                          $under_seat_studentId = $under_seat[0]['studentId'];
                          $under_seat_room = $under_seat[0]['room'];
                          $under_seat_no = $under_seat[0]['no'];
                          $under_seat_firstname = $under_seat[0]['firstname'];
                          $under_seat_lastname = $under_seat[0]['lastname'];
                          $under_seat_self_studentId = $under_seat[0]['self_studentId'];
                          $under_seat_self_room = $under_seat[0]['self_room'];
                          $under_seat_self_firstname = $under_seat[0]['self_firstname'];
                          $under_seat_self_nickname = $under_seat[0]['self_nickname'];
                          $under_seat_self_tel = $under_seat[0]['self_tel'];
                          $under_seat_self_facebook = $under_seat[0]['self_facebook'];
                          $under_seat_self_ig = $under_seat[0]['self_ig'];
                          $under_html = '
                            <hr>
                            <div class="row" style="padding-left: 10px; padding-right: 10px;">
                              <div class="col-xs-2" style="text-align: center;">
                                <div class="row">
                                  <h1>'.$under_seat_seatRow.$under_seat_seatColumn.'</h1>
                                </div>
                                <div class="row">
                                  <label>'.' '.'</label>
                                </div>
                              </div>
                              <div class="col-xs-5">
                                <div class="row">
                                  <p>Staff</p>
                                  <h3>'.$under_seat_studentId.'</h3>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_firstname.' '.$under_seat_lastname.'</span>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_room.' เลขที่ '.$under_seat_no.'</span>
                                </div>
                              </div>
                              <div class="col-xs-5">
                                <div class="row">
                                  <p>Student</p>
                                  <h3>'.$under_seat_self_studentId.'</h3>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_self_firstname.' '.$under_seat_self_nickname.'</span>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_self_room.'</span> <span>'.$under_seat_self_tel.'</span>
                                </div>
                              </div>
                            </div>';
                        }
                      }catch(Exception $e ) {
                        echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
                        echo nl2br($e->getTraceAsString());
                        echo '<br>';
                      }
                      
                    }
                    
                    print('<div class="col-xs-12 card '.$status_class.'">
                    
                      <div class="row" style="padding-left: 10px; padding-right: 10px;">
                        <div class="col-xs-2" style="text-align: center;">
                          <div class="row">
                            <h1>'.$seatRow.$seatColumn.'</h1>
                          </div>
                          <div class="row">
                            <label>'.$status.'</label>
                          </div>
                        </div>
                        <div class="col-xs-5">
                          <div class="row">
                            <p>Staff</p>
                            <h3>'.$studentId.'</h3>
                          </div>
                          <div class="row">
                            <span>'.$firstname.' '.$lastname.'</span>
                          </div>
                          <div class="row">
                            <span>'.$room.' เลขที่ '.$no.'</span>
                          </div>
                        </div>
                        <div class="col-xs-5">
                          <div class="row">
                            <p>Student</p>
                            <h3>'.$self_studentId.'</h3>
                          </div>
                          <div class="row">
                            <span>'.$self_firstname.' '.$self_nickname.'</span>
                          </div>
                          <div class="row">
                            <span>'.$self_room.'</span> <span>'.$self_tel.'</span>
                          </div>
                        </div>
                      </div>'.$under_html.'
                    </div>');
                  }
                }
              }
            ?>
          </div>
          <div class="col-xs-4 right-container" style="padding: 15px;">
          <?php
              if(isset($results)){
                foreach($results as $key => $value){
                  if($value['seatColumn']>25) {
                    $seatRow = $value['seatRow'];
                    $seatColumn = $value['seatColumn'];
                    $status = $value['status'];
                    $studentId = $value['studentId'];
                    $room = $value['room'];
                    $no = $value['no'];
                    $firstname = $value['firstname'];
                    $lastname = $value['lastname'];
                    $self_studentId = $value['self_studentId'];
                    $self_room = $value['self_room'];
                    $self_firstname = $value['self_firstname'];
                    $self_nickname = $value['self_nickname'];
                    $self_tel = $value['self_tel'];
                    $self_facebook = $value['self_facebook'];
                    $self_ig = $value['self_ig'];
                    // print('seatRow => '.$seatRow.' ');
                    // print('seatColumn => '.$seatColumn.' ');
                    // print('status => '.$status.' ');
                    // print('studentId => '.$studentId.' ');
                    // print('room => '.$room.' ');
                    // print('no => '.$no.' ');
                    // print('firstname => '.$firstname.' ');
                    // print('lastname => '.$lastname.' ');
                    // print('self_studentId => '.$self_studentId.' ');
                    // print('self_room => '.$self_room.' ');
                    // print('self_firstname => '.$self_firstname.' ');
                    // print('self_nickname => '.$self_nickname.' ');
                    // print('self_tel => '.$self_tel.' ');
                    // print('self_facebook => '.$self_facebook.' ');
                    // print('self_ig => '.$self_ig.' ');
                    if ($status=='wrong') {
                      $status_class = 'card-wrong';
                    } else if ($status=='corrected') {
                      $status_class = 'card-corrected';
                    } else {
                      $status_class = '';
                    }
                    $under_html = '';
                    if ($seatRow != 'Y') {
                      try {
                        $under_seat = getStudentAtSeat(chr(ord($seatRow)+1), $seatColumn);
                        if(isset($under_seat)){
                          $under_seat_seatRow = $under_seat[0]['seatRow'];
                          $under_seat_seatColumn = $under_seat[0]['seatColumn'];
                          $under_seat_studentId = $under_seat[0]['studentId'];
                          $under_seat_room = $under_seat[0]['room'];
                          $under_seat_no = $under_seat[0]['no'];
                          $under_seat_firstname = $under_seat[0]['firstname'];
                          $under_seat_lastname = $under_seat[0]['lastname'];
                          $under_seat_self_studentId = $under_seat[0]['self_studentId'];
                          $under_seat_self_room = $under_seat[0]['self_room'];
                          $under_seat_self_firstname = $under_seat[0]['self_firstname'];
                          $under_seat_self_nickname = $under_seat[0]['self_nickname'];
                          $under_seat_self_tel = $under_seat[0]['self_tel'];
                          $under_seat_self_facebook = $under_seat[0]['self_facebook'];
                          $under_seat_self_ig = $under_seat[0]['self_ig'];
                          $under_html = '
                            <hr>
                            <div class="row" style="padding-left: 10px; padding-right: 10px;">
                              <div class="col-xs-2" style="text-align: center;">
                                <div class="row">
                                  <h1>'.$under_seat_seatRow.$under_seat_seatColumn.'</h1>
                                </div>
                                <div class="row">
                                  <label>'.' '.'</label>
                                </div>
                              </div>
                              <div class="col-xs-5">
                                <div class="row">
                                  <p>Staff</p>
                                  <h3>'.$under_seat_studentId.'</h3>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_firstname.' '.$under_seat_lastname.'</span>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_room.' เลขที่ '.$under_seat_no.'</span>
                                </div>
                              </div>
                              <div class="col-xs-5">
                                <div class="row">
                                  <p>Student</p>
                                  <h3>'.$under_seat_self_studentId.'</h3>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_self_firstname.' '.$under_seat_self_nickname.'</span>
                                </div>
                                <div class="row">
                                  <span>'.$under_seat_self_room.'</span> <span>'.$under_seat_self_tel.'</span>
                                </div>
                              </div>
                            </div>';
                        }
                      }catch(Exception $e ) {
                        echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
                        echo nl2br($e->getTraceAsString());
                        echo '<br>';
                      }
                      
                    }
                    
                    print('<div class="col-xs-12 card '.$status_class.'">
                    
                      <div class="row" style="padding-left: 10px; padding-right: 10px;">
                        <div class="col-xs-2" style="text-align: center;">
                          <div class="row">
                            <h1>'.$seatRow.$seatColumn.'</h1>
                          </div>
                          <div class="row">
                            <label>'.$status.'</label>
                          </div>
                        </div>
                        <div class="col-xs-5">
                          <div class="row">
                            <p>Staff</p>
                            <h3>'.$studentId.'</h3>
                          </div>
                          <div class="row">
                            <span>'.$firstname.' '.$lastname.'</span>
                          </div>
                          <div class="row">
                            <span>'.$room.' เลขที่ '.$no.'</span>
                          </div>
                        </div>
                        <div class="col-xs-5">
                          <div class="row">
                            <p>Student</p>
                            <h3>'.$self_studentId.'</h3>
                          </div>
                          <div class="row">
                            <span>'.$self_firstname.' '.$self_nickname.'</span>
                          </div>
                          <div class="row">
                            <span>'.$self_room.'</span> <span>'.$self_tel.'</span>
                          </div>
                        </div>
                      </div>'.$under_html.'
                    </div>');
                  }
                }
              }
            ?>
          </div>
          <div class="col-xs-4">
            <div class="row">
              <table style="width:100%">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>Message</th>
                    <th>Status</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody class="message-list">
                </tbody>
              </table>
            </div>
          </div>
      </div>
  </body>
  <script>

    // Set the date we're counting down to
    // var countDownDate = new Date("Nov 14, 2019 00:00:00").getTime();
    var countDownDate = null;
    var imageDuration = null;
    var x = null;
    $( document ).ready(function() {
      countDownDate = dayjs('<?php print($start_time)?>').valueOf();
      imageDuration = <?php print($duration)?>;
      x = null;
      startTimer();
      getShowNoticeMessage();
    });

    function getShowNoticeMessage() {
      $('.message-list').html('');
      $.ajax({
        type: 'GET',
        url: "getShowNoticeMessage.php",
        data: {
        },
        success: function(results){
          results = JSON.parse(results);
          results.forEach(function(item, index) {
            let tmp = item.show_status==1?'checked':'';
            // console.log('index'+ item.show_status+' ' + tmp);
            let html = `
              <tr>
                <td>`+item.id+`</td>
                <td>`+item.message+`</td>
                <td>`+item.status+`</td>
                <td>`+item.updated_at.split(" ")[1]+`</td>
              </tr>
            `;
            $('.message-list').append(html);
          });
          console.log(results);
        },
        error: function(error) {
          console.log(error);
          $('#error-message').html(error.responseText);
          $('#error-message-row').show();
        }
      });
    }

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