<?php
session_start();
	if(!session_is_registered("login_true")){
	echo"Please login again";
	exit();
	}
    require('../../../include/config.inc.php'); 
	mysql_select_db($db);
	 
	$q = "SELECT * FROM `p2mx_f_rep` WHERE `GIDF` LIKE '".$_GET['id']."' AND `rep_uname` LIKE '".$_SESSION['uname']."' LIMIT 0 , 1";
	
    $qs = mysql_query($q);
	
	  if(mysql_num_rows($qs)){ 
	    //update status to not finished 
		
	   $arrinfo = mysql_fetch_array($qs);	
	   //check if not session DD, MM, YYY
	   $_SESSION['DD'] = $arrinfo['DD'];
	   $_SESSION['MM'] = $arrinfo['MM'];  
	   $_SESSION['YYYY'] = $arrinfo['YYYY']; 
	   $_SESSION["GIDF"] = $_GET['id'];
	 
 		mysql_query("UPDATE  `lionproduction`.`p2mx_f_rep` SET  `rep_status` =  'pending'  WHERE  `GIDF` LIKE '".$_GET['id']."' LIMIT 1");
		//go to check page
	      echo"<meta http-equiv='refresh' content='0; url=../?f=0'>";
		}else{
			 
		echo "WONG OPERATION PLEASE TRY AGAIN";
		exit();
	     	 
		}
	
	
?>