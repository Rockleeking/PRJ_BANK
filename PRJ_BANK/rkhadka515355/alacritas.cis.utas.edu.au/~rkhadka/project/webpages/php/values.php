<?php
	include('db_conn.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Values </title>
        <link rel="stylesheet" type="text/css" href="../../css/templete.css">
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
  <?php
  echo"<br />";echo"<br />";echo"<br />";echo"<br />";
   
		$que="select * from test_users";
		$result=$db->query($que);
		
		while($row=$result->fetch_array(MYSQLI_ASSOC)){
			echo'<div style="background-color:#fff; padding: 25px;">';
			echo"Welcome ".$row['u_fristName']." ".$row['u_lastName'];
			echo"<br />";
			echo"Your Contact number is ".$row['u_phone'];
			echo"<br />";
			echo"Your email is ".$row['u_email'];
			echo"<br />";
			echo"Your Username is ".$row['u_uname'];
			echo"<br />";
			echo"Your gender is ".$row['u_gender'];
			echo"<br />";
			echo"Your account was created on ".$row['u_dateReg'];
			echo"<br />";echo"</div>";
			echo"<br />";echo"<br />";
		}
		
	$mysql_free_result($result);
	$db->close();
?>
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