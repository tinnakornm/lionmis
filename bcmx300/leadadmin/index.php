 <?php session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
/*	File Name    : index.php
    	Project No   : V002
    	Create Date  : 02/05/2015
	Create by    : Tinnakorn.M
	Description  : Index of oee admin
	psd/File data flow:       
*/
 if(!$_SESSION['uname']){  echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>"; }
 
error_reporting(E_ALL);


 require('../../include/config.inc.php'); 
 mysql_select_db($db,$connect); 
     include_once '../../include/class/coo_pk_shiftadmin.class.php';
   //Open class OP
 	//$OPS = new OP();	
//menu get
		if(!isset($_GET['f'])){
			$f=0;
		}else{
			$f=$_GET['f'];
		}
     !isset($_GET['page'])?$page=1:$page=$_GET['page'];
 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title>MIXING OEE ADMIN</title>
	<link rel="stylesheet"  href="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	<style type="text/css">
	
	
#tlb td, #tlb td th {
border: 1px solid #CCC;
padding: 4px;
 
}
 
	 .ui-responsive {
 display: table-row-group;
}
 
<?php if($_SESSION['uname']){ ?>
.ui-icon-user:after{ background-color:#060; }
<?php } ?>

  table { border-collapse:collapse;}
 .frame{ border: 1px solid black;	text-align: center; }

    </style>
	<script type="text/javascript" src="../../include/lib/jquery1.10.2.min.js"></script>
	<script src="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js"></script>
    



</head>

<body>
<div data-role="page" style="background-color:#FFF;">
   <!-- panel -->
       <?php  require('components/menu.php'); ?>
    <!-- header -->
	<?php require('components/header.php'); ?>

 
    
		<?php 
	 if($f==0){ 
	       if($page==1){
		     if(isset($_SESSION['GIDF'])){ //go to check page
	 			require('components/page/subpast/ckfrm-oee.php');   
			 }else{
				require('components/page/frm-oee.php');    
			 }
			 
		   }else{
				include('add_pd_data.php');   
			   
		   }
		}elseif($f==1){
			
		
			 require('components/page/his-oee.php');
		
			
			
			 
			   
		}elseif($f==2)
		
		{ 
		
		
		if(!isset($_GET['page'])) $_GET['page'] = 'date';
				if($_GET['page'] == 'rank') 
						require('components/page/his-mxqa.php'); 
				else
						require('components/page/filter-date.php'); 
		 }
	
		
		 ?>
        
        <!--/content-->
	 

	<div data-role="footer">
	  <?php include('../../components/footer.php'); ?>
  </div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
