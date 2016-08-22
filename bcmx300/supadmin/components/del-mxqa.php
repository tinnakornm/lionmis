<?php session_start();
##########################################################################################
/*	File Name    : del-mxqa.php
    	Project No   : P002
    	Create Date  : 18/05/2015
	Create by    : Tinnakorn.M
	Description  : Save report oee
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
		- 18/05/2015 : imprement file.
	     
	       
*/
##########################################################################################

if(!isset($_SESSION['uname'])){ 	echo"session ของคุณหมดอายุ กรุณาเข้าสู่ระบบใหม่อีกครั้ง"; exit(); }

if(isset($_GET['id'])){ $QID =  $_GET['id']; }else{  echo 'Error, No QID';  exit();  }
	
      require('../../../include/config.inc.php');
	  mysql_select_db($db); 
//check oee report
 
$qs =mysql_query("SELECT * FROM  `qamxbc_rep` WHERE  `QID` LIKE  '$QID' AND  `mix_uname` LIKE  '".$_SESSION['uname']."' LIMIT 0 , 1"); //lock delete only user
	if(mysql_num_rows($qs)){
		
	 
	 
		//delete report
		mysql_query("DELETE FROM `lionproduction`.`qamxbc_rep` WHERE `qamxbc_rep`.`QID`  LIKE  '$QID' ");

		echo 'ลบรายงานสำเร็จ กรุณารอสักครู่.. ';
		 
	}else{ echo 'ไม่สามารถลบรายงานได้ ผู้สร้างรายงานเท่านั้นจึงจะสามารถลบรายงานนี้ได้ หรือใบส่งตัวอย่างนี้ถูกรับไปแล้วโดย QA'; exit; } 
 
 
 echo"<meta http-equiv='refresh' content='0; url=../?f=2'>";

 

?>