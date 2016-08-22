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
 
 $sql="INSERT INTO `p3mx_pd`(`id` ,`pd_group`, `process`, `formula`, `version`, `fullformula`, `mixer`, `definition`, `status`, `product_name`, `create_by`, `create_date`, `effective_date`, `rev`, `batch_size`,`dup_status`) 

VALUES (NULL,'1','2','3','4','5','6','7','8','9','10','11','12','13','14','15')";
 
 if(mysql_query($sql)){
	 echo "Success";
			
							
				}else{
					 echo 'Error'.$sql;
				}

 

?>
</body>
</html>
