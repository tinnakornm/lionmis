<?php
session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	/*	File Name    : add_sparepart.php
    	Project No   : -
    	Create Date  : 12/02/2016
	Create by    : Tinnakorn.M
	Description  : Add and upload file for spare part
	 */
	require('../../../../include/config.inc.php'); 
    mysql_select_db($db);

   if(isset($_POST['editquizS'])){
		//get post initial value
		$spr_recname = $_SESSION['name'];
		if(isset($_POST['quiz_name'])){ $quiz_name = htmlspecialchars($_POST['quiz_name'], ENT_QUOTES); }else{ $quiz_name = ""; }
		 
		if(isset($_POST['quiz_title'])){ $quiz_title = htmlspecialchars($_POST['quiz_title'], ENT_QUOTES); }else{ $quiz_title = ''; }
		if(isset($_POST['quiz_date'])){ $quiz_date = $_POST['quiz_date']; }else{ $quiz_date = ''; }
	 	if(isset($_POST['quiz_username'])){ $quiz_username = htmlspecialchars($_POST['quiz_username'], ENT_QUOTES); }else{ $quiz_username = ''; }
	   
			
	   
	   
        mysql_query("INSERT INTO  `lionproduction`.`hr_quiztopic` (
`quiz_id` ,`quiz_status` ,`quiz_name` ,`quiz_title` ,`quiz_description` ,`quiz_date` ,`quiz_username` ,`quiz_revdate` ,`quiz_revusername`)
VALUES (NULL ,'$quiz_status','$quiz_name',  '$quiz_title', '$quiz_description',  '".date("Y-m-d")."','$quiz_username',   '$quiz_revdate', '$quiz_revusername')")or die ("Cannot insert to database");
   }//end post newsprt
      echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/hr/leadadmin/?f=2&mn=2'>";
?>	  
