<?php 
    /******************** MIS STANDARD HEADER ***********************	
File Name         : module_machine.php
    Project No    : 
    Create Date  : 05/08/2016
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            05/08/2016 : Module Template : mtmachine, By Tinnakorn.M
/****************************************************************/
	//initial setting 
	 $modulename = 'mtmachine';
     $plant=$_SESSION["plant"];
	 //Switch your component here
	if(!isset($_GET['c'])){ $c=1; }else{ $c=$_GET['c']; }

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

 <td style="margin:1px;" width="12%" ><a  style="width:90%;"  data-ajax="false"  href="index.php?m=<?php echo $modulename; ?>&c=1"  class="ui-btn ui-btn-inline <?php if($c==1){ echo 'ui-link ui-btn ui-btn-active'; } ?> " > กลุ่มเครื่องจักร
</a></td>
  <td  style="margin:1px;"  width="12%"><!-- <a  data-ajax="false" style="width:90%;"  href="index.php?m=<?php echo $modulename; ?>&c=2"  class="ui-btn ui-btn-inline <?php if($c==2){ echo 'ui-link ui-btn ui-btn-active'; } ?> " > ประวัติการซ่อม
   </a> --></td>
  <td style="margin:1px;" width="12%" ><!-- <a  data-ajax="false"  style="width:90%;"   href="index.php?m=<?php echo $modulename; ?>&amp;c=3"  class="ui-btn ui-btn-inline <?php if($c==3){ echo 'ui-link ui-btn ui-btn-active'; } ?> " >การตรวจเช็ค</a> --></td>
  <td style="margin:1px;" > 
       </td>
    </tr>
</table>

 
<div>
<?php  
//initial setting area
	  !isset($_GET['gr']) ? $gr='ALL':$gr=$_GET['gr']   ;

	
	if ($c ==1){
			//Start component 1
			if($gr=='ALL'){
				include('../../include/model-teadmin/components/page/component_machine.php');
			}else{
				include('../../include/model-teadmin/components/page/component_machine_gr.php');
			}
	}else if ($c==2){
		//Start component 2
	}else if ($c==3){
		//Start component 3
	}else if ($c==4){
		//Start component 4
	}

?>
</div>

</div>
<!-- end div module -->
