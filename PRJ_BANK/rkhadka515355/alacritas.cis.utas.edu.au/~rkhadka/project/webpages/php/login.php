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
<?php
include 'db_conn.php';
if(isset($_GET["reg"])){
	$message = "Registered sucessfully";
	echo "<script type='text/javascript'>alert('".$message."');</script>";
}

if($_POST["login"]=="submit")
{
	$sql1='SELECT * FROM detail';
$result=mysqli_query($db,$sql1);
$ph=$_POST["phone"];
$pp=$_POST["pass"];$ok=true;
while($row=mysqli_fetch_array($result))
{
	if($row["phone"]==$ph){
		$ok=false;
		if($row["password"]==$$pp){
			$message = "password did not match with your username";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
			header("Location: login.php");
		}else{
			header("Location: welcome.php");
		}
	}
}
if(ok){
		$message = "You are not registerd with secure banking please regster first!!";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
	}
}
?>
<header>
<div class="container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><script type="text/javascript" src="../../js/new.js" ></script></div>

</header>	
    <section id="main">
      <div class="container">
        <article id="main-col">
          <h1 class="page-title">Services</h1>
          <ul id="services">
            <li>
              <h3>Saving account</h3>
              <p>Secure Bank saving account offer. We offer a very reliable and secure Saving Account for you.</p>
						  <p>Open Your Saving account today</p>
            </li>
            <li>
              <h3>Business Account</h3>
              <p>Your professional business needs a secure hand please come join us.  </p>
						  <p>Open Your Business account today</p>
            </li>
            <li>
              <h3>E-Banking</h3>
              <p>Need an convinent Banking option come join us for free today.Manage your transaction's Online and 24 hours, 7Days access. </p>
						  <p>Pricing: $25 per month</p>
            </li>
          </ul>
        </article>

        <aside id="sidebar">
          <div class="cool">
            <h3>User Log IN</h3>
            <form class="quote" method="post" onsubmit="return valid();" action="#">
  						<div>
  							<label>UserName</label><br>
  							<input type="text" name="phone" placeholder="UserName">
  						</div>
  						<div>
  							<label>password</label><br>
  							<input type="password" name="pass" placeholder="Password">
  						</div>
  						<button class="button_1" name="login" value="submit">Log IN</button>
						<span> New User? <a href="register.php">Sign Up here</a></span>
					</form>
          </div>
        </aside>
      </div>
    </section>

    <footer id="footerplaceholder">
    </footer>
  </body>
</html>
