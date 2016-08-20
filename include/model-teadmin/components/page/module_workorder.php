 
<style type="text/css">
 
#tlb td, #tlb td th {
border: 1px solid #CCC;
padding: 4px;
font-size:13px;
}

.HIDDEN_LINE{ display:none; }
.BLOCK { background-color: #EFAEAE; }
.OK { background-color:#C6F5CA; } 
 

</style>
<?php
	
    if(!isset($_GET['mn'])){ $mn=1; }else{ $mn=$_GET['mn']; }
	if($mn==1){
		if(!isset($_GET['gr'])){ $gr = 'CASE_PACKER'; }else{ $gr = $_GET['gr']; }	
		$sprg_type = 'SPECIAL';
	}else{
		if(!isset($_GET['gr'])){ $gr = 'ELECTRICS'; }else{ $gr = $_GET['gr']; }
		$sprg_type = 'GENERAL';
	}
	
	

//query main spare part group detail.
 if(isset($gr)){
	 
 	$qgr = mysql_query("SELECT `sprg_describ` FROM  `tpm_sprgrp` WHERE  `sprg_name` LIKE  '$gr' LIMIT 0 , 1");
	$arrgn = mysql_fetch_array($qgr);
	$sprg_describ = $arrgn['sprg_describ'];
 }else{
	 $sprg_describ = '';
 }

?>
 
<link href="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.1.css"  />
<script type="text/javascript" src="js/sparepart.js"></script>

  <script type="text/javascript">
$(document).ready(function(){
			$('#select-10-button').removeClass('ui-corner-all');
	$('#select-9-button').removeClass('ui-corner-all');
	});
	
	
 
//-->
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
  </script>       
  
  
 
		 
			
		 
     
 
 
<div id="content-sparepart" style="margin-left:10px; margin-right:10px; margin-top:10px;">              
<table  border="0" cellpadding="0" style=" width: 100%;">
 <tr>

 <td style="margin:1px;" width="12%" ><a  style="width:90%;"  data-ajax="false"  href="?f=2&amp;mn=1"  class="ui-btn ui-btn-inline <?php if($mn==1){ echo 'ui-link ui-btn ui-btn-active'; } ?> " > ใบแจ้งซ่อม </a></td>
  <td  style="margin:1px;"  width="12%"><a  data-ajax="false" style="width:90%;"  href="?f=2&amp;mn=2"  class="ui-btn ui-btn-inline <?php if($mn==2){ echo 'ui-link ui-btn ui-btn-active'; } ?> " > คิวงานซ่อม  </a></td>
  <td style="margin:1px;" width="12%" ><a data-ajax="false" style="width:90%;"  href="#"  class="ui-btn ui-btn-inline <?php if($mn==3){ echo 'ui-link ui-btn ui-btn-active'; } ?> " >  อื่นๆ   </a></td>
  <td style="margin:1px;" > 
    <div style="text-align:right; width: 80%;
    float: right; margin-right:18px;">
    <!-- 
   <form class="ui-filterable" ><input id="autocomplete-input" data-type="search" placeholder="ค้นหาตามชื่องาน หรือเครื่องจักร..">
</form>
<ul id="autocomplete" data-role="listview" data-inset="true" data-filter="true" data-input="#autocomplete-input" 
style="position: absolute; z-index: 1110;"
></ul> -->
          
    </div>  </td>
    </tr>
</table>

<!-- Sub menu -->
 
<!--//End sub menu -->

 <?php
   if($mn==1){
  include("component_workorder.php");
  }else{
  include("component_workorder_q.php");
  }
 
  ?>

<!-- End data-role content -->

</div><!--- end content-sparepart -- >


    

 
   
                    
                 
                   
               
       
         
   
              
              
              
              
              
              
              
              
              
           