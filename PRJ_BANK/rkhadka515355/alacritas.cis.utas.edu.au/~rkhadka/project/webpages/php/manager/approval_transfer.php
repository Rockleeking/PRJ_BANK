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
    //session and database
include '../db_conn.php';
include '../session.php';
    //session and access level contraints 
    if($session_user==""){
        header("location:../login.php?err=Please Login to continue");
    }else{
        if($session_access=="Saving"||$session_access=="Business"){
            header("location:../account.php?msg=Unauthorised section");
        }else if($session_access!=="BM"){
             header("location:../signout.php");
        }
    }
    //del transcation approval
    if(isset($_GET["deltrans"])){
	$diid=$_GET["deltrans"];
		$sql2="DELETE FROM approval where d_id=$diid";
		$result2=mysqli_query($db,$sql2);
		header("location:./approval_transfer.php");
}
    //approve transction
    if(isset($_GET["accepttrans"])){
$tamount="";
$did=$_GET["accepttrans"];
$query1=mysqli_query($db,"SELECT * FROM approval where a_ref=".$did."");
$exeQue=mysqli_fetch_array($query1);
    $senderAcc_no=$exeQue['t_f_acc_no'];
    $receiverAcc_no=$exeQue['t_t_acc_no'];
    $query2=mysqli_query($db,"Select balance from account where acc_no=".$senderAcc_no."");
    $query3=mysqli_query($db,"Select balance from account where acc_no=".$receiverAcc_no."");
    $exeQue1=mysqli_fetch_array($query2);
	$exeQue2=mysqli_fetch_array($query3);
    $amount=$exeQue['t_amt'];
    $senderBal=$exeQue1['balance'];
    $reveiverBal=$exeQue2['balance'];
	echo "<script>alert('$reveiverBal');</script>";
    echo "<script>alert('$senderBal');</script>";
    $tC=$exeQue['t_currency'];
        if($tC=="GBP"){
            $tamount=$amount*1.85;
        }else if($tC=="USD"){
            $tamount=$amount*1.46;
        }else if($tC=="AUD"){
            $tamount=$amount;
        }
        
		//record the transaction	
			$sqlc=$exeQue['sq3'];
	$qsqc=mysqli_query($db,$sqlc);
        if($qsqc){
            //deduct sender balance
            $senderBal=$senderBal-$tamount;
			$sql00="UPDATE account SET balance=$senderBal WHERE acc_no=$senderAcc_no";
			$resulta=mysqli_query($db,$sql00);
        //add receiver balance
			$reveiverBal=($reveiverBal)+intval($tamount);
			$sql01="UPDATE account SET balance=$reveiverBal WHERE acc_no=$receiverAcc_no";
            $resultb=mysqli_query($db,$sql01);
        //delete approved transaction in approval table from database
	$qsqd=mysqli_query($db,"DELETE FROM `approval` WHERE a_ref=$did");
    header("location:./approval_transfer.php");
        }else{
            echo "<script>alert('Error occured please contact bank is he problem persist!!!')</script>";
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
            <!-- nav left --><aside><button><a href="./manager.php">Back to main menu</a></button></aside>
    <?php
    //approval pending transaction area
	echo"<div class='controlled' id='formTable'>
<center>
<h3> Pending Approvals</h3></center>
<center><table id='rm_margin' border='1'>
<tr>
                <th>Date</th>
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
                <th>Detail about Transaction</th>
                <th>Approve</th>
                <th>Delete</th>
</tr>";
?>
<?php
                   // $sql22="select * from transaction";
                $sql1='SELECT * FROM approval';
                $result=mysqli_query($db,$sql1);
                while($ro=mysqli_fetch_array($result))
                {
                  echo "<tr><td>".$ro['t_date']."</td><td>".$ro['a_ref']."</td><td>".$ro['t_f_name']."</td><td>".$ro['t_f_acc_no']."</td><td>".$ro['t_f_bsb']."</td><td>".$ro['t_f_bankname']."</td><td>".$ro['t_t_name']."</td><td>".$ro['t_t_acc_no']."</td><td>".$ro['t_t_bsb']."</td><td>".$ro['t_t_bank_name']."</td><td>".$ro['t_currency']."</td><td>".$ro['t_amt']."</td><td>".$ro['t_detail']."</td>";
                    echo '<td ><a href="./approval_transfer.php?accepttrans='.$ro["a_ref"].'"><img src="../../../img/check.png" style=" width: 30px; height: 20px; " alt="Accept the bank account detail" /></a></td>';
                    echo '<td><a href="./approval_transfer.php?deltrans='.$ro['a_ref'].'"> Delete</a> </td>';
                    echo"</tr>";
                }
            echo"</table></center>"
                ?>

</div>
        </div>
	  </section>
    <!-- footer -->
    <footer id="footerplaceholder">
        <?php include'../footer.php'; ?>
    </footer>
    </body></html>