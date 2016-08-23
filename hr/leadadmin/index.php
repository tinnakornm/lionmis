
<?php session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	
/*	File Name    : index.php
    	Project No   : V002
    	Create Date  : 8/11/2014
	Create by    : Tinnakorn.M
	Description  : Index of leaderadmin
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
            
            - 17/12/2012 : [Card No:-], Create leader admin for line leader of packing division, By Tinnakorn.M
	    
			
	    (Case backup)
            - DD/MM/YYYY : Backup, File name : xx.php, By Tinnakorn.M
	       
*/


 if(!$_SESSION['uname']){  echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>"; }
 
error_reporting(E_ALL);




 require('../../include/config.inc.php'); 
 mysql_select_db($db,$connect); 
 	
//menu get
		if(!isset($_GET['f'])){
			$f=0;
		}else{
			$f=$_GET['f'];
		}
 
 ?>

<!DOCTYPE html>
<html>
<head>
<?php   !isset($_GET['mc']) ? $mc='ALL'   : $mc=$_GET['mc']   ;    ?>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title>Technician TPM</title>
	<link rel="stylesheet"  href="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	<style type="text/css">
	 .ui-responsive {
 display: table-row-group;
}
 
<?php if($_SESSION['uname']){ ?>
.ui-icon-user:after{ background-color:#060; }
<?php } ?>

  table { border-collapse:collapse;}
 .frame{ border: 1px solid black;	text-align: center; }
  
  .ui-filter-inset {
			margin-top: 0;
		}
    </style>
	<script type="text/javascript" src="../../include/lib/jquery1.10.2.min.js"> 	</script>
	<script src="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js"></script>
 
</head>

<body>
<div data-role="page" id="myPage" data-url="myPage" >
   <!-- panel -->
       <?php  require('components/menu.php'); ?>
    <!-- header -->

    <?php require('components/header.php'); ?>
   <?php 
		//Module requirement 
		//if($f==0){  require('components/page/index.php'); }
		if($f==0){
			  require('components/page/index.php');
			   }
		elseif($f==1){
			echo '';
			 require('components/page/module_q_register.php');
			  }
		elseif($f==2){
			echo ''."<br>";
			 require('components/page/module_q_topic.php');
			  }
		elseif($f=='3'){
			echo ''."<br>";
			 require('components/page/module_q_topic_edit.php');
			  }
		 
		
	?>
        
        <!--/content-->
	 

	<div data-role="footer">
		<?php include('../../components/footer.php'); ?>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
