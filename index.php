<?php  

if(isset($_GET['c']) && isset($_GET['t']))
{
	echo $_GET['c']. ' ' .$_GET['t'];
}

else
{
	echo "<h1>Not welcome anyyyymoore</h1>";
}