<?php  error_reporting(E_ALL);
 session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	/*	File Name    : eidt_mclocation.php
    	Project No   : -
    	Create Date  : 09/07/2016
	Create by    : Tinnakorn.M
	Description  : Edit machine location item
	 */
	require('../../../../include/config.inc.php'); 
    mysql_select_db($db);

   if(isset($_POST['editmc'])){
	   
	    //find sparepart by item
 
		$q = mysql_query("SELECT * FROM  `tpm_item` WHERE  `item_id` =".$_POST['item_id']." LIMIT 0 , 1");
	    if(!mysql_num_rows($q)){
			echo 'Error Missing spr_id, please contact staff admin.'; 
		}
		$arr = mysql_fetch_array($q);
		
		//get post initial value
 
		if(isset($_POST['sap_id'])){ $sap_id = htmlspecialchars($_POST['sap_id'], ENT_QUOTES); }else{ $sap_id = ""; }
		$sap_id = strtoupper($sap_id); 
		if(isset($_POST['item_name'])){ $item_name = htmlspecialchars($_POST['item_name'], ENT_QUOTES); }else{ $item_name = ""; }
		if(isset($_POST['descrip_en'])){ $descrip_en = htmlspecialchars($_POST['descrip_en'], ENT_QUOTES); }else{ $descrip_en = ""; }
		if(isset($_POST['descrip_th'])){ $descrip_th = htmlspecialchars($_POST['descrip_th'], ENT_QUOTES); }else{ $descrip_th = ""; }
	    if(isset($_POST['sprg_name'])){ $sprg_name = $_POST['sprg_name']; }else{ $sprg_name = ""; }
 
 
 
       //file manager
		if(isset($_FILES["img"]["name"]) and $_FILES["img"]["name"] !="" and $_FILES["img"]["tmp_name"] !=""){ //case replace image
		
		         //casae new image
					 $qim = mysql_query("SELECT * FROM  `tpm_img` WHERE  `img_id` =".$arr['img_id']." LIMIT 0 , 1");
					 if(mysql_num_rows($qim)){
						 $arrim = mysql_fetch_array($qim);
						 $fullpart = '../../../../tpm/images/'.$arrim['img_filepart'];
					     $filename = $arrim['img_filename'];
						 $img_id = $arr['img_id'];
						 $qimg = "`img_id` =  '$img_id',";
					 }else{
						 //gen new image
						$partname = 'MCLOCATION/'.date("Y").'/'.date("m");
						$fullpart = '../../../../tpm/images/'.$partname;
						$ydir =  '../../../../tpm/images/MCLOCATION/'.date("Y"); if (!file_exists($ydir) && !is_dir($ydir)) {  mkdir($ydir, 0777);} 
						$mdir = '../../../../tpm/images/MCLOCATION/'.date("Y").'/'.date("m"); if (!file_exists($mdir) && !is_dir($mdir)) {  mkdir($mdir, 0777);}
						$filename = 'MCLOC'.$sap_id.time().'.jpg';
						//insert new image file to tpm_img
			  			mysql_query("INSERT INTO  `lionproduction`.`tpm_img` (`img_id` ,`img_date` ,`img_recname` ,
`img_name` ,`img_type` ,`img_descript` ,`img_filename` ,`img_filepart` ,`img_priority`, `img_systag`)VALUES (NULL ,  '".date("Y-m-d")."',  '".$_SESSION['uname']."',  '".$item_name."',  'MCLOCATION',  'Location of machine $filename',  '$filename',  '$partname',  '0', '".$item_name." ".$sap_id."')");
			 			 //update image id to tpm_item.
			 			 $img_id = mysql_insert_id();
						 $qimg = "`img_id` =  '$img_id',";
			  
			  
					 }
 
				     copy($_FILES["img"]["tmp_name"],$fullpart.'/'.$filename);
					 chmod($fullpart.'/'.$filename, 0777);   // decimal; probably incorrect
					 
					 
		}else{ 
		   //if no case img
		   $qimg = "";
		
		}
		
		//update databases
		mysql_query("UPDATE  `lionproduction`.`tpm_item` SET  
		`main_id` =  '".$_POST['smain_id']."',
		`item_name` =  '$item_name',
		`sap_id` =  '$sap_id',
		`descrip_en` =  '$descrip_en',
		`descrip_th` =  '$descrip_th',
		 $qimg
		`edit_uname` =  '".$_SESSION['uname']."',
		`edit_date` =  '".date("Y-m-d H:i:s")."', 
		`sprg_name` = '$sprg_name'
		WHERE  `tpm_item`.`item_id` =".$_POST['item_id']."");

 
		
	}//end post newsprt
	
    echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/".$_POST['dev_root']."/teadmin/index.php?f=0&mn=1&gr=".$_POST['main_id']."'>";

 ?>
 