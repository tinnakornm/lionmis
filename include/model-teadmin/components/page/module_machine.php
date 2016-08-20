<?php
 	  $plant=$_SESSION["plant"];
	  !isset($_GET['gr']) ? $gr='ALL':$gr=$_GET['gr']   ;
	  !isset($_GET['mn']) ? $mn='1':$mn=$_GET['mn']   ;
	
?>

  
      
 

<link href="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.1.css"  />
<link href="include/search/jquery-typeahead-2.0.0/src/jquery.typeahead.css">

  <script type="text/javascript">
$(	document).ready(function() {
    
	$('#search').change(function(){
		var text = $(this).val();
				
		
		});
	
	
});	

  


<!--
function JJ_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
  
}
//-->
  
</script>                       


<div id="content-machine" style="margin-left:10px; margin-right:10px; margin-top:10px;">

<table  border="0" cellpadding="0" style=" width: 100%;">
 <tr>

 <td style="margin:1px;" width="12%" ><a  style="width:90%;"  data-ajax="false"  href="index.php?f=0&mn=1"  class="ui-btn ui-btn-inline <?php if($mn==1){ echo 'ui-link ui-btn ui-btn-active'; } ?> " > กลุ่มเครื่องจักร
</a></td>
  <td  style="margin:1px;"  width="12%"><!-- <a  data-ajax="false" style="width:90%;"  href="index.php?f=0&mn=2"  class="ui-btn ui-btn-inline <?php if($mn==2){ echo 'ui-link ui-btn ui-btn-active'; } ?> " > ประวัติการซ่อม
   </a> --></td>
  <td style="margin:1px;" width="12%" ><!-- <a  data-ajax="false"  style="width:90%;"   href="index.php?f=0&amp;mn=3"  class="ui-btn ui-btn-inline <?php if($mn==3){ echo 'ui-link ui-btn ui-btn-active'; } ?> " >การตรวจเช็ค</a> --></td>
  <td style="margin:1px;" > 
       </td>
    </tr>
</table>

 
<div>
<?php 
if ($mn ==1){
	if($gr=='ALL'){
		include('../../include/model-teadmin/components/page/component_machine.php');
	}else{
		include('../../include/model-teadmin/components/page/component_machine_gr.php');
	}
		
}else if ($mn==2){
	
}else if ($mn==3){
	
}else if ($mn==4){
	
}

?>
</div>

</div><!-- end div module -->
