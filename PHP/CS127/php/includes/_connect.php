<?php
$mysql_host = "localhost";
$mysql_user = "MedMngt";
$mysql_pass = "f2BsBQDdzXnerwEn";
$mysql_db = "MedMngt";

$connect = mysqli_connect($mysql_host, $mysql_user, $mysql_pass, $mysql_db);

if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

set_time_limit (0);