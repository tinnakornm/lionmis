<!-- popup popup_edit_frm_new_sparepart by Tinnakorn.M 02/16/2016 -->
<?php session_start(); ?>  
<script type="text/javascript" src="../../../../../include/lib/jquery1.10.2.min.js"></script>
	<script src="../../../../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="../../../../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" >
<div data-role="page" id="popupEditSpareParts" data-dialog="true" data-url="" data-external-page="true" tabindex="0" class="ui-page ui-page-theme-a ui-page-active" style="margin-bottom:20px">
<style>
.ui-dialog-contain{
	margin: 2% auto 1em;
}
</style>

<script type="text/javascript" src="../../../js/workorder_setting.js"></script>

 

  <div data-role="header" data-theme="b" style="min-width:500px; max-width:650px; margin:25px auto lem;">
    <h2>แก้ไขข้อมูลใบแจ้งซ่อม</h2>
  </div>
  <div>
  <?php  
  
    if(isset($_GET['JRID'])){ $item_id = $_GET['JRID']; }else{ echo 'Error, no JRID '; exit; }
	if(isset($_GET['dev_root'])){ $dev_root = $_GET['dev_root']; }else{ echo 'Error, dev_root '; exit; }
	
	
   require('../../../../../include/config.inc.php'); 
   mysql_select_db($db,$connect); 
   
    $q1 ="SELECT * FROM  `tpm_jobreq` WHERE  `JRID` LIKE  '".$_GET['JRID']."' LIMIT 0 , 1";
 
  $r=mysql_query($q1);
  $arrj=mysql_fetch_array($r);
  $mn=1;
  
   ?>
   <div style="padding:5px; margin:5px;">
   
    
   
    <form action="http://lionproduction.sli/pdmis/include/model-teadmin/components/query/update_workorder.php" method="post" enctype="multipart/form-data" data-ajax="false" class="frm-edit" >
        <table cellpadding="3" style="width:100%;">
        
         <tr>
          <td colspan="2">
        
        <div style="text-align:left;
         padding-left:5px;">
        <strong> สำหรับหน่วยงานผู้แจ้ง</strong>
        <hr/></div>  </td>
          </tr>
        <tr>
        
         
         
        <tr>
        <td> <div style="text-align:right; padding-right:5px;  margin:5px;">
          <label for="spr_type">วันที่แจ้ง : </label></div></td>
        <td><!-- process -->
            
           <input name="JRID" type="hidden" value="<?php echo $arrj['JRID']; ?>" />
           <input type="hidden" name="dev_root" id="dev_root" value="<?php echo $dev_root ; ?>" />
           <input type="date"   name="date_send" id="date_send" style="width:100%;" value="<?php echo $arrj['date_send']; ?>"  data-role="none" disabled="disabled" /></td>
        </tr>
        
         
         
        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;  margin:5px;">ชื่อเครื่องจักร  :</div> </td>
        	<td> <input name="machine" type="text" data-role="none" style="width:100%" 
            value="<?php  echo  $arrj['machine'];  ?>"  disabled="disabled"  />
            </td>
        </tr>
       
        
         
        <tr>
          <td><!-- gr --><div style="text-align:right; padding-right:5px;  margin:5px;">
          <label for="jobreq_name">ชื่องาน : </label></div></td>
          <td><textarea name="jobreq_name"  id="jobreq_name" rows="1" style="width:100%;"  data-role="none" disabled="disabled"><?php echo $arrj['jobreq_title']; ?></textarea>
             
          </td>
        </tr>
        <tr>
          <td> <!-- mixer -->   
          <div style="text-align:right; padding-right:5px;  margin:5px;">
          <label for="jobreq_detail">เหตุขัดข้อง : </span></label>
          </div>
          </td>
          <td><textarea name="jobreq_detail"  id="jobreq_detail" rows="2" style="width:100%;"  data-role="none" disabled="disabled"><?php echo $arrj['jobreq_detail']; ?></textarea> </td>
        </tr>
         <tr>
          <td><!-- gr -->
          <div style="text-align:right; padding-right:5px;"><img src="http://lionproduction.sli/pdmis/tpm/images/WORKORDER/<?php echo $arrj['jobreq_imgname']; ?>" height="80"/></div></td>
          <td><input name="jrt_img" id="jrt_img" type="file"  />
          * หากไม่ต้องการเปลี่ยนภาพให้ว่างไว้</td>
        </tr>
        <tr>
          <td><!-- gr --></td>
          <td>&nbsp; 
             
          </td>
        </tr>
          <tr>
          <td><!-- CycleTime --> <div style="text-align:right; padding-right:5px;  margin:5px;">
          <label for="jobreq_recname">ผู้แจ้ง : </label></div></td>
          <td><input  name="jobreq_recname"  id="jobreq_recname" style="width:100%;" type="text" step="any"  data-role="none"  required="required" value="<?php echo $arrj['jobreq_recname']; ?>"  disabled="disabled"  /></td>
        </tr>
         
        <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_name_th"> สถานะงาน : </label></div></td>
          <td>  
          
            <select name="job_status" id="job_status" style="width:100%;" data-role="none"  >
            <option value="Pending" <?php if($arrj['job_status']=='Pending'){ echo 'selected="selected"'; } ?>>รอรับเรื่อง</option> 
			<option value="MTReceived" <?php if($arrj['job_status']=='MTReceived'){ echo 'selected="selected"'; } ?>>รับเรื่องแล้ว</option>
            <option value="MTOperating" <?php if($arrj['job_status']=='MTOperating'){ echo 'selected="selected"'; } ?>>กำลังดำเนินงาน</option> 
            <option value="MTClosed" <?php if($arrj['job_status']=='MTClosed'){ echo 'selected="selected"'; } ?>>ปิดงานโดยช่าง MT</option>  
             <option value="DIVClosed" <?php if($arrj['job_status']=='DIVClosed'){ echo 'selected="selected"'; } ?>>ปิดงานโดยช่ายหน่วยงาน</option>  
            </select>
          
           </td>
        </tr>
        
   
        
        
        
          <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="jobto_actstart"> วันเริ่มงาน : <span style="color:red;">*</span></label>  </div></td>
          <td>  
          
             <input name="jobto_actstart" type="datetime-local" data-role="none" style="width:100%" 
            value="<?php if($arrj['jobto_actstart']!='0000-00-00 00:00:00'){ echo date("Y-m-d\TH:i", strtotime($arrj['jobto_actstart'])); } ?>" required="required" />
          
           </td>
        </tr>
        
          <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="jobto_actfinish"> วันปิดงาน :  <span style="color:red;">*</span></label></div></td>
          <td>  
          
             <input name="jobto_actfinish" type="datetime-local" data-role="none" style="width:100%" 
            value="<?php if($arrj['jobto_actfinish']!='0000-00-00 00:00:00'){ echo date("Y-m-d\TH:i", strtotime($arrj['jobto_actfinish'])); } ?>" required="required" />
          
           </td>
        </tr>
        
        
        <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="jobto_user">ผู้รับเรื่อง : <span style="color:red;">*</span> </label></div></td>
          <td>
          <select name="jobto_user" id="jobto_user" style="width:100%;" data-role="none"  >
          <option value=""></option>
            <?php 
			         $qu = mysql_query("SELECT uname,name FROM  `user` WHERE  `dev` LIKE  '".$_SESSION['dev']."' AND `position` LIKE  'technician'  LIMIT 0 , 300"); 
					 
                     while($arru = mysql_fetch_array($qu)){ 
					 echo '<option value="'.$arru['uname'].'"';
					 if($arrj['jobto_user']==$arru['uname']){ echo 'selected="selected"'; }
					 echo '>'.$arru['name'].'</option>'; } 
			  ?>
              
            </select> 
          </td>
        </tr>
        
        <tr>
          <td>  
          <div style="text-align:right; padding-right:5px;  margin:5px;">
          <label for="jobreq_detail">อาการ สาเหตุ :</span><span style="color:red;">*</span></label>
           
          </div>
         
          </td>
          <td><textarea name="job_cause"  id="job_cause" rows="2" style="width:100%;"  data-role="none" placeholder="ใส่อาการ/สาเหตุขัดข้อง" required="required" ><?php echo $arrj['job_cause']; ?></textarea> </td>
        </tr>
        
        <tr>
          <td> <!-- mixer -->   
          <div style="text-align:right; padding-right:5px;  margin:5px;">
          <label for="jobreq_detail">รายละเอียด : </span></label>
          </div>
          </td>
          <td><textarea name="job_causedetail"  id="job_causedetail" rows="3" style="width:100%;"  data-role="none" placeholder="ใส่รายละเอียดของการขัดข้อง"  ><?php echo $arrj['job_causedetail']; ?></textarea> </td>
        </tr>
        
         <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="jobto_user">Supervisor :  <span style="color:red;">*</span></label></div></td>
          <td>
          <select name="jobto_supuser" id="jobto_supuser" style="width:100%;" data-role="none"  >
          <option value=""></option>
            <?php 
			         $qu = mysql_query("SELECT uname,name FROM  `user` WHERE  `dev` LIKE  '".$_SESSION['dev']."' AND  `position` LIKE  'supervisor' LIMIT 0 , 300"); 
                     while($arru = mysql_fetch_array($qu)){ 
					 echo '<option value="'.$arru['uname'].'"';
					 if($arrj['jobto_supuser']==$arru['uname']){ echo 'selected="selected"'; }
					 echo '>'.$arru['name'].'</option>'; } 
			  ?>
            </select> 
          </td>
        </tr>
        
        <tr>
          <td colspan="2">
            <div style="text-align:right;"> 
            <a href="#" id="<?php echo $arrj['JRID']; ?>" class="del-jrq  ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a ui-btn-icon-left ui-icon-delete"  style=" background-color:#F03; color:#FFF;" data-ajax="false" >ลบ</a>  
            <button type="submit" name="update_workorder" id="<?php echo $arrj['jobreq_id']; ?>" class="editreport ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;"> บันทึก </button>
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a ui-btn-icon-left ui-icon-back" data-rel="back">ยกเลิก</a>    
              </div>
            </td>
        </tr>
        
        </table>
    </form>
   </div>
    
  </div>

 
