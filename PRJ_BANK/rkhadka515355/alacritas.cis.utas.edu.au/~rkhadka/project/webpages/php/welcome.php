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
if(isset($_GET["reg"])){
	$message = "Registered sucessfully";
	echo "<script type='text/javascript'>alert('".$message."');</script>";
}

if($_POST["login"]=="submit")
{
	$sql1='SELECT * FROM detail';
$result=mysqli_query($db,$sql1);
$ph=$_POST["phone"];
$pp=$_POST["pass"];$ok=true;
while($row=mysqli_fetch_array($result))
{
	if($row["phone"]==$ph){
		$ok=false;
		if($row["password"]==$$pp){
			$message = "password did not match with your username";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
			header("Location: login.php");
		}else{
			header("Location: welcome.php");
		}
	}
}
if(ok){
		$message = "You are not registerd with secure banking please regster first!!";
			echo "<script type='text/javascript'>alert('".$message."');</script>";
	}
}
?>
<header>
<div class="container">
        <div id="branding">
          <h1><span class="highlight">Secure</span> Bank Ltd.</h1>
        </div>
<div id="nplaceholder"><script type="text/javascript" src="../../js/new.js" ></script></div>

</header>	
    <section id="main_welcome">
<aside id="leftside"><div class="cool">
            <h3>Categories</h3>
<?php
	echo"<ul>";
	$que1="select * from menu";
				$que2="select * from link";
				$page1ink1="SELECT page.* FROM menu_item, link, page WHERE menu_item.menu_item_id = link.menu_item_id AND menu_item.page_id=page.page_id";
						$result_menu=$db->query($que1);
						while($row=$result_menu->fetch_array(MYSQLI_ASSOC)){
							$result_page=$db->query("SELECT page_link FROM page where page_id='".$row['page_id']."'");
							echo'<li><a href="'.$result_page.'"/>'.$row['menu_name'];
							$result_menuItem=$db->query($que2);
							while($col=$result_menuItem->fetch_array(MYSQLI_ASSOC)){
								if(intval($row['menu_id']) == intval($col['menu_id']) ){
									echo'<ul>';
									$result_page=$db->query($page1ink1);
									while($page1=$result_page->fetch_array(MYSQLI_ASSOC)){
										echo "<li><a href=".$page1['paget_link']."/>".$page1['page_name']."</li>";
									}
									echo"</ul>";
									
									break;
									}
								}
							
							echo"</li>";
						}echo"</ul>";
	?>
          </div>
        </aside>
	

	</div>

	</section>

    <footer id="footerplaceholder">
    </footer>
  </body>
</html>
