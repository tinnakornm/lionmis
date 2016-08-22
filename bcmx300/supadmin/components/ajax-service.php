<?php
/*	File Name    : ajax-service.php
    	Project No   : P002
    	Create Date  : 01/07/2015
	Create by    : Tinnakorn.M
	Description  : Ajax checking service
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
 		         
        - 01/07/2015 : [Card No:-], Ajax posted by class, By Tinnakorn.M
		- 28/09/2015 : [Card No:-], Add process softener alert query item (2)
		
	    (Case backup)
            - DD/MM/YYYY : Backup, File name :  , By Tinnakorn.M
	       
*/
##########################################################################################
session_start();
if(!session_is_registered("login_true"))
{exit;}
 require('../../../include/config.inc.php'); 
 mysql_select_db($db); 
 $q = mysql_query("SELECT * FROM  `meta_tag` WHERE  `meta_tag` LIKE  'BCMXQA' AND  `meta_val` LIKE  '1' LIMIT 0 , 1");
 if(mysql_num_rows($q)){
	 echo '1'; //has an event, going to action.
 }else{
	 echo '0'; //no event.
	 }
 
 

 
?>

