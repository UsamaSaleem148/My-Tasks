<?php
$db = new Mysqli;
$db->connect('localhost:3307','root','','crud');
if(!$db)
{
	echo "success";
}
?>