<?php
	$host 		= 'localhost';
	$user 		= 'root';
	$password 	= '12345';
	$db 		= 'seminario';
	
	$conection=@mysqli_connect($host,$user,$password,$db);
	
	if (!$conection){
		echo "Error en la conexion";
	}
?>
	