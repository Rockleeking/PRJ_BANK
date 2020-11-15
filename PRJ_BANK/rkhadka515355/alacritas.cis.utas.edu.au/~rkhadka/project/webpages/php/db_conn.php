<?php
	$db= new mysqli('localhost','rkhadka','UTAS123','rkhadka');
	
	if(mysqli_connect_errno())
    {
		printf("connect failed: %s\n",mysqli_connect_errno());
		exit();
	}
?>