<?php require('../../../../include/config.inc.php'); ?>
<?php mysql_select_db($db); ?>
<?php  

		$JRID=$_POST['JRID'];
		$mdate=$_POST['date_send'];
		$dev_v1=$_POST['dev_v1'];
		$item_id=$_POST['item_id'];
		$dev_code = $_POST['dev_code'];
		$jobreq_title=$_POST['jobreq_title'];
		$jobreq_detail=$_POST['jobreq_detail'];
		$jobreq_recname=$_POST['jobreq_recname'];
		$plant = $_POST['plant'];
		$job_category = $_POST['job_category'];
		$jobreq_tel = $_POST['jobreq_tel'];
		 
	  $arrd = explode("-",$mdate);
	  $DD = (int)($arrd[count($arrd)-1]);
	  $MM = (int)($arrd[count($arrd)-2]);	
	  $YYYY = (int)($arrd[count($arrd)-3]);	
 
      //find initial machine location
	  $qm = mysql_query("SELECT * FROM  `tpm_item` WHERE  `item_id` =$item_id LIMIT 0 , 1");
	  if(mysql_num_rows($qm)){
		  $arrm = mysql_fetch_array($qm);
		  $machine = $arrm['item_name'];
		  $mc_description = $arrm['descrip_en'];
		  
	  }else{
		  $machine = '';
		  $$mc_description = '';
	  }
	  
	  
	   
 	   //Add image to directory
		if(isset($_FILES["spr_jrq"])){
			    $filename = $JRID.".jpg";
				$images = $_FILES["spr_jrq"]["tmp_name"];
				if($_FILES["spr_jrq"]["tmp_name"]!=""){
				copy($_FILES["spr_jrq"]["tmp_name"],"../../../../tpm/images/WORKORDER/".$filename); //Copy file to dir location
				}
		}else{
			
			$filename = "";
		}
		
		if($_FILES["spr_jrq"]["tmp_name"]==""){
			$filename = "";
		}
		
	  
	  	 //find jobreq_user
		 
		 if(isset($_POST['jobreq_user'])){
			$q1 = mysql_query("SELECT * FROM  `user` WHERE  `uname` LIKE  '".$_POST['jobreq_user']."' LIMIT 0 , 1");
			$arr1 = mysql_fetch_array($q1);
			$jobreq_user = $_POST['jobreq_user'];
			$jobreq_name = $arr1['name'];
			$jobreq_sname = $arr1['s_name'];
		}else{
			$jobreq_user = "";
			$jobreq_name = "";
			$jobreq_sname = "";
		} 
		
		//find m/c mc_mainid
		$qmid = mysql_query("SELECT  `main_id` FROM  `tpm_item` WHERE  `item_id` =$item_id LIMIT 1");
		if(mysql_num_rows($qmid)){
			$arrmid = mysql_fetch_array($qmid);
			$mc_mainid = $arrmid['main_id'];
		}else{
			$mc_mainid = 0;
			
		}
		
		 
			  



	   if(isset($JRID)){      
	   $q = "INSERT INTO `lionproduction`.`tpm_jobreq` (`jobreq_id`,
				   `JRID`, 
				   `plant`, 
				   `DD`, 
				   `MM`, 
				   `YYYY`, 
				   `date_send`, 
				   `dev_v1`, 
				   `dev_code`, 
				   `mc_itemid`, 
				   `mc_mainid`, 
				   `machine`, 
				   `mc_description`, 
				   `mc_subitem`, 
				   `job_status`, 
				   `jobreq_title`, 
				   `jobreq_detail`, 
				   `jobreq_recname`, 
				   `jobreq_edit_by`, 
				   `jobreq_type`, 
				   `jobreq_priority`, 
				   `jobreq_tel`, 
				   `jobreq_user`, 
				   `jobreq_name`, 
				   `jobreq_sname`, 
				   `jobto_user`, 
				   `jobto_name`, 
				   `jobto_sname`, 
				   `jobto_supuser`, 
				   `jobto_supname`, 
				   `jobto_supsname`, 
				   `jobto_schdstart`, 
				   `jobto_schdfinish`, 
				   `jobto_actstart`, 
				   `jobto_actfinish`, 
				   `jobreq_imgname`, 
				   `job_category`
				   ) VALUES (NULL, '$JRID', '$plant', '$DD', '$MM', '$YYYY', '$mdate', '$dev_v1', '$dev_code', '$item_id', '$mc_mainid', '$machine', '$mc_description', '0', 'Pending', '$jobreq_title', '$jobreq_detail', '$jobreq_recname', '-', 'MT', '0', '$jobreq_tel', '$jobreq_user', '$jobreq_name', '$jobreq_sname', '-', '-', '-', '-', '-', '-', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '$filename', '$job_category')";
				   
				 

			if(mysql_query($q)){
			  	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/".$_POST['dev_root']."/teadmin/?f=2&mn=1&D=ALL&MM=$MM&YYYY=$YYYY'>";
			}
		   
	   }
 




?>