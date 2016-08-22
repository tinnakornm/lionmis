<?php session_start();

##########################################################################################
/*	File Name    : startmxqa.php
    	Project No   : P002
    	Create Date  : 13/05/2015
	Create by    : Tinnakorn.M
	Description  : OEE Start batch f for mixing OEE new server mobile version
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
 
	       
*/
##########################################################################################


	require('../../../include/config.inc.php'); 
	mysql_select_db($db);	
	$login_true = $_SESSION['login_true'];
	
	echo $_POST['fullformula'];
		if (isset($_POST['fullformula'])) {	
 
	    /*
  	  $mdate = $_POST['date'];
	  $arrd = explode("-",$mdate);
	  $DD = (int)($arrd[count($arrd)-1]);
	  $MM = (int)($arrd[count($arrd)-2]);	
	  $YYYY = (int)($arrd[count($arrd)-3]);	
	  */
 	 $rep_date = date("Y-m-d H:i:s");
	 $DD = date("d");
	 $MM = date("m");
	 $YYYY = date("Y");
	 $timstamp = time();
     $QID = "QABC".date("YmdHis").$_SESSION['lion_id'];
	 
   		 $step = $_POST['step'];	
		  $fullformula = $_POST['fullformula'];
		   $col_point = $_POST['col_point'];
		     $point = $_POST['point'];
		    $order_no = $_POST['order_no'];		 
		   $bt_no = $_POST['bt_no']; /* shiftleader == shift_uname */
		    $bt_size = $_POST['bt_size'];
			$tank_no = $_POST['tank_no'];
			 $mix_no = $_POST['main_mixer'];
			  $mix_uname = $_POST['mix_uname'];
 
				//find lead s_name
				$qld = mysql_query("SELECT name, s_name FROM  `user` WHERE  `uname` LIKE  '".$mix_uname."' LIMIT 0 , 1");
				if(mysql_num_rows($qld)){
					$arr1=mysql_fetch_array($qld);
					$mix_name = $arr1['name'];
					$mix_sname = $arr1['s_name'];
				}else{
					$mix_name = '-';
					$mix_sname = '-';
				}
				  
				//search product group
				$qpd = mysql_query("SELECT  `pd_group` FROM  `p3mx_pd` WHERE  `fullformula` LIKE  '".$fullformula."' LIMIT 1");
				if(mysql_num_rows($qpd)){
					$arrp = mysql_fetch_array($qpd);
					$pd_group = $arrp['pd_group'];
				}else{
					$pd_group = '-';
				}
				  

     $check_note_mx=  mysql_real_escape_string($_POST['check_note_mx']);
		
		
$q1 = "INSERT INTO `qamxbc_rep`(`rep_id`, `QID`, `DD`, `MM`, `YYYY`, `rep_date`, `timstamp`, `pd_group`, `fullformula`, `order_no`, `bt_no`, `bt_size`, `tank_no`, `collection_point`,`point`,`step_type`, `mix_no`, `qa_anaref_no`, `timmx_sent_cnf`, `timmx_reciv_cnf`, `timqa_sent_cnf`, `timqa_reciv_cnf`, `timqa_startcheck_cnf`, `mix_name`, `mix_uname`, `mix_sname`, `qa_name`, `qa_uname`, `qa_sname`, `rep_status`, `result_status`, `check_note_mx`) 

VALUES (NULL,'$QID','$DD','$MM','$YYYY','$rep_date',".time().",'$pd_group','$fullformula','$order_no','$bt_no','$bt_size','$tank_no','$col_point','$point','$step','$mix_no','0000-00-00 00:00:00','$rep_date','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','$mix_name','$mix_uname','$mix_sname','','','','0','0','$check_note_mx')";



				if(mysql_query($q1)){
							//insert meta alertation sent to QA
							mysql_query("UPDATE  `lionproduction`.`meta_tag` SET  `meta_val` =  '1' WHERE  `meta_tag`.`meta_tag` LIKE 'QA_BC_PENDING'");
							echo '0';
				}else{
					 echo 'Error'.$q1;
				}
	
		}

?>
 