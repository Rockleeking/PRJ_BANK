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
    //session start and database connection
include '../db_conn.php';
include '../session.php';
    //validate session and access level constraints
    if($session_user==""){
        header("location:../login.php?err=Please Login to continue");
    }else{
        if($session_access=="Saving"||$session_access=="Business"){
            header("location:../account.php?msg=Unauthorised section");
        }else if($session_access!=="BM"){
             header("location:../signout.php");
        }
    }
    //get message alert field
    if(isset($_GET["msg"])){
	$message = $_GET['msg'];
	echo "<script type='text/javascript'>alert('".$message."');</script>";
}
    //delete card request
   if(isset($_GET["delid"])){
	$diid=$_GET["delid"];
		$sql2="DELETE FROM card where card_no=$diid";
		$result2=mysqli_query($db,$sql2);
		header("location:card_management.php");
}
    // Accept credit card request
    if(isset($_GET["accept"])){  
        $deduct=0;
        $card_no=$_GET["accept"];
        $accNo=mysqli_query($db,"SELECT * from card WHERE card_no=$card_no");
        $acc_no=mysqli_fetch_array($accNo);
        // annual charge according to account number
        if($acc_no['card_type']=="Saving"){
            $deduct=50;
        }else if($acc_no['card_type']=="Business"){
            $deduct=100;
        }
        //collecting associated account number
        $s_account=$acc_no['acc_no'];
        $useracc=mysqli_query($db,"SELECT * from account WHERE acc_no=$s_account"); 
					$userB=mysqli_fetch_array($useracc);
        
				   $userBal=$userB['balance']-$deduct;
				   if($userBal<=0){
					  header('location:./card_management.php?msg=Acount holder does not have sufficient balance');
				  }else{
				$user=mysqli_query($db,"select * from opening where acc_no=".$s_account."");
                     $userphone=mysqli_fetch_array($user);  
				$userD=mysqli_query($db,"select * from detail where phone=".$userphone['uname']."");
				$userDetail=mysqli_fetch_array($userD);
                //deducing balance from user
				$statement_cost=mysqli_query($db,"UPDATE account SET balance=".$userBal." WHERE acc_no=$s_account");
				$bank=mysqli_query($db,"SELECT balance from account WHERE acc_no=102000000");
				$bankBal=mysqli_fetch_array($bank);
                //Adding balance to Bank Account       
				$newbal=$bankBal['balance']+$deduct;
				$upload_bank=mysqli_query($db,"UPDATE account SET balance=".$newbal." WHERE acc_no=102000000");
				//recording transaction
               $statement="INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name,  t_currency, t_amt)  VALUES (".$s_account.",'Credit card Fee','".$userDetail['fname']." ".$userDetail['mname']." ".$userDetail['lname']."', ".$userB['bsb'].",".$userB['acc_no'].",'Secure Bank Pvt. Ltd.','Secure Bank Pvt. Ltd.',102456,102000000,'Secure Bank Pvt. Ltd.','AUD',$deduct)";
              $post=mysqli_query($db,$statement);
              
        if($post){
            //approve credit card 
        $result22=mysqli_query($db,"UPDATE `card` SET `card_grant`=1 where card_no=$card_no");
        if($result22){
            
        header("location:card_management.php?msg=Credit card approval completed");
        }
    }else{  
                           header('location:./card_management.php?msg=Error printing transaction');
                           
                       }}
    }	
    ?><!-- header -->
    <header>
<div class="container" id="nav_container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><!-- navigation --><?php include'../nav.php' ?><script type="text/javascript" src="../../../js/new.js" ></script></div>
    </div>
</header>
	<section id="space">
      <div class="container" id="main_container">
          
        <div id="manager_table">
             <aside><!-- left side navigation --><button><a href="./manager.php">Back to main menu</a></button></aside>
    <?php
    //available card request view table
	echo"<div class='controlled' id='formTable'>
<center>
<h3> New Card Pending Approvals</h3></center><center><table border='1' id='rm_margin'>
<tr>
<th>Card Number</th>
<th>Account Number</th>
<th>Account Type</th>
<th>Accound holder</th>
<th>Grant</th>
<th>Delete</th>
</tr>";
            ?>
<?php
$sql1='SELECT * FROM card Where card_grant=0';
$result=mysqli_query($db,$sql1);
while($row=mysqli_fetch_array($result))
{
    $sql1=mysqli_query($db,'SELECT uname FROM opening Where acc_no='.$row["acc_no"].'');
    $acc=mysqli_fetch_array($sql1);
    $sql2=mysqli_query($db,'SELECT * FROM detail Where phone='.$acc["uname"].'');
    $acc=mysqli_fetch_array($sql2);
	
	echo'<tr>';
    echo'<td>'.$row["card_no"].'</td><td>'.$row["acc_no"].'</td><td> '.$row["card_type"].'</td><td> '.$acc["fname"].' '.$acc["mname"].' '.$acc["lname"].'</td>';
	echo '<td ><a href="./card_management.php?accept='.$row["card_no"].'"><img src="../../../img/check.png" style="
    width: 30px;
    height: 20px;
" alt="Accept the bank account detail" /></a></td>';
	echo '<td><a href="./card_management.php?delid='.$row["card_no"].'"> Delete</a> </td>';
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