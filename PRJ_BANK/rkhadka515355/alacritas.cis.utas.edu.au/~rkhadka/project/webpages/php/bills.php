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
    //database and session
include 'db_conn.php';
    include'session.php';
    if(!isset($_SESSION['session_user'])|| $_SESSION['session_user']==""){
        header('location:./login.php?err=Please login First');
    }
    //checking access level
    if($session_access=="BM"){
             header("location:./manager/manager.php");

    }
    //message alert for reg
if(isset($_GET["reg"])){
	$message = "Registered sucessfully";
	echo "<script type='text/javascript'>alert('".$message."');</script>";
}
?>
    <!-- header -->
<header>
<div class="container" id="nav_container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><!-- top nav --><?php include'nav.php' ?><script type="text/javascript" src="../../js/new.js" ></script></div>
    </div>
</header>	
    <section id="space"><!-- left nav -->
<?php include'aside.php' ?>
		 <div id="formTable">
             <!-- Payemnt form -->
<div class="container">
            <form class="quote" method="post" onsubmit="return validtrans();" action="./operation.php">
			<table class="cool" id="table1">
						<tr>
			<td colspan="3">
							<h4>Payment To</h4></td></tr>
  							<tr><td>
                                <select name="tAccName" id="billSel"><option value="Water Department Goverment">Water bills</option><option value="Electricity Department Goverment">Electricity bills</option><option value="NBN Internet Corporation">NBN bills</option></select></td>
  						</tr><tr><td><label>Customer number</label><br>
  							<input type="text" placeholder="Customer Number" name="cnumber"></td>
  						</tr>
						<tr>
  							<td><label>Amount</label><br>
  							<input type="hidden"value="012000" placeholder="BSB" id="tbsb" name="tbsb"><input type="hidden" value="102002002" id="tAccNo" name="tAccNo"><input type="number" placeholder="Amount" id="amount" name="amount"><input type="hidden" value="External"id="info" name="type"><input type="hidden" placeholder="Reason for Transfer" value="bill Payment"id="info" name="info"><input type="hidden" id="bname" value="ABC Bank" name="bname"><input type="hidden" value="AUD" name="Currency"></td>
  						</tr>	
							<tr><td><label>Password</label><br>
  							<input type="password" placeholder="Password" name="pass"></td>
  						</tr>
  						<tr><td><input type="submit" name="transfer" value="transfer"/></td></tr>
						</table>
					</form>
        </div>
      </div>

    

	</section>
<!-- footer -->
    <footer id="footerplaceholder">        <?php include'footer.php'; ?>
    </footer>
  </body>
</html>
