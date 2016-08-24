<?php  error_reporting(E_ALL);
       session_start();
   /*	File Name    : update_workorder.php
    	Project No   : -
    	Create Date  : 11/06/2016
		Create by    : Tinnakorn.M
		Description  : Edit spare parts item
	 */
	 
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	
	require('../../../../include/config.inc.php'); 
    mysql_select_db($db);

   if(isset($_POST['update_workorder'])){
	   
	   
		 
		$q = mysql_query("SELECT * FROM  `tpm_jobreq` WHERE  `JRID` LIKE '".$_POST['JRID']."' LIMIT 0 , 1");
	    if(!mysql_num_rows($q)){
			echo 'Error Missing spr_id, please contact staff admin.'; 
		}
		$arr = mysql_fetch_array($q);
		
		//get post initial value
		$JRID = $_POST['JRID'];
		//$jobreq_type = $_POST['jobreq_type'];
		 if(isset($_POST['job_cause']) and $_POST['job_cause']!=''){ $job_cause = htmlspecialchars($_POST['job_cause'], ENT_QUOTES); }else{ $job_cause = $arr['job_cause']; }
		 if(isset($_POST['job_causedetail']) and $_POST['job_causedetail']!=''){ $job_causedetail = htmlspecialchars($_POST['job_causedetail'], ENT_QUOTES); }else{ $job_causedetail = $arr['job_causedetail']; }
	 
		if(isset($_POST['jobto_schdstart']) and $_POST['jobto_schdstart']!=''){ $jobto_schdstart = date("Y-m-d H:i:s", strtotime($_POST['jobto_schdstart'])); }else{ $jobto_schdstart = '0000-00-00 00:00:00'; }
		if(isset($_POST['jobto_schdfinish']) and $_POST['jobto_schdfinish']!=''){ $jobto_schdfinish = date("Y-m-d H:i:s", strtotime($_POST['jobto_schdfinish'])); }else{ $jobto_schdfinish = '0000-00-00 00:00:00'; }
		if(isset($_POST['jobto_actstart']) and $_POST['jobto_actstart']!=''){ $jobto_actstart = date("Y-m-d H:i:s", strtotime($_POST['jobto_actstart'])); }else{ $jobto_actstart = '0000-00-00 00:00:00'; }
		if(isset($_POST['jobto_actfinish']) and $_POST['jobto_actfinish']!=''){ $jobto_actfinish = date("Y-m-d H:i:s", strtotime($_POST['jobto_actfinish'])); }else{ $jobto_actfinish = '0000-00-00 00:00:00'; }
		 
		
		
		 
		if(isset($_POST['jobto_user'])){
			$q1 = mysql_query("SELECT * FROM  `user` WHERE  `uname` LIKE  '".$_POST['jobto_user']."' LIMIT 0 , 1");
			$arr1 = mysql_fetch_array($q1);
			$jobto_user = $_POST['jobto_user'];
			$jobto_name = $arr1['name'];
			$jobto_sname = $arr1['s_name'];
		}else{
			$jobto_user = '';
			$jobto_name = '';
			$jobto_sname = '';
		}
		
		if(isset($_POST['jobto_supuser'])){
			$q2 = mysql_query("SELECT * FROM  `user` WHERE  `uname` LIKE  '".$_POST['jobto_supuser']."' LIMIT 0 , 1");
			$arr2 = mysql_fetch_array($q2);
			$jobto_supuser = $_POST['jobto_supuser'];
			$jobto_supname = $arr2['name'];
			$jobto_supsname = $arr2['s_name'];
		}else{
			$jobto_supuser = '';
			$jobto_supname = '';
			$jobto_supsname = '';
		}
		 
		//   var_dump($_FILES["spr_img"]);
		//   echo '<br/> Datatemp = '.$_FILES['spr_img']['tmp_name'];
		//  echo '<br/> Error = '.$_FILES['spr_img']['error'];
		//   exit;
		
		if(isset($_FILES["jrt_img"]["name"]) and $_FILES["jrt_img"]["name"] !="" and $_FILES["jrt_img"]["tmp_name"] !=""){ //case replace image
		   //remove old image file.
				    //upload new file.
				 $filename = $_POST['JRID'].".jpg";
				 copy($_FILES["jrt_img"]["tmp_name"],"../../../../tpm/images/WORKORDER/".$filename); //Copy new file to dir location 
			     mysql_query("UPDATE  `lionproduction`.`tpm_jobreq` SET   `jobreq_imgname` =  '$filename'  WHERE  `tpm_jobreq`.`JRID` LIKE '$JRID' ");
				 
			}else{
				
				 
				
			}
	 
		 
		//update databases
		 
		mysql_query("UPDATE  `lionproduction`.`tpm_jobreq` SET  `job_status` =  '".$_POST['job_status']."',
					
					`jobto_user` =  '$jobto_user',
					`jobto_name` =  '$jobto_name',
					`jobto_sname` =  '$jobto_sname',
					`jobto_supuser` =  '$jobto_supuser',
					`jobto_supname` =  '$jobto_supname',
					`jobto_supsname` =  '$jobto_supsname',
					`jobto_schdstart` =  '$jobto_schdstart',
					`jobto_schdfinish` =  '$jobto_schdfinish',
					`jobto_actstart` =  '$jobto_actstart',
					`jobto_actfinish` =  '$jobto_actfinish',
					`job_operat` =  '$jobto_sname',
					`job_cause` =  '$job_cause',
					`job_causedetail` =  '$job_causedetail'
					
					 WHERE  `tpm_jobreq`.`JRID` LIKE '$JRID' ");
 
		
	}//end post newsprt
	
	    echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/".$_POST['dev_root']."/teadmin/?m=mtworkorder&D=ALL&MM=".$arr['MM']."&YYYY=".$arr['YYYY']."'>";

 ?>
 