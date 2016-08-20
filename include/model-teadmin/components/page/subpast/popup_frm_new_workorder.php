<!-- popup popup_frm_new_workorder by Tinnakorn.M 09/06/2016 -->
 
<div data-role="popup" id="popupNewWorkOrder" data-theme="a" class="ui-corner-all" style="max-width:550px;">
 
  <div data-role="header" data-theme="b" style="min-width:450px; max-width:650px; margin:25px auto lem;">
    <h2>เพิ่มใบแจ้งซ่อม</h2>
  </div>
  <div>
 
    <form action="http://lionproduction.sli/pdmis/include/model-teadmin/components/query/insert_workorder.php" method="post" enctype="multipart/form-data" data-ajax="false" class="frm-insert-workorder" >
    
      <table style=" margin-right:15px;" >
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div >
        <table style="width:100%;">
        <tr>
          <td  width="30%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="spr_mtcode"> 
            <input type="hidden" name="plant" id="plant" value="<?php echo $plant; ?>" />
            <input type="hidden" name="dev_v1" id="dev_v1" value="<?php echo $dev_v1; ?>" />
            <input type="hidden" name="dev_root" id="dev_root" value="<?php echo $dev_root ; ?>" />
            JRID : </label></div> </td>
          <td><div > <input type="text" name="JRID" id="JRID" style="width:100%;"  data-role="none"  readonly="readonly" value="<?php echo $dev_root.time(); ?>" /> </div></td>
        </tr>
         
        <tr>
        <td> <div style="text-align:right; padding-right:5px;">
          <label for="spr_type">วันที่แจ้ง <span style="color:red;">*</span>: </label></div></td>
        <td><!-- process -->
        <div style="padding-top:5px;">
          <label for="textfield"></label>
          <input type="date"   style="width:100%;"  name="date_send" id="date_send" data-role="none" required="required"  />
         </div>
          </td>
        </tr>
        
         
        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="dev_code">รหัสหน่วยงาน <span style="color:red;">*</span>: </label> </div> </td>
        	<td>
            <div style="padding-top:5px;">
            <input type="text" name="dev_code" id="dev_code"  value=""  data-role="none" placeholder="เช่น 130 123 2PK " style="text-transform: uppercase; width:100%;" required="required" />
            </div>
             </td>
        </tr>
        
        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="dev_code">ชนิดงาน <span style="color:red;">*</span>: </label> </div> </td>
        	<td>
             <div style="padding-top:5px;">
             <select name="job_category"  id="job_category" style="width:100%;" data-role="none">
               <option value="MTMC">ซ่อมบำรุงงานเครื่องจักร</option>
               <option value="MTEE">ซ่อมบำรุงงานไฟฟ้า</option>
               <option value="MTTPM">ซ่อมบำรุงงานบำรุงรักษา PM</option>
               <option value="UTILITY">ซ่อมบำรุงงาน Utility น้ำ ลม ไฟ</option>
             </select>
            </div>
             </td>
        </tr>
       
  
        
         
        <tr>
          <td> <!-- mixer -->   
          <div style="text-align:right; padding-right:5px;"> 
         <label for="machine">ชื่อเครื่องจักร  : </label></div></td>
          <td>
          <div style="padding-top:5px;">
          <select name="item_id" id="item_id" style="width:100%;" data-role="none"  >
            <?php 
			
			 $qgr = mysql_query("SELECT item_id, item_name FROM  `tpm_item` WHERE  `dev_v1` LIKE  '$dev_v1' AND  `item_type` LIKE  'mc_group' ORDER BY  `tpm_item`.`item_name` ASC  LIMIT 0 , 300");

			 
			 while($arrg = mysql_fetch_array($qgr)){
			   echo '<optgroup label="'.$arrg['item_name'].'">';
				$qmc = mysql_query("SELECT * FROM  `tpm_item` WHERE  `main_id` =".$arrg['item_id']." AND  `item_type` LIKE  'mc_location' ORDER BY  `tpm_item`.`item_name` ASC  LIMIT 0 , 300"); 
				 
                     while($arrmc = mysql_fetch_array($qmc)){ echo '<option value="'.$arrmc['item_id'].'">'.$arrmc['sap_id'].' '.$arrmc['item_name'].'</option>'; } //end while 2
			
			   echo '</optgroup>';
			   
			 }//end while 1
			   
			         
			  ?>
              
              
            </select> 
            </div>
            </td>
        </tr>
        
        <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="jobreq_name">ชื่องาน : </label></div></td>
          <td> 
          <div style="padding-top:5px;">
           <textarea name="jobreq_title"  id="jobreq_title" rows="2" style="width:100%;"  data-role="none" required="required" ></textarea>
           </div>
           </td>
        </tr>
        <tr>
          <td><!-- version --> <div style="text-align:right; padding-right:5px;">
          <label for="jobreq_detail">เหตุขัดข้อง : </span></label></div></td>
          <td>   
          <div style="padding-top:5px;">
           <textarea name="jobreq_detail"  id="jobreq_detail" rows="2" style="width:100%;"  data-role="none" required="required" ></textarea>
           </div>
           </td>
        </tr>
        <tr>
          <td><!-- CycleTime --> <div style="text-align:right; padding-right:5px;">
          <label for="jobreq_recname">ผู้แจ้ง : </label></div></td>
          <td>
          <div style="padding-top:5px;">
          <input  name="jobreq_recname"  id="jobreq_recname" style="width:100%;" type="hidden"   data-role="none"   value="<?php echo $_SESSION['name']; ?>"    />
          
          
             <select name="jobreq_user" id="jobreq_user" style="width:100%;" data-role="none"  >
          
            <?php 
			         $qu = mysql_query("SELECT uname,name FROM  `user` WHERE `dev` LIKE  '".$_SESSION['dev']."'  AND `position` LIKE  'technician'  LIMIT 0 , 300"); 
                     while($arru = mysql_fetch_array($qu)){ 
					 echo '<option value="'.$arru['uname'].'"';
					 if($_SESSION['uname']==$arru['uname']){ echo 'selected="selected"'; }
					 echo '>'.$arru['name'].'</option>'; } 
			  ?>
            </select> 
            
            
            
          </div>
          </td>
        </tr>
        
           <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="dev_code"> เบอร์ติดต่อ  : </label> </div> </td>
        	<td>
            <div style="padding-top:5px;">
            <input type="text" name="jobreq_tel" id="jobreq_tel"   data-role="none" placeholder="เช่น 654 " style="width:100%;" required="required" value="654" />
            </div>
             </td>
        </tr>
        
        
            <tr>
          <td><!-- gr -->
          <div style="text-align:right; padding-right:5px;">
          รูปภาพ
          </div></td>
          <td><input name="spr_jrq" id="spr_jrq" type="file"  />
          * หากไม่ต้องการเปลี่ยนภาพให้ว่างไว้</td>
        </tr>
        <tr>
          <td colspan="2">
            
            
            <div style="text-align:right;">    
              <button type="submit" name="addWorkOrdeer" id=" " class="addWorkOrdeer ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-plus  ui-btn-inline" style="background:#3388CC; color:#FFF;"> เพิ่มใบแจ้ง </button>
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

 
