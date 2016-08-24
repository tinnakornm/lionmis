<?php require('../../../../include/config.inc.php'); ?>
<?php mysql_select_db($db); ?>
<?php  

	   $JRID=$_POST['JRID'];
	   if(isset($_POST['flag']) and $_POST['flag'] == '826'){
		   $q1 = mysql_query("SELECT * FROM  `tpm_jobreq` WHERE  `JRID` LIKE  '$JRID' LIMIT 0 , 1");
		    $arr = mysql_fetch_array($q1);
			if($arr['jobreq_imgname']!=''){ 
			//unlink images
		     unlink("../../../../tpm/images/WORKORDER/".$arr['jobreq_imgname']);
			}
		   
            $q = "DELETE FROM `lionproduction`.`tpm_jobreq` WHERE `tpm_jobreq`.`JRID` LIKE '$JRID' LIMIT 1";
				  
			if(mysql_query($q)){
				//echo"<meta http-equiv='refresh' content='0; url=../../?m=2&c=1'>";
				echo '1';
			}
		   
	   }
 




?>