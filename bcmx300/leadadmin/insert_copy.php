
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<?php
require('../../include/config.inc.php'); 
 mysql_select_db($db); 
// echo $_GET['qid'];
  $SS = substr($_GET['qid'], 18, 6);
  
  $step = $_POST['step'];	
  $QQID = $_GET['qid'];
  $rep_date = date("Y-m-d H:i:s");
	 $DD = date("d");
	 $MM = date("m");
	 $YYYY = date("Y");
	 $timstamp = time();
     $QID = "QABC".date("YmdHis").$SS;
	 
$qold = mysql_query("SELECT `collection_point`,`point` FROM  `qamxbc_rep` WHERE QID = '".$QQID."' LIMIT 0 , 1");	 
	 $arr1=mysql_fetch_array($qold);
	 $col_point = $arr1['collection_point'];
	 $point = $arr1['point'];
 	
	$qld = mysql_query("SELECT mix_name, mix_uname,mix_sname FROM  `qamxbc_rep`  WHERE QID = '".$QQID."' LIMIT 0 , 1");
				if(mysql_num_rows($qld)){
					$arr1=mysql_fetch_array($qld);
					$mix_name = $arr1['mix_name'];
					$mix_sname = $arr1['mix_sname'];
					$mix_uname = $arr1['mix_uname'];
				}else{
					$mix_name = '-';
					$mix_sname = '-';
				}	
	
	
	
$sql="INSERT INTO `qamxbc_rep`(`rep_id`, `QID`, `DD`, `MM`, `YYYY`, `rep_date`, `timstamp`, `pd_group`, `fullformula`, `order_no`, `bt_no`, `bt_size`, `tank_no`, `collection_point`,`point`,`step_type`, `mix_no`, `qa_anaref_no`, `timmx_sent_cnf`, `timmx_reciv_cnf`, `timqa_sent_cnf`, `timqa_reciv_cnf`, `timqa_startcheck_cnf`, `mix_name`, `mix_uname`, `mix_sname`, `qa_name`, `qa_uname`, `qa_sname`, `rep_status`, `result_status`, `check_note_mx`) 

VALUES (NULL,'$QID','$DD','$MM','$YYYY','$rep_date',".time().",'$_POST[txtpd_group]','$_POST[txtformula]','$_POST[txtorder_no]','$_POST[txtbt_no]','$_POST[txtbt_size]','$_POST[txttank_no]','$col_point','$point','$step','$_POST[txtmixer]','0000-00-00 00:00:00','$rep_date','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','0000-00-00 00:00:00','$_POST[txtmix_name]','$_POST[txtmix_name]','$_POST[txtmix_name]','','','','0','0','$_POST[txtcomment]')";
 
 if(mysql_query($sql)){

echo "<script>window.opener.location.reload();</script>";
echo "<script>window.close();</script>";
				}else{
					 echo 'Error'.$sql;
				}

 

?>
</body>
</html>
