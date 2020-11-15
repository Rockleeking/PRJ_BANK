<?php
//database and session
include 'db_conn.php';
include 'session.php';
//receive transaction details
if($_POST["transfer"]=="transfer"){
    $limit_total;
    //setting transcation limit per day
    if($session_access=="Saving"){
        $limit_total=10000;
    }else if($session_access=="Business"){
        $limit_total=50000;
    }else if($session_access=="BANK"){
         $limit_total=9999999999;
    }
    $spend="";
    $senderBal="";
    $receiverBal="";
    //fetching values
    $sql1='SELECT * FROM detail where phone="'.$_SESSION['session_uname'].'"';
    $result1=mysqli_query($db,$sql1);
    while($rowm=mysqli_fetch_array($result1)){
        //checking password
    if(sha1($_POST["pass"])==$rowm['password']){
    if($rowm['mname']==""){
			$fName=$rowm['fname']." ".$rowm['lname'];
		}else{
			$fName=$rowm['fname']." ".$rowm['mname']." ".$rowm['lname'];
		}
	$tAccNo=$_POST['tAccNo'];
	$tName = $_POST['tAccName'];
	$info=$_POST['info'];
    $amount=$_POST['amount'];
	$sql2='SELECT acc_no FROM opening where d_id="'.$rowm['d_id'].'"';
	$result2=mysqli_query($db,$sql2);
	$fAccN=mysqli_fetch_array($result2);
	$fAccNo=$fAccN['acc_no'];
	$fbank="Secure Bank Pvt. Ltd.";
	//$tAccNo=$_POST['tAccNo'];
	$tbsb=$_POST['tbsb'];
	//$tbank=$_POST['tbank'];
    $sql5='SELECT * From account where acc_no="'.$fAccNo.'"';
    $result5=mysqli_query($db,$sql5);
    $row5=mysqli_fetch_array($result5);
    $fbsb=$row5['bsb'];
    $senderBal=$row5['balance'];
    $tbank=$_POST['bname'];
    $tC=$_POST['Currency'];
        if($amount<=0){
        header('location:./transaction.php?msg=Please enter an valid positive amount to transfer!!!');
    }else{
            //converting cross currency values
        if($tC=="GBP"){
            $tamount=$amount*1.85;
        }else if($tC=="USD"){
            $tamount=$amount*1.46;
        }else if($tC=="AUD"){
            $tamount=$amount;
        }
       //checking daily transaction limit
   $day=mysqli_query($db,"select t_amt from transaction where t_date >= now()-interval 1 day AND t_f_acc_no=$session_account");
	while($spending=mysqli_fetch_array($day)){
        $a=$spending["t_amt"];
       // echo "<script>alert('$a');</script>";
        $spend=$spend+$spending['t_amt'];
    }
        if(($tamount+$spend)>$limit_total){
            header('location:./transaction.php?msg=Daily transaction limit exceeded!!!');
        }else{
     //for Inter Bank transfer   
	if($_POST['type']=="Internal"){
		$type="internal";
		$tbank="Secure Bank Pvt. Ltd.";
		$sql3='SELECT uname From opening where acc_no="'.$tAccNo.'"';
		$result3=mysqli_query($db,$sql3);
		$tAcc=mysqli_fetch_array($result3);
		$sql4='SELECT * From detail where phone="'.$tAcc['uname'].'"';
		$result4=mysqli_query($db,$sql4);    
		$row4=mysqli_fetch_array($result4);
        //checking transaction constrains
            if($tC!="AUD" && $row4['type']!="Business"){
                header('location:./transaction.php?msg= foreign currency tranfer is only posible between business accounts!!!');
            }else{
		if($row4['mname']==""){
			$tcName=$row4['fname']." ".$row4['lname'];
		}else{
			$tcName=$row4['fname']." ".$row4['mname']." ".$row4['lname'];
		}
                //checking input Name and account number;s name
			if($tName==$tcName){
				//checking Balance
			if($senderBal<=$amount){
				header('location:./transaction.php?msg=Insufficient Balance!!!');
			}else{
		$sql6='SELECT * From account where acc_no="'.$tAccNo.'"';
		$result6=mysqli_query($db,$sql6);
		$row6=mysqli_fetch_array($result6);
			$tAccNo=$row6['acc_no'];
			$a=$row6['acc_no'];
			$tbsb=$row6['bsb'];
            $receiverBal=$row6['balance'];
                if($tamount>25000){
                    //transaction set to send for approval
                    $senderBal=$senderBal-$amount;
                $sql00="UPDATE account SET balance=$senderBal WHERE acc_no=$fAccNo";
                $receiverBal=$receiverBal+$amount;
                $sql01="UPDATE account SET balance=$receiverBal WHERE acc_no=$tAccNo";
                $sql07='INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name, t_currency, t_amt )  VALUES ('.$fAccNo.',"'.$info.'","'.$fName.'",'.$fbsb.','.$fAccNo.',"'.$fbank.'","'.$tName.'",'.$tbsb.','.$tAccNo.',"'.$tbank.'", "'.$tC.'",'.$amount.')';
                $sql107="INSERT INTO approval (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name, t_currency, t_amt, sq3)  VALUES ($fAccNo,'$info','$fName',$fbsb,$fAccNo,'$fbank','$tName',$tbsb,$tAccNo,'$tbank','$tC',$amount,'$sql07')";
                    $result107=mysqli_query($db,$sql107);
                   header('location:./transaction.php?msg=Send to manager for approval please contact Bank Manager!!!');
                }else{
			//deducing sender balance
			$senderBal=$senderBal-$tamount;
			$sql00="UPDATE account SET balance=$senderBal WHERE acc_no=$fAccNo";
			$resulta=mysqli_query($db,$sql00);
            //increasing receiver balance
			$receiverBal=$receiverBal+$tamount;
			$sql01="UPDATE account SET balance=$receiverBal WHERE acc_no=$tAccNo";
			$resultb=mysqli_query($db,$sql01);
            //recording transaction
			$sql07="INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name, t_currency, t_amt )  VALUES ($fAccNo,'$info','$fName',$fbsb,$fAccNo,'$fbank','$tName',$tbsb,$tAccNo,'$tbank', '$tC', $amount)";
              $result07=mysqli_query($db,$sql07);      
	header('location:./transaction.php?msg=Transfer Sucessful!!!\\npayment for: '.$info.'\\n Paid amount: '.$tamount.'');
                } }
			}else{
			header('location:./transaction.php?msg=Account name and account numbers dosent match!!!');
    }
        }  }else{//for intra bank transfer
        if($tamount>25000){
                //transaction set for approval
                    $senderBal=$senderBal-$tamount;
                $sql00="UPDATE account SET balance=$senderBal WHERE acc_no=$fAccNo";
                $sql07="INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name,  t_currency, t_amt)  VALUES ($fAccNo,'$info','$fName',$fbsb,$fAccNo,'$fbank','$tName',$tbsb,$tAccNo,'$tbank', '$tC', $amount)";
                $sql107="INSERT INTO approval (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name, t_currency, t_amt, sq3)  VALUES ($fAccNo,'$info','$fName',$fbsb,$fAccNo,'$fbank','$tName',$tbsb,$tAccNo,'$tbank','$tC',$amount,'$sql07')";
                $result107=mysqli_query($db,$sql107);
            header('location:./transaction.php?msg=Send to manager for approval please contact Bank Manager!!!');
                }else{
            //deducing sender balance
		      $senderBal=$senderBal-$tamount;
			$sql00="UPDATE account SET balance=$senderBal WHERE acc_no=$fAccNo";
			$resulta=mysqli_query($db,$sql00);
            //recording transaction
			$sql07="INSERT INTO transaction (t_acc_no, t_detail, t_f_name, t_f_bsb, t_f_acc_no, t_f_bankname, t_t_name, t_t_bsb, t_t_acc_no, t_t_bank_name, t_currency, t_amt )  VALUES ($fAccNo,'$info','$fName',$fbsb,$fAccNo,'$fbank','$tName',$tbsb,$tAccNo,'$tbank', '$tC', $amount)";
			$result07=mysqli_query($db,$sql07);
			header('location:./transaction.php?msg=Transfer Sucessful!!!\\npayment for: '.$info.'\\n Paid amount: '.$tamount.'');
        }  }
    }}}else{
	header('location:./transaction.php?msg=your password dosent match!!!');
}
}
}

?>