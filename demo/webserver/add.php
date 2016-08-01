<?php
   	include("connect.php");

   	$link=Connection();
/*
  $idboard=$_GET["board1"];
	$temp1=$_GET["temp1"];
	$hum1=$_GET["hum1"];
	$gas1=$_GET["gas1"];
  $luz1=$_GET["light1"];
  $noise1=$_GET["noise1"];
	$poslat1=$_GET["poslat1"];
	$poslon1=$_GET["poslon1"];
*/
  $idboard=$_POST["board1"];
	$temp1=$_POST["temp1"];
	$hum1=$_POST["hum1"];
	$gas1=$_POST["gas1"];
  $luz1=$_POST["light1"];
  $noise1=$_POST["noise1"];
	$poslat1=$_POST["poslat1"];
	$poslon1=$_POST["poslon1"];

print("DATO 1: ".$idboard);
print("DATO 2: ".$temp1);
print("DATO 3: ".$hum1);
print("DATO 4: ".$gas1);
print("DATO 5: ".$luz1);
print("DATO 6: ".$noise1);
print("DATO 7: ".$noise1);
print("DATO 8: ".$noise1);
print("DATO 1:");



	$query = "INSERT INTO `demo` (`temp`, `hum`,`gas`,`luz`,`noise`,`poslon`,`poslat`,`boardid`) VALUES (".$temp1.",".$hum1.",".$gas1.",".$luz1.",".$noise1.",".$poslat1.",".$poslon1.",".$idboard.")";

  mysql_query($query,$link);
	mysql_close($link);
  header("Location: maps.php");
?>
