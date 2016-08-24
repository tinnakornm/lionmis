<?php
    /******************** MIS STANDARD HEADER ***********************	
File Name        : component_workorder.php
    Project No   : 
    Create Date  : 05/08/2016
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            05/08/2016 : Component Template : workorder, By Tinnakorn.M
/****************************************************************/
?>
<?php
 
	if(!isset($_GET['V'])){
	$V = 2;
	}else{ $V=$_GET['V']; }	
	
	if(!isset($_GET['D'])){	
	$D ='ALL';	
	}else{ $D=$_GET['D']; 
	}
	
	if(!isset($_GET['dev'])){	
	$dev =$dev_v1;	
	}else{ $dev=$_GET['dev']; 
	}
	
	if(!isset($_GET['MM'])){
	$MM = (int)date("m");	
	}else{ $MM=$_GET['MM']; }
	
	if(!isset($_GET['YYYY'])){
	$YYYY = (int)date("Y");
	}else{ $YYYY=$_GET['YYYY']; }
	
	if($D<=1){ $YD = 1; }else{ $YD=$D-1; }
	
	 
	
	?>

<!-- dinamic table -->  
<link rel="stylesheet" href="../../include/lib/jspkg/jquery.dynatable.css">
 <script src="../../include/lib/jspkg/jquery.dynatable.js"></script>  
 <script>
   $(document).ready(function() 
	{ //start all function here
        //start dynatable
 		$('#tlb').dynatable({
		  table: {
			defaultColumnIdStyle: 'trimDash'
		  }
		});
 
	});
 </script> 
 
<div data-role="content">
   <div class="title-header">
  <div style="float:left; font-size:24px; padding-top:15px;  padding-bottom:10px;"><strong>&raquo;    ใบแจ้งซ่อม work order</strong></div>
  <div id="info"></div>
 <div style="text-align:right; float:right;">
 
 
                  <table>
                  <tr>
                   <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                     
                    
                  <td> <a href="#popupNewWorkOrder"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c"   style="display: inline-flex; background-color: rgb(51, 136, 204); color: #FFF;"  > เพิ่มใบแจ้งซ่อม</a>
 
               
                  
                  </td>
                 </tr>
                 </table>
 </div>
  </div><!-- end title-header -->
  <div style="margin-top:60px;  padding-bottom:5px;">  รายการใบแจ้งซ่อมออนไลน์ ซึ่งถูกสร้างขึ้นโดยหน่วยงาน </div>
  <div style="text-align:center; padding:5px; background-color:#CEE1F7;">
      <form id="form1" name="form1" method="post" action="">
       <strong>Fillter </strong>
       หน่วยงาน 
         	   <select name="D" onchange="MM_jumpMenu('parent',this,0)" data-role="none">
                  <option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($dev==$dev_v1){ echo"selected=\"selected\""; }?>><?php echo $dev_v1; ?></option>
               </select>
       
	   DD 
	   <select name="D" onchange="MM_jumpMenu('parent',this,0)" data-role="none">
	   
<option value="?m=<?php echo $modulename; ?>&amp;D=ALL&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='ALL'){ echo"selected=\"selected\""; }?>>ALL</option>
	 
