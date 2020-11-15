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
    //session adn access level constraints
    if($session_user==""){
        header("location:../login.php?err=Please Login to continue");
    }else{
        if($session_access=="Saving"||$session_access=="Business"){
            header("location:../account.php?msg=Unauthorised section");
        }else if($session_access!=="BM"){
             header("location:../signout.php");
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
      <div class="container">
            <!-- left nav --> <aside><button><a href="./manager.php">Back to main menu</a></button></aside>            
<script>
                function myFunction() {
                var a=$('#datefrom').val();
                    if(a==""){
                        alert('Please enter date');
                        return false;
                    }else{
                    return true;
                }
                }
                </script><!--  statement peroid selection area-->
<?php
       echo" <div id='heading3' >
          <center><h3>&nbsp;&nbsp;&nbsp;Statements</h3><center>
        </div>
		<form method='post' action=''>
        <div><span>From date</span> <input type='date' id='datefrom' name='from'></div>
            
         <div> <button class='box' onclick=' return myFunction()' name='one' value='one'>
          <h3>One month</h3>
          <p>See your one months statement </p>
        </button>
        <button class='box' onclick='return myFunction()' name='three' value='three'>
          <h3>Three month</h3>
          <p>See your Three months statement </p>
        </button >
        <button class='box' onclick='return myFunction()' name='six' value='six'>
          <h3>Six month</h3>
          <p>See your Six months statement </p>
        </button></div>
        </form>
		</div>
        ";?><div id="manager_table"><!-- display statement area -->
          <?php
          echo"
		<div class='controlled' id='formTable'>
			<table class='cool' id='rm_margin'>
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
                ";
                ?>
                <?php
                   //post controller as per time peroid";
                if($_POST['one']=="one"){
                    $fromDate=$_POST['from'];
                $sql22="select * from transaction where t_date >= '".$fromDate."' - interval 1 month ORDER BY t_date DESC";
                $result_t=mysqli_query($db,$sql22);
                while($ro=$result_t->fetch_array(MYSQLI_ASSOC)){
                  echo "<tr><td>".$ro['t_date']."</td><td>".$ro['t_ref']."</td><td>".$ro['t_f_name']."</td><td>".$ro['t_f_acc_no']."</td><td>".$ro['t_f_bsb']."</td><td>".$ro['t_f_bankname']."</td><td>".$ro['t_t_name']."</td><td>".$ro['t_t_acc_no']."</td><td>".$ro['t_t_bsb']."</td><td>".$ro['t_t_bank_name']."</td><td>".$ro['t_currency']."</td><td>".$ro['t_amt']."</td><td>".$ro['t_detail']."</td></tr>";
				   }
                }else if($_POST['three']=="three"){
                     $fromDate=$_POST['from'];
                $sql22="select * from transaction where t_date >= '".$fromDate."' - interval 3 month ORDER BY t_date DESC";
                $result_t=mysqli_query($db,$sql22);
                while($ro=$result_t->fetch_array(MYSQLI_ASSOC)){
                  echo "<tr><td>".$ro['t_date']."</td><td>".$ro['t_ref']."</td><td>".$ro['t_f_name']."</td><td>".$ro['t_f_acc_no']."</td><td>".$ro['t_f_bsb']."</td><td>".$ro['t_f_bankname']."</td><td>".$ro['t_t_name']."</td><td>".$ro['t_t_acc_no']."</td><td>".$ro['t_t_bsb']."</td><td>".$ro['t_t_bank_name']."</td><td>".$ro['t_currency']."</td><td>".$ro['t_amt']."</td><td>".$ro['t_detail']."</td></tr>";
                }
                }else if($_POST['six']=="six"){ 
                $fromDate=$_POST['from'];
                $sql22="select * from transaction where t_date >= '".$fromDate."' - interval 6 month ORDER BY t_date DESC";
                $result_t=mysqli_query($db,$sql22);
                while($ro=$result_t->fetch_array(MYSQLI_ASSOC)){
                  echo "<tr><td>".$ro['t_date']."</td><td>".$ro['t_ref']."</td><td>".$ro['t_f_name']."</td><td>".$ro['t_f_acc_no']."</td><td>".$ro['t_f_bsb']."</td><td>".$ro['t_f_bankname']."</td><td>".$ro['t_t_name']."</td><td>".$ro['t_t_acc_no']."</td><td>".$ro['t_t_bsb']."</td><td>".$ro['t_t_bank_name']."</td><td>".$ro['t_currency']."</td><td>".$ro['t_amt']."</td><td>".$ro['t_detail']."</td></tr>";
                }
                }
                echo"
						</table>
					
        </div>";
       ?></div>
        </div>
	  </section>
    <!-- footer -->
    <footer id="footerplaceholder">
        <?php include'../footer.php'; ?>
    </footer>
    </body></html>