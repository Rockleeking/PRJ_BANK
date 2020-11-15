<doctype! HTML>
<html>
<head>
<title>Welcome to </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/new.css">
</head>
<body>
<?php//database and session
include 'db_conn.php';
include 'session.php';
?>
    <!-- header -->
<header>
<div class="container" id="nav_container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><!-- top nav --><?php include'nav.php' ?><script type="text/javascript" src="../../js/new.js" ></script></div>
    </div>
</header>
<!-- image slider -->
<section id="showcase">
      <div class="container" id="slider">
	  <ul class="slides">
		<li class="slide"><img src="../../img/slider1.jpg"/></li>
		<li class="slide"><img src="../../img/slider2.jpg"/></li>
		<li class="slide"><img src="../../img/slider3.jpg"/></li>
		<li class="slide"><img src="../../img/slider4.png"/></li>
		<li class="slide"><img src="../../img/slider1.jpg"/></li>
	  </ul>
	</div>
    </section>
    <!-- video box -->
	<section id="boxes">
      <div class="container">
        <div id="heading3" >
          <h3>&nbsp;&nbsp;&nbsp;Introduction Video</h3>
        </div>
          <center>
          <div class="video_box">
          
          <video src="../../video/website.mp4"  width="80%" controls></video>
          <h3>HOW TO USE THIS WEBSITE?</h3>
          <p>This is a short introduction video on how to use the website</p>
          </div>
              </center>
      </div>
	  </section>
    <!-- feedback box -->
	<section id="boxes">
      <div class="container">
        <div id="heading3" >
          <h3>&nbsp;&nbsp;&nbsp;User Feedback</h3>
        </div>
        <form>
          <div class="box">
          <img src="../../img/saroj.jpg">
          <h3>Best Bank</h3>
          <p>Helo everyone this is just a random data please dont see</p>
        </div>
        <div class="box">
          <img src="../../img/sujit.jpg">
          <h3>Awsome bank</h3>
          <p>Helo everyone this is just a random data please dont see</p>
        </div>
        <div class="box">
          <img src="../../img/saroj.jpg">
          <h3>Great services</h3>
          <p>Helo everyone this is just a random data please dont see</p>
        </div>
        </form>
      </div>
	  </section>
    <!-- footer -->
    <footer id="footerplaceholder">
        <?php include'footer.php'; ?>
    </footer>
    </body></html>