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
include ("db_conn.php");
include'session.php';
    if(!isset($_SESSION['session_user'])|| $_SESSION['session_user']==""){
        header('location:./login.php?err=Please login First');
    }
    //checking access level
    if($session_access=="BM"){
             header("location:./manager/manager.php");
        }
    //get alert for message
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
    <div id="nplaceholder"><?php include'nav.php' ?><script type="text/javascript" src="../../js/new.js" ></script></div></div>
    </header>
    <section id="space">
       <!-- left side navigation -->
<?php include'aside.php' ?>
		 <div id="formTable">
<div class="container">
	
       <!-- Transfer amount table -->
            <form class="quote" method="post" onsubmit="return validtrans();" action="operation.php">
			<table class="cool" id="table1">
						<tr>
			<td colspan="3">
							<h4>Transfer To</h4></td></tr>
  							<tr><td><label>Account holder's Name</label><br>
  							<input type="text" placeholder="Account holder's Name" id="tAccName" name="tAccName"></td>
							<td><label>BSB</label><br>
  							<input type="number" placeholder="BSB" id="tbsb" name="tbsb"></td>
							<td><label>Account Number</label><br>
  							<input type="number" placeholder="Account Number" id="tAccNo" name="tAccNo"></td>
  						</tr>
						<tr>
  							<td><label>Amount</label><br>
  							<input type="number" placeholder="Amount" id="amount" name="amount"></td>
							<td <?php 
                                    if($session_access==Saving){ 
                                    echo "style='visibility:hidden;'";}
                                ?> >
  							<label>Curency Type</label><br>
									 <select name="Currency">
										<option value="AUD" selected>AUD</option>
									   <option value = "GBP">GBP</option>
									   <option value = "USD">USD</option>
									 </select>
  							</td><td><label>Reason for Transfer</label><br>
  							<input type="text" placeholder="Reason for Transfer" id="info" name="info"></td>
  						</tr>
						<tr><td>
  							<label>Transfer Type</label><br>
									 <select name="type" id="Bank" >
										<option value="">Select one</option>
									   <option value = "Internal">Inter Bank</option>
									   <option  value = "External">External bank</option>
									 </select>
  							</td><td><label>Bank name</label><br>
                           
  							<input type="text" placeholder="Bank name" id="bname" name="bname"></td></tr>
						
							<tr><td><label>Password</label><br>
  							<input type="password" placeholder="Password" name="pass"></td>
  						</tr>
  						<tr><td><input type="submit" name="transfer" value="transfer"/></td></tr>
						</table>
					</form>
        </div>
      </div>

    

	</section>

    <footer id="footerplaceholder">        <?php include'footer.html'; ?>
    </footer>
  </body>
</html>
