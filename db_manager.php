<?php
	$servername = "localhost";
	$username = "wwwplust_marcom";
	$password = "contrasena";
	$dbname = "wwwplust_ventaseq3";

	function sqlSelect($sql){
		global $servername, $username, $password, $dbname;

		// Create connection
		$conn = mysqli_connect( $servername, $username, $password, $dbname);

		// Check connection
		if (!$conn) {

			die("Connection failed: " . mysqli_connect_error());

		}

		$result = mysqli_query($conn, $sql);

		mysqli_close($conn);
		return ($result);
	}

	function sqlInsert($sql)
	{
		global $servername, $username, $password, $dbname;

		// Create connection
		$conn = mysqli_connect( $servername, $username, $password, $dbname);

		if (!$conn)
		{
			die("Fallo la conexion: ".mysqli_connect_error());
		}
		$result = mysqli_query($conn, $sql);
		mysqli_close($conn);
	}
	
?>