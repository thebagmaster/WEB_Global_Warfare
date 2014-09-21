<?php

$allowedip = array(
'66.61.84.206','Tommy',
'68.53.51.214','Home',
'174.17.59.185','Mike',
'66.32.167.173','Hunter',
'108.83.2.43','Greg Short',
'208.29.216.2','dad temp',
'108.54.108.151', 'dad crash');
$ip = $_SERVER['REMOTE_ADDR'];
if(in_array($ip,$allowedip))
{
$tileS[10]="Grassland";
$tileS[11]="Lake";
$tileS[12]="River";
$tileS[20]="Oil";
$tileS[30]="Hills";
$tileS[40]="Mountain";
$tileS[50]="Plain";
$tileS[51]="City";
$tileS[52]="Ruin";
$tileS[53]="City Mist";
$tileS[201]="SR1";
$tileS[202]="SR2";
$tileS[203]="SR3";
$tileS[204]="SR4";

$con = mysql_connect("sql211.byethost7.com","b7_8874455","daniel");
if (!$con)
{
	die('Could not connect: ' . mysql_error());
}

mysql_select_db("b7_8874455_coords", $con);
if($_POST['search'])
{
$name=$_POST['id'];
$sql="SELECT * FROM coords
WHERE  name LIKE '%" . $name . 
"%' OR city LIKE '%" . $name  .
"%' OR alli LIKE '%" . $name  ."%'"; 
}
else
$sql="SELECT *  FROM coords WHERE tile > 100";

$result=mysql_query($sql);
echo "
<style type='text/css'>
table{text-align:center;border:3px solid #FFF;}
td{padding:2px;}
th{padding:5px;background-color:#385E0F;color:#FFF;}
div.opt{height:24px; width:100px; display:block; color:#385E0F; font-weight:900;}
#optContainer{
height:100px; 
width:105px; 
-webkit-transform:rotate(270deg);
-moz-transform:rotate(270deg);
}
a.sortA{color:#FFF;cursor:pointer;}
</style>

<script type='text/javascript'>
function hideColumn (col, show)
{
	var cells = document.getElementsByClassName('c' + col);
	var mode = show ? 'table-cell' : 'none';
	for(j = 0; j < cells.length; j++) cells[j].style.display = mode;
}
function hideType (type,show)
{
	var mode = show ? 'table-row' : 'none';
	var rows = document.getElementById('mTable').rows;
	for(i = 1; i < rows.length; i++)
		if(type)
		{
			if(rows[i].cells[2].innerHTML.search('City') >= 0)
				rows[i].style.display = mode;
		}
		else
			if(rows[i].cells[2].innerHTML.search('City') < 0)
				rows[i].style.display = mode;
	zebra();
}
function zebra ()
{
	var rows = document.getElementById('mTable').rows;
	var color, n = 1;
	for(i = 1; i < rows.length; i++)
	{
		color = (n%2) ? '#FFF' : '#B6EA7D';
		if(rows[i].style.display != 'none')
		{
			for(j = 0; j < rows[i].cells.length; j++)
				rows[i].cells[j].style.backgroundColor = color;
			n++;
		}
	}
}
function sortCol (col)
{
	var rows = document.getElementById('mTable').rows;
	var tmp2;
	for (i = 1; i < rows.length; i++) 
	{
		tmp = i;
		for (j = i+1; j < rows.length; j++) 
			if (compare(rows[j].cells[col].innerHTML,
			            rows[tmp].cells[col].innerHTML))
	           		tmp = j;
	     	tmp2 = rows[tmp].innerHTML;
	     	rows[tmp].innerHTML = rows[i].innerHTML;
	   	rows[i].innerHTML = tmp2;
	}
	zebra();
}
function compare (a, b)
{
	if(isNaN(parseInt(a)))
		return (a.toLowerCase() < b.toLowerCase());
	else
		return (parseInt(a) < parseInt(b));
}
window.onload = zebra;
</script>

<div style='
background-image:url(matrix.gif);
height:128px;
width:128px;
right:30px;
position:absolute;
opacity:0.5;
color:#A7C942;
font-weight:900;
font-size:24px;
text-align:center;
border:3px solid #6BB200'><br>MATRIX
</div>

<div id='optContainer'>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(0,this.checked);'>
	X
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(1,this.checked);'>
	Y
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(2,this.checked);'>
	Tile
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(3,this.checked);'>
	TileLvl
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(4,this.checked);'>
	City
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(5,this.checked);'>
	General
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(6,this.checked);'>
	GenLvl
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(7,this.checked);'>
	Power
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideColumn(8,this.checked);'>
	Alliance
	</div>
	<div class='opt'></div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideType(1,this.checked);'>
	Cities
	</div>
	<div class='opt'>
	<input type='checkbox' checked='true' onClick='hideType(0,this.checked);'>
	Wilds
	</div>
</div>

<table id='mTable'>
<tr>
	<th class='c0'><a class='sortA' onClick='sortCol(0)'>X</a></th>
	<th class='c1'><a class='sortA' onClick='sortCol(1)'>Y</a></th>
	<th class='c2'><a class='sortA' onClick='sortCol(2)'>Tile</a></th>
	<th class='c3'><a class='sortA' onClick='sortCol(3)'>TileLvl</a></th>
	<th class='c4'><a class='sortA' onClick='sortCol(4)'>City</a></th>
	<th class='c5'><a class='sortA' onClick='sortCol(5)'>General</a></th>
	<th class='c6'><a class='sortA' onClick='sortCol(6)'>GenLvl</a></th>
	<th class='c7'><a class='sortA' onClick='sortCol(7)'>Power</a></th>
	<th class='c8'><a class='sortA' onClick='sortCol(8)'>Alliance</a></th>
</tr>
";
$counter = 1;
if($_POST['id'] || $_POST['srs'])
while($row=mysql_fetch_array($result))
{ 
	$id=$row['id']; 
	$x=$row['x']; 
	$y=$row['y']; 
	$tile=$row['tile'];
	$tlvl=$row['tlvl']; 
	$city=$row['city'];
	$name=$row['name'];
	$lvl=$row['lvl'];
	$power=$row['power'];
	$alli=$row['alli'];  
	
	echo "<tr><td class='c0'>" . $x .
	"</td><td class='c1'>" . $y .
	"</td><td class='c2'>" . $tileS[$tile] .
	"</td><td class='c3'>" . $tlvl .
	"</td><td class='c4'>" . $city .
	"</td><td class='c5'>" . $name .
	"</td><td class='c6'>" . $lvl .
	"</td><td class='c7'>" . $power .
	"</td><td class='c8'>" . $alli .
	"</td></tr>";
	$counter++;
	if($counter > 5000)
		break;
}
echo "</table>"; 
}
else
{
	$con = mysql_connect("localhost","thebagma_admin","daniel");
	mysql_select_db("thebagma_coords", $con);
	mysql_query("INSERT INTO ips (ip) VALUES ('" . $ip . 
	"');", $con);
	echo "<h1>No Soup For You... "
	 . $ip . "</h1><br><h6>Your Feeble Attempt Has Been Logged.</h6><hr>";
}
?>