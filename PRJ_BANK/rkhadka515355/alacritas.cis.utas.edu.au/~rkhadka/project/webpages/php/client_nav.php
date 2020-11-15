<!doctype_HTML>
					<nav>
				 <?php
include 'db_conn.php';
				$que1="select * from menu";
				$que2="select * from link";
				$page1ink1="SELECT page.* FROM menu_item, link, page WHERE menu_item.menu_item_id = link.menu_item_id AND menu_item.page_id=page.page_id";
						$result_menu=$db->query($que1);
						echo'<ul>';
						while($row=$result_menu->fetch_array(MYSQLI_ASSOC)){
							$result_page=$db->query("SELECT page_link FROM page where page_id='".$row['page_id']."'");
							echo'<li id ="'.$row['menu_name'].'"><a href="'.$result_page.'">'.$row['menu_name'].'</a></li>';
							$result_menuItem=$db->query($que2);
							while($col=$result_menuItem->fetch_array(MYSQLI_ASSOC)){
								if(intval($row['menu_id']) == intval($col['menu_id']) ){						
									$page1ink1="SELECT page.* FROM menu_item, link, page WHERE menu_item.menu_item_id = link.menu_item_id AND menu_item.page_id=page.page_id";
									$result_page=$db->query($page1ink1);
									echo "<ul>";
									while($page1=$result_page->fetch_array(MYSQLI_ASSOC)){
										echo '<li id="'.$page1['page_name'].'"><a href="'.$page1['paget_link'].'">'.$page1['page_name'].'</a></li>';
									}
									echo"</ul>";
									break;
								}
							}
									
									
									
								}
								echo"</ul>";
				?>
					</nav>
