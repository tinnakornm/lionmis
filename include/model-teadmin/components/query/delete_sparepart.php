<?php 
    //Del Sparepart : Tinnakorn.M 29/02/2016
    require('../../../../include/config.inc.php');  
    mysql_select_db($db);

   if(isset($_POST['flag']) and $_POST['flag'] == '256'){
	   $spr_id = $_POST['spr_id'];
	  // echo 'spr_id='.$spr_id;
	   
	   $q = mysql_query("SELECT * FROM   `lionproduction`.`tpm_sparepart` WHERE `tpm_sparepart`.`spr_id` = $spr_id LIMIT 0 , 1");
	   if(mysql_num_rows($q)){
		   $arr = mysql_fetch_array($q);
 
		   //remove old image file.
	$qimg = mysql_query("SELECT `img_filename` ,  `img_filepart`   FROM  `tpm_img`  WHERE  `img_id` =".$arr['img_id']." LIMIT 0 , 1");
	if(mysql_num_rows($qimg)){
		$arrimg = mysql_fetch_array($qimg);
		if(unlink("../../../../tpm/images/".$arrimg['img_filepart'].'/'.$arrimg['img_filename'])){
				mysql_query("DELETE FROM `lionproduction`.`tpm_img` WHERE `tpm_img`.`img_id` = ".$arr['img_id']."");
		 }
	}//end if img
	
		   //remove query
		   mysql_query("DELETE FROM `lionproduction`.`tpm_sparepart` WHERE `tpm_sparepart`.`spr_id` = $spr_id"); 
		   echo '1';
	   }else{
		   echo '0';
	   }
	    
	   
   }else{
	   echo 'Error, Missing flag';
   }
   
   
?>
 