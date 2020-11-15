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
    //session check
    if(!isset($_SESSION['session_user'])|| $_SESSION['session_user']==""){
        header('location:./login.php?err=Please login First');
    }
    //access level check
if($session_access=="BM"){
             header("location:./manager/manager.php");
        }
    //get alert for msg
if(isset($_GET['msg'])){
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
<div id="nplaceholder"><!-- top nav --><?php include'nav.php' ?><script type="text/javascript" src="../../js/new.js" ></script></div>
    </div>
</header>	
    <section id="space"><div><!-- left nav -->
        <?php include'aside.php' ?> <div id="heading_acc">
            <center><h3>Hello <?php echo $session_user ?>!!<br >&nbsp;&nbsp;&nbsp;WELCOME TO SECURE BANK
                </h3></center>
        </div></div>
         
        <div class="container">
            <div class="container" >
                <!-- detail of the user table -->
                <table id="acc_container">
            <?php
                $sql1="select * from detail where phone=".$session_uname."";
                $sql2='SELECT * from account where acc_no='.$session_account.'';
                $result1=mysqli_query($db,$sql1);
                $result2=mysqli_query($db,$sql2);
                $row1=$result1->fetch_array(MYSQLI_ASSOC);
                $row2=$result2->fetch_array(MYSQLI_ASSOC);
            ?>
            <tr><td>Available Balance:</td><td><?php echo $row2['balance']; ?></td></tr>
            <tr><td>Last login:</td><td><?php echo $session_lastLogin ?></td></tr>
            <tr><td>Account type:</td><td><?php echo $session_access ?> Account</td></tr>
            <tr><td>Account number:</td><td><?php echo $session_account ?></td></tr>
            <tr><td>BSB number:</td><td><?php echo $row2['bsb'] ?></td></tr>
            <tr><td>Username/phone number:</td><td><?php echo $session_uname ?></td></tr>
            <tr><td>Account holder Name:</td><td><?php echo "".$row1['fname']." ".$row1['mname']." ".$row1['lname'].""; ?></td></tr>
            <tr><td>Account holder email:</td><td><?php echo $row1['email']; ?></td></tr>
            <tr><td>Account holder Address:</td><td><?php echo "".$row1['address1']." ".$row1['address2'].""; ?></td></tr>
          
            </table>
        </div></div>
	</section>
    <!-- footer -->
    <footer id="footerplaceholder">        <?php include'footer.php'; ?>
    </footer>
  </body>
</html>
