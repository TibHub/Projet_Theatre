<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>sans titre 1</title>
</head>

<body>

<?php

	$host = 'localhost';
	$name = 'root';
	$pass = '';
	$base = 'projettheatre';
	
	mysql_connect($host, $name, $pass) or die("erreur de connexion : " . mysql_error());
	mysql_select_db($base) or die("erreur d\'accès à la base : " . $base);


?>

</body>

</html>
