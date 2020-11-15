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
include 'db_conn.php';
    include'session.php';
    if(!isset($_SESSION['session_user'])|| $_SESSION['session_user']==""){
        header('location:./login.php?err=Please login First');
    }
    if($session_access=="BM"){
             header("location:./manager/manager.php");
        }

       if($_POST['one']=="one"){
           $req=mysqli_query($db,"insert into card (`acc_no`, `card_type`) VALUES ('".$session_account."','".$session_access."')");
           if($req){
               header('location:./account.php?msg=Your credit card request has been submitted and will be processed soon. Thankyou!! ');
           }
       }
?>
<header>
<div class="container" id="nav_container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><?php include'nav.php' ?><script type="text/javascript" src="../../js/new.js" ></script></div>
    </div>
</header>	
    <section id="space">
        <?php include'aside.php' ?>
      <div class="container">
           <script>
                function myFunction() {
                
                  if (confirm("Do you really wish to continue, your request will be sent to the manager for approval and you will be charged for the process")) {
                    return true;
                  } else {
                    return false;
                  
                }}
                </script>
        <center><div class="boxes" id="space">
             <form method="post"> <table id="manager_table">
              <tr><td><button name='one' onclick=" return myFunction()" value='one'>
          <h3>Request credit card</h3>
          <img src="../../img/requestcard.jfif">
                  </button></td></tr></table></form></div></center></div></section><footer id="footerplaceholder">        <?php include'footer.php'; ?>
    </footer></body></html>