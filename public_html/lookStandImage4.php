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
        $results = getImageSeatOfImageAllOnlySeat($imageId);
      }catch(Exception $e ) {
        echo "Error No: ".$e->getCode(). " <br>Error Message: ". $e->getMessage() . "<br >";
        echo nl2br($e->getTraceAsString());
        echo '<br>';
      }
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
      h3, h4 { 
        margin-top: 0px;
      }
      td {
        font-size: 24px;
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
            <div class="col-md-2">
              <a onclick="refresh()" class="btn btn-primary" style="width:200px; height:80px;">refresh</a>
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
                                  <h3>'.$under_seat_firstname.' '.$under_seat_lastname.'</h3>
                                </div>
                                <div class="row">
                                  <h4>'.$under_seat_room.' เลขที่ '.$under_seat_no.'</h4>
                                  <span>'.$under_seat_studentId.' </span>
                                </div>
                              </div>
                              <div class="col-xs-5">
                                <div class="row">
                                  <p>Student</p>
                                  <h3>'.$under_seat_self_firstname.' '.$under_seat_self_nickname.'</h3>
                                </div>
                                <div class="row">
                                  <h4>'.$under_seat_self_room.'</h4>
                                  <span>'.$under_seat_self_tel.'</span>
                                  <span>'.$under_seat_self_studentId.'</span>
                                </div>
                              </div>
                            </div>';
                          // $under_seat_seatRow = $under_seat[0]['seatRow'];
                          // $under_seat_seatColumn = $under_seat[0]['seatColumn'];
                          // $under_html = '
                          //   <hr>
                          //   <div class="row" style="padding-left: 10px; padding-right: 10px;">
                          //     <div class="col-xs-2" style="text-align: center;">
                          //       <div class="row">
                          //         <h1>'.$under_seat_seatRow.$under_seat_seatColumn.'</h1>
                          //       </div>
                          //       <div class="row">
                          //         <label>'.' '.'</label>
                          //       </div>
                          //     </div>
                          //     <div class="col-xs-5">
                          //       <div class="row">
                          //         <p>Staff</p>
                          //         <h3 id="under-seat-studentId-'.$under_seat_seatRow.$under_seat_seatColumn.'"></h3>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-firstname-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-room-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span>
                          //       </div>
                          //     </div>
                          //     <div class="col-xs-5">
                          //       <div class="row">
                          //         <p>Student</p>
                          //         <h3 id="under-seat-self-studentId-'.$under_seat_seatRow.$under_seat_seatColumn.'"></h3>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-self-firstname-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-self-room-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span> <span id="under-seat-self-tel-'.$seatRow.$seatColumn.'"></span>
                          //       </div>
                          //     </div>
                          //   </div>';
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
                            <h3 class="firstname-'.$seatRow.$seatColumn.'"></h3>
                          </div>
                          <div class="row">
                            <h4 class="room-'.$seatRow.$seatColumn.'"></h4>
                            <span class="studentId-'.$seatRow.$seatColumn.'"></span>
                          </div>
                        </div>
                        <div class="col-xs-5">
                          <div class="row">
                            <p>Student</p>
                            <h3 class="self-firstname-'.$seatRow.$seatColumn.'"></h3>
                          </div>
                          <div class="row">
                            <h4 class="self-room-'.$seatRow.$seatColumn.'"></h4>
                            <span class="self-tel-'.$seatRow.$seatColumn.'"></span>
                            <span class="self-studentId-'.$seatRow.$seatColumn.'"></span>
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
                                  <h3>'.$under_seat_firstname.' '.$under_seat_lastname.'</h3>
                                </div>
                                <div class="row">
                                  <h4>'.$under_seat_room.' เลขที่ '.$under_seat_no.'</h4>
                                  <span>'.$under_seat_studentId.' </span>
                                </div>
                              </div>
                              <div class="col-xs-5">
                                <div class="row">
                                  <p>Student</p>
                                  <h3>'.$under_seat_self_firstname.' '.$under_seat_self_nickname.'</h3>
                                </div>
                                <div class="row">
                                  <h4>'.$under_seat_self_room.'</h4>
                                  <span>'.$under_seat_self_tel.'</span>
                                  <span>'.$under_seat_self_studentId.'</span>
                                </div>
                              </div>
                            </div>';
                          // $under_seat_seatRow = $under_seat[0]['seatRow'];
                          // $under_seat_seatColumn = $under_seat[0]['seatColumn'];
                          // $under_html = '
                          //   <hr>
                          //   <div class="row" style="padding-left: 10px; padding-right: 10px;">
                          //     <div class="col-xs-2" style="text-align: center;">
                          //       <div class="row">
                          //         <h1>'.$under_seat_seatRow.$under_seat_seatColumn.'</h1>
                          //       </div>
                          //       <div class="row">
                          //         <label>'.' '.'</label>
                          //       </div>
                          //     </div>
                          //     <div class="col-xs-5">
                          //       <div class="row">
                          //         <p>Staff</p>
                          //         <h3 id="under-seat-studentId-'.$under_seat_seatRow.$under_seat_seatColumn.'"></h3>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-firstname-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-room-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span>
                          //       </div>
                          //     </div>
                          //     <div class="col-xs-5">
                          //       <div class="row">
                          //         <p>Student</p>
                          //         <h3 id="under-seat-self-studentId-'.$under_seat_seatRow.$under_seat_seatColumn.'"></h3>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-self-firstname-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span>
                          //       </div>
                          //       <div class="row">
                          //         <span id="under-seat-self-room-'.$under_seat_seatRow.$under_seat_seatColumn.'"></span> <span id="under-seat-self-tel-'.$seatRow.$seatColumn.'"></span>
                          //       </div>
                          //     </div>
                          //   </div>';
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
                          <h3 class="firstname-'.$seatRow.$seatColumn.'"></h3>
                        </div>
                        <div class="row">
                          <h4 class="room-'.$seatRow.$seatColumn.'"></h4>
                          <span class="studentId-'.$seatRow.$seatColumn.'"></span>
                        </div>
                      </div>
                      <div class="col-xs-5">
                        <div class="row">
                          <p>Student</p>
                          <h3 class="self-firstname-'.$seatRow.$seatColumn.'"></h3>
                        </div>
                        <div class="row">
                          <h4 class="self-room-'.$seatRow.$seatColumn.'"></h4>
                          <span class="self-tel-'.$seatRow.$seatColumn.'"></span>
                          <span class="self-studentId-'.$seatRow.$seatColumn.'"></span>
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
      getImageSeatOfImageAllOnlySeat();
      setTimeout(function() {
        location.reload();
      }, 30000);
    });

    function getImageSeatOfImageAllOnlySeat() {
      $.ajax({
        type: 'GET',
        url: "getImageSeatOfImageAllOnlySeat.php",
        data: {
          imageId: <?php print($imageId)?>
        },
        success: function(results){
          results = JSON.parse(results);
          console.log(results);
          if(results){
            results.forEach(function(item, index){
              // console.log(item);
              let seatRow = item.seatRow || '';
              let seatColumn = item.seatColumn || '';
              let status = item.status || '';
              // $("#"+seatRow+seatColumn).addClass(status);
              // $("#"+seatRow+seatColumn).attr('status', status);
              $.ajax({
                type: 'GET',
                url: "getStudentAtSeat.php",
                data: { 
                  "seatRow": seatRow,
                  "seatColumn": seatColumn
                },
                success: function(seat){
                  seat = JSON.parse(seat);
                  console.log(seat);
                  if(seat) {
                    let studentId = seat[0]['studentId'] || null;
                    let firstname = seat[0]['firstname'] || null;
                    let lastname = seat[0]['lastname'] || null;
                    let room = seat[0]['room'] || null;
                    let no = seat[0]['no'] || null;
                    let self_studentId = seat[0]['self_studentId'] || null;
                    let self_firstname = seat[0]['self_firstname'] || null;
                    let self_nickname = seat[0]['self_nickname'] || null;
                    let self_room = seat[0]['self_room'] || null;
                    let self_tel = seat[0]['self_tel'] || null;
                    $('.studentId-'+seatRow+seatColumn).html(studentId);
                    $('.firstname-'+seatRow+seatColumn).html(firstname+' '+lastname);
                    $('.room-'+seatRow+seatColumn).html(room+' เลขที่'+ no);
                    $('.self-studentId-'+seatRow+seatColumn).html(self_studentId);
                    let self_fullname = null;
                    if(self_firstname) {
                      self_fullname = self_firstname + ' ' + self_nickname
                    }
                    $('.self-firstname-'+seatRow+seatColumn).html(self_fullname);
                    $('.self-room-'+seatRow+seatColumn).html(self_room);
                    $('.self-tel-'+seatRow+seatColumn).html(self_tel);
                  }
                },
                error: function(error) {
                  console.log(error);
                  $('#stop-error-message').html(error.responseText);
                  $('#stop-error-message-row').show();
                }
              });
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

    function refresh() {
      location.reload();
    }

    function startTimer() {
      x = setInterval(function() {
        var now = new Date().getTime();

        var distance = now - countDownDate;

        var minutes = Math.floor((distance / (1000 * 60)));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("timer").innerHTML = minutes + " m " + seconds + " s ";
        document.getElementById("max-time").innerHTML = " / " + imageDuration + " m";
        if (minutes >= imageDuration) {
          document.getElementById("timer").style.color = 'red';
        }
      }, 1000);
    }
    
  </script>
</html>