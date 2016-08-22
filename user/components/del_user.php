 <?php 
/******************** MIS STANDARD HEADER ***********************	
File Name         : add_user.php
    Project No    : 
    Create Date  : 15/10/2015
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            22/08/2016 : Start project reversion, By Tinnakorn.M
/****************************************************************/
?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php require('../../include/config.inc.php'); ?>
<?php mysql_select_db($db); 

  mysql_query("DELETE FROM `user` WHERE `user`.`id` = ".$_GET['id']." LIMIT 1");

echo"<meta http-equiv='refresh' content='0; url=../index.php?dev=".$_GET['dev']."'>";
?>
</body>
</html>
