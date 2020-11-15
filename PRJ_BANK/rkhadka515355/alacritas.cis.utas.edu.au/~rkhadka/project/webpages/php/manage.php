<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Page</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
</head>
<body>
<?php
include'db_conn.php';
/*session_start();*/

if($_POST["esubmit"]=="submit"){
	$eid=$_POST["eid"];	
	$euname=$_POST["euname"];
	$epass=$_POST["epass"];
	$edesc=$_POST["edescription"];
	$update='UPDATE login_admin SET uname="'.$euname.'", password="'.$epass.'", description="'.$edesc.'", date_created=now() WHERE login_id="'.$eid.'"';
	$result2=mysqli_query($db,$update);
	header("location:manage.php");
}
if($_POST["submit"]=="submit"){
	$id=$_POST["id"];	
	$uname=$_POST["uname"];
	$pass=$_POST["pass"];
	$desc=$_POST["description"];
	$insert="INSERT INTO login_admin (uname, password, description) VALUES ('".$uname."','".$pass."','".$desc."')";
	$result3=mysqli_query($db,$insert);
	header("location:manage.php");
}
		
if(isset($_GET["did"])){
	$did=$_GET["did"];
		$sql2='delete FROM login_admin where login_id="'.$did.'"';
		$result2=mysqli_query($db,$sql2);
		header("location:manage.php");
}
/*if(!$_SESSION["uname"]){
header("location:login.php");
}elseif (isset($_GET["logout"])){
$_SESSION["uname"]="";
header("location:login.php");
}*/

?>
<center>
<table border="1">
<tr>
<th>Created/Updated date</th>
<th>uname</th>
<th>Description</th>
<th>Edit</th>
<th>Delete</th>
</tr>
<?php
$sql1='SELECT * FROM login_admin';
$result=mysqli_query($db,$sql1);
while($row=mysqli_fetch_array($result))
{
	$artid=$row["login_id"];
	$uname=$row["uname"];
	$desc=$row["description"];
	
	echo'<tr>';
	echo'<td class="dbRow">'.$row["date_created"].'</td><td class="dbRow">'.$row["uname"].'</td><td class="dbRow">'.$row["description"].'</td>';
	echo '<td><a href="manage.php?eid='.$artid.'&euname='.$uname.'&edesc='.$desc.'"> Edit</a></td>';
	echo '<td><a href="manage.php?did='.$artid.'"> Delete</a> </td>';
	echo"</tr>";
	}
?>
</table>
</center><center>
<?php
if(isset($_GET["eid"])&&isset($_GET["euname"])&&isset($_GET["edesc"])){
	echo'
<script type="text/javascript">
$(document).ready(function(){
    $("#new").hide(200);
});
</script>
<form method="post" id="edit">
<fieldset>
<legend>Enter the update data</legend>
<table border="1">
<tr><td>User name</td><td><input type="text" value= "'.$_GET["euname"].'" name="euname"></td></tr>
<tr><td>Password</td><td><input type="password" value="" name="epass"/></td></tr>
<tr><td>Confirm password</td><td><input type="password" value=""name="confirm_epass"/></td></tr>
<tr><td>Description</td><td><input type="text" value="'.$_GET["edesc"].'" name="edescription"/></td></tr>
<tr><td><input type="submit" name="esubmit" value="submit"></td><td><input type="hidden" value="'.$_GET["eid"].'" name="eid"></td></tr>
</table>
</fieldset>
</form>';
}?>
<center>
<form method="post" id="new">
<fieldset>
<legend>Create new data</legend>
<table border="1">
<tr><td>User name</td><td><input type="text" value= "" name="uname"></td></tr>
<tr><td>Password</td><td><input type="password" value="" name="pass"/></td></tr>
<tr><td>Confirm password</td><td><input type="password" value=""name="confirm_pass"/></td></tr>
<tr><td>Description</td><td><input type="text" value="" name="description"/></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="submit"></td></tr>
</table>
</fieldset>
</form>
</center>


</center>
</body>
</html>