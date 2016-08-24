<?php 
 session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	/*	File Name    : add_sparepart.php
    	Project No   : -
    	Create Date  : 12/02/2016
	Create by    : Tinnakorn.M
	Description  : Add and upload file for spare part
	 */
	require('../../../../include/config.inc.php'); 
    mysql_select_db($db);

   if(isset($_POST['newsprt'])){
		//get post initial value
		$spr_recname = $_SESSION['name'];
		if(isset($_POST['spr_mtcode'])){ $spr_mtcode = htmlspecialchars($_POST['spr_mtcode'], ENT_QUOTES); }else{ $spr_mtcode = ""; }
		if(isset($_POST['spr_type'])){ $spr_type = $_POST['spr_type']; }else{ $spr_type = 'GENERAL'; }
		
		if(isset($_POST['sprg_name'])){ $sprg_name = $_POST['sprg_name']; }else{ $sprg_name = 'ZOTHERS'; }
		if(isset($_POST['spr_name_en'])){ $spr_name_en = htmlspecialchars($_POST['spr_name_en'], ENT_QUOTES); }else{ $spr_name_en = ''; }
		if(isset($_POST['spr_name_th'])){ $spr_name_th = htmlspecialchars($_POST['spr_name_th'], ENT_QUOTES); }else{ $spr_name_th = ''; }
 
	//	$spr_stock_min = $_POST['spr_stock_min'];
		$spr_stock_loc = $_POST['spr_stock_loc'];
		$dev_v1 = $_POST['dev_v1'];
 
		
		if($spr_type=='SPECIAL'){ $spr_stype = 'ZS'; }else{ $spr_stype = 'ZG'; }
		//set file name and auto id
		$spr_id = $spr_stype.time();
		if($spr_mtcode==""){ $spr_mtcode = $spr_id; }
		
		 
		//Add image to directory
		if(isset($_FILES["img"])){
			
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
`img_name` ,`img_type` ,`img_descript` ,`img_filename` ,`img_filepart` ,`img_priority`, `img_systag`)VALUES (NULL ,  '".date("Y-m-d")."',  '".$_SESSION['uname']."',  '".$spr_name_en."',  'SPAREPART',  '".$spr_mtcode."',  '$filename',  '$partname',  '0', '".$spr_mtcode.' '.$spr_name_en.' '.$spr_name_th."')");
			  //update image id to tpm_item.
			  $img_id = mysql_insert_id();
 	
		}else{
			  $img_id = 0;
		}
		

		mysql_query("INSERT INTO  `lionproduction`.`tpm_sparepart` (
		`spr_id` ,
		`spr_mtcode` ,
		`spr_type` ,
		`sprg_name` ,
		`spr_name_en` ,
		`spr_name_th`, 
		`spr_location`  ,
		`spr_stock_loc` ,
		`spr_recname` ,
		`spr_recuname` ,
		`spr_recdate`,
		`spr_status`, 
		`dev_v1`,
		`img_id`
		 )
		VALUES (
		NULL ,  
		'$spr_mtcode',  
		'$spr_type',  
		'$sprg_name',  
		'$spr_name_en',  
		'$spr_name_th', 
		'$dev_v1', 
		'$spr_stock_loc',
        '".$_SESSION['name']."',  
	    '".$_SESSION['uname']."',  
	   '".date("Y-m-d H:i:s")."',
	     '1',
		 '$dev_v1',
		 '$img_id'
		 )") or die ("Cannot insert to database");
		
	}//end post newsprt
	
 
 	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/".$_POST['dev_root']."/teadmin/?m=mtsparepart&c=1&gr=$sprg_name'>";

 ?>
 