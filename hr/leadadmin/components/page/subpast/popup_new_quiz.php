<!-- popup  frm_new_formula by Tinnakorn.M 25/11/2015 --> 
<?php
	

?>
<div data-role="popup" id="popupNewQuiz" data-theme="a" class="ui-corner-all" style="max-width:550px;">


            <div data-role="header" data-theme="b" style="min-width:450px; max-width:550px;">
            <h2>Add new quiz topic</h2>
            </div>
            
            <div>
            <form action="components/query/insert_quiz.php" method="post" enctype="multipart/form-data" data-ajax="false" class="NewQuiz" >
               <table style="width:100%;  padding:15px;">
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div >
        <table style="width:100%;">
        <tr>
          <td  width="40%"><div style="text-align:right; padding-right:5px;">
            <label for="process">Quiz name :</label></div></td>
          <td><div > <input type="text" name="quiz_name" id="quiz_name" style="width:100%;" value="<?php echo $arrq['quiz_name']; ?>" data-role="none"/></div></td>
        </tr>
       
        <tr>
          <td  width="50%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="lion_id"> Quiz title</label></div> </td>
          <td><div > <input type="" name="quiz_title" id="quiz_title" style="width:100%;" value="<?php echo $arrq['quiz_title']; ?>"  data-role="none"  /> </div></td>
        </tr>
		
		<tr>
          <td  width="50%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="name"> Date create:   </label></div> </td>
          <td><div > <input type="text" name="quiz_date" id="quiz_date" style="width:100%;" value="<?php echo $arrq['quiz_date']; ?>"  data-role="none"  /> </div></td>
        </tr>
		
		<tr>
          <td  width="50%"> 
            <div style="text-align:right; padding-right:5px;">
          <label for="s_name"> Username creat :   </label></div> </td>
          <td><div > <input type="text" name="quiz_username" id="quiz_username" style="width:100%;" value="<?php echo $arrq['quiz_username']; ?>"  data-role="none"  /> </div></td>
        </tr>
        
        	

        <tr>
          <td colspan="2">
          <div style="text-align:right;">
        
            <button type="submit" name="newquiz" id="newquiz" class="ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;">
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
