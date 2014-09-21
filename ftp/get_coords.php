<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: content-type");

$con = mysql_connect("sql211.byethost7.com","b7_8874455","daniel");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("b7_8874455_coords", $con);

if ($_POST["x"] < 1)
{
	$result = mysql_query("SELECT * FROM current WHERE id='1'");
	$row = mysql_fetch_array($result);
	echo $row['x'] . "," . $row['y'];
}
else
{
	mysql_query("UPDATE current 
	SET x = '" . $_POST["x"] . "', y = '" . $_POST["y"] . "' 
	WHERE id = '1'");
}
?> 