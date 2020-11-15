<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
</head>
<body><div>
<center>
<div style="border:1px solid black; width:580px;">
<table>
<tr>
<input type="checkbox" class="cat" value="cat">cat the beautiful</input>
<input type="checkbox" class="tiger" value="lion">Tiger the brave</input>
<input type="checkbox" class="frog" value="frog">Frog the king</input>
<input type="checkbox" class="zebra" value="zebra">Zebra the best</input>
<input type="checkbox" class="pig" value="pig">Pig the chubby</input>
<script type="text/javascript" src="../../js/jadoo.js" ></script>
<tr><div>
<td style="border:3px solid red; height:102px; width:102px;"><input class="catimg" style="background-image:url(../../img/cat.png); background-size:100px 100px; width: 100px; height: 100px; "type="hidden" readonly></input></td>
<td style="border:3px solid red; height:102px; width:102px;"><input type="hidden" class="tigerimg" style="background-image:url(../../img/tiger.png); background-size:100px 100px; width: 100px; height: 100px; " readonly></input></td>
<td style="border:3px solid red; height:102px; width:102px;"><input type="hidden" class="frogimg" style="background-image:url(../../img/frog.jpg); background-size:100px 100px; width: 100px; height: 100px; " readonly></input></td>
<td style="border:3px solid red; height:102px; width:102px;"><input type="hidden" class="zebraimg" style="background-image:url(../../img/zebra.jpg); background-size:100px 100px; width: 100px; height: 100px; " readonly></input></td>
<td style="border:3px solid red; height:102px; width:102px;"><input type="hidden" class="pigimg" style="background-image:url(../../img/pig.png); background-size:100px 100px; width: 100px; height: 100px; " readonly></input></td>
</div>
</tr></table></div></center></div>
<div>
<br />
<br />
<br />
<br />
<center><table>
<tr ><th style="border:1px solid black;"></th><th style="border:1px solid black;">KIT 502</th><th style="border:1px solid black;">KIT 503</th><th style="border:1px solid black;">KIT 707</th><th style="border:1px solid black;">KIT 710</th></tr>
<?php 
	$tabblee = array(
  array("David",55,60,65,70),
  array("Jackson",40,70,55,60),
  array("Lucia",80,94,75,72),
  array("Mary",47,55,62,65),
  array("John",77,86,90,85));
  
  for ($row = 0; $row < 5; $row++) {
	  echo'<tr>';
	  for ($col = 0; $col < 5; $col++) {
		  echo '<td style="border:1px solid black;">'.$tabblee[$row][$col].'</td>';
		}
		echo "</tr>";
	}
		  
//	echo"<tr><td>".$tabblee[0][0]."</td><td>".$tabblee[0][1]."</td><td>".$tabblee[0][2]."</td><td>".$tabblee[0][3]."</td><td>".$tabblee[0][4]."</td></tr>";
//	echo"<tr><td>".$tabblee[1][0]."</td><td>".$tabblee[1][1]."</td><td>".$tabblee[1][2[."</td><td>".$tabblee[1][3]."</td><td>".$tabblee[1][4]."</td></tr>";
//	echo"<tr><td>".$tabblee[2][0]."</td><td>".$tabblee[2][1]."</td><td>".$tabblee[2][2]."</td><td>".$tabblee[2][3]."</td><td>".$tabblee[2][4]."</td></tr>";
//	echo"<tr><td>".$tabblee[3][0]."</td><td>".$tabblee[3][1]."</td><td>".$tabblee[3][2]."</td><td>".$tabblee[3][3]."</td><td>".$tabblee[3][4]."</td></tr>";
//	echo"<tr><td>".$tabblee[4][0]."</td><td>".$tabblee[4][1]."</td><td>".$tabblee[4][2]."</td><td>".$tabblee[4][3]."</td><td>".$tabblee[4][4]."</td></tr>";
 ?>
</table></center>
</div>
<br />
<br />
<br />
<div>
<?php 

	for ($row = 0; $row < 5; $row++) {
		$col=0;
		echo "<b>".$tabblee[$row][$col]."</b><br />";
	  for ($col = 1; $col < 5; $col++) {
		  if($col==1){
			  echo"KIT 502: ";
		  }else if($col==2){
			  echo"KIT 503: ";
		  }else if($col==3){
			  echo"KIT 707: ";
		  }else{
			  echo"KIT 710: ";
		  }
		   $a=intval($tabblee[$row][$col]);
		  
	  if($a >=80 && $a < 100){	
			 echo "High Distintion (".$a.") <br />";
	  }else if($a<80&&$a>=70){
			echo  "Distintion (".$a.")<br />";
		  }else if($a<70&&$a>=60){
			 echo "Credit (".$a.")<br />";
		  }else if($a<60&&$a>=50){
			echo  "Pass (".$a.")<br />";
		  }else{
			 echo "Fail (".$a.")<br />";
		  }
		}
		
		echo "<br />";
	}
?>
</div>

</body></html>