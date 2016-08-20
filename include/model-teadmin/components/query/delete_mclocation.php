<?php 
    //Del Sparepart : Tinnakorn.M 09/07/2016
    require('../../../../include/config.inc.php');  
    mysql_select_db($db);

   if(isset($_POST['flag']) and $_POST['flag'] == '779'){
	   $item_id = $_POST['item_id'];
	}else{
	   echo 'Error, Missing flag';
	   exit;
   }   
	  
 //TODO; Check Item Usage : note  by Tinnakorn.M 09/07/2016
	   $q = mysql_query("SELECT * FROM  `tpm_item` WHERE  `item_id` =$item_id LIMIT 0 , 1");
	   if(mysql_num_rows($q)){
		   $arr = mysql_fetch_array($q);
	   }else{
		   echo 'Error, No item id'; exit;
	   }
		   
		if($arr['img_id'] != 0){
			//delete image 
			$qim = mysql_query("SELECT * FROM  `tpm_img` WHERE  `img_id` =".$arr['img_id']." LIMIT 0 , 1");
			if(mysql_num_rows($qim)){
				$arrim = mysql_fetch_array($qim);
				//unlink images
		        if(unlink("../../../../tpm/images/".$arrim['img_filepart']."/".$arrim['img_filename'])){
					mysql_query("DELETE FROM `lionproduction`.`tpm_img` WHERE `tpm_img`.`img_id` = ".$arr['img_id']."");
				}				 
			}
		}
		   
		   
		   //remove query
		   mysql_query("DELETE FROM `lionproduction`.`tpm_item` WHERE `tpm_item`.`item_id` = $item_id"); 
 
		   echo '1';
	  
	    
	   
   
   
   
?>
 