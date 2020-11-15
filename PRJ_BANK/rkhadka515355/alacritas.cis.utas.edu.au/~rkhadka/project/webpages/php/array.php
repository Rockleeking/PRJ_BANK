<!DOCTYPE html>
<html>
<body>
<?php
$grades = array(
  array("David",55,60,65,70),
  array("Jackson",40,70,55,60),
  array("Lucia",80,94,75,72),
  array("Mary",47,55,62,65),
  array("John",77,86,90,85));
for($row=0;$row<5;$row++){
	$col=0;
echo "<b>".$grades[$row][$col]."</b><br>";	
	for($col=1;$col<5;$col++){
		if($col==1){echo "KIT502:";}
		elseif($col==2){echo "KIT503:";}
		elseif($col==3){echo "KIT707:";}
		elseif($col==4){echo "KIT710:";}
    $score=$grades[$row][$col];
	if($score>=80&&$score<100){
	echo"High Distinction(".$score.")<br/>";}
	elseif($score>=70&&$score<80){
	echo"Distinction(".$score.")<br/>";}
	elseif($score>=60&&$score<70){
	echo"Credit(".$score.")<br/>";}
	elseif($score>=50&&$score<60){
	echo"Pass(".$score.")<br/>";}
	elseif($score<50){
	echo"Fail(".$score.")<br/>";}
}
}
?>
</body>
</html>