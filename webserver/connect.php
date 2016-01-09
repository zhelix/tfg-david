<?php

	function Connection(){
		$server="192.168.1.18";
		$user="root";
		$pass="lolcat1$";
		$db="arduino";
	   	
		$connection = mysql_connect($server, $user, $pass);

		if (!$connection) {
	    	die('MySQL ERROR: ' . mysql_error());
		}
		
		mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );

		return $connection;
	}
?>
