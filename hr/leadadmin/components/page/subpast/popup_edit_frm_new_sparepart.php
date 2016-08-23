<!-- popup popup_edit_frm_new_sparepart by Tinnakorn.M 02/16/2016 -->
  
<script type="text/javascript" src="../../../../../include/lib/jquery1.10.2.min.js"></script>
	<script src="../../../../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="../../../../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" >
<div data-role="page" id="popupEditSpareParts" data-dialog="true" data-url="" data-external-page="true" tabindex="0" class="ui-page ui-page-theme-a ui-page-active" style="margin-bottom:20px">
<style>
.ui-dialog-contain{
	margin: 2% auto 1em;
}
</style>

<script type="text/javascript" src="../../../js/sparepart_setting.js"></script>

 

  <div data-role="header" data-theme="b" style="min-width:450px; max-width:650px; margin:25px auto lem;">
    <h2>แก้ไขข้อมูล Spare Parts</h2>
  </div>
  <div>
  <?php  
   include_once ("../../../../../include/sap/sapclasses/sap.php");
   include_once ("../../../../../include/sap/sapclasses/examples/sapserverconnect.php");
   require('../../../../../include/config.inc.php'); 
  $id=$_GET['id'];
  $q1 ="SELECT * FROM  `tpm_sparepart` WHERE  `tpm_sparepart`.`spr_id` ='".$_GET['id']."'";
   mysql_select_db($db,$connect); 
  $r=mysql_query($q1);
  $arrsp=mysql_fetch_array($r);
  $mn=1;
  
  
  					$fce = &$sap->NewFunction ("ZINVENTORY_SPARE_PART");
					$fce->P_WERKS = '1100';
					$fce->P_MATNR = $arrsp['spr_mtcode']; //Material code or spare part code
					$fce->P_LGORT  = 'MT01';
					$fce->Call();
					$fce->Call();
					if (($fce->status)==SAPRFC_OK) { 		               
						$fce->I_ZMM106->Reset();
						while ( $fce->I_ZMM106->Next() ){
							$spr_name_en = $fce->I_ZMM106->row['MAKTX'];
							$spr_stock_min = $fce->I_ZMM106->row['EISBE'];  
						}
					}else{ //if fail
					     
					}
  
   ?>
    <form action="../../query/update_sparepart.php" method="post" enctype="multipart/form-data" data-ajax="false" class="frm-edit" >
    
      <table >
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div >
        <table style="width:100%;">
        <tr>
          <td  width="40%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="spr_mtcode"> Materail Code :   </label></div> </td>
          <td><div > <input type="text" name="spr_mtcode" id="spr_mtcode" style="width:100%;" value="<?php echo $arrsp['spr_mtcode']; ?>"  data-role="none" placeholder="กรณีไม่ใส่ระบบจะตั้งให้อัตโนมัติ" disabled="disabled" /> </div></td>
        </tr>
         
        <tr>
        <td> <div style="text-align:right; padding-right:5px;">
          <label for="spr_type">ชนิด Spare part : </label></div></td>
        <td><!-- process -->
           <?php echo $arrsp['spr_type']; ?> 
           <input name="spr_id" type="hidden" value="<?php echo $arrsp['spr_id']; ?>" />
          </td>
        </tr>
        
         
        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="process">กลุ่มเครื่องจักร : </label> </div> </td>
        	<td><select name="sprg_name" id="sprg_name" style="width:100%;" data-role="none">
			  <?php 
		  $qg = mysql_query("SELECT * FROM `tpm_sprgrp` WHERE `sprg_type` LIKE  '".$arrsp['spr_type']."' ORDER BY  `tpm_sprgrp`.`sprg_name` ASC  LIMIT 0 , 100"); 
		   while($arrg =mysql_fetch_array($qg)){
		  ?>
            <option value="<?php echo $arrg['sprg_name']; ?>" <?php if($arrsp['sprg_name']==$arrg['sprg_name']){ echo 'selected="selected"'; } ?>><?php echo $arrg['sprg_name']; ?></option>
		 <?php }//end while ?>
         
      	  </select>  </td>
        </tr>
       
        
        <tr>
          <td><!-- gr -->
          <div style="text-align:right; padding-right:5px;">
          <img src="http://lionproduction.sli/pdmis/tpm/images/SPAREPART/<?php echo $arrsp['spr_img']; ?>" height="80"/>
          </div></td>
          <td><input name="spr_img" id="spr_img" type="file"  />
          * หากไม่ต้องการเปลี่ยนภาพให้ว่างไว้</td>
        </tr>
        <tr>
          <td><!-- gr --></td>
          <td>&nbsp; 
             
          </td>
        </tr>
        <tr>
          <td> <!-- mixer -->   
          <div style="text-align:right; padding-right:5px;"> 
         <label for="spr_name_en">ชื่อทางการ <br/>ภาษาอังกฤษ :<span style="color:red;">*</span></label></div></td>
          <td><textarea name="spr_name_en"  id="spr_name_en" rows="2" style="width:100%;"  data-role="none" placeholder="EX: FILTER SET FOR PX MODEL: PX-D260A P/N 40"><?php if(isset($spr_name_en)){ echo $spr_name_en; }else{ echo $arrsp['spr_name_en']; } ?></textarea></td>
        </tr>
        <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_name_th">ชื่อภาษาไทย : </label></div></td>
          <td>  <textarea name="spr_name_th"  id="spr_name_th" rows="2" style="width:100%;"  data-role="none" placeholder="เช่น : ชุดฟิลเตอร์สำหรับโมเดล PX : PX-D260A P/N 40"><?php echo $arrsp['spr_name_th']; ?></textarea></td>
        </tr>
        <tr>
          <td><!-- version --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_sap_price">ราคา SAP Price : </span></label></div></td>
          <td>    <input type="number" step="any" name="spr_sap_price" id="spr_sap_price" style="width:100%;" value="<?php echo $arrsp['spr_sap_price']; ?>"  data-role="none" placeholder="ไม่มีให้เว้นว่าง"   /></td>
        </tr>
        <tr>
          <td><!-- CycleTime --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_leadtime">เวลาสั่งซื้อ (Lead time) : </label></div></td>
          <td><input  name="spr_leadtime"  id="spr_leadtime" style="width:100%;" value="<?php echo $arrsp['spr_leadtime']; ?>" type="number" step="any"  data-role="none" placeholder="ไม่มีให้เว้นว่าง"  /></td>
        </tr>
        <tr>
          <td><!-- product_name --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_leadtime_unit">หน่วยเวลาสั่งซื้อ :</label> </div></td>
          <td><select name="spr_leadtime_unit" id="spr_leadtime_unit" style="width:100%;" data-role="none">
          <option value="-" <?php if($arrsp['spr_leadtime_unit']=='-'){ echo 'selected="selected"'; } ?>>-</option>
          <option value="DAY" <?php if($arrsp['spr_leadtime_unit']=='DAY'){ echo 'selected="selected"'; } ?>>วัน</option>
          <option value="WEEK" <?php if($arrsp['spr_leadtime_unit']=='WEEK'){ echo 'selected="selected"'; } ?>>สัปดาห์</option>
          <option value="MONTH" <?php if($arrsp['spr_leadtime_unit']=='MONTH'){ echo 'selected="selected"'; } ?>>เดือน</option>
          <option value="YEAR" <?php if($arrsp['spr_leadtime_unit']=='YEAR'){ echo 'selected="selected"'; } ?>>ปี</option>
        </select></td>
        </tr>
        <tr>
          <td><!-- definetion --><div style="text-align:right; padding-right:5px;"> 
          <label for="spr_stock_min">ค่า Stock น้อยที่สุด :</label></div> </td>
          <td><input type="number" step="any" name="spr_stock_min" id="spr_stock_min"  style="width:100%;" value="<?php if(isset($spr_stock_min) and $spr_stock_min>0){ echo $spr_stock_min; }else{ echo $arrsp['spr_stock_min']; } ?>"  data-role="none" placeholder="ไม่มีให้เว้นว่าง"   /></td>
        </tr>
        <tr>
          <td><!-- effective_date --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_stock_avalible">จำนวน Stock : </label></div></td>
          <td> <span style="color:#CCC">SAP RFC Auto </span> </td>
        </tr>
        <tr>
          <td width="35%"> <div style="text-align:right; padding-right:5px;">
          <label for="spr_location">Stock location :</label></div></td>
          <td><!-- process -->
          <select name="spr_location" id="spr_location" style="width:100%;" data-role="none">
          <option value="ST" >Advance Store</option>
        </select></td>
        </tr>
        <tr>
          <td colspan="2">
          
           
           <div style="text-align:right;"> <a href="#" id="<?php echo $arrsp['spr_id']; ?>" class="del-sp ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a ui-btn-icon-left ui-icon-delete"  style=" background-color:#F03; color:#FFF;" data-ajax="false" >ลบ</a>  
                      <button type="submit" name="editreport" id="<?php echo $arrsp['spr_id']; ?>" class="editreport ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;"> แก้ไข</button>
                       <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a ui-btn-icon-left ui-icon-back" data-rel="back">ยกเลิก</a>     
                    </div>
                 </td>
          </tr>
        
        </table>

          </div>
        </td></tr>
        
               </table>
    </form>
  </div>

 
