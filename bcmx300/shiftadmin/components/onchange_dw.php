<?php session_start();
##########################################################################################
/*	File Name    : onchange_dw.php
    	Project No   : P002
    	Create Date  : 13/06/2015
	Create by    : Tinnakorn.M
	Description  : Onchange DW
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
 
	     
	       
*/
##########################################################################################

	if(!session_is_registered("login_true")){
	echo"กรุณาเข้าสู่ระบบ";
	exit();
	}

 
	
    require('../../../include/config.inc.php');
	mysql_select_db($db); 
	$key = $_POST['ID'];
	$val = $_POST['val'];
 
  if($key=='DW1'){
      $q= "UPDATE  `lionproduction`.`p2mx_f_rep` SET  `DW1_code` =  '$val'  WHERE  `p2mx_f_rep`.`GIDF` LIKE '".$_SESSION['GIDF']."' ";
	  $q2 = "UPDATE  `lionproduction`.`p2mx_f_check` SET  `DW1_code` =  '$val' WHERE  `p2mx_f_check`.`GIDF` LIKE '".$_SESSION['GIDF']."'";
  }else{
	  
	  $q= "UPDATE  `lionproduction`.`p2mx_f_rep` SET  `DW2_code` =  '$val'  WHERE  `p2mx_f_rep`.`GIDF`  LIKE '".$_SESSION['GIDF']."' ";
	  $q2 = "UPDATE  `lionproduction`.`p2mx_f_check` SET  `DW2_code` =  '$val' WHERE  `p2mx_f_check`.`GIDF` LIKE '".$_SESSION['GIDF']."'";
	   
  }

  if(mysql_query($q)){
	  mysql_query($q2);
	  echo '0';
  }else{
	  echo 'An error occured :';
  }
 

?>