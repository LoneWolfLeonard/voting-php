<?php if(isset($_COOKIE['vote-1'])) 
{
  	echo "Sorry, you voted already!";
	  exit(0);
}
?>
<?php
ob_start();
 setcookie(vote, 1, 31536000);
ob_end_flush();
?>
<?php  setcookie(vote, 1, 31536000);?>
<br><br><br>
<body>
<?php


 $myfile2 = fopen("iplog.txt", "w") or die("Unable to open file!");
$txt2 = $_SERVER['REMOTE_ADDR'];
fwrite($myfile2, $txt2);
$txt2 = "Jane Doe\n";
fwrite($myfile2, $txt2);
fclose($myfile2);


$vote = $_REQUEST['vote'];
//insert votes to txt file
$filename = "poll_result.txt";
$content = file($filename);
//put content in array
$array = explode("||", $content[0]);
$Pets = $array[0];
$Voices = $array[1];
$Stones =$array[2];

if ($vote == 0) {
  $Pets = $Pets + 1;
}
if ($vote == 1) {
  $Voices = $Voices + 1;
}
if ($vote == 2) {
  $Stones = $Stones + 1;
}


$insertvote = $Pets."||".$Voices."||".$Stones;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>
<center>
<table>
<tr>
<td>Pets:</td>
<td>
<?php echo(100*round($Pets/($Stones+$Pets+$Voices),3)); ?>%
</td>
<td>Votes:</td>
<td>
<?php echo($Pets); 
?>
</td>
</tr>
<tr>
<td>Sticks & Stones:</td>
<td>
<?php echo(100*round($Stones/($Stones+$Pets+$Voices),3)); 
?>%
</td>
<td>Votes:</td>
<td>
<?php echo($Stones); ?>
</td>
</tr>
<tr>
<td>Voices:</td>
<td>
<?php echo(100*round($Voices/($Stones+$Pets+$Voices),3));
 ?>%
</td>
<td>Votes:</td>
<td>
<?php echo($Voices); ?>
</td>
</tr>
</table>
</center>
</body>
<html>
<script>
document.cookie = "vote=1; expires=Sat, 20 May 2018 00:00:00 EST;";
</script>
</html>
