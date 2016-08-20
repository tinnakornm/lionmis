<!-- popup  frm_new_formula by Tinnakorn.M 25/11/2015 --> 
<?php
	

?>
<div data-role="popup" id="popupNewSparePart" data-theme="a" class="ui-corner-all" style="max-width:550px;">
            <div data-role="header" data-theme="b" style="min-width:450px; max-width:550px;">
            <h2>เพิ่ม Spare Part</h2>
            </div>
            
            <div>
            <form action="http://lionproduction.sli/pdmis/include/model-teadmin/components/query/insert_sparepart.php" method="post" enctype="multipart/form-data" data-ajax="false" class="NewSparePart" >
               <table style="width:100%;  padding:15px;">
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div >
        <table style="width:100%;">
        <tr>
          <td  width="40%"><div style="text-align:right; padding-right:5px;">
            <label for="process">สร้างโดย :</label></div></td>
          <td><div > <?php echo $_SESSION['name'];  ?>  
             
          </div></td>
        </tr>
         
        <tr>
        <td> <div style="text-align:right; padding-right:5px;">
          <label for="spr_type">ชนิด Spare part :<span style="color:red;">*</span></label></div></td>
        <td><!-- process -->
          
          <select name="showtype" id="showtype" style="width:100%;" data-role="none" disabled="disabled" >
		  <option value="SPECIAL" <?php if($mn==1){ echo 'selected="selected"'; $sprg_type='SPECIAL'; } ?>>SPECIAL ใช้เฉพาะเครื่องจักร </option>
		  <option value="GENERAL" <?php if($mn==2){ echo 'selected="selected"'; $sprg_type='GENERAL';  } ?>>GENERAL ใช้ทั่วไป</option>
          </select>
          <input name="spr_type" type="hidden" value="<?php if($mn==1){ echo 'SPECIAL'; }else{ echo 'GENERAL'; } ?>" />
           <input type="hidden" name="dev_root" id="dev_root" value="<?php echo $dev_root; ?>" />
           <input type="hidden" name="dev_v1" id="dev_v1" value="<?php echo $dev_v1; ?>" />
          </td>
        </tr>
        
        
        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="process">กลุ่มเครื่องจักร :<span style="color:red;">*</span></label> </div> </td>
        	<td><select name="sprg_name" id="sprg_name" style="width:100%;" data-role="none">
			  <?php 
		 if($mn==1){	  
		  $qg = mysql_query("SELECT * FROM `tpm_sprgrp` WHERE  `dev_v1` LIKE  '$dev_v1' AND `sprg_type` LIKE  'SPECIAL' ORDER BY  `tpm_sprgrp`.`sprg_name` ASC  LIMIT 0 , 30"); 
		 }else{
		  $qg = mysql_query("SELECT * FROM `tpm_sprgrp` WHERE  `sprg_type` LIKE  'GENERAL' ORDER BY  `tpm_sprgrp`.`sprg_name` ASC  LIMIT 0 , 30"); 	 
		 }
		  
		   while($arrg =mysql_fetch_array($qg)){
		  ?>
            <option value="<?php echo $arrg['sprg_name']; ?>" <?php if($gr==$arrg['sprg_name']){ echo 'selected="selected"'; } ?>><?php  if($arrg['sub_gr']!=""){ echo $arrg['sub_gr'].'->'; } echo $arrg['sprg_name']; ?></option>
		 <?php }//end while ?>
         
      	  </select>  </td>
        </tr>
         
        
        <tr>
          <td><!-- gr --><div style="text-align:right; padding-right:5px;">
          <label for="img"> รูปภาพ : <span style="color:red;">*</span></label></div></td>
          <td><input name="img" id="img" type="file" required="required" /></td>
        </tr>
        <tr>
          <td><!-- gr --><div style="text-align:right; padding-right:5px;">
          <label for="spr_mtcode"> Materail Code :   </label></div></td>
          <td><input type="text" name="spr_mtcode" id="spr_mtcode" style="width:100%;" value=""  data-role="none" placeholder="กรณีไม่ใส่ระบบจะตั้งให้อัตโนมัติ" />
             
          </td>
        </tr>
        <tr>
          <td> <!-- mixer -->   
          <div style="text-align:right; padding-right:5px;"> 
         <label for="spr_name_en">ชื่อทางการ <br/>ภาษาอังกฤษ :<span style="color:red;">*</span></label></div></td>
          <td><textarea name="spr_name_en"  id="spr_name_en" rows="2" style="width:100%;"  data-role="none" placeholder="EX: FILTER SET FOR PX MODEL: PX-D260A P/N 40"></textarea></td>
        </tr>
        <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_name_th">ชื่อภาษาไทย : </label></div></td>
          <td>  <textarea name="spr_name_th"  id="spr_name_th" rows="2" style="width:100%;"  data-role="none" placeholder="เช่น : ชุดฟิลเตอร์สำหรับโมเดล PX : PX-D260A P/N 40"></textarea></td>
        </tr>
        
        <tr>
          <td><!-- effective_date --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_stock_loc">จำนวน Stock : </label></div></td>
          <td><input  name="spr_stock_loc"  id="spr_stock_loc" type="number" value="" style="width:100%;"  placeholder="จำนวณ stock ปัจุบัน"   data-role="none"/></td>
        </tr>
        <tr>
          <td width="35%"> <div style="text-align:right; padding-right:5px;">
            <label for="spr_location">Stock location :</label></div></td>
          <td><!-- process -->
            
            <select name="spr_location" id="spr_location" style="width:100%;" data-role="none" disabled="disabled">
          <option value="ST">Advance Store</option>
          <option value="<?php echo $dev_v1; ?>" selected="selected"><?php echo $dev_v1; ?></option>
        </select></td>
        </tr>
        <tr>
          <td colspan="2">
          <div style="text-align:right;">
       
           
        
            
            
            <button type="submit" name="newsprt" id="newsprt" class="ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;">
              บันทึก </button>
            
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
            
   
</div>
