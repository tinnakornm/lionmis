<?php 
##########################################################################################
/*	File Name    : filter_btn.php
    	Project No   : -
    	Create Date  : 17/5/2016
	Create by    : Peerayu.R
	Description  : HEADDER BUTTON FOR his-mxqa.php

        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
*/
##########################################################################################
if(!isset($_GET['page'])){
	$_GET['page'] = 'date';	
}


?>
<a href="?f=2&page=date" data-inline="true" data-role="button" data-icon="clock" data-iconpos="left" data-corners="false" data-theme="c" style="display: inline-flex;   width:110px; " class=" <?php echo $_GET['page'] == 'date'?  'ui-btn-active ':'';  ?>  ui-link ui-btn ui-btn-c ui-icon-clock ui-btn-icon-left ui-shadow"  role="button">Filter By Date</a>
<a href="?f=2&page=rank" data-inline="true" data-role="button" data-icon="clock" data-iconpos="left" data-corners="false" data-theme="c" style="display: inline-flex;   width:110px; " class="<?php echo $_GET['page'] == 'rank'?  'ui-btn-active ':'';  ?> ui-link ui-btn ui-btn-c ui-icon-clock ui-btn-icon-left ui-shadow"  role="button">Filter By Rank</a>
