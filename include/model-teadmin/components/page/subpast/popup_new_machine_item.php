<?php
	

?>
<div data-role="popup" id="popupNewMCItem" data-theme="a" class="ui-corner-all" style="max-width:500px; ">
            <div data-role="header" data-theme="b" style="min-width:450px; max-width:550px;">
            <h2>Add new m/c item</h2>
            </div>
            
            <div>
            <form action="http://lionproduction.sli/pdmis/include/model-teadmin/components/query/insert_machine_item.php" method="post" enctype="multipart/form-data" data-ajax="false" class="NewMCGroup" >
               <table style="width:100%;  padding:15px;">
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div style=" padding-right: 15px;" >
        <table style="width:100%;">
  
        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="process">Item name :<span style="color:red;">*</span></label> </div> </td>
        	<td>
            <input type="text" name="item_name" id="item_name"  value=""  data-role="none" placeholder="เช่น BOSSAR2" style="width:100%;" /></td>
        </tr>      

        <tr>
          <td> <!-- mixer -->   
          <div style="text-align:right; padding-right:5px;"> 
         <label for="descrip_en"> Desciption en :<span style="color:red;">*</span></label></div></td>
          <td><textarea name="descrip_en"  id="descrip_en" rows="2" style="width:100%;"  data-role="none" placeholder="EX: Caes Packer and Auto Case Packer Machine" required="required"></textarea></td>
        </tr>
        <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="descrip_th"> Description th : </label></div></td>
          <td>  <textarea name="descrip_th"  id="descrip_th" rows="2" style="width:100%;"  data-role="none" placeholder="เช่น : เครื่องขึ้นรูปหีบ และเครื่องขึ้นรูปหีบอัตโนมัติ"></textarea></td>
        </tr>
		
		<tr>
          <td  width="40%"><div style="text-align:right; padding-right:5px;">
            <label for="process">Username create :</label></div></td>
          <td><div > <?php echo $_SESSION['name'];  ?>  
             <input name="plant" type="hidden" value="<?php echo $plant; ?>" />
             <input name="main_id" type="hidden" value="<?php echo $arrgr['item_id']; ?>" />
             <input type="hidden" name="dev_v1" value="<?php echo $dev_v1; ?>" />
             <input type="hidden" name="dev_root" id="dev_root" value="<?php echo $dev_root ; ?>" />
          </div></td>
        </tr>
		
        <tr>
          <td colspan="2">
            <div style="text-align:right;">
 
              <button type="submit" name="newMachineItem" id="newMachineItem" class="ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;">
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
