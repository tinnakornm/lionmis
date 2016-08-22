<?php session_start();
##########################################################################################
/*	File Name    : del-oee.php
    	Project No   : P002
    	Create Date  : 05/05/2015
	Create by    : Tinnakorn.M
	Description  : Save report oee
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
		- 17/08/2013 : [Card No:V1.16/14OP02], Fix bug OEE Save report, By Tinnakorn.M
		- 03/05/2015 : Move oee system to lionproduction.sli 
	     
	       
*/
##########################################################################################

if(!isset($_SESSION['uname'])){ 	echo"session ของคุณหมดอายุ กรุณาเข้าสู่ระบบใหม่อีกครั้ง"; exit(); }

if(isset($_GET['id'])){ $GIDF =  $_GET['id']; }else{  echo 'Error, No GIDF';  exit();  }
	
      require('../../../include/config.inc.php');
	  mysql_select_db($db); 
//check oee report
$qs =mysql_query("SELECT * FROM  `p2mx_f_rep` WHERE  `GIDF` LIKE  '$GIDF' AND  `rep_uname` LIKE  '".$_SESSION['uname']."' LIMIT 0 , 1"); //lock delete only user
	if(mysql_num_rows($qs)){
		
		//delete report
		mysql_query("DELETE FROM `lionproduction`.`p2mx_f_check` WHERE `p2mx_f_check`.`GIDF`  LIKE  '$GIDF' ");
		mysql_query("DELETE FROM `lionproduction`.`p2mx_f_checkt` WHERE `p2mx_f_checkt`.`GIDF`  LIKE  '$GIDF' ");
		mysql_query("DELETE FROM `lionproduction`.`p2mx_f_rep` WHERE `p2mx_f_rep`.`GIDF`  LIKE  '$GIDF'");
		
		
        if(isset($_SESSION['GIDF'])){
			if($_SESSION['GIDF']==$GIDF){
				 unset($_SESSION['GIDF']);
				 unset($_SESSION['DD']);
				 unset($_SESSION['MM']);
				 unset($_SESSION['YYYY']);
			}
		}
		
	 
		echo 'ลบรายงานสำเร็จ กรุณารอสักครู่.. ';
		 
	}else{ echo 'Cannot delete report, only owner of report can delete report'; exit; } 
 
 
 echo"<meta http-equiv='refresh' content='0; url=../?f=1'>";

 

?>