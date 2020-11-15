<?php
	include('db_conn.php');
	if ( isset( $_POST['submit'] ) ) {
		  
		$uname=$_POST['uuname'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$gender=$_POST['gender'];
		$pass=$_POST['ppass'];
		$contact=$_POST['phone'] ;
		$query="INSERT INTO test_users(u_fristName,u_lastName,u_email,u_phone,u_uname,u_pass,u_gender) VALUES('".$fname."','".$lname."','".$email."','".$contact."','".$uname."','".$pass."','".$gender."')";
		if($db->query($query)==true){
			$message = "data send sucessfully";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
			header("Location: https://alacritas.cis.utas.edu.au/~rkhadka/webpages/php/values.php");
		}else{
			$message = "error occured";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
		}
	}

?>
<!DOCTYPE html>
<html>
    <head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Game time </title>
        <link rel="stylesheet" type="text/css" href="../../css/templete.css">
		<script>  
function validateform(){  
var fname=document.form.fname.value;
var lname=document.form.lname.value;
var uname=document.form.uuname.value;
var password=document.form.ppass.value;
var phone=document.form.phone.value;
var email=document.form.email.value; 
var cpass=document.form.cpass.value;
  
if (fname==null || fname==""){  
  alert("Frist Name can't be blank");  
  return false;}
else if (lname==null || lname==""){  
  alert("Last Name can't be blank");  
  return false;   
}else if (uname==null || uname==""|| uname<5){  
  alert("UserName can't be blank or less than 5 charaters longs");  
  return false;
  }else if(email==null||email==""){
	alert("email cannot be blank");}
  else if(password.length<6){  
  alert("Password must be at least 6 characters long.");  
  return false; 
  } else if(phone.length<10){  
  alert("Phone must be at least 10 characters long.");  
  return false;  
}else if(password!==cpass){
	alert("password dosent match");
	return false;
}
}
</script>
    </head>
	<body>
	<div class="mainContener">
    <div class="header"><h1>welcome</h1><br />
        <h3>sign up</h3></div>
<div class="topnav" id="myHeader">
  <a href="../index.html">Index</a>
  <a href="../home.html">home</a>
  <a href="../contact Us">contact us</a>
  <a href="../game time.html">Game time</a>
</div>
<div class="row">
  <div class="column side">  
    <h2></h2>
    <div id="center">
	<p>
		</p>
	</div>
  </div ><div class="column_middle"><div id="center"><div>
  <form method="post" onsubmit="return validateform();" name="form" action="sign up.php">
	<table style="border:1px solid black; min-height:100px;min-width:100px;">
	<tr><td><span><label for="fname" class="lname">Frist Name :</label></span></td><td><input type="text" name="fname" id="fname" value=""/></td></tr>
    <tr><td><span><label for="lname" class="llname">Last Name :</label></span></td><td><input type="text" id="lname" name="lname" value=""/></td></tr>
	<tr><td><span><label for="email" class="lemail">E-mail :</label></span></td><td><input type="text" id="email"name="email" value=""/></td></tr>
	<tr><td><span><label for="phone" class="lphone">Phone :</label></span></td><td><input type="text" id="phone" name="phone" value=""/></td></tr>
	<tr><td><span><label for="uuname" class="luuname">Username :</label></span></td><td><input type="text" id="uuname" name="uuname" value=""/></td></tr>
    <tr><td><span><label for="ppass" class="lppass">Password :</label></span></td><td><input type="password" id="ppass" name="ppass" value=""/></td></tr>
    <tr><td><span><label for="cpass" class="lcpass">confirm Password :</label></span></td><td><input type="password" name="cpass" id="cpass" value=""/></td></tr>
	    <tr><td><span><label for="gender" class="lgen">Gender :</label></span></td><td><input type="radio" name="gender" checked="checked" value="m"/>male<input type="radio" name="gender" value="f"/>female<input type="radio" name="gender" value="o"/>others</td></tr>
		<tr><td><input type="submit" value="Submit" name="submit"></td></tr>
	</table>
	</form>
	</div></div></div>
	 <div class="column side">
    <h2></h2>
    <div id="center"><p>		</p>
	</div>	
  </div>
</div>
<div class="footer">
	this is footer
</div>
</div>     
	</body>
	</html>