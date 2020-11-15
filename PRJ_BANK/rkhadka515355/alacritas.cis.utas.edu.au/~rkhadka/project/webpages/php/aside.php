<!-- php code for left navigation -->
<?php
echo'<aside id="leftside"><div class="cool"><h3>Categories</h3>';

	echo"<ul>";
	//fetch details from database
	$que1="select * from menu ORDER BY displayOrder";
				$result_menu=$db->query($que1);
                    while($row=$result_menu->fetch_array(MYSQLI_ASSOC)){
                        
							$result_page=$db->query("SELECT paget_link FROM page where page_id='".$row['page_id']."'");
                            $row1=$result_page->fetch_array(MYSQLI_ASSOC);
							echo'<li><a href="'.$row1['paget_link'].'">'.$row['menu_name'].'</a>';
                            $main="select menu_item_id from link where menu_id =".$row['menu_id']."";
							$result_main=$db->query($main);
                                echo'<ul>';
							while($main_row=$result_main->fetch_array(MYSQLI_ASSOC)){
                                if(!empty($main_row)){
									$result_page1=$db->query("SELECT `page_id` FROM menu_item WHERE menu_item_id =".$main_row['menu_item_id']."");
									$page1ink1=$result_page1->fetch_array(MYSQLI_ASSOC);
									$result_page2=$db->query("SELECT * FROM `page` WHERE `page_id`=".$page1ink1['page_id']."");
									$page1=$result_page2->fetch_array(MYSQLI_ASSOC);
										echo "<li><a href=".$page1['paget_link'].">".$page1['page_name']."</a></li>";
								    }
                                }
							 echo"</ul>";
							 echo"</li>";
				
    }
    echo"</ul></div></aside>";
	?>
         