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

$sql="CREATE TABLE IF NOT EXISTS coords (id REAL UNIQUE, x INTEGER, y INTEGER, tile INTEGER, 
					tlvl INTEGER, city TEXT, name TEXT, lvl INTEGER, power REAL, alli TEXT)";

if (mysql_query($sql,$con))
{
echo "Database exists or created\n";
}
else
{
echo "fail";
}


for ($i = 0; $i < 25; $i++) {
$sql="INSERT INTO coords (id, x, y, tile, tlvl, city, name, lvl, power, alli) VALUES (
'" . mysql_real_escape_string($_POST["id$i"]) . "',
'" . mysql_real_escape_string($_POST["x$i"]) . "',
'" . mysql_real_escape_string($_POST["y$i"]) . "',
'" . mysql_real_escape_string($_POST["type$i"]) . "',
'" . mysql_real_escape_string($_POST["tlvl$i"]) . "',
'" . mysql_real_escape_string($_POST["city$i"]) . "',
'" . mysql_real_escape_string($_POST["name$i"]) . "',
'" . mysql_real_escape_string($_POST["lvl$i"]) . "',
'" . mysql_real_escape_string($_POST["power$i"]) . "',
'" . mysql_real_escape_string($_POST["alli$i"]) . "')";
if (!mysql_query($sql,$con))
  {
  
	  $sql="UPDATE coords SET 
	   x='" . mysql_real_escape_string($_POST["x$i"]) . "',
	  y='" . mysql_real_escape_string($_POST["y$i"]) . "',
	  tile='" . mysql_real_escape_string($_POST["type$i"]) . "',
	  tlvl='" . mysql_real_escape_string($_POST["tlvl$i"]) . "',
	  city='" . mysql_real_escape_string($_POST["city$i"]) . "',
	  name='" . mysql_real_escape_string($_POST["name$i"]) . "',
	  lvl='" . mysql_real_escape_string($_POST["lvl$i"]) . "',
	  power='" . mysql_real_escape_string($_POST["power$i"]) . "',
	  alli='" . mysql_real_escape_string($_POST["alli$i"]) . "'
	   WHERE id='" . $_POST["id$i"] . "'";
  	if (!mysql_query($sql,$con))
  	{
  		echo "$sql\n";
  		echo "Really dead : " . mysql_error($con) . "\n";
  	}
  	else
  	{
  		echo "Updated 1 ROW\n";
  	}
  
  }
  else
  {
  	echo "Added 1 ROW\n";
  }
}
?> 