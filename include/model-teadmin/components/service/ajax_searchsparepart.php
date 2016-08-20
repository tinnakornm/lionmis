<?php require('../../../../include/config.inc.php'); ?>
<?php mysql_select_db($db); ?>
<?php  
  $callback = $_GET['callback'];
  $q = $_GET['q'];
  $q = mysql_query("SELECT * FROM  `tpm_sparepart` WHERE  `spr_mtcode` LIKE  '%".$q."%' OR  `spr_name_en` LIKE  '%".$q."%' LIMIT 0 , 600");
?>
<?php echo $callback; ?>
<?php echo '(['; ?>
<?php
   if(mysql_num_rows($q)){
	   while($arr = mysql_fetch_array($q)){
		   echo '"';
		   echo $arr['spr_mtcode']; echo ',';
		   echo htmlspecialchars ($arr['spr_name_en']);
		   echo '",';
	   }
   }
?>
<?php echo ']);'; ?>