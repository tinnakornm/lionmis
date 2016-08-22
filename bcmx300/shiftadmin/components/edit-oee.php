<?php session_start();
##########################################################################################
/*	File Name    : edit-oee.php
    	Project No   : P002
    	Create Date  : 03/05/2015
	Create by    : Tinnakorn.M
	Description  : Save report oee
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
		- 03/05/2015 : Move oee system to lionproduction.sli , Tinnakorn.M
	     
	       
*/
##########################################################################################

	 
	
	if(!isset($_SESSION['login_true'])){ echo 'Session ของคุณหมดอายุ กรุณาเข้าสู่ระบบใหม่อีกครั้ง'; }
	
   require('../../../include/config.inc.php');
	  mysql_select_db($db); 

 $mdate = $_POST['date'];
	  $arrd = explode("-",$mdate);
	  $DD = (int)($arrd[count($arrd)-1]);
	  $MM = (int)($arrd[count($arrd)-2]);	
	  $YYYY = (int)($arrd[count($arrd)-3]);	


$shift_uname = $_POST['shiftleader'];

 

 //find shift_name, shift_sname
				 $qs = mysql_query("SELECT name,s_name FROM  `user` WHERE  `uname` LIKE  '".$shift_uname."' LIMIT 0 , 1");
				if(mysql_num_rows($qs)){
					$arr2=mysql_fetch_array($qs);
					$shift_name = $arr2['name'];
					$shift_sname = $arr2['s_name'];
					
				}else{
					$shift_name = '-';
					$shift_sname = '-';
				}
	  
//last update
$qs ="UPDATE  `lionproduction`.`p2mx_f_rep` SET  
`pd_group` =  '".$_POST['pd_group']."',
`main_mixer` =  '".$_POST['main_mixer']."',
`date` =  '".$_POST['date']."',
`DD` =  '$DD',
`MM` =  '$MM',
`YYYY` =  '$YYYY',
`shiftleader` =  '".$shift_name."',
`shift` =  '".$_POST['mainshift']."',
`start_tim_define` =  '".$_POST['start_tim_define']."',
`stop_tim_define` =  '".$_POST['stop_tim_define']."',
`rep_uname` =  '".$_SESSION['uname']."',
`shift_uname` =  '".$shift_uname."',
`shift_sname` =  '".$shift_sname."' 
  WHERE  `p2mx_f_rep`.`GIDF` LIKE '".$_SESSION['GIDF']."'";
  
  

 
 
if(mysql_query($qs)){ echo '0';
}else{ echo 'Error, can not qury'; }
 

?>