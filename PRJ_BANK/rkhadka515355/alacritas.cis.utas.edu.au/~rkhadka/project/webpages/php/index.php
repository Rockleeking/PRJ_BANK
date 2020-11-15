<?php
 include 'db_conn.php';
 if(isset $_GET['sel']){
	 $sel=$_GET['sel'];
 }
 
 ?>
<html>
<head>
<title>Welcome to ABC BANK</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<link rel="stylesheet" type="text/css" href="../css/templete.css">
</head>
<body>
 <header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Acme</span> Web Design</h1>
        </div>
		<div id="nplaceholder"></div>
		<script>
			$(function(){
			  $("#nplaceholder").load("nav.html");
			});
		</script>
        
      </div>
    </header>

    <section id="showcase">
      <div class="container">
        <h1></h1>
        <p></p>
      </div>
    </section>

    <section id="newsletter">
      <div class="container">
        <h1>Subscribe To Our Newsletter</h1>
        <form>
          <input type="email" placeholder="Enter Email...">
          <button type="submit" class="button_1">Subscribe</button>
        </form>
      </div>
    </section>

    <section id="boxes">
      <div class="container">
        <div class="box">
          <img src="./img/logo_html.png">
          <h3>HTML5 Markup</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
        <div class="box">
          <img src="./img/logo_css.png">
          <h3>CSS3 Styling</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
        <div class="box">
          <img src="./img/logo_brush.png">
          <h3>Graphic Design</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mi augue, viverra sit amet ultricies</p>
        </div>
      </div>
    </section>

</body>
</html>