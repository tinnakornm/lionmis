<?php 
 session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	/*	File Name    : insert_newmclocation.php
    	Project No   : -
    	Create Date  : 03/07/2016
	Create by    : Tinnakorn.M
	Description  : Insert new mc location.
	 */
	require('../../../../include/config.inc.php'); 
    mysql_select_db($db);

   if(isset($_POST['newMachineItem'])){
		//get post initial value

		if(isset($_POST['item_name'])){ $item_name = htmlspecialchars($_POST['item_name'], ENT_QUOTES); }else{ $spr_mtcode = ""; }
		$item_name = strtoupper($item_name);
		 
		if(isset($_POST['descrip_en'])){ $descrip_en = htmlspecialchars($_POST['descrip_en'], ENT_QUOTES); }else{ $spr_name_en = ''; }
		if(isset($_POST['descrip_th'])){ $descrip_th = htmlspecialchars($_POST['descrip_th'], ENT_QUOTES); }else{ $spr_name_th = ''; }
	
 
	//insert to main tiem   
	mysql_query("INSERT INTO  `lionproduction`.`tpm_item` (
	`item_id` ,
	`main_id` ,
	`plant` ,
	`dev_v1` ,
	`item_type` ,
	`item_name` ,
	`sap_id` ,
	`descrip_en` ,
	`descrip_th` ,
	`img_id` ,
	`rec_uname`,
	`rec_date`,
	`edit_uname`,
	`edit_date`
)
VALUES (
	NULL ,  
	'".$_POST['main_id']."', 
	 '".$_POST['plant']."', 
	  '".$_POST['dev_v1']."',  
	  'mc_item',  
	  '$item_name',  
	  ' ',  
	  '$descrip_en',  
	  '$descrip_th',  
	  '0', 
	   '".$_SESSION["uname"]."' ,
	   '".date("Y-m-d H:i:s")."',
	     '".$_SESSION["uname"]."' ,
	   '".date("Y-m-d H:i:s")."'
	   )");
    //insert to sparepart
	

	}

//end post newsprt
	
	 echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/".$_POST['dev_root']."/teadmin/index.php?m=mtmachine&c=1&gr=".$_POST['main_id']."'>"; 

 ?>
 