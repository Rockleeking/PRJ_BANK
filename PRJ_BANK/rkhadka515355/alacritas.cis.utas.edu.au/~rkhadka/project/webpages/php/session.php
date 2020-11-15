<!-- session start and initialize -->
<?php
session_start();
if(!isset($_SESSION['session_user'])){
	$_SESSION['session_user']="";
	$_SESSION['session_access']="";
	$_SESSION['session_uname']="";
    $_SESSION['session_account']="";
    $_SESSION['session_lastLogin']="";
}

$session_user=$_SESSION['session_user'];
$session_access=$_SESSION['session_access'];
$session_uname=$_SESSION['session_uname'];
$session_account=$_SESSION['session_account'];
$session_lastLogin=$_SESSION['session_lastLogin'];
?>