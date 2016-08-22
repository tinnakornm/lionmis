 <?php
 
 		if(!isset($_GET['P'])){
	$P = 'all';
	}else{ $P = $_GET['P']; }


	if(!isset($_GET['V'])){
	$V = 2;
	}else{ $V=$_GET['V']; }	
	
	if(!isset($_GET['D'])){
	$D =(int)date("d");	
	}else{ $D=$_GET['D']; }
	
	if(!isset($_GET['MM'])){
	$MM = (int)date("m");	
	}else{ $MM=$_GET['MM']; }
	
	if(!isset($_GET['YYYY'])){
	$YYYY = (int)date("Y");
	}else{ $YYYY=$_GET['YYYY']; }
	
	if($D<=1){ $YD = 1; }else{ $YD=$D-1; }
	
	
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
<script type="text/javascript" src="components/page/js/leader.js"></script> 
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<div data-role="content" style="background:#FFF;">
  <div style="text-align:center; padding:5px; background-color:#CEE1F7;">
      <form id="form1" name="form1" method="post" action="">
       <strong>Fillter </strong>
	   DD 
	   <select name="D" onchange="MM_jumpMenu('parent',this,0)" data-role="none">
	   
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=all&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='all'){ echo"selected=\"selected\""; }?>>ALL</option>
	 
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=01&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='01'){ echo"selected=\"selected\""; }?>>01</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=02&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='02'){ echo"selected=\"selected\""; }?>>02</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=03&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='03'){ echo"selected=\"selected\""; }?>>03</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=04&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='04'){ echo"selected=\"selected\""; }?>>04</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=05&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='05'){ echo"selected=\"selected\""; }?>>05</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=06&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='06'){ echo"selected=\"selected\""; }?>>06</option>	   
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=07&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='07'){ echo"selected=\"selected\""; }?>>07</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=08&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='08'){ echo"selected=\"selected\""; }?>>08</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=09&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='09'){ echo"selected=\"selected\""; }?>>09</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=10&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='10'){ echo"selected=\"selected\""; }?>>10</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=11&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='11'){ echo"selected=\"selected\""; }?>>11</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=12&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='12'){ echo"selected=\"selected\""; }?>>12</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=13&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='13'){ echo"selected=\"selected\""; }?>>13</option>	
<option value="components/page/?f=1&amp;V=<?php echo "$V"; ?>&amp;D=14&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='14'){ echo"selected=\"selected\""; }?>>14</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=15&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='15'){ echo"selected=\"selected\""; }?>>15</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=16&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='16'){ echo"selected=\"selected\""; }?>>16</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=17&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='17'){ echo"selected=\"selected\""; }?>>17</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=18&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='18'){ echo"selected=\"selected\""; }?>>18</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=19&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='19'){ echo"selected=\"selected\""; }?>>19</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=20&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='20'){ echo"selected=\"selected\""; }?>>20</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=21&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='21'){ echo"selected=\"selected\""; }?>>21</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=22&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='22'){ echo"selected=\"selected\""; }?>>22</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=23&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='23'){ echo"selected=\"selected\""; }?>>23</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=24&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='24'){ echo"selected=\"selected\""; }?>>24</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=25&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='25'){ echo"selected=\"selected\""; }?>>25</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=26&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='26'){ echo"selected=\"selected\""; }?>>26</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=27&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='27'){ echo"selected=\"selected\""; }?>>27</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=28&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='28'){ echo"selected=\"selected\""; }?>>28</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=29&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='29'){ echo"selected=\"selected\""; }?>>29</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=30&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='30'){ echo"selected=\"selected\""; }?>>30</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=31&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($D=='31'){ echo"selected=\"selected\""; }?>>31</option>	
        </select>
	   (MM)
       <select name="MM" onchange="MM_jumpMenu('parent',this,0)"  data-role="none">
	 
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=01&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='01'){ echo"selected=\"selected\""; }?>>01</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=02&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='02'){ echo"selected=\"selected\""; }?>>02</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=03&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='03'){ echo"selected=\"selected\""; }?>>03</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=04&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='04'){ echo"selected=\"selected\""; }?>>04</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=05&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='05'){ echo"selected=\"selected\""; }?>>05</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=06&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='06'){ echo"selected=\"selected\""; }?>>06</option>	   
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=07&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='07'){ echo"selected=\"selected\""; }?>>07</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=08&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='08'){ echo"selected=\"selected\""; }?>>08</option>
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=09&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='09'){ echo"selected=\"selected\""; }?>>09</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=10&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='10'){ echo"selected=\"selected\""; }?>>10</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=11&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='11'){ echo"selected=\"selected\""; }?>>11</option>	
<option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=12&amp;YYYY=<?php echo $YYYY; ?>&amp;P=<?php echo $P; ?>" <?php if($MM=='12'){ echo"selected=\"selected\""; }?>>12</option>			   
        </select>
       /(YYYY)
            <select name="YYYY" onchange="MM_jumpMenu('parent',this,0)"  data-role="none">
              <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2011&amp;P=<?php echo $P; ?>" <?php if($YYYY=='2011'){ echo"selected=\"selected\""; }?>>2011</option>
              <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2012&amp;P=<?php echo $P; ?>" <?php if($YYYY=='2012'){ echo"selected=\"selected\""; }?>>2012</option>
              <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2013&amp;P=<?php echo $P; ?>" <?php if($YYYY=='2013'){ echo"selected=\"selected\""; }?>>2013</option>
              <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2014&amp;P=<?php echo $P; ?>" <?php if($YYYY=='2014'){ echo"selected=\"selected\""; }?>>2014</option>
              <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2015&amp;P=<?php echo $P; ?>" <?php if($YYYY=='2015'){ echo"selected=\"selected\""; }?>>2015</option>
            </select>
			
			Process 
			<select name="P" onchange="MM_jumpMenu('parent',this,0)"  data-role="none">
			 <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=all" <?php if($P=='DW'){ echo"selected=\"selected\""; }?>>ALL</option>	
			 
          <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=DW" <?php if($P=='DW'){ echo"selected=\"selected\""; }?>>DW</option>	
		  <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=SF" <?php if($P=='SF'){ echo"selected=\"selected\""; }?>>SF</option>	
		  <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=ST" <?php if($P=='ST'){ echo"selected=\"selected\""; }?>>ST</option>	
		  <option value="?f=1&amp;V=<?php echo "$V"; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>&amp;P=LD" <?php if($P=='LD'){ echo"selected=\"selected\""; }?>>LD</option>	
            </select>
			  Date Control [  <a data-ajax="false" href="?f=1&D=<?php echo $YD; ?>&MM=<?php echo $MM; ?>&YYYY=<?php echo $YYYY; ?>" title="ย้อนกลับ"> <img src="../../source/icons/control-180.png" width="16" height="16" style="vertical-align:middle;" /></a> ] [  <a data-ajax="false" href="?f=1" title="กลับมายังวันปัจุบัน"> <img src="../../source/icons/control-pause.png" width="16" height="16" style="vertical-align:middle;"/></a> ] [  <a data-ajax="false" href="?f=1&D=<?php echo $D+1; ?>&MM=<?php echo $MM; ?>&YYYY=<?php echo $YYYY; ?>" title="วันถัดไป"> <img src="../../source/icons/control.png" width="16" height="16" style="vertical-align:middle;" /></a>]
             
			 
      </form> 
	</div>
  <div style="float:left; font-size:24px; padding-top:15px; padding-left:8px;"><strong>&raquo; รายงานการผลิต OEE</strong></div>
  <div id="info"></div>
 <div style="text-align:right; float:right;">
 
 
                  <table>
                  <tr>
                   <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                    <td>&nbsp;</td>
                  <td>&nbsp;</td>
                 </tr>
                 </table>
 </div>
  <!--rep table-->
 		<table style="width:100%;" id="tlb">
        <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
          <td>#No</td>
        	<td>Date</td>
        	<td>Process</td>
            <td>Mixer</td>
        	<td>Shift</td>
             
            <td> Shift Lead</td>
            <td> Operate </td>
            <td> Start Tim</td>
            <td>Finish Tim</td>
            
            <td> Status </td>
            <td> Tools </td>
         </tr>
  
  <?php
  
   //original detail
	 if($D=='all'){ $RD='';}else{ $RD = 'AND `DD` = '."'$D'"; }
	 if($P=='all'){ $PD=''; }else{ $PD = 'AND `pd_group` = '."'$P'"; }
 
	 $qstring = "SELECT * FROM  `p2mx_f_rep` WHERE `rep_uname` LIKE '".$_SESSION['uname']."'  ".$PD.$RD." AND `MM` = '$MM' AND `YYYY` ='$YYYY'  ORDER BY  `p2mx_f_rep`.`id` DESC ";
 
				$query = mysql_query($qstring);
				if(mysql_num_rows($query)){
					 $i=1;
				   while($arrep = mysql_fetch_array($query)){
  ?>       
         <tr style="" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"> 
         
           <td>
           <div style="text-align:center;">
           
           <?php if(($arrep['rep_uname']==$_SESSION['uname'])and($arrep['shift_appr']==0)and($arrep['sup_appr']==0)and($arrep['acc_appr']==0)){
			   ?>
		   [<a href="components/del-oee.php?id=<?php echo $arrep['GIDF']; ?>" onclick="return confirm('คุณต้องการลบรายงานนี้ใช่หรือไม่ ?')" data-ajax="false" >ลบ</a>]
           <?php } ?>
           
           
		   <?php echo $i; ?></div></td>   
           <td> <div style="text-align:center;"><?php echo $arrep['DD'].'-'.$arrep['MM'].'-'.$arrep['YYYY']; ?></div></td>
           <td><div style="text-align:center;"><?php echo $arrep['pd_group']; ?></div></td>
           <td><div style="text-align:center;"><?php echo $arrep['main_mixer']; ?></div></td>
           <td><div style="text-align:center;"><?php echo $arrep['shift']; ?></div></td>
           
            <td> <div style="text-align:center;"><?php echo $arrep['shift_sname']; ?></div></td>
            <td>  <div style="text-align:center;"><?php echo $arrep['lead_sname']; ?></div></td>
            <td> <div style="text-align:center;"><?php echo $arrep['start_tim_define']; ?></div></td>
            <td><div style="text-align:center;"><?php echo $arrep['stop_tim_define']; ?></div></td>
            
            <td>
            
            <div style="text-align:center;">
            <?php 
			if($arrep['rep_status']=='pending'){
				echo 'กำลังบันทึก..';
			}else{
				if($arrep['shift_appr']==0){
				echo '<span style="color:rgb(255, 58, 0)">รอตรวจสอบ</span>';
				}else{
				echo '<span style="color:green">อนุมัติแล้ว</span>';
				}
			}
			
			 ?>
            
            </div>
            
             </td>
            <td>
            <div style="text-align:center; margin:auto;">
            <?php if($arrep['rep_uname']==$_SESSION['uname']){ ?>
            <a href="components/join-oee.php?id=<?php echo $arrep['GIDF']; ?>"  style="display: inline-flex; background-color:green; " data-ajax="false" 
            class="<?php if($arrep['shift_appr']==1){ echo 'ui-disabled'; } ?> ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext">
            
            แก้ไข</a>
            <?php } ?>
            
            
            <a href="p_repf.php?id=<?php echo $arrep['GIDF']; ?>"   target="<?php echo $arrep['GIDF']; ?>" data-ajax="false" class="ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext" style="display: inline-flex; background-color:#3388cc;" >รายงาน</a>
            
           </div> </td>
            
        </tr>
        <?php $i++;}//end while
				}else{
					
		?>
        <tr>   <td colspan="12"><div style="text-align:center;"> ไม่มีรายงานที่ท่านค้นหา  </div></td> </tr>
        <?php }//end if not num rows 
		?>
        
        </table>
 
  <!-- end rep table -->
 
 </div><!--end data-role content -->
        