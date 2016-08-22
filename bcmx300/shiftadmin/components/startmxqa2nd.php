<?php session_start();

##########################################################################################
/*	File Name    : startmxqa2nd.php
    	Project No   : P002
    	Create Date  : 23/05/2015
	Create by    : Tinnakorn.M
	Description  : OEE Start batch f for mixing OEE new server mobile version
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
	$login_true = $_SESSION['login_true'];
	
	
		if(isset($_POST['QID'])) {	
 		//find mix s_name
        $qld = mysql_query("SELECT name, s_name FROM  `user` WHERE  `uname` LIKE  '".$_SESSION['uname']."' LIMIT 0 , 1");
				if(mysql_num_rows($qld)){
					$arr1=mysql_fetch_array($qld);
					$mix_name = $arr1['name'];
					$mix_sname = $arr1['s_name'];
				}else{
					$mix_name = '-';
					$mix_sname = '-';
				}
				
    	
		 $q1="UPDATE  `lionproduction`.`qamx_rep` SET  `timmx_sent_cnf_p1` =  '".date("Y-m-d H:i:s")."',
`mix_name_p1` =  '$mix_name',
`mix_uname_p1` =  '".$_SESSION['uname']."',
`mix_sname_p1` =  '$mix_sname',
`rep_status` =  '0',
`result_status` =  '0',
`check_note_mx_p1` =  '".mysql_real_escape_string($_POST['check_note_mx'])."',
`check_priority` =  '1' WHERE  `qamx_rep`.`QID` LIKE '".$_POST['QID']."'";
		
 
				if(mysql_query($q1)){
							echo '0';
				}else{
					echo '1';
				}
	
		}
?>
 