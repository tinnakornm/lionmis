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
	Description  : Add and upload file for machine group
	 */
	require('../../../../include/config.inc.php'); 
    mysql_select_db($db);

   if(isset($_POST['newmcgroup'])){
		//get post initial value
		$spr_recname = $_SESSION['name'];
		if(isset($_POST['item_name'])){ $item_name = htmlspecialchars($_POST['item_name'], ENT_QUOTES); }else{ $spr_mtcode = ""; }
		$item_name = strtoupper($item_name);
		 
		if(isset($_POST['descrip_en'])){ $descrip_en = htmlspecialchars($_POST['descrip_en'], ENT_QUOTES); }else{ $spr_name_en = ''; }
		if(isset($_POST['descrip_th'])){ $descrip_th = htmlspecialchars($_POST['descrip_th'], ENT_QUOTES); }else{ $spr_name_th = ''; }
		 
	 
	   //add images
	   if(isset($_FILES["grp_img"]["name"]) and $_FILES["grp_img"]["name"] !="" and $_FILES["grp_img"]["tmp_name"] !=""){ //case replace image
	        $partname = 'MCGROUP/'.date("Y").'/'.date("m");
			$fullpart = '../../../../tpm/images/'.$partname;
			$ydir =  '../../../../tpm/images/MCGROUP/'.date("Y"); if (!file_exists($ydir) && !is_dir($ydir)) {  mkdir($ydir, 0777);} 
		 	$mdir = '../../../../tpm/images/MCGROUP/'.date("Y").'/'.date("m"); if (!file_exists($mdir) && !is_dir($mdir)) {  mkdir($mdir, 0777);}
			$filename = 'MAINGR'.time().'.jpg';
			  //compy img, insert db and find img id
			  copy($_FILES["grp_img"]["tmp_name"],$fullpart.'/'.$filename);
			  //insert new image file to tpm_img
			  mysql_query("INSERT INTO  `lionproduction`.`tpm_img` (`img_id` ,`img_date` ,`img_recname` ,
`img_name` ,`img_type` ,`img_descript` ,`img_filename` ,`img_filepart` ,`img_priority`, `img_systag`)VALUES (NULL ,  '".date("Y-m-d")."',  '".$_SESSION['uname']."',  '".$item_name."',  'MCGROUP',  'Main group of machine',  '$filename',  '$partname',  '0', '".$item_name."')");
			  //update image id to tpm_item.
			  $img_id = mysql_insert_id();
	   
	   }else{
		   $img_id = 0;
	   }
	   
	//insert to main tiem   
	mysql_query("INSERT INTO  `lionproduction`.`tpm_item` (`item_id` ,
`main_id` ,
`plant` ,
`dev_v1` ,
`item_type` ,
`item_name` ,
`descrip_en` ,
`descrip_th` ,
`img_id` ,
`rec_uname` ,
`rec_date`
)VALUES (
NULL ,  
'',
  '".$_POST['plant']."',
    '".$_POST['dev_v1']."',
	  'main_group',
	    '$item_name',
		  '$descrip_en',
		    '$descrip_th',
			  '$img_id',
			  '".$_SESSION["uname"]."', 
				 '".date("Y-m-d H:i:s")."'
				)
");
    //insert to sparepart
 
	}//end post newsprt
	
  	 echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/".$_POST['dev_root']."/teadmin/index.php?f=0&mn=1'>";

 ?>
 