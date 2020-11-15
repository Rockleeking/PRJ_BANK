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
    //session and acccess level constraints
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
    <!-- manager manupulation area  -->
	<section id="space">
      <div class="container">
        <center><div class="boxes" id="table">
              <table id="manager_table">
              <tr><td><button name='one' value='one'><a href=./user%20detail.php>
          <h3>Edit Users</h3>
          <img src="../../../img/edit.jfif">
                  </a></button></td><td><button name='one' value='one'>
          <a href=./statements.php><h3>View Statements</h3>
          <img src="../../../img/bank-statement.jpg">
                  </a></button></td><td><button  name='one' value='one'>
          <a href=./approval_transfer.php><h3>Approve Transaction</h3>
          <img src="../../../img/transaction.png">
                  </a></button></td></tr>
        <tr><td><button name='one' value='one'>
         <a href=./approval_accounts.php> <h3>Approve New Users</h3>
          <img src="../../../img/users.png">
            </a></button></td><td><button name='one' value='one'>
         <a href=./card_management.php> <h3>Card Request</h3>
          <img src="../../../img/card.png">
            </a></button></td><td><button  name='one' value='one'>
          <h3>Log out</h3>
          <a href=../signout.php><img src="../../../img/logout.png">
            </a></button></td></tr>
              </table>
        </div></center>  
        
        </div>
	  </section>
    <!-- footer -->
    <footer id="footerplaceholder">
        <?php include'../footer.php'; ?>
    </footer>
    </body></html>