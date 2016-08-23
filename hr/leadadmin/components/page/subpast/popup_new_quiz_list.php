<!-- popup  frm_new_formula by Tinnakorn.M 25/11/2015 --> 
 
<div data-role="popup" id="popupaddnewquiz" data-theme="a" class="ui-corner-all" style="max-width:550px;">

            <div data-role="header" data-theme="b" style="min-width:450px; max-width:550px;">
            <h2>Add new quiz list</h2>
            </div>
            
            <div>
            <form action="components/query/insert_quiz_list.php" method="post" enctype="multipart/form-data" data-ajax="false" class="addnewquiz" >
               <table style="width:100%;  padding:15px;">
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div >
        <table style="width:100%;">
        <tr>
          <td  width="40%"><div style="text-align:right; padding-right:5px;">
            <label for="process">คำถาม :</label></div></td>
          <td><div > <input type="text" name="list_title" id="list_title" style="width:100%;" value="<?php echo $arrq['list_title']; ?>" data-role="none"/></div></td>
        </tr>
       
        <tr>
          <td  width="50%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="lion_id">Upload image:</label></div> </td>
          <td><div > <input type="" name="list_img" id="list_img" style="width:100%;" value="<?php echo $arrq['list_img']; ?>"  data-role="none"  /> </div></td>
        </tr>
		
		<tr>
          <td  width="50%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="name"> ชนิดคำถาม:   </label></div> </td>
          <td><div > <input type="text" name="list_type" id="list_type" style="width:100%;" value="<?php echo $arrq['list_type']; ?>"  data-role="none"  /> </div></td>
        </tr>
		
		<tr>
          <td  width="50%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="s_name"> เพิ่มเติม:   </label></div> </td>
          <td><div > <input type="text" name="list_note" id="list_note" style="width:100%;" value="<?php echo $arrq['list_note']; ?>"  data-role="none"  /> </div></td>
        </tr>
        
        	

        <tr>
          <td colspan="2">
          <div style="text-align:right;">
        
            <button type="submit" name="addnewquiz" id="addnewquiz" class="ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;">
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
