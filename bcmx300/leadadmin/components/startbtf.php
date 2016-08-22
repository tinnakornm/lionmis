<?php session_start();

##########################################################################################
/*	File Name    : startbtf.php
    	Project No   : P002
    	Create Date  : 02/05/2015
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
	
	
		if (isset($_POST['date'])) {	
 
	    //v1.22/14AD01
  	  $mdate = $_POST['date'];
	  $arrd = explode("-",$mdate);
	  $DD = (int)($arrd[count($arrd)-1]);
	  $MM = (int)($arrd[count($arrd)-2]);	
	  $YYYY = (int)($arrd[count($arrd)-3]);	
 
	     $_SESSION["GIDF"] = "MX200F".date("Ymdhms").$_SESSION['lion_id'];
		 $_SESSION['DD']=$DD;
		 $_SESSION['MM']=$MM;
		 $_SESSION['YYYY']=$YYYY;
		 
		 $pd_group = $_POST['pd_group'];
		  $shift = $_POST['mainshift'];
		   $shift_uname = $_POST['shiftleader']; /* shiftleader == shift_uname */
		    $lineleader = $_POST['shiftleader'];
			 $operater1 = $_POST['operater1'];
			  $operater2 = $_POST['operater2'];
			  $operator = $operater1.', '.$operater2;
			  $tim_shift = $_POST['tim_shift'];
			  if($tim_shift=='06:30'){ 
			      $start_tim_define='06:30:00';  $stop_tim_define='14:30:00'; }
			  elseif($tim_shift=='14:30'){
				  $start_tim_define='14:30:00';  $stop_tim_define='22:30:00';
			  }else{
				  $start_tim_define='22:30:00';  $stop_tim_define='06:30:00';
			  }
			  // $start_tim_define = $_POST['start_tim_define'];
			   // $stop_tim_define = $_POST['stop_tim_define'];
				
				//find lead s_name
				$qld = mysql_query("SELECT s_name FROM  `user` WHERE  `uname` LIKE  '".$_SESSION['uname']."' LIMIT 0 , 1");
				if(mysql_num_rows($qld)){
					$arr1=mysql_fetch_array($qld);
					$lead_sname = $arr1['s_name'];
				}else{
					$lead_sname = '-';
				}
				 
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
				 
				 
				 
		$q1 = "INSERT INTO `p2mx_f_rep` ( `id` , `GIDF` ,`pd_group`, `main_mixer` ,`date` ,`DD` ,`MM` ,`YYYY` ,`operater` ,`shiftleader` ,`lineleader` ,`shift` ,`start_tim_define` ,`stop_tim_define` ,`name`,`rep_status`, `rep_uname`, `lead_sname`, `shift_uname`, `shift_sname`)VALUES (NULL ,  '".$_SESSION["GIDF"]."',  '".$pd_group."',  '".$_POST['main_mixer']."',  '".$mdate."',  '".$DD."',  '".$MM."',  '".$YYYY."',  '".$operator."',  '".$shift_name."',  '".$_SESSION['name']."',  '".$shift."',  '".$start_tim_define."',  '".$stop_tim_define."',  '".$_SESSION['name']."', 'pending',  '".$_SESSION['uname']."', '$lead_sname', '$shift_uname', '$shift_sname')";
        

				if(mysql_query($q1)){
							echo '0';
				}else{
					 echo $q1;
				}
	
		}
?>
 