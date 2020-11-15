<doctype! HTML>
<html>
<head>
<title>Welcome to </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../../css/new.css">
</head>
<body>
<?php
    //database and session
include '../db_conn.php';
include '../session.php';
    //session and access level constraints
    if($session_user==""){
        header("location:../login.php?err=Please Login to continue");
    }else{
        if($session_access=="Saving"||$session_access=="Business"){
            header("location:../account.php?msg=Unauthorised section");
        }else if($session_access!=="BM"){
             header("location:../signout.php");
        }
    }
    //update user's detail
    if($_POST["update"]=="submit"){
    
     $mname=$_POST['mname'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$type=$_POST['type'];
		$title=$_POST['title'];
        $did=$_POST['iid'];
        $v=$_POST['value'];
		$add1=$_POST['add1'];
		$add2=$_POST['add2'];
		$pass=sha1($_POST['pass']);
		$contact=$_POST['phone'] ;
//       echo "$fname<br>
//       $mname<br>
//		$lname<br>
//		$email<br>
//		$type<br>
//		$title<br>
//        $did<br>
//        $v<br>
//		$add1<br>
//		$add2<br>
//		$pass<br>
//		$contact<br>";
$update="UPDATE `detail` SET `title`='$title',`fname`='$fname',`mname`='$mname',`lname`='$lname',`email`='$email',`phone`='$contact',`address1`='$add1',`address2`='$add2',`type`='$type',`value`='$v',`password`='$pass' WHERE d_id='$did'";
	$result2=mysqli_query($db,$update);
    if($result2){
	header("location:user%20detail.php");
    }else{$message = "error occured";
			echo "<script type='text/javascript'>alert('".$message."');</script>";}
}
 //insert user's detail   
if($_POST["sign_up"]=="submit"){
	$mname=$_POST['mname'];
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$type=$_POST['type'];
		$title=$_POST['title'];
		$add1=$_POST['add1'];
		$add2=$_POST['add2'];
		$pass=sha1($_POST['pass']);
    
		$contact=$_POST['phone'] ;
		$query="INSERT INTO detail( title, fname, mname, lname, email, phone, address1, address2, type, value, password) VALUES ('".$title."','".$fname."','".$mname."','".$lname."','".$email."','".$contact."','".$add1."','".$add2."','".$type."','0','".$pass."')";
		if($db->query($query)==true){
			$message = "data send sucessfully";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
			header("Location: user%20detail.php");
		}else{
			$message = "error occured";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
		}
	}
    //delete user
if(isset($_GET["delid"])){
	$diid=$_GET["delid"];
		$sql2="DELETE FROM detail where d_id=$diid";
		$result2=mysqli_query($db,$sql2);
		header("location:user%20detail.php");
}
?>
    <!-- header -->
<header>
<div class="container" id="nav_container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><!-- top nav --><?php include'../nav.php' ?><script type="text/javascript" src="../../../js/new.js" ></script></div>
    </div>
</header>
	<section id="space">
        
      <div class="container" id="main_container">
          
        <div id="manager_table">
            <aside><button><a href="./manager.php">Back to main menu</a></button></aside>
<!--Search information About the Users-->
            <div><form method="post" id="search">Please Enter Users informtaion<br>
                to search&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="input_text">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="search" value="Search" form="search"></form></div>
      
        <?php
    //post code to search details about the user
    if($_POST["search"]=="Search"){
        echo '<script type="text/javascript">
$(document).ready(function(){
    $(".controlled").hide(0);
});</script>';
     //printing found result   
	echo"<div id='formTable'>
<center><h3> User details</h3></center>
<center><table border='1' id='rm_margin'>
<tr>
<th>Title</th>
<th>Name</th>
<th>Email</th>
<th>Address</th>
<th>Contact Number</th>
<th>Type</th>
<th>Grant</th>
<th>last_login</th>
<th>Edit</th>
<th>Delete</th>
</tr>";
$sql1='SELECT * FROM `detail` WHERE `title` LIKE "%'.$_POST["input_text"].'%" OR`fname` LIKE "%'.$_POST["input_text"].'%" OR `mname` LIKE "%'.$_POST["input_text"].'%" OR`lname` LIKE "%'.$_POST["input_text"].'%" OR`email` LIKE "%'.$_POST["input_text"].'%" OR`phone` LIKE "%'.$_POST["input_text"].'%" OR`address1` LIKE "%'.$_POST["input_text"].'%" OR`address2` LIKE "%'.$_POST["input_text"].'%" OR`type` LIKE "%'.$_POST["input_text"].'%" OR`value` LIKE "%'.$_POST["input_text"].'%" OR`last_login` LIKE "%'.$_POST["input_text"].'%"';
$result=mysqli_query($db,$sql1);
while($row=mysqli_fetch_array($result))
{

	
	echo'<tr>';
	echo'<td>'.$row["title"].'</td><td>'.$row["fname"].' '.$row["mname"].' '.$row["lname"].'</td><td>'.$row["email"].'</td><td>'.$row["address1"].' '.$row["address2"].'</td><td>'.$row["phone"].'</td><td>'.$row["type"].'</td><td>'.$row["value"].'</td><td>'.$row["last_login"].'</td>';
	echo '<td><a href="./user%20detail.php?eid='.$row["d_id"].'&etitle='.$row["title"].'&efname='.$row["fname"].'&emname='.$row["mname"].'&elname='.$row["lname"].'&eemail='.$row["email"].'&ephone='.$row["phone"].'&eadd1='.$row["address1"].'&eadd2='.$row["address2"].'&etype='.$row["type"].'&evalue='.$row["value"].'"> Edit</a></td>';
	echo '<td><a href="./user%20detail.php?delid='.$row['d_id'].'"> Delete</a> </td>';
	echo"</tr>";
	}
        echo "</table></div></center>";
         }
?>
<!--Display all users informtaion initially--> 
        <?php
	echo"<div class='controlled' id='formTable'>
<center><h3> User details</h3></center>
<center><table border='1' id='rm_margin'>
<tr>
<th>Title</th>
<th>Name</th>
<th>Email</th>
<th>Address</th>
<th>Contact Number</th>
<th>Type</th>
<th>Grant</th>
<th>last_login</th>
<th>Edit</th>
<th>Delete</th>
</tr>"; 
?>
<?php
$sql1='SELECT * FROM detail';
$result=mysqli_query($db,$sql1);
while($row=mysqli_fetch_array($result))
{

	
	echo'<tr>';
	echo'<td>'.$row["title"].'</td><td>'.$row["fname"].' '.$row["mname"].' '.$row["lname"].'</td><td>'.$row["email"].'</td><td>'.$row["address1"].' '.$row["address2"].'</td><td>'.$row["phone"].'</td><td>'.$row["type"].'</td><td>'.$row["value"].'</td><td>'.$row["last_login"].'</td>';
	echo '<td><a href="user detail.php?eid='.$row["d_id"].'&etitle='.$row["title"].'&efname='.$row["fname"].'&emname='.$row["mname"].'&elname='.$row["lname"].'&eemail='.$row["email"].'&ephone='.$row["phone"].'&eadd1='.$row["address1"].'&eadd2='.$row["address2"].'&etype='.$row["type"].'&evalue='.$row["value"].'"> Edit</a></td>';
	echo '<td><a href="user detail.php?delid='.$row['d_id'].'"> Delete</a> </td>';
	echo"</tr>";
	}

echo "</table></div></center>";
?>
            <!--Edit current user Informtaion--> 
<?php
if(isset($_GET["eid"])&&isset($_GET["efname"])&&isset($_GET["ephone"])&&isset($_GET["eemail"])&&isset($_GET["etype"])&&isset($_GET["evalue"])){
	echo'
<script type="text/javascript">
$(document).ready(function(){
    $("#new").hide(200);
});
</script>
<form method="post" onsubmit="return validateform();" id="edit">
<center><h3> Edit detail</h3></center>
<fieldset>
<legend>Enter the update data</legend>
<center><table>
<tr><td colspan="3">
  							<label>Title</label><br>
  							<select name="title">
										<option value ="'.$_GET["etitle"].'" selected>'.$_GET["etitle"].'</option>
									   <option value = "miss">Miss</option>
									   <option value = "mr">Mr.</option>
									   <option value = "ms">Ms.</option>
									   
									 </select></td></tr>
  						<tr>
  							<td><label>Frist Name</label><br>
  							<input type="text" placeholder="Frist Name" value="'.$_GET["efname"].'" id="fname" name="fname"></td>
							<td><label>Middel Name</label><br>
  							<input type="text" placeholder="Middel Name" value="'.$_GET["emname"].'" name="mname"></td>
							<td><label>Last Name</label><br>
  							<input type="text" placeholder="Last Name" id="lname" value="'.$_GET["elname"].'" name="lname"></td>
  						</tr>
						<tr><td colspan="2">
  							<label>Acount Type</label><br>
									 <select name="type">
										<option value="'.$_GET["etype"].'">'.$_GET["etype"].'</option>
									   <option value = "Saving">Saving</option>
									   <option value = "Business">Business</option>
									 </select>
  							</td><td><label>Acount Grant</label><br><select name="value">
										<option value ="'.$_GET["evalue"].'" selected>'; if($_GET["evalue"]==1){echo "Yes";}else if($_GET["evalue"]==0){echo "No";} echo'</option>
									   <option value = "0">No</option>
									   <option value = "1">Yes</option>
									   
									 </select></td></tr>
                            
						<tr>
  							<td><label>Email</label><br>
  							<input type="text" placeholder="Email" id="email" value="'.$_GET["eemail"].'" name="email"></td>
							<td><label>Phone</label><br>
  							<input type="text" placeholder="Phone" id="phone" value="'.$_GET["ephone"].'" name="phone"></td>
  						</tr>
						<tr>
							<td><label>Address 1</label><br>
  							<input type="text" placeholder="Address 1" id="add1" value="'.$_GET["eadd1"].'" name="add1"></td>
							<td><label>Address 2</label><br>
  							<input type="text" placeholder="Address 2" value="'.$_GET["eadd2"].'" name="add2"></td>
                            <td><input type="hidden" name="iid" value="'.$_GET["eid"].'"></td>
  						</tr>
						<tr>
							<td><label>Password</label><br>
  							<input type="password" placeholder="Password" name="pass"></td>
							<td><label>Confirm Password</label><br>
  							<input type="password" placeholder="Confirm Password" name="cpass"></td>
  						</tr>
  						<tr><td><button name="update" value="submit">Update</button></td><td><button class="button_1" name="" value="Insert new data"><a href=./user%20detail.php>Insert new data</a></button></td></tr>
						</table></center>
</fieldset>
</form>';
}
//Insert new users
   echo" <div id='new'>
          <center><h3> Insert Users</h3></center>
            <form class='quote' method='post' onsubmit='return validateform();' action=''>
			<center><table id='rm_margin'><tr>
			<td colspan='3'>
  							<label>Title</label><br>
  							<select name='title'>
										<option value = ''>select one</option>
									   <option value = 'miss'>Miss</option>
									   <option value = 'mr'>Mr.</option>
									   <option value = 'ms'>Ms.</option>
									   
									 </select></td></tr>
  						<tr>
  							<td><label>Frist Name</label><br>
  							<input type='text' placeholder='Frist Name' id='fname' name='fname'></td>
							<td><label>Middel Name</label><br>
  							<input type='text' placeholder='Middel Name' name='mname'></td>
							<td><label>Last Name</label><br>
  							<input type='text' placeholder='Last Name' id='lname' name='lname'></td>
  						</tr>
						<tr><td colspan='3'>
  							<label>Acount Type</label><br>
									 <select name='type''>
										<option value=''>Select one</option>
									   <option value = 'Saving''>Saving</option>
									   <option value = 'Business'>Business</option>
									 </select>
  							</td></tr>
						<tr>
  							<td><label>Email</label><br>
  							<input type='text' placeholder='Email' id='email' name='email'></td>
							<td><label>Phone</label><br>
  							<input type='text' placeholder='Phone' id='phone' name='phone'></td>
  						</tr>
						<tr>
							<td><label>Address 1</label><br>
  							<input type='text' placeholder='Address 1' id='add1' name='add1'></td>
							<td><label>Address 2</label><br>
  							<input type='text' placeholder='Address 2' name='add2'></td>
  						</tr>
						<tr>
							<td><label>Password</label><br>
  							<input type='password' placeholder='Password' name='pass'></td>
							<td><label>Confirm Password</label><br>
  							<input type='password' placeholder='Confirm Password' name='cpass'></td>
  						</tr>
                <tr><td><button class='button_1' name='sign_up' value='submit'>Register</button></td></tr>
						</table></center>
					</form>
        </div>";
            ?></div>
        </div>
	  </section>
    <!-- footer -->
    <footer id="footerplaceholder">
        <?php include'../footer.php'; ?>
    </footer>
    </body></html>