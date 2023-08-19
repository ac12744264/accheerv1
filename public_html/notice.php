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
      <title>AC CHEER | Notice</title>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css"/>
      <script src="jquery/jquery-1.12.4.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
      <div class="container" id="maincontainer">
        <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a>
        <H1>ข้อความ</H1>
        <div class="row">
          <div class="form-group">
            <div class="col-sm-5">
              <form>
                <div id="error-message-row" class="row" hidden>
                  <p id="error-message"></p>
                </div>
                <div class="row">
                  <label for="message">กรอกข้อความ<span style="color:red;">*</span>: </label>
                  <textarea id="message" name="message" type="text" class="form-control" rows="10" cols="100"></textarea>
                </div>
                <div class="row">
                  <label for="status">สถานะ<span style="color:red;">*</span>: </label>
                  <input id="status" name="status" type="text" class="form-control" />
                </div>
                <div class="row">                  
                  <label for="show-status">แสดงผล<span style="color:red;">*</span>: </label>
                  <input id="show-status" name="show-status" type="checkbox" class="form-control" />
                </div>
                <div class="row pull-right">
                  <a id="submit-button" class="btn btn-primary">Save</a>
                </div>
              </form>
            </div>
          </div>
        <div>
        <div class="row">
          <div class="col-xs-6">
            <table style="width:100%">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>show</th>
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
    $( document ).ready(function() {
      refreshNoticeList();      
    });

    function refreshNoticeList() {
      $('.message-list').html('');
      $.ajax({
        type: 'GET',
        url: "getNoticeMessage.php",
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
                <td><input id="show-status-`+item.id+`" name="show-status" type="checkbox" class="form-control" `+tmp+` onclick="toggleShowStatus(`+item.id+`)"/></td>
                <td>`+item.updated_at+`</td>
                <td><a class="btn btn-primary" onclick="removeNotice(`+item.id+`)">remove</a></td>
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

    function toggleShowStatus(id) {
      let check = $('#show-status-'+id).is(':checked');
      $.ajax({
        type: 'GET',
        url: "toggleShowStatus.php",
        data: {
          id: id,
          show_status: check
        },
        success: function(results){
          results = JSON.parse(results);
          refreshNoticeList();
        },
        error: function(error) {
          console.log(error);
          $('#error-message').html(error.responseText);
          $('#error-message-row').show();
        }
      });
    }

    function removeNotice(id) {
      let check = $('#show-status-'+id).is(':checked');
      console.log('id=>',id,'check=>', !check);
      $.ajax({
        type: 'GET',
        url: "removeNotice.php",
        data: {
          id: id
        },
        success: function(results){
          results = JSON.parse(results);
          console.log(results);
          refreshNoticeList();
        },
        error: function(error) {
          console.log(error);
          $('#error-message').html(error.responseText);
          $('#error-message-row').show();
        }
      });
    }

    $('#submit-button').click(function() {
      let message = $('#message').val();
      let status = $('#status').val();
      let showStatus = $('#show-status').is(':checked');
      $.ajax({
        type: 'GET',
        url: "createNoticeMessage.php",
        data: {
          message: message,
          status: status,
          show_status: showStatus
        },
        success: function(results){
          results = JSON.parse(results);
          refreshNoticeList();
        },
        error: function(error) {
          console.log(error);
          $('#error-message').html(error.responseText);
          $('#error-message-row').show();
        }
      });
    });
  </script>
</html>