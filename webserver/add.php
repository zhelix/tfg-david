<?php
   	include("connect.php");
   	
   	$link=Connection();

	$temp1=$_POST["temp1"];
	$hum1=$_POST["hum1"];
	$gas1=$_POST["gas1"];
	$poslat1=$_POST["poslat1"];
	$postlon1=$_POST["poslon1"];

	
	$query = "INSERT INTO `data` (`arduino`, `longitud`,`latitud`,`temperatura`,`humedad`,`gas`) 
		VALUES ('"."1"."','".$postlon1."','".$poslat1."','".$temp1."','".$hum1."','".$gas1."')"; 
		
   	mysql_query($query,$link);
	mysql_close($link);
   	header("Location: maps.php");
?>
