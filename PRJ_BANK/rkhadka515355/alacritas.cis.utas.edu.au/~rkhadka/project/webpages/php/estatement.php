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
    //database ans session
include ("db_conn.php");
include'session.php';
    //session constraint
    if(!isset($_SESSION['session_user'])|| $_SESSION['session_user']==""){
        header('location:./login.php?err=Please login First');
			
    }else{
        //Access level constraint
        if($session_access=="BM"){
             header("location:./manager/manager.php");
        }
    }
    //get messgage alert
if(isset($_GET["msg"])){
	$message = $_GET['msg'];
	echo "<script type='text/javascript'>alert('".$message."');</script>";
}


?>
<!-- header -->
<header>
<div class="container" id="nav_container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><!-- navigation top --><?php include'nav.php' ?><script type="text/javascript" src="../../js/new.js" ></script></div>
    </div>
</header>
	<section id="space">
	<div>
      <div class="container" id="main_container">
	  <script>
                function myFunction() {
                    var a=$('#datefrom').val();
                    if(a==""){
                        alert('Please enter date');
                        return false;
                    }else{
                  if (confirm("Do you really wish to continue, you will be charged for the statement")) {
                    return true;
                  } else {
                    return false;
                  }
                }}
                </script>
          <!-- navigation left -->
	  <?php include 'aside.php';?>
        <div id="heading3" >
            <center><h3>&nbsp;&nbsp;&nbsp;User Feedback</h3></center>
        </div><div class="container">
          <!-- different peroid statement option -->
		<form method="post"  action="./estatement.php">
           <div> <span class="cool">From date</span> <input type='date' id="datefrom" name='from'></div> 
         <div> <button class="box" onclick=" return myFunction()" name="one" value="one">
          <img src="../../img/one%20month.png">
          <h3>one month</h3>
          <p>See your one months statement at $2.5 only</p>
        </button></div>
        <div><button class="box" onclick="return myFunction()" name="three" value="three">
          <img src="../../img/threemonth.png">
          <h3>Three month</h3>
          <p>See your Three months statement at $5 only</p>
        </button ></div>
        <div><button class="box" onclick="return myFunction()" name="six" value="six">
          <img src="../../img/six%20month.png">
          <h3>Six month</h3>
          <p>See your Six months statement at $7 only</p>
        </button></div>
        </form></div>
		</div>
		<div id="formTable">
            <!-- print statement area -->
			<table class="cool" id="rm_margin">
                <tr><th>Date</th>
                <th>Reference Number</th>
                <th>Sender Name</th>
                <th>Sender Account Number</th>
                <th>Sender BSB</th>
                <th>Sender's Bank</th>
                <th>Receiver Name</th>
                <th>Receiver Account Number</th>
                <th>Receiver BSB</th>
                <th>Receiver's Bank</th>
                <th>Currency</th>
                <th>Amount</th>
                <th>Detail about Transaction</th></tr>
                
                
                <?php
                if($_POST['one']=="one"){
                    $fromDate=$_POST['from'];
					$useracc=mysqli_query($db,"SELECT * from account WHERE acc_no=$session_account"); 
					$userB=mysqli_fetch_array($useracc);
				   $userBal=$userB['balance']-2.5;
				   if($userBal<=0){
					  header('location:./estatement.php?msg=Insufficient Balance');
				  }else{
					
				$userD=mysqli_query($db,"select * from detail where phone=".$session_uname."");
				$userDetail=mysqli_fetch_array($userD);
				$statement_cost=mysqli_query($db,"UPDATE account SET balance=".$userBal." WHERE acc_no=$session_account");
				$bank=mysqli_query($db,"SELECT balance from account WHERE acc_no=102000000");
				$bankBal=mysqli_fetch_array($bank);
				$newbal=$bankBal['balance']+2.5;
				$upload_bank=mysqli_query($db,"UPDATE account SET balance=".$newbal." WHERE acc_no=102000000");
				$statement="INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name,  t_currency, t_amt)  VALUES (".$session_account.",'Statement Fee','".$userDetail['fname']." ".$userDetail['mname']." ".$userDetail['lname']."', ".$userB['bsb'].",".$userB['acc_no'].",'Secure Bank Pvt. Ltd.','Secure Bank Pvt. Ltd.',102456,102000000,'Secure Bank Pvt. Ltd.','AUD',2.5)";
                $sql22="select * from transaction where t_date >= '".$fromDate."'-interval 1 month AND t_f_acc_no=$session_account UNION SELECT * FROM transaction WHERE t_date >= now()-interval 1 month AND t_t_acc_no=$session_account ORDER BY t_date DESC";
                $post=mysqli_query($db,$statement);
                $result_t=mysqli_query($db,$sql22);
                while($ro=$result_t->fetch_array(MYSQLI_ASSOC)){
                echo "<tr><td>".$ro['t_date']."</td><td>".$ro['t_ref']."</td><td>".$ro['t_f_name']."</td><td>".$ro['t_f_acc_no']."</td><td>".$ro['t_f_bsb']."</td><td>".$ro['t_f_bankname']."</td><td>".$ro['t_t_name']."</td><td>".$ro['t_t_acc_no']."</td><td>".$ro['t_t_bsb']."</td><td>".$ro['t_t_bank_name']."</td><td>".$ro['t_currency']."</td><td>".$ro['t_amt']."</td><td>".$ro['t_detail']."</td></tr>";
				   }
                   }
                }else if($_POST['three']=="three"){
                    $fromDate=$_POST['from'];
                    $useracc=mysqli_query($db,"SELECT * from account WHERE acc_no=$session_account"); 
					$userB=mysqli_fetch_array($useracc);
				   $userBal=$userB['balance']-5;
				   if($userBal<=0){
                    header('location:./estatement.php?msg=Insufficient Balance');
				  }else{
					
				$userD=mysqli_query($db,"select * from detail where phone=".$session_uname."");
				$userDetail=mysqli_fetch_array($userD);
				$statement_cost=mysqli_query($db,"UPDATE account SET balance=".$userBal." WHERE acc_no=$session_account");
				$bank=mysqli_query($db,"SELECT balance from account WHERE acc_no=102000000");
				$bankBal=mysqli_fetch_array($bank);
				$newbal=$bankBal['balance']+5;
				$upload_bank=mysqli_query($db,"UPDATE account SET balance=".$newbal." WHERE acc_no=102000000");
				$statement="INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name,  t_currency, t_amt)  VALUES (".$session_account.",'Statement Fee','".$userDetail['fname']." ".$userDetail['mname']." ".$userDetail['lname']."', ".$userB['bsb'].",".$userB['acc_no'].",'Secure Bank Pvt. Ltd.','Secure Bank Pvt. Ltd.',102456,102000000,'Secure Bank Pvt. Ltd.','AUD',5)";
                $sql22="select * from transaction where t_date >= '".$fromDate."'-interval 3 month AND t_f_acc_no=$session_account UNION SELECT * FROM transaction WHERE t_date >= '".$fromDate."'-interval 3 month AND t_t_acc_no=$session_account ORDER BY t_date DESC";
                $post=mysqli_query($db,$statement);
                $result_t=mysqli_query($db,$sql22);
                while($ro=$result_t->fetch_array(MYSQLI_ASSOC)){
                  echo "<tr><td>".$ro['t_date']."</td><td>".$ro['t_ref']."</td><td>".$ro['t_f_name']."</td><td>".$ro['t_f_acc_no']."</td><td>".$ro['t_f_bsb']."</td><td>".$ro['t_f_bankname']."</td><td>".$ro['t_t_name']."</td><td>".$ro['t_t_acc_no']."</td><td>".$ro['t_t_bsb']."</td><td>".$ro['t_t_bank_name']."</td><td>".$ro['t_currency']."</td><td>".$ro['t_amt']."</td><td>".$ro['t_detail']."</td></tr>";
                }
                   }
                }else if($_POST['six']=="six"){
                    $fromDate=$_POST['from'];
                   $useracc=mysqli_query($db,"SELECT * from account WHERE acc_no=$session_account"); 
					$userB=mysqli_fetch_array($useracc);
				   $userBal=$userB['balance']-7;
				   if($userBal<=0){
					  header('location:./estatement.php?msg=Insufficient Balance');
				  }else{
					
				$userD=mysqli_query($db,"select * from detail where phone=".$session_uname."");
				$userDetail=mysqli_fetch_array($userD);
				$statement_cost=mysqli_query($db,"UPDATE account SET balance=".$userBal." WHERE acc_no=$session_account");
				$bank=mysqli_query($db,"SELECT balance from account WHERE acc_no=102000000");
				$bankBal=mysqli_fetch_array($bank);
				$newbal=$bankBal['balance']+7;
				$upload_bank=mysqli_query($db,"UPDATE account SET balance=".$newbal." WHERE acc_no=102000000");
				$statement="INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name,  t_currency, t_amt)  VALUES (".$session_account.",'Statement Fee','".$userDetail['fname']." ".$userDetail['mname']." ".$userDetail['lname']."', ".$userB['bsb'].",".$userB['acc_no'].",'Secure Bank Pvt. Ltd.','Secure Bank Pvt. Ltd.',102456,102000000,'Secure Bank Pvt. Ltd.','AUD',7)";
                $sql22="select * from transaction where t_date >= '".$fromDate."'-interval 6 month AND t_f_acc_no=$session_account UNION SELECT * FROM transaction WHERE t_date >= '".$fromDate."'-interval 6 month AND t_t_acc_no=$session_account ORDER BY t_date DESC";
                $post=mysqli_query($db,$statement);
                $result_t=mysqli_query($db,$sql22);
                while($ro=$result_t->fetch_array(MYSQLI_ASSOC)){
                  echo "<tr><td>".$ro['t_date']."</td><td>".$ro['t_ref']."</td><td>".$ro['t_f_name']."</td><td>".$ro['t_f_acc_no']."</td><td>".$ro['t_f_bsb']."</td><td>".$ro['t_f_bankname']."</td><td>".$ro['t_t_name']."</td><td>".$ro['t_t_acc_no']."</td><td>".$ro['t_t_bsb']."</td><td>".$ro['t_t_bank_name']."</td><td>".$ro['t_currency']."</td><td>".$ro['t_amt']."</td><td>".$ro['t_detail']."</td></tr>";
                }
                   }
                }
                ?>
						</table>
					
        </div>
      </div>
	  </section>
    <!-- footer -->
    <footer id="footerplaceholder">
        <?php include'footer.php'; ?>
    </footer>
    </body></html>