<option value="?m=<?php echo $modulename; ?>&amp;D=01&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='01'){ echo"selected=\"selected\""; }?>>01</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=02&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='02'){ echo"selected=\"selected\""; }?>>02</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=03&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='03'){ echo"selected=\"selected\""; }?>>03</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=04&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='04'){ echo"selected=\"selected\""; }?>>04</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=05&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='05'){ echo"selected=\"selected\""; }?>>05</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=06&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='06'){ echo"selected=\"selected\""; }?>>06</option>	   
<option value="?m=<?php echo $modulename; ?>&amp;D=07&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='07'){ echo"selected=\"selected\""; }?>>07</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=08&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='08'){ echo"selected=\"selected\""; }?>>08</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=09&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='09'){ echo"selected=\"selected\""; }?>>09</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=10&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='10'){ echo"selected=\"selected\""; }?>>10</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=11&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='11'){ echo"selected=\"selected\""; }?>>11</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=12&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='12'){ echo"selected=\"selected\""; }?>>12</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=13&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='13'){ echo"selected=\"selected\""; }?>>13</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=14&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='14'){ echo"selected=\"selected\""; }?>>14</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=15&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='15'){ echo"selected=\"selected\""; }?>>15</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=16&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='16'){ echo"selected=\"selected\""; }?>>16</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=17&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='17'){ echo"selected=\"selected\""; }?>>17</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=18&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='18'){ echo"selected=\"selected\""; }?>>18</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=19&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='19'){ echo"selected=\"selected\""; }?>>19</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=20&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='20'){ echo"selected=\"selected\""; }?>>20</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=21&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='21'){ echo"selected=\"selected\""; }?>>21</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=22&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='22'){ echo"selected=\"selected\""; }?>>22</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=23&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='23'){ echo"selected=\"selected\""; }?>>23</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=24&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='24'){ echo"selected=\"selected\""; }?>>24</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=25&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='25'){ echo"selected=\"selected\""; }?>>25</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=26&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='26'){ echo"selected=\"selected\""; }?>>26</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=27&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='27'){ echo"selected=\"selected\""; }?>>27</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=28&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='28'){ echo"selected=\"selected\""; }?>>28</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=29&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='29'){ echo"selected=\"selected\""; }?>>29</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=30&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='30'){ echo"selected=\"selected\""; }?>>30</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=31&amp;MM=<?php echo $MM; ?>&amp;YYYY=<?php echo $YYYY; ?>" <?php if($D=='31'){ echo"selected=\"selected\""; }?>>31</option>	
        </select>
	   (MM)
       <select name="MM" onchange="MM_jumpMenu('parent',this,0)"  data-role="none">
	 
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=01&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='01'){ echo"selected=\"selected\""; }?>>01</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=02&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='02'){ echo"selected=\"selected\""; }?>>02</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=03&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='03'){ echo"selected=\"selected\""; }?>>03</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=04&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='04'){ echo"selected=\"selected\""; }?>>04</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=05&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='05'){ echo"selected=\"selected\""; }?>>05</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=06&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='06'){ echo"selected=\"selected\""; }?>>06</option>	   
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=07&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='07'){ echo"selected=\"selected\""; }?>>07</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=08&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='08'){ echo"selected=\"selected\""; }?>>08</option>
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=09&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='09'){ echo"selected=\"selected\""; }?>>09</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=10&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='10'){ echo"selected=\"selected\""; }?>>10</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=11&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='11'){ echo"selected=\"selected\""; }?>>11</option>	
<option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=12&amp;YYYY=<?php echo $YYYY; ?>" <?php if($MM=='12'){ echo"selected=\"selected\""; }?>>12</option>			   
        </select>
       /(YYYY)
            <select name="YYYY" onchange="MM_jumpMenu('parent',this,0)"  data-role="none">
              <option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2016" <?php if($YYYY=='2016'){ echo"selected=\"selected\""; }?>>2016</option>
              <option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2017" <?php if($YYYY=='2017'){ echo"selected=\"selected\""; }?>>2017</option>
              <option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2018" <?php if($YYYY=='2018'){ echo"selected=\"selected\""; }?>>2018</option>
              <option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2019" <?php if($YYYY=='2019'){ echo"selected=\"selected\""; }?>>2019</option>
              <option value="?m=<?php echo $modulename; ?>&amp;D=<?php echo $D; ?>&amp;MM=<?php echo $MM; ?>&amp;YYYY=2020" <?php if($YYYY=='2020'){ echo"selected=\"selected\""; }?>>2020</option>
            </select>
		
			  Date Control [  <a data-ajax="false" href="?m=<?php echo $modulename; ?>&D=<?php echo $YD; ?>&MM=<?php echo $MM; ?>&YYYY=<?php echo $YYYY; ?>" title="ย้อนกลับ"> <img src="../../source/icons/control-180.png" width="16" height="16" style="vertical-align:middle;" /></a> ] [  <a data-ajax="false" href="?m=<?php echo $modulename; ?>" title="กลับมายังวันปัจุบัน"> <img src="../../source/icons/control-pause.png" width="16" height="16" style="vertical-align:middle;"/></a> ] [  <a data-ajax="false" href="?m=<?php echo $modulename; ?>&D=<?php echo $D+1; ?>&MM=<?php echo $MM; ?>&YYYY=<?php echo $YYYY; ?>" title="วันถัดไป"> <img src="../../source/icons/control.png" width="16" height="16" style="vertical-align:middle;" /></a>] 
      </form> 
	</div>
