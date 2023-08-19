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
      <link rel="stylesheet" href="style.css"/>
      <script src="jquery/jquery-1.12.4.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="script.js"></script>
      <style>
        body {
          background-color: black;
        }

        .btn {
          width: 100px;
        }

        .black { background-color: black;}
        .ac-red { background-color: red;}
        .ac-white { background-color: white;}
        .ds-green { background-color: green;}
        .ds-yellow { background-color: yellow;}
        .sk-pink { background-color: pink;}
        .sk-blue { background-color: blue;}
        .bcc-purple { background-color: purple;}
        .bcc-gold { background-color: yellow;}
        
        .orange { background-color: orange;}

        .transition {
          animation: transition 20s infinite;
          -moz-animation: transition 20s infinite;
          -webkit-animation: transition 20s infinite;
        }
        @keyframes transition
        {
          0%   {background: white;}
          12.5%   {background: red;}
          25%   {background: green;}
          37.5%   {background: yellow;}
          50%   {background: pink;}
          62.5%   {background: blue;}
          75%   {background: purple;}
          87.5%   {background: yellow;}
          100% {background: white;}
        }
        @-webkit-keyframes transition
        {
          0%   {background: white;}
          12.5%   {background: red;}
          25%   {background: green;}
          37.5%   {background: yellow;}
          50%   {background: pink;}
          62.5%   {background: blue;}
          75%   {background: purple;}
          87.5%   {background: yellow;}
          100% {background: white;}
        }
      </style>
  </head>
  <body>
      <div class="container" id="maincontainer">
        <!-- <a class="btn btn-primary" href="/indexForStaffCheerOnlyNaJaPleaseDoNotPublishThisLink.php">กลับหน้าแรก</a> -->

        <div class="row">
          <div class="col-xs-3">
            <label id="reset" class="btn" onclick="changeBackgroundColor('black')">reset</label>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-3">
            <H1 style="margin:0px;">AC</H1>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-3">
            <label id="ac-red" class="btn" onclick="changeBackgroundColor('ac-red')">แดง</label>
          </div>
          <div class="col-xs-3">
            <label id="ac-white" class="btn" onclick="changeBackgroundColor('ac-white')">ขาว</label>
          </div>
          <div class="col-xs-3">
            <label id="ac-blink" class="btn" onclick="blink()">กระพริบ</label>
          </div>
          <div class="col-xs-3">
            <label id="ac-swap" class="btn" onclick="swap('ac-red', 'ac-white')">สลับAC</label>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-3">
            <H1 style="margin:0px;">DS</H1>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-3">
            <label id="ds-green" class="btn" onclick="changeBackgroundColor('ds-green')">เขียว</label>
          </div>
          <div class="col-xs-3">
            <label id="ds-yellow" class="btn" onclick="changeBackgroundColor('ds-yellow')">เหลือง</label>
          </div>
          <div class="col-xs-3">
            <label id="ds-blink" class="btn" onclick="blink()">กระพริบ</label>
          </div>
          <div class="col-xs-3">
            <label id="ds-swap" class="btn" onclick="swap('ds-green', 'ds-yellow')">สลับDS</label>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-3">
            <H1 style="margin:0px;">SK</H1>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-3">
            <label id="sk-pink" class="btn" onclick="changeBackgroundColor('sk-pink')">ชมพู</label>
          </div>
          <div class="col-xs-3">
            <label id="sk-blue" class="btn" onclick="changeBackgroundColor('sk-blue')">ฟ้า</label>
          </div>
          <div class="col-xs-3">
            <label id="sk-blink" class="btn" onclick="blink()">กระพริบ</label>
          </div>
          <div class="col-xs-3">
            <label id="sk-swap" class="btn" onclick="swap('sk-pink', 'sk-blue')">สลับSK</label>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-3">
            <H1 style="margin:0px;">BCC</H1>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-3">
            <label id="bcc-purple" class="btn" onclick="changeBackgroundColor('bcc-purple')">ม่วง</label>
          </div>
          <div class="col-xs-3">
            <label id="bcc-gold" class="btn" onclick="changeBackgroundColor('bcc-gold')">ทอง</label>
          </div>
          <div class="col-xs-3">
            <label id="bcc-blink" class="btn" onclick="blink()">กระพริบ</label>
          </div>
          <div class="col-xs-3">
            <label id="bcc-swap" class="btn" onclick="swap('bcc-purple', 'bcc-gold')">สลับBCC</label>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-3">
            <label id="bcc-purple" class="btn" onclick="transition()">transition</label>
          </div>
          <div class="col-xs-3">
            <label id="bcc-purple" class="btn" onclick="random()">random</label>
          </div>
        </div>
        
        <div class="row">
          <div class="col-xs-3">
            <label id="orange" class="btn" onclick="changeBackgroundColor('orange')">ส้ม</label>
          </div>
        </div>


      </div>
  </body>
  <script>
    var myInterval = null;
    function blink() {
      let color = document.body.className;
      console.log(color);
      swap('black', color);
    }
    function swap(color1, color2) {
      clearInterval(myInterval);
      myInterval = null;
      var cur_color = -1,
      colors = [
        color1,
        color2,
      ];
      myInterval = setInterval(function() {
        document.body.classList = "";
        document.body.classList.add(colors[(++cur_color) % colors.length]);
      }, 1000);
    }
    function changeBackgroundColor(color) {
      clearInterval(myInterval);
      myInterval = null;
      document.body.classList = "";
      document.body.classList.add(color);
    }
    function transition() {
      clearInterval(myInterval);
      myInterval = null;
      document.body.classList = "";
      document.body.classList.add('transition');
    }
    function random() {
      clearInterval(myInterval);
      myInterval = null;
      var cur_color = -1,
      colors = [
        'ac-red',
        'ac-white',
        'ds-green',
        'ds-yellow',
        'sk-pink',
        'sk-blue',
        'bcc-purple',
        'bcc-yellow'
      ];
      myInterval = setInterval(function() {
        document.body.classList = "";
        document.body.classList.add(colors[getRndInteger(0, colors.length)]);
      }, 1000);
    }
    function getRndInteger(min, max) {
      return Math.floor(Math.random() * (max - min + 1) ) + min;
    }
  </script>
</html>