<?php 
    //Check Spare part by MT CODE : Tinnakorn.M 12/02/2016
    require('../../../../include/config.inc.php');  
    mysql_select_db($db);

   if(isset($_POST['flag']) and $_POST['flag'] == '142'){
	   $spr_mtcode = $_POST['spr_mtcode'];
	   $q = mysql_query("SELECT * FROM  `tpm_sparepart` WHERE  `spr_mtcode` LIKE  '$spr_mtcode' LIMIT 0 , 1");
	   if(mysql_num_rows($q)){
		   echo '1';
	   }else{
		   echo '0';
	   }
	   
   }else{
	   echo 'Error, Missing flag';
   }
   
   
?>
 