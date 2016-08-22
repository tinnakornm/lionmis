<!-- Update Filter Duration 9/05/59  Peerayu.R -->

 <?php
 
 require('../../../../include/config.inc.php'); 
 mysql_select_db($db,$connect); 
 		
	if(!isset($_GET['SE'])){
	$SE = 'ALL';
	}else{ $SE = $_GET['SE']; }
	
	 if(isset($_GET['DB'])){ $DB=$_GET['DB']; }else{ $DB=date("Y-m-d"); }
        $date=date_create($DB);
        $MM = date_format($date,"m");
        $DD = date_format($date,"d");
        $YYYY = date_format($date,"Y");
        
        
	if(isset($_GET['DF'])){ $DF=$_GET['DF']; }else{ $DF=date("Y-m-d"); }
        	
	
	$thisMM = (int)date("m");
	if($thisMM==12){ $nextMM = 1; $thisYY = (int)date("Y")+1; }else{ $nextMM=$thisMM+1;  $thisYY=(int)date("Y"); }
	?>
<style type="text/css">
 
#tlb td, #tlb td th {
border: 1px solid #CCC;
padding: 4px;
 
font-size:13px;
}
 
input { border:none; color:#0000FF;  text-align:center; padding-top:0px; padding-bottom:0px;  }
input:hover { background:#FFCCCC;   color:#FF0000; }

.hightlight{ background-color:#EAD24D; }
.hightlightbf{ background-color:#FCC;}

.tim{ cursor:cell; }
.blur{ color:#CCC;}
.leadconfirm{ color: rgb(228, 69, 0); }
 

</style>
<link rel="stylesheet"  href="../../../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">


<script type="text/javascript" src="http://lionproduction.sli/pdmis/include/lib/jquery1.10.2.min.js"></script>
<script type="text/javascript" src="http://lionproduction.sli/pdmis/include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js"></script>



<script type="text/javascript" src="../../js/mxqa.js"></script> 
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<script type="text/javascript"> 
    $(document).ready(function() {
		
	//start change
			$("#main_mixer").change(function()
			{	var main_mixer=$(this).val();
				var dataString = 'main_mixer='+ main_mixer;
			 
				$.ajax({ type: "GET",
				url: "components/ajax_start_fullformula.php",
				data: dataString,
				cache: false,
				success: function(html){ 
				$("#fullformula").html(html);  
				} 
				}); //end GET
			});//end .change	
 
	
	});
	//popupscript
</script>
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	
	newwindow=window.open(url,'name','height=550,width=500,screenX=500,screenY=100');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>

<div data-role="content" style="background:#FFF;">
  <div style="text-align:center; padding:5px; background-color:#CEE1F7;">
      <form id="form1" name="form1" method="GET" action="components/page/filter.php">
       <strong>Filter </strong>
       
        DateStart :
<input type="date" name="DB" id="DB" data-role="none" required="required" value="<?php echo $DB; ?>" /> - <input type="date" name="DF" id="DF" data-role="none" required="required" value="<?php echo $DF; ?>" />
        
            
            Semi-Code: 
            <select name="SE" id="jumpMenu"   data-role="none">
            <option value="ALL" <?php if($SE=='ALL'){ echo 'selected="selected"'; } ?>>ALL</option>
      <?php $qse = mysql_query("SELECT DISTINCT  `fullformula` 
FROM  `qamxbc_rep` ORDER BY  `fullformula` ASC LIMIT 0 , 100");
	  while ($arrse = mysql_fetch_array($qse)){ ?>
      <option value="<?php echo $arrse['fullformula']; ?>" <?php if($SE==$arrse['fullformula']){ echo 'selected="selected"'; } ?>><?php echo $arrse['fullformula']; ?></option>
      <?php }//end while ?>
    </select>
			
              <input name="f" type="hidden" value="2" />    
           
      <input type="submit" name="button"  id="button" value="Execute" data-role="none" />
            
             
		 
      </form> 
             
			  
</div>
  <div style="float:left; font-size:24px; padding-top:15px; padding-left:8px;"><strong>&raquo;ใบส่งตัวอย่างและแจ้งผลการวิเคราะห์</strong></div>
   
  <div id="info"></div>
<div style="text-align:right; float:right;">
 
 
                  <table>
                  <tr>
                   <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                    <td>&nbsp;</td>
                  <td><a href="#popupLogin"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex;"   >สร้างใบส่ง</a></td>
                 </tr>
                 </table>
 </div>
  <!--rep table-->
  <table style="width:100%;" id="tlb">
    <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
      <td>#No</td>
      <td>Date</td>
     
      <td>Formula</td>
      <td>Bt.No</td>
     
      <td> Bt.Size</td>
     
     
     
       <td> PH  </td>
      
      <td>VISC</td>
      <td>Step</td>
      <td>Note</td>
      <td>ผู้ส่ง</td>
      <td> Status </td>
      <td> Tools </td>
    </tr>
    <?php
  
   //original detail
	// if($D=='all'){ $RD='';}else{ $RD = 'AND `DD` = '."'$D'"; }
	// if($P=='all'){ $PD=''; }else{ $PD = 'AND `pd_group` = '."'$P'"; }
 
  if(isset($_GET['SE'])){  if($_GET['SE']!='ALL'){  $qSE = "AND  `fullformula` LIKE  '".$_GET['SE']."'"; }else{ $qSE = ''; }  
	 }else{ $qSE = ''; }
 
 $qstring = "SELECT * FROM  `qamxbc_rep` WHERE   `rep_date` BETWEEN  '$DB 00:00:00' AND  '$DF 23:59:59'  $qSE  ORDER BY `bt_no` DESC,`rep_date` DESC,`fullformula` ASC";
 
 
	//$qstring = "SELECT * FROM `qamxbc_rep` WHERE 1 AND `DD` = '9' AND `MM` = '5' AND `YYYY` ='2016' ORDER BY `qamxbc_rep`.`rep_id` DESC ";
	
	  

	
 
 
				$query = mysql_query($qstring);
				if($query==""){
					
				}
				if(mysql_num_rows($query)){
					 $i=1;
				   while($arrep = mysql_fetch_array($query))				   
				   {
					    $qck =mysql_query("SELECT * FROM  `qamxbc_check` WHERE  `QID` LIKE  '".$arrep['QID']."' LIMIT 0 , 1",$connect)or die(mysql_error());
 $arck = mysql_fetch_array($qck);
 
  ?>
    <tr style="" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
      <td><div style="text-align:center;">
        <?php if($arrep['rep_status']==0 ){ ?>
        [<a href="components/del-mxqa.php?id=<?php echo $arrep['QID']; ?>" onclick="return confirm('คุณต้องการลบรายงานนี้ใช่หรือไม่ ?')"  data-ajax="false" >ลบ</a>]
        <?php } ?>
        <?php echo $i; ?></div></td>
      <td><div style="text-align:center;"><?php echo $arrep['DD'].'-'.$arrep['MM'].'-'.$arrep['YYYY']; ?></div></td>
     
      <td><div style="text-align:center;"><?php echo $arrep['fullformula']; ?></div></td>
      
      <td><div style="text-align:center;"><?php echo $arrep['bt_no']; ?></div></td>
     
      <td><div style="text-align:center;"><?php echo $arrep['bt_size']; ?></div></td>
     
     
       <td width="70px"><div style="text-align:center;"><?php echo $arck['ph_act'] ; ?> 
       </div>
       </td>
       
       
      
      <td><div style="text-align:center;"><?php echo $arck['vis_act']; ?></div></td>
        <td><div style="text-align:center;">
        <?php if ($arrep['step_type'] == 1) {echo "Semi";} 
			 elseif ($arrep['step_type'] == 0) {echo "Premix" ;}
			 elseif ($arrep['step_type'] == 2) {echo "pH Adj" ;}
			 elseif ($arrep['step_type'] == 3) {echo "Visc. Adj" ;}
			   ?>
      </div></td>
      <td><div style="text-align:center;"><?php echo $arrep['check_note_mx']; ?></div></td>
      <td><div style="text-align:center;"><?php echo $arrep['mix_sname']; ?></div></td>
      <td><div style="text-align:center;">
        <div style="text-align:center;">
          <?php require("subpast/part_btn_checkresult.php"); ?>
        </div>
      </div></td>
      <td><div style="text-align:center; margin:auto;">
        <!--  
            <a href="components/join-oee.php?qid=<?php echo $arrep['QID']; ?>"  style="display: inline-flex; background-color:green; " data-ajax="false" 
            class="  ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext <?php if($arrep['rep_status']>0){ echo 'ui-disabled'; } ?>">
            
            แก้ไข</a>
             -->
        <a href="../../p_rep-pe-031.php?qid=<?php echo $arrep['QID']; ?>"   tarGET="<?php echo $arrep['QID']; ?>" data-ajax="false" class="ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext" style="display: inline-flex; background-color:#3388cc;" >รายงาน</a> 
        
        
        <a href="../../header_print.php?qid=<?php echo $arrep['QID']; ?>"    tarGET="<?php echo $arrep['QID']; ?>" data-ajax="false" id="popup" onclick="return popitup('../../header_print.php?qid=<?php echo $arrep['QID'];?>')" class="ui-btn ui-shadow ui-corner-all ui-icon-eye ui-btn-icon-notext" style="display: inline-flex; background-color:#FFCC00;" >รายงาน</a>
        
        
        
        <a href="../../copy_rep.php?qid=<?php echo $arrep['QID']; ?>"    tarGET="<?php echo $arrep['QID']; ?>" data-ajax="false" id="popup" onclick="return popitup('../../copy_rep.php?qid=<?php echo $arrep['QID'];?>')" class="ui-btn ui-shadow ui-corner-all ui-icon-action ui-btn-icon-notext" style="display: inline-flex; background-color: #090;" >รายงาน</a>
        
        <!-- report-info-popup -->
        <?php include('subpast/popup_repinfo.php');  ?></td>
    </tr>
    <?php 
		  
		
		$i++;}//end while
				}else{
					
		?>
    <tr>
      <td colspan="16"><div style="text-align:center;"> ไม่มีรายงานที่ท่านค้นหา </div></td>
    </tr>
    <?php }//end if not num rows 
		?>
  </table>
  <!-- end rep table -->
  <!-- pouup -->
          <?php include('subpast/popup_start_mxqa.php'); ?>
  <!-- endpoupu --> 
 		  <?php 
		    //update alertation
		    mysql_query("UPDATE  `lionproduction`.`meta_tag` SET  `meta_val` =  '0'  WHERE  `meta_tag`.`meta_tag` LIKE 'BCMXQA'");
			
			
	
		  ?>
  
            
          
        