<!-- tbl sparepart -->
  <div style="padding-top:5px; background: #FFF; padding-bottom:20px;">
  <table  style="width:100%;" id="tlb" class="ui-body-d ui-shadow table-stripe">
  	<thead>
        <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
          <td>No</td>
           
          <td>ประเภท</td>
        	<td>ชื่อเครื่องจักร</td>
          
            <td>ชื่องาน อาการ</td>
            <td>ผู้แจ้ง</td>
            <td>วันที่แจ้ง</td>
            <td><strong> ผู้รับแจ้ง</strong> </td>
            <td>สถานะ</td>
            <td style="width:120px;">เครื่องมือ</td>
         </tr>
    </thead>
    <tbody>
          <?php     
   if($D=='ALL' ){
	   $stm="SELECT * FROM `tpm_jobreq` WHERE `MM` = '$MM'  and `YYYY` ='$YYYY'  and  `dev_v1` like  '$dev_v1'  ORDER BY  `tpm_jobreq`.`jobreq_id` DESC  ";  
   }else if ($D != 'ALL') {
	    $stm="SELECT * FROM `tpm_jobreq` WHERE `MM` ='$MM'   and `YYYY` = '$YYYY'  and  `DD` = '$D'  and  `dev_v1` like  '$dev_v1'   ORDER BY  `tpm_jobreq`.`jobreq_id` DESC ";
   }
   $job=mysql_query($stm);
            $i=1 ;         
   if ($job != ''){
	 $row = mysql_num_rows($job);
		 }else{
		 $row=0;
			 }			
			if($row >= 1){
			 ?>
   <?php  while ($arrjob=mysql_fetch_array($job)){   ?>
      
         <tr  onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
           <td><div style="text-align:center;"><?php echo $i; ?></div></td>
           <td style="width:80px;"><div style="text-align:center;"><?php echo $arrjob['jobreq_type'] ?></div></td>
             
           <td style="width:120px;"><div style="text-align:center;"><?php echo $arrjob['machine'] ?></div></td>
             
            <td><div style="text-align:left;">
            <?php if($arrjob['jobreq_imgname']!=""){ ?>
            <a href="#<?php echo $arrjob['jobreq_imgname']; ?>" data-rel="popup" data-position-to="window" data-transition="fade">
			<img style="vertical-align:middle;" width="50px;" src="http://lionproduction.sli/pdmis/tpm/images/WORKORDER/<?php echo $arrjob['jobreq_imgname']; ?>" /></a>
            <div data-role="popup" id="<?php echo $arrjob['jobreq_imgname']; ?>" data-overlay-theme="b" data-theme="b" data-corners="false">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">ปิด</a><img class="popphoto" src="http://lionproduction.sli/pdmis/tpm/images/WORKORDER/<?php echo $arrjob['jobreq_imgname']; ?>" style="max-height:512px;" alt="<?php echo $arrjob['jobreq_imgname']; ?>">
</div>
            <?php } ?>
            
			<?php if($arrjob['jobreq_title']!=""){  echo '<strong>'.$arrjob['jobreq_title'].'</strong>'; echo ', '; } ?> <?php echo $arrjob['jobreq_detail']; ?></div>
            </td>
            <td><div style="text-align:center;"><?php echo $arrjob['jobreq_recname']; ?></div>
            </td>
            <td> <div style="text-align:center;"><?php echo $arrjob['DD']; ?>/<?php echo $arrjob['MM']; ?>/<?php echo $arrjob['YYYY']; ?></div></td>
            <td><div style="text-align:center;"><?php echo $arrjob['jobto_sname']; ?></div></td>
            <td><div style="text-align:center; font-weight:bold;">
			
			<?php
			if($arrjob['job_status']=='Pending'){ echo '<span style="color:red;">••• รอรับ</span>'; }
			elseif($arrjob['job_status']=='MTReceived'){ echo '<span style="color:orange;">•• รับเรื่องแล้ว</span>'; }
			elseif($arrjob['job_status']=='MTOperating'){ echo '• กำลังดำเนินการ'; }
			elseif($arrjob['job_status']=='MTClosed'){ echo '<span style="color:green;">✔ ปิดงาน<br/>โดยช่าง MT</green>'; }
			else{ echo '<span style="color:green;">✔ ปิดงาน <br/>ช่างหน่วยงาน</green>'; }
			  
			 
			 ?></div></td>
            <td>
           <div style="text-align:center;">
           <a href="../../include/model-teadmin/components/page/subpast/popup_edit_workorder.php?JRID=<?php echo $arrjob['JRID']; ?>&dev_root=<?php echo $dev_root; ?>" data-ajax="false" id="editForm" data-transition="pop" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext " style="display: inline-flex;">Edit list</a>
            <a href="http://lionproduction.sli/pdmis/tpm/rep/workorder.php?id=<?php echo $arrjob['JRID']; ?>"  target="#" data-ajax="false" class="ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext" style="display: inline-flex;" title="Print">Print</a>
           </div> 
            </td>
            
        </tr>
          <?php $i++; }//end while
		  }else{ ?>
        <tr>   <td colspan="9"><div style="text-align:center;"> ไม่มีรายงานที่ท่านค้นหา  </div></td> </tr>
          <?php } ?>
        </tbody>
        </table>
   </div>
<!-- //end tlb sparepart -->
</div>

<!-- Popup -->
<?php include("../../include/model-teadmin/components/page/subpast/popup_frm_new_workorder.php"); 
 