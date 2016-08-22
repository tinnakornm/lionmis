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

if($_POST['main_mixer']){
	$main_mixer = 	$_POST['main_mixer'];
}else{
	 exit;
}
 
   require('../../../include/config.inc.php');
	  mysql_select_db($db); 
	  
	  $q=mysql_query("SELECT DISTINCT (fullformula) FROM  `p3mx_pd` WHERE  `mixer` LIKE  '".$_POST['main_mixer']."' AND  `status` !=2 ORDER BY  `p3mx_pd`.`fullformula` DESC  LIMIT 0 , 300");
	  
	  echo '<option value=""> เลือกผลิตภัณฑ์ </option>';
	  if(mysql_num_rows($q)){
		  
		  while($arr=mysql_fetch_array($q)){
			  echo '<option value="'.$arr['fullformula'].'"> '.$arr['fullformula'].' </option>';
		  }
	  }
 

?>