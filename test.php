<?php

require ("../../dbconfig.php");
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR
	die('Coul not connect MySQL: ' . mysqli_connect_error () );

if($dbc) echo "we did it";

?>