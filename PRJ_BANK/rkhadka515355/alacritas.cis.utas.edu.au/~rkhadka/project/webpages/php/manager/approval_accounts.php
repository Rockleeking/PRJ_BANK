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
    //session constrains
    if($session_user==""){
        header("location:../login.php?err=Please Login to continue");
    }else{
        //user access contraints
        if($session_access=="Saving"||$session_access=="Business"){
            header("location:../account.php?msg=Unauthorised section");
        }else if($session_access!=="BM"){
             header("location:../signout.php");
        }
    }
    //delete account approval
   if(isset($_GET["delid"])){
	$diid=$_GET["delid"];
		$sql2="DELETE FROM detail where d_id=$diid";
		$result2=mysqli_query($db,$sql2);
		header("location:approval_accounts.php");
}
    //accept account approval
    if(isset($_GET["accept"])){
	$did=$_GET["accept"];
    $acc_no="";
    $sql111=mysqli_query($db,"Select acc_no from account where occupied=0");
    while($set_acc=mysqli_fetch_array($sql111)){
        $acc_no=$set_acc['acc_no'];
       // echo $acc_no;
        break;
        
    }
  
    $sql20=mysqli_query($db,"Select phone from detail where d_id=$did");
    $uname=mysqli_fetch_array($sql20);
    //link user with a bank account detail
    $sql21=mysqli_query($db,"Insert into `opening`(`acc_no`, `d_id`, `uname`) VALUES ($acc_no,$did,'".$uname['phone']."')");
     If(sql21){
         //update and finalise assosiation
        $result22=mysqli_query($db,"UPDATE `account` SET `occupied`=1 where acc_no=$acc_no");
        $result20=mysqli_query($db,"UPDATE `detail` SET `value`=1 where d_id=$did");
        header("location:approval_accounts.php");
    }	
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
            <!-- nav left --> <aside><button><a href="./manager.php">Back to main menu</a></button></aside>
            <!-- print pending accoount detail area -->
    <?php
	echo"<div class='controlled' id='formTable'>
<center>
<h3> New Account Pending Approvals</h3></center><center><table border='1' id='rm_margin'>
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
$sql1='SELECT * FROM detail Where value=0';
$result=mysqli_query($db,$sql1);
while($row=mysqli_fetch_array($result))
{

	
	echo'<tr>';
    echo'<td>'.$row["title"].'</td><td>'.$row["fname"].' '.$row["mname"].' '.$row["lname"].'</td><td>'.$row["email"].'</td><td>'.$row["address1"].' '.$row["address2"].'</td><td>'.$row["phone"].'</td><td>'.$row["type"].'</td><td>'.$row["value"].'</td><td>'.$row["last_login"].'</td>';
	echo '<td ><a href="approval_accounts.php?accept='.$row["d_id"].'"><img src="../../../img/check.png" style="
    width: 30px;
    height: 20px;
" alt="Accept the bank account detail" /></a></td>';
	echo '<td><a href="approval_accounts.php?delid='.$row['d_id'].'"> Delete</a> </td>';
	echo"</tr>";
	}
echo"</table></center>";
            ?>

</div>
        </div>
	  </section>
    <!-- footer -->
    <footer id="footerplaceholder">
        <?php include'../footer.php'; ?>
    </footer>
    </body></html>