<?php
   	include("connect.php");

   	$link=Connection();

  $idboard=$_GET["board1"];
	$temp1=$_GET["temp1"];
	$hum1=$_GET["hum1"];
	$gas1=$_GET["gas1"];
  $luz1=$_GET["light1"];
  $noise1=$_GET["noise1"];
	$poslat1=$_GET["poslat1"];
	$poslon1=$_GET["poslon1"];

	$query = "INSERT INTO `demo` (`temp`, `hum`,`gas`,`luz`,`noise`,`poslon`,`poslat`,`boardid`)
		VALUES ('".	$temp1."','".$hum1."','".$gas1."','".$luz1."','".$noise1."','".$poslat1."','".$poslon1."','".$idboard."')";

  mysql_query($query,$link);
	mysql_close($link);
  header("Location: maps.php");
?>
