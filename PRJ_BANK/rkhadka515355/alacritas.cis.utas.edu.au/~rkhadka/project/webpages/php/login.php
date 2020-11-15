<?php
//session and database
include 'db_conn.php';
include 'session.php';
    if(isset($_SESSION['session_user'])&& $_SESSION['session_user']!=""){
       header('location:./account.php');
    }
//alert for msg
if(isset($_GET["reg"])){
	$message = "Registered sucessfully";
	echo "<script type='text/javascript'>alert('".$message."');</script>";
}
//message from signout
if(isset($_GET['signout'])){
	$message = $_GET['signout'];
	echo "<script type='text/javascript'>
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();
    var dateTime = date+' '+time;
    alert('".$message." \\n Log Out Time : '+dateTime);</script>";
}
//alert for error
if(isset($_GET['err'])){
	$message = $_GET['err'];
	echo "<script type='text/javascript'>
    alert('".$message."');</script>";
}
// post controller of login submit 
if($_POST["login"]=="submit")
{
    //login for business
    if($_POST["access"]=="BU"){
	$sql1='SELECT * FROM detail';
    $result=mysqli_query($db,$sql1);
    $ph=$_POST["phone"];
    $pp=$_POST["pass"];
    $ok=true;
    while($row=mysqli_fetch_array($result)){
        //check username
        if($row['phone']==$ph){
            $ok=false;
            //encryption
            $pw=sha1($pp);
           //check password
            $pp1=$row['password'];
            $message = "password did not match with your username";
                echo "<script type='text/javascript'>alert('".$message."');</script>";
            if($pw==$pp1){
                if($row['value']!=1){
                    header("Location: login.php?err=Your account is not yet verified,//n Please contact bank if problem persists");
                }else{
                    //set session value
                $_SESSION['session_lastLogin']=$row['last_login'];
                $do=mysqli_query($db,"UPDATE detail SET last_login=now() WHERE d_id=".$row['d_id']."");
                $_SESSION['session_user']=$row['fname'];
                $_SESSION['session_uname']=$ph;
                $acc=mysqli_query($db,"SELECT acc_no FROM opening WHERE uname=$ph");
                $acc_n=mysqli_fetch_array($acc);
                $_SESSION['session_account']=$acc_n['acc_no'];
                $_SESSION['session_access']=$row['type'];
                //redirect to client page
                header("Location: ./account.php");
                }
            }else{
                header("Location: login.php?err=password you entered is incorrect");
            }
        }
    }
        //message if  not registered
    if(ok){
            $message = "You are not registerd with secure banking please regster first!!";
                echo "<script type='text/javascript'>alert('".$message."');</script>";
        }

    
}//login for managers
    else if($_POST['access']=="BM"){
	$sql5='SELECT * FROM detail_bm';
    $result5=mysqli_query($db,$sql5);
    $ph1=$_POST["phone"];
    $pp=$_POST["pass"]; 
    while($row5=mysqli_fetch_array($result5)){
        //check username
        if($row5['uname']==$ph1){
            //encryption
            $pw=sha1($pp);
            $pp1=$row5['password'];
            //check password
            if($pw==$pp1){
                //setting value in session
                $_SESSION['session_uname']=$row5['uname'];
                $_SESSION['session_user']=$row5['uname'];
                $_SESSION['session_access']="BM";
                //redirect to manager page
                header("Location: ./manager/manager.php");
            }else{
                header("Location: login.php?err=password you entered is incorrect");
            }
        }else{
            $message = "User name Dosen't mate Mate, Please check it!!!";
                echo "<script type='text/javascript'>alert('".$message."');</script>";
            $pw=$row5['password'];
            }
        }
}
}

?>
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
<script type="text/javascript" src="../../js/new.js" ></script>
    <!-- header -->
<header>
<div class="container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><!-- nav top --><?php include'nav.php' ?></div>
    </div>
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
              <!-- lgin area -->
            <h3>User Log IN</h3>
            <form class="quote" method="post" onsubmit="return valid();" action="">
  						<div>
                            <label>Select User Type</label><br>
                            <select name="access" class="Dropdn">
                                <option value ="BM">Bank Manager</option>
                                <option value ="BU"selected>Bank Account Holders</option>
                            </select></div><div>
  							<label>UserName</label><br>
  							<input type="text" name="phone" placeholder="UserName">
  						</div>
  						<div>
  							<label>password</label><br>
  							<input type="password" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[~!#$]).{8,12}" placeholder="Password" oninvalid="setCustomValidity('password must be 8-12 charater including one Uppercase ans lower case letter with a symbol')">
  						</div>
  						<button class="button_1" name="login" value="submit">Log IN</button>
						<span> New User? <a href="register.php">Sign Up here</a></span>
					</form>
          </div>
        </aside>
      </div>
    </section>
<!-- footer -->
    <footer id="footerplaceholder">        <?php include'footer.php'; ?>
    </footer>
  </body>
</html>
