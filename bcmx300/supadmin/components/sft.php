<?php session_start();
 if(!session_is_registered("login_true")){
	echo"กรุณาเข้าสู่ระบบใหม่อีกครั้ง";
	exit;
 }
 require('../../../include/config.inc.php'); 
 mysql_select_db($db); 
 
 //Posted NOT
 if($_POST['key'] and $_POST['val']){
	 $q =mysql_query("SELECT * FROM  `p2mx_f_checkt` WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `causekey` LIKE  '".$_POST['key']."' LIMIT 0 , 1");
	 if(!mysql_num_rows($q)){
	 $q1 = "INSERT INTO  `lionproduction`.`p2mx_f_checkt` (`GIDF` ,`causekey` ,`check_val`)
	 VALUES ('".$_SESSION['GIDF']."',  '".$_POST['key']."', '".$_POST['val']."')";  
	 }else{
	 $q1 = "UPDATE  `lionproduction`.`p2mx_f_checkt` SET  `check_val` =  '".$_POST['val']."' WHERE CONVERT(  `p2mx_f_checkt`.`GIDF` USING utf8 ) =  '".$_SESSION['GIDF']."' AND `causekey` LIKE '".$_POST['key']."' LIMIT 1 ;";
	 }
	  mysql_query($q1);  
 }
 
 

?>

