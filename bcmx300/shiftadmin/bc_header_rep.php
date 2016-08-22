<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h3><title>ใบส่งตัวอย่าง</title></h3>

<style type="text/css">
@media print
{
.noprint {visibility:hidden;}
}
</style>


 
</head>
<?php

 require('../../include/config.inc.php'); 
 mysql_select_db($db); 
    if(isset($_GET['qid'])){
		    
		  
		  
		$qrep =mysql_query("SELECT * FROM  `qamxbc_rep` WHERE  `QID` LIKE  '".$_GET['qid']."' LIMIT 0 , 1",$connect)or die(mysql_error());				
		if(!mysql_num_rows($qrep)){ echo 'Error, no report record'; exit; }
		$arrep = mysql_fetch_array($qrep);
		
		
		 $qck =mysql_query("SELECT * FROM  `qamxbc_check` WHERE  `QID` LIKE  '".$_GET['qid']."' LIMIT 0 , 1",$connect)or die(mysql_error());
 $arck = mysql_fetch_array($qck);
	}
	else
	echo 'No Report ID';		
 ?>
 

    
    
   









<body >


 <p>แสดง</p>
<p class="noprint">ไม่แสดง</p>

</body>
</html>
