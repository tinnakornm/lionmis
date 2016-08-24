<?php  error_reporting(E_ALL);
 session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	/*	File Name    : eidt_sparepart.php
    	Project No   : -
    	Create Date  : 16/02/2016
	Create by    : Tinnakorn.M
	Description  : Edit spare parts item
	 */
	require('../../../../include/config.inc.php'); 
    mysql_select_db($db);

   if(isset($_POST['editreport'])){
	   
	    //find sparepart by item
		echo $_POST['spr_id']; 
		$q = mysql_query("SELECT * FROM  `tpm_sparepart` WHERE  `spr_id` =".$_POST['spr_id']." LIMIT 0 , 1");
	    if(!mysql_num_rows($q)){
			echo 'Error Missing spr_id, please contact staff admin.'; 
		}
		$arr = mysql_fetch_array($q);
		
	   
		//get post initial value
		$spr_recname = $_SESSION['name'];
		if(isset($_POST['spr_mtcode'])){ $spr_mtcode = htmlspecialchars($_POST['spr_mtcode'], ENT_QUOTES); }else{ $spr_mtcode = $arr['spr_mtcode']; }
		//if(isset($_POST['spr_type'])){ $spr_type = $_POST['spr_type']; }else{ $spr_type = 'GENERAL'; }
		if(isset($_POST['sprg_name'])){ $sprg_name = $_POST['sprg_name']; }else{ $sprg_name = $arr['sprg_name']; }
		if(isset($_POST['spr_name_en'])){ $spr_name_en = htmlspecialchars($_POST['spr_name_en'], ENT_QUOTES); }else{ $spr_name_en = $arr['spr_name_en']; }
		if(isset($_POST['spr_name_th'])){ $spr_name_th = htmlspecialchars($_POST['spr_name_th'], ENT_QUOTES); }else{ $spr_name_th = $arr['spr_name_th']; }
		if(isset($_POST['spr_spec'])){ $spr_spec = $_POST['spr_spec']; }else{ $spr_spec = ''; }
		 
		$spr_stock_min = $_POST['spr_stock_min'];
		$spr_leadtime = $_POST['spr_leadtime'];
		$spr_leadtime_unit = $_POST['spr_leadtime_unit'];
		$spr_sap_price = $_POST['spr_sap_price'];
		$spr_stock_loc = $_POST['spr_stock_loc'];
		$spr_details = '';
		$filename = $arr['spr_img'];
		//if($arr['spr_type']=='SPECIAL'){ $d=1; }else{ $d=2; }
		
	   
		if(isset($_FILES["img"]["name"]) and $_FILES["img"]["name"] !="" and $_FILES["img"]["tmp_name"] !=""){ //case replace image
		   //remove old image file.
	$qimg = mysql_query("SELECT `img_filename` ,  `img_filepart`   FROM  `tpm_img`  WHERE  `img_id` =".$arr['img_id']." LIMIT 0 , 1");
	if(mysql_num_rows($qimg)){
		$arrimg = mysql_fetch_array($qimg);
		if(unlink("../../../../tpm/images/".$arrimg['img_filepart'].'/'.$arrimg['img_filename'])){
				mysql_query("DELETE FROM `lionproduction`.`tpm_img` WHERE `tpm_img`.`img_id` = ".$arr['img_id']."");
		 }
	}//end if img
		   
		   //upload & insert new image file.
		    $partname = 'SPAREPART/'.date("Y").'/'.date("m");
			$fullpart = '../../../../tpm/images/'.$partname;
			$ydir =  '../../../../tpm/images/SPAREPART/'.date("Y"); if (!file_exists($ydir) && !is_dir($ydir)) {  mkdir($ydir, 0777);} 
		 	$mdir = '../../../../tpm/images/SPAREPART/'.date("Y").'/'.date("m"); if (!file_exists($mdir) && !is_dir($mdir)) {  mkdir($mdir, 0777);}
			$filename = $spr_mtcode.'.jpg';
			  //compy img, insert db and find img id
			  copy($_FILES["img"]["tmp_name"],$fullpart.'/'.$filename);
			  //insert new image file to tpm_img
			  mysql_query("INSERT INTO  `lionproduction`.`tpm_img` (`img_id` ,`img_date` ,`img_recname` ,
`img_name` ,`img_type` ,`img_descript` ,`img_filename` ,`img_filepart` ,`img_priority`, `img_systag`)VALUES (NULL ,  '".date("Y-m-d")."',  '".$_SESSION['uname']."',  '".$spr_name_en."',  'SPAREPART',  '".$spr_mtcode."',  '$filename',  '$partname',  '0', '".$spr_mtcode.' '.$arr['spr_name_en'].' '.$arr['spr_name_th']."')");
			  //update image id to tpm_item.
			  $img_id = mysql_insert_id();
			 
		}else{ 
		 //case no img
		   $img_id  = $arr['img_id'];
		 }
		
		//update databases
		mysql_query("UPDATE  `lionproduction`.`tpm_sparepart` SET  
		`spr_mtcode` =  '$spr_mtcode',
		`sprg_name` =  '$sprg_name',
`spr_name_en` =  '$spr_name_en',
`spr_name_th` =  '$spr_name_th',
`spr_stock_loc` =  '$spr_stock_loc',
`spr_stock_min` =  '$spr_stock_min',
`spr_leadtime` =  '$spr_leadtime',
`spr_leadtime_unit` =  '$spr_leadtime_unit',
`spr_sap_price` =  '$spr_sap_price',
`img_id` =  '$img_id'
WHERE  `tpm_sparepart`.`spr_id` =".$_POST['spr_id']."");

 
 
		
	}//end post newsprt
	
	   echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/".$_POST['dev_root']."/teadmin/?m=mtsparepart&c=".$_POST['c']."&gr=$sprg_name'>";

 ?>
 