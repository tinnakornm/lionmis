<!-- popup  frm_new_formula by Tinnakorn.M 25/11/2015 --> 
<?php
	

?>
<div data-role="popup" id="popupEQuiz" data-theme="a" class="ui-corner-all" style="max-width:550px;">
            <div data-role="header" data-theme="b" style="min-width:450px; max-width:550px;">
            <h2>Edit quiz ans</h2>
            </div>
            
            <div>
            <form action="components/query/edit_quiz_ans.php" method="post" enctype="multipart/form-data" data-ajax="false" class="EditQuiz" >
               <table style="width:100%;  padding:15px;">
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div >
        <table style="width:100%;">
        <tr>
          <td  width="40%"><div style="text-align:right; padding-right:5px;">
            <label for="process">choice prefix(คำนำหน้า :)</label></div></td>
          <td><div > <input type="text" name="choice_prefix" id="choice_prefix" style="width:100%;" value="<?php echo $arrq['choice_prefix']; ?>" data-role="none"/></div></td>
        </tr>
       
        <tr>
          <td  width="50%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="lion_id">choice title(อธิบายคำตอบ)</label></div> </td>
          <td><div > <input type="text" name="choice_title" id="choice_title" style="width:100%;" value="<?php echo $arrq['choice_title']; ?>"  data-role="none"  /> </div></td>
        </tr>

        <tr>
          <td colspan="2">
          <div style="text-align:right;">
        
            <button type="submit" name="editquiz" id="editquiz" class="ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;">
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
