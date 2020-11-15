<doctype! HTML>
<html>
<head>
<title>Welcome to </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/new.css">
<script type="text/javascript" src="../../js/new.js" ></script>
</head>
<body>
<?php
include 'db_conn.php';
if($_POST["sign_up"]=="submit"){	  
		$mname=$_POST['mname'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$type=$_POST['type'];
		$title=$_POST['title'];
		$add1=$_POST['add1'];
		$add2=$_POST['add2'];
		$pass=$_POST['pass'];
		$contact=$_POST['phone'] ;
		$query="INSERT INTO detail( title, fname, mname, lname, email, phone, address1, address2, type, value, password) VALUES ('".$title."','".$fname."','".$mname."','".$lname."','".$email."','".$contact."','".$add1."','".$add2."','".$type."','1','".$pass."')";
		if($db->query($query)==true){
			$message = "data send sucessfully";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
			header("Location: login.php?reg=1");
		}else{
			$message = "error occured";
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
        <div id="registration">
          <h3>User Registration</h3>
            <form class="quote" method="post" onsubmit="return validateform();" action="#">
			<table><tr>
			<td colspan="3">
  							<label>Title</label><br>
  							<select name="title">
										<option value = "">select one</option>
									   <option value = "miss">Miss</option>
									   <option value = "mr">Mr.</option>
									   <option value = "ms">Ms.</option>
									   
									 </select></td></tr>
  						<tr>
  							<td><label>Frist Name</label><br>
  							<input type="text" placeholder="Frist Name" id="fname" name="fname"></td>
							<td><label>Middel Name</label><br>
  							<input type="text" placeholder="Middel Name" name="mname"></td>
							<td><label>Last Name</label><br>
  							<input type="text" placeholder="Last Name" id="lname" name="lname"></td>
  						</tr>
						<tr><td colspan="3">
  							<label>Acount Type</label><br>
									 <select name="type">
										<option value="">Select one</option>
									   <option value = "Saving">Saving</option>
									   <option value = "Business">Business</option>
									 </select>
  							</td></tr>
						<tr>
  							<td><label>Email</label><br>
  							<input type="text" placeholder="Email" id="email" name="email"></td>
							<td><label>Phone</label><br>
  							<input type="text" placeholder="Phone" id="phone" name="phone"></td>
  						</tr>
						<tr>
							<td><label>Address 1</label><br>
  							<input type="text" placeholder="Address 1" id="add1" name="add1"></td>
							<td><label>Address 2</label><br>
  							<input type="text" placeholder="Address 2" name="add2"></td>
  						</tr>
						<tr>
							<td><label>Password</label><br>
  							<input type="password" placeholder="Password" id="pass" name="pass"></td>
							<td><label>Confirm Password</label><br>
  							<input type="password" placeholder="Confirm Password" name="cpass"></td>
  						</tr>
  						<tr><td><button class="button_1" name="sign_up" value="submit">Register</button></td></tr>
						</table>
					</form>
        </div>
      </div>
    </section>

    <footer id="footerplaceholder">
    </footer>
  </body>
</html>
