<!-- logout page -->
<?php
	include("session.php");
	session_destroy();
	header('Location:./login.php?signout=ThankYou for using our service!');
?>