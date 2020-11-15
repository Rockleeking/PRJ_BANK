<!-- Top Navigation -->
 <?php
					echo "<nav class='topnav' id='myTopnav'>";
					echo"<ul>";
					echo"<li class='current' ><a href='https://alacritas.cis.utas.edu.au/~rkhadka/project/webpages/php/' > Home</a></li>";
                     

                        if(!isset($_SESSION['session_user'])|| $_SESSION['session_user']==""){
                            echo'<li><a href="https://alacritas.cis.utas.edu.au/~rkhadka/project/webpages/php/login.php">Login</a></li>';
                        }else
                        {
					       echo "<li><a href='https://alacritas.cis.utas.edu.au/~rkhadka/project/webpages/php/account.php'>".$_SESSION['session_user']."</a><ul>";
                            echo "<li><a href='https://alacritas.cis.utas.edu.au/~rkhadka/project/webpages/php/signout.php'>Sign out</a></li></ul></li>";
                        }
                            
					echo "<li><a href=''>Contact Us</a></li></ul>";
					echo "</nav>";
?>
			