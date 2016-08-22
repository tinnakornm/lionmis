<!-- time pikder -->
 <SCRIPT LANGUAGE="JavaScript">

function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()

    if (hours >=0 && hours < 10) 
    { 
        hours=("0" + hours);     
    } 

    if (minutes >=0 && minutes < 10) 
    { 
        minutes=("0" + minutes);     
    } 
	
var timeValue = hours + ":" + minutes
 
 return timeValue;
 
}
</SCRIPT>

 
<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all" style="max-width:650px;">
         <div data-role="header" data-theme="b" style="min-width:450px; max-width:650px;">
            <h2>สร้างใบส่งตัวอย่าง</h2>
            </div>
            
            <form action="" method="post" enctype="multipart/form-data" data-ajax="false" id="newreport">
            <div role="main" class="ui-content" style="max-width:650px;">
              <div class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;">
              <select name="step" required="required" id="step">
                <option value=""> เลือก Step </option>
                <option value="0"> Premix </option>
                <option value="1"> Semi </option>
                <option value="2"> PH. Adjust </option>
                <option value="3"> Visc. Adjust </option>
              

              </select>
            </span></div>
            
            <div class="ui-title" style="padding-top:5px;">
             <div class="ui-title" style="padding-top:5px;">
               
               
               
           
            </div>
            <div class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;">
              <select name="main_mixer" required="required" id="main_mixer">
                <option value=""> เลือก Mixer </option>
                <option value="3SCMMT01"> 3SCMMT01 </option>
                <option value="3SCMMT02"> 3SCMMT02 </option>                     
                <option value="3SCMMT05"> 3SCMMT05 </option>              
                <option value="3SCMMT06"> 3SCMMT06 </option>
                <option value="3SCMMT07"> 3SCMMT07 </option>
                <option value="3SCMMT08"> 3SCMMT08 </option> 
                <option value="3SCMMT11"> 3SCMMT11 </option>
                <option value="3SCMMT12"> 3SCMMT12 </option>
                <option value="3SCMMT18"> 3SCMMT18 </option>
              </select>
            </span></div>
            
            <div class="ui-title" style="padding-top:5px;">
             <div class="ui-title" style="padding-top:5px;">
               
               
               
           
            </div>
             <select name="fullformula"  required="required" id="fullformula" >
	       <?php $qr = mysql_query("SELECT DISTINCT fullformula
FROM  `p3mx_pd` 
WHERE STATUS =1");
		          echo "<option value=\"\"> เลือกผลิตภัณฑ์ </option>";
	              while($arr = mysql_fetch_array($qr)){
			  
	 echo "<option value=\"".$arr['fullformula']."\">".$arr['fullformula']."</option>";
	    		
	            }?>
	       </select>
           
           
           <div class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;">
             <select name="col_point" required="required" id="col_point">
               <option value=""> เลือก จุดเก็บตัวอย่าง </option>
               <option value="0"> ก้น Tank </option>
               <option value="1"> Hopper </option>
               <option value="2"> Nozzle </option>
               <option value="3"> Mixer </option>
               <option value="4"> อื่น ๆ </option>
             </select>
           </span></span></span></span></span></span></span></div>
            </div>
              <div id="div_point"  class="ui-title" style="padding-top:5px; display:none;">
            <strong>   Point  : </strong>
            
          <span class="ui-title" style="padding-top:5px;" >
        <input type="text" name="point" id="point" value="" style="font-size:16px;" placeholder="point" />
        </span></div>
            <div class="ui-title" style="padding-top:5px;">
            <strong>   Tank No  : </strong>
          <span class="ui-title" style="padding-top:5px;">
        <input type="text" name="tank_no" id="tank_no" required="required" value="" style="font-size:16px;" placeholder="กรอกชื่อ Tank หากไม่มีให้ใส่ - " />
        </span></div>
            
<div class="ui-title" style="padding-top:5px;">
            <strong>   Order No  : </strong>
          <span class="ui-title" style="padding-top:5px;">
        <input type="number" name="order_no" id="order_no" required="required" value="" style="font-size:16px;" placeholder="ใส่ Order No เป็นตัวเลข" />
        </span></div>
            <div class="ui-title" style="padding-top:5px;">
            <strong>   Batch No  : </strong>
          <span class="ui-title" style="padding-top:5px;">
        <input  type="text" name="bt_no" id="bt_no" required="required" value="" style="font-size:16px;" placeholder="ใส่ Batch No " />
        </span></div>
             <div class="ui-title" style="padding-top:5px;">
            <strong>   Batch Size  : </strong>
          <input type="number" name="bt_size" id="bt_size" required="required" value="" style="font-size:16px;"  placeholder="ใส่ Batch Size เป็นตัวเลข"  />
			 </div>
              
             <div class="ui-title" style="padding-top:5px;">
            <strong>   Note  : </strong>
          <textarea name="check_note_mx" id="check_note_mx" cols="" rows="" placeholder="ใส่ Note ของคุณถึง QA ได้ที่นี่"></textarea>
			 </div>
             
            
            
             
            
            <div class="ui-title" style="padding-top:5px;">
            
            <?php 
 		$qo ="SELECT * FROM `user` WHERE  `dev` ='bcmx300' AND `position` LIKE 'operator'";
		   ?>
 <select name="mix_uname"  required="required"  id="mix_uname" >
  <option value=""> เลือก ผู้ส่ง </option>
	       <?php    
		         $qro = mysql_query($qo);
	              while($arro = mysql_fetch_array($qro)){
			  
	 echo "<option value=\"".$arro['uname']."\">".$arro['name']."</option>";
	    		
	            }?>
	       </select>  
            </div>
            
             
            
             
             
          <button type="submit" name="newreport" id="startbtf" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">
          ส่งตัวอย่าง </button>
                 
         
             
            </div><!--end role main -->
            </form>
            
            
            
            
        </div>