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

<?php 
           //query from user_online
          $qon = mysql_query("SELECT * FROM  `pk_useronline` WHERE  `username` LIKE  '".$_SESSION['uname']."' LIMIT 0 , 1");
          $arro = mysql_fetch_array($qon);
         
         ?>
<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all" style="max-width:650px;">
         <div data-role="header" data-theme="b" style="min-width:450px; max-width:650px;">
            <h2>สร้างใบสรุปการผลิต</h2>
            </div>
            
            <form action="" method="post" enctype="multipart/form-data" data-ajax="false" id="newreport">
            <div role="main" class="ui-content" style="max-width:650px;">
            
            <div class="ui-title" style="padding-top:5px;">
               
             <select name="main_mixer" required="required" id="main_mixer">
             <option value=""> เลือก Mixer </option> 
		      <option value="2DWMMT01"> 2DWMMT01 </option> 
              <option value="2DWMMT02"> 2DWMMT02 </option> 
              <option value="2DWMMT03"> 2DWMMT03 </option> 
              <option value="2FSMMT01"> 2FSMMT01 </option> 
              <option value="2FSMMT03"> 2FSMMT03 </option> 
              <option value="2FSMMT04"> 2FSMMT04 </option> 
              <option value="2FSMMT05"> 2FSMMT05 </option> 
              <option value="2LDMMT01"> 2LDMMT01 </option> 
              <option value="2LDMMT02"> 2LDMMT02 </option> 
              <option value="2STMMT01"> 2STMMT01 </option> 
  </select> 
            </div>
            
            <div class="ui-title" style="padding-top:5px;">
           
             <select name="pd_group"  required="required" id="pd_group" >
	       <?php $qr = mysql_query("SELECT DISTINCT (pd_group) FROM  `p2mx_pd` WHERE status =1");
		          echo "<option value=\"\"> เลือกกลุ่มผลิตภัณฑ์ </option>";
	              while($arr = mysql_fetch_array($qr)){
			  
	 echo "<option value=\"".$arr['pd_group']."\">".$arr['pd_group']."</option>";
	    		
	            }?>
	       </select>
            </div>

            <div class="ui-title" style="padding-top:5px;">
            <strong>   Date : </strong>
          <input type="date" name="date" id="date" required="required" value="" style="font-size:16px;" />
			 </div>
             
             <div class="ui-title" style="padding-top:5px;">
              <select name="tim_shift" required="required" id="tim_shift">
          <option value="">เลือกเวลาผลิต</option>
           <option value="06:30">06:30-14:30</option>
           <option value="14:30">14:30-22:30</option>
           <option value="22:30">22:30-06:30</option>
           
          </select>
			 </div>
             
             
            <div class="ui-title" style="padding-top:5px;">
         
          <select name="mainshift" required="required" id="mainshift">
          <option value="">เลือกกะผลิต</option>
           <option value="A" <?php if($arro['last_mainshift']=='A'){ echo 'selected="selected"'; } ?> >A</option>
           <option value="B" <?php if($arro['last_mainshift']=='B'){ echo 'selected="selected"'; } ?> >B</option>
           <option value="C" <?php if($arro['last_mainshift']=='C'){ echo 'selected="selected"'; } ?> >C</option>
           
          </select>
             </div>
            
            
            <div class="ui-title" style="padding-top:5px;">
            
            <?php 
 		$qo ="SELECT * FROM `user` WHERE  `dev` LIKE 'mix200' AND `position` LIKE 'shiftleader'";
		   ?>
 <select name="shiftleader"  required="required" id="shiftleader"  >
  <option value=""> เลือก shift leader </option>
	       <?php    
		         $qro = mysql_query($qo);
	              while($arro = mysql_fetch_array($qro)){
			  
	 echo "<option value=\"".$arro['uname']."\">".$arro['name']."</option>";
	    		
	            }?>
	       </select>
            </div>
            
            <div class="ui-title" style="padding-top:5px;">
            
            <?php 
 		$qo ="SELECT * FROM `user` WHERE  `dev` ='mix200' AND `position` LIKE 'operator'";
		   ?>
 <select name="operater1"  required="required" id="operater1" >
  <option value=""> เลือก operator1 </option>
	       <?php    
		         $qro = mysql_query($qo);
	              while($arro = mysql_fetch_array($qro)){
			  
	 echo "<option value=\"".$arro['name']."\">".$arro['name']."</option>";
	    		
	            }?>
	       </select>  
            </div>
            
            <div class="ui-title" style="padding-top:5px;" >
        
            <?php 
 		$qo ="SELECT * FROM `user` WHERE  `dev` ='mix200' AND `position` LIKE 'operator'";
		   ?>
 <select name="operater2"  id="operater2" >
  <option value=""> เลือก operator2 </option>
	       <?php    
		         $qro = mysql_query($qo);
	              while($arro = mysql_fetch_array($qro)){
			  
	 echo "<option value=\"".$arro['name']."\">".$arro['name']."</option>";
	    		
	            }?>
	       </select>  
            </div>
            
             
             
          <button type="submit" name="newreport" id="startbtf" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">
          สร้างรายงาน</button>
                 
         
             
            </div><!--end role main -->
            </form>
            
            
            
            
        </div>