<?php 
	include('db_conn.php');
	if ( isset( $_GET['submit'] ) ) {
		  
		$uname=$_GET['uname'];
		$contact=$_GET['contact'] ;
		$query="INSERT INTO test_insert(Username,Contact) VALUES('".$uname."','".$contact."')";
		if($db->query($query)==true){
			$message = "data send sucessfully";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
			/*header("Location: https://alacritas.cis.utas.edu.au/~rkhadka/webpages/php/sendData.php");*/
		}else{
			$message = "error occured";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
		}
	}
?>
<html>
<body>
<p>Hello everyone</p>
<form method="GET" action="#">
	Username:&nbsp;<input type="text" name="uname"></input> <br />
	Contact:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="contact"></input> <br />
	<input type="submit" name="submit"/>
</form>
<?php
		$que="select * from test_insert";
		$result=$db->query($que);
		
		while($row=$result->fetch_array(MYSQLI_ASSOC)){
			echo"Welcome ".$row['Username'];
			echo"<br />";
			echo"Your Contact number is ".$row['Contact'];
			echo"<br />";
			
		}
		
	
	
	$mysql_free_result($result);
	$db->close();
?>

</body>
</html>