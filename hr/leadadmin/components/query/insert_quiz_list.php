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

   if(isset($_POST['addnewquiz'])){
		//get post initial value
		$spr_recname = $_SESSION['name'];
		if(isset($_POST['list_title'])){ $list_title = htmlspecialchars($_POST['list_title'], ENT_QUOTES); }else{ $list_title = ""; }
		 
		if(isset($_POST['list_img'])){ $list_img = htmlspecialchars($_POST['list_img'], ENT_QUOTES); }else{ $list_img = ''; }
		if(isset($_POST['list_type'])){ $list_type = htmlspecialchars($_POST['list_type'], ENT_QUOTES); }else{ $list_type = ''; }
	 	if(isset($_POST['list_note'])){ $list_note = htmlspecialchars($_POST['list_note'], ENT_QUOTES); }else{ $list_note = ''; }
	   
			
	   
	   
        mysql_query("INSERT INTO  `lionproduction`.`hr_quizlist` (
`list_id` ,`list_type` ,`list_title` ,`list_img` ,`list_note` )
VALUES (NULL ,'$list_type','$list_title',  '$list_img', '$list_note')")or die ("Cannot insert to database");
   }//end post newsprt
      echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/hr/leadadmin/?f=3&mn=1'>";
?>	  
