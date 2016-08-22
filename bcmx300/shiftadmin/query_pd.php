<?php
require('../../include/config.inc.php'); 
 mysql_select_db($db);

$main_mix=$_POST['main_mix'];


$strSQL = "SELECT * FROM p3mx_pd SELECT * FROM  `p3mx_pd` WHERE mixer = '$main_mix' ";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 




?>
