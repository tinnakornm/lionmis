<?php session_start();
##########################################################################################
/*	File Name    : save_oee.php
    	Project No   : P002
    	Create Date  : 17/08/2013
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

	if(!session_is_registered("login_true")){
	echo"กรุณาเข้าสู่ระบบ";
	exit();
	}

if($_GET['id']){
	$GIDF = 	$_GET['id'];
}else{
	$GIDF = $_SESSION['GIDF'];
}
	 if(!$GIDF){
		 echo 'Error, No GIDF';
		 exit();
	 }
	
   require('../../../include/config.inc.php');
	  mysql_select_db($db); 
//last update
$qs ="UPDATE  `lionproduction`.`p2mx_f_rep` SET  `rep_status` =  'finish' WHERE  `p2mx_f_rep`.`GIDF` LIKE  '".$GIDF."' LIMIT 1 ";
	if(mysql_query($qs)){
		 unset($_SESSION['GIDF']);
		 unset($_SESSION['DD']);
		 unset($_SESSION['MM']);
		 unset($_SESSION['YYYY']);
	}
	
//search unfinish report
$qset = mysql_query("SELECT * FROM  `p2mx_f_rep` WHERE  `rep_uname` LIKE  '".$_SESSION['uname']."' AND  `rep_status` LIKE  'pending' LIMIT 0 , 1"); 
if(mysql_num_rows($qset)){
	   //start new session
	   $arrinfo = mysql_fetch_array($qset);	
	   $SESSION['DD'] = $arrinfo['DD'];
	   $SESSION['MM'] = $arrinfo['MM'];  
	   $SESSION['YYYY'] = $arrinfo['YYYY']; 
	   $_SESSION["GIDF"] = $arrinfo['GIDF'];
	   echo"<meta http-equiv='refresh' content='0; url=../?f=0'>";
	
}else{
 
echo"<meta http-equiv='refresh' content='0; url=../?f=1'>";

}


?>