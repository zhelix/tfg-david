<?php

	function Connection(){
		$server="127.0.0.1";
		$user="root";
		$pass="root";
		$db="dbproject";

		$connection = mysql_connect($server, $user, $pass);

		if (!$connection) {
	    	die('MySQL ERROR: ' . mysql_error());
		}
		print("conectado a la schema");
		mysql_select_db($db) or die( 'MySQL ERROR: '. mysql_error() );

		return $connection;
	}
?>
