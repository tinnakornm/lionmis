 
<?php 
           //query from user_online
          $qon = mysql_query("SELECT * FROM  `pk_useronline` WHERE  `username` LIKE  '".$_SESSION['uname']."' LIMIT 0 , 1");
          $arro = mysql_fetch_array($qon);
         
         ?>
<div data-role="popup" id="popupEdit" data-theme="a" class="ui-corner-all" style="max-width:650px;">
         <div data-role="header" data-theme="b" style="min-width:450px; max-width:650px;">
            <h2>แก้ไขรายงาน OEE</h2>
            </div>
 
            <form action="" method="post" enctype="multipart/form-data" data-ajax="false" id="editbt">
            <div role="main" class="ui-content" style="max-width:650px;">
            
            <div class="ui-title" style="padding-top:5px;">
               
             <select name="main_mixer" required="required" id="main_mixer">
		      <option value="2DWMMT01" <?php if($arrinfo['main_mixer']=='2DWMMT01'){ echo 'selected="selected"'; } ?>> 2DWMMT01 </option> 
              <option value="2DWMMT02" <?php if($arrinfo['main_mixer']=='2DWMMT02'){ echo 'selected="selected"'; } ?>> 2DWMMT02 </option> 
              <option value="2DWMMT03" <?php if($arrinfo['main_mixer']=='2DWMMT03'){ echo 'selected="selected"'; } ?>> 2DWMMT03 </option> 
              <option value="2FSMMT01" <?php if($arrinfo['main_mixer']=='2FSMMT01'){ echo 'selected="selected"'; } ?>> 2FSMMT01 </option> 
              <option value="2FSMMT03" <?php if($arrinfo['main_mixer']=='2FSMMT03'){ echo 'selected="selected"'; } ?>> 2FSMMT03 </option> 
              <option value="2FSMMT04" <?php if($arrinfo['main_mixer']=='2FSMMT04'){ echo 'selected="selected"'; } ?>> 2FSMMT04 </option> 
              <option value="2FSMMT05" <?php if($arrinfo['main_mixer']=='2FSMMT05'){ echo 'selected="selected"'; } ?>> 2FSMMT05 </option> 
              <option value="2LDMMT01" <?php if($arrinfo['main_mixer']=='2LDMMT01'){ echo 'selected="selected"'; } ?>> 2LDMMT01 </option> 
              <option value="2STMMT01" <?php if($arrinfo['main_mixer']=='2STMMT01'){ echo 'selected="selected"'; } ?>> 2STMMT01 </option> 
  </select> 
            </div>
            
            <div class="ui-title" style="padding-top:5px;">
           
             <select name="pd_group"  required="required" id="pd_group" >
	       <?php $qr = mysql_query("SELECT DISTINCT (pd_group) FROM  `p2mx_pd` WHERE status =1");
	              while($arr = mysql_fetch_array($qr)){
	 echo "<option value=\"".$arr['pd_group']."\"";
	 if($arrinfo['pd_group']==$arr['pd_group']){ echo 'selected="selected"'; } 
	 echo ">".$arr['pd_group']."</option>";
	    		
	            }?>
	       </select>
            </div>

            <div class="ui-title" style="padding-top:5px;">
            <strong>   Date : </strong>
          <input type="date" name="date" id="date" required="required"   style="font-size:16px;" value="<?php echo $arrinfo['date']; ?>" />
			 </div>
             
             <div class="ui-title" style="padding-top:5px;">
             <table><tr>
             <td width="50%">
          <strong>Time : </strong> <input required="required"  data-role="none"  type="time" name="start_tim_define" style="width:120px;" id="start_tim_define" value="<?php if(isset($arrinfo['start_tim_define'])){  if($arrinfo['start_tim_define']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrinfo['start_tim_define']); }  }?>" />
             </td>
             <td> - <input required="required"  data-role="none"  type="time" name="stop_tim_define" style="width:120px;"  id="stop_tim_define" value="<?php if(isset($arrinfo['stop_tim_define'])){  if($arrinfo['stop_tim_define']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrinfo['stop_tim_define']); }  }?>" />
             </td>
             </tr>
             </table>
			 </div>
             
             
            <div class="ui-title" style="padding-top:5px;">
         
          <select name="mainshift" required="required" id="mainshift">
           <option value="A" <?php if($arrinfo['shift']=='A'){ echo 'selected="selected"'; } ?> >22.30-6.30</option>
           <option value="B" <?php if($arrinfo['shift']=='B'){ echo 'selected="selected"'; } ?> >6.30-14.30</option>
           <option value="C" <?php if($arrinfo['shift']=='C'){ echo 'selected="selected"'; } ?> >14.30-22.30</option>
           
          </select>
             </div>
            
            
            <div class="ui-title" style="padding-top:5px;">
            
            <?php 
 		$qo ="SELECT * FROM `user` WHERE  `dev` LIKE 'mix200' AND `position` LIKE 'shiftleader'";
		   ?>
 <select name="shiftleader"  required="required" id="shiftleader"  >
 
	       <?php    
		         $qro = mysql_query($qo);
	              while($arro = mysql_fetch_array($qro)){
			  
	 echo "<option value=\"".$arro['uname']."\"";
	  if($arrinfo['shift_uname']==$arro['uname']){ echo 'selected="selected"'; } 
	 echo ">".$arro['name']."</option>";
	    		
	            }?>
	       </select>
            </div>
            
          
            
            
            
             
             
          <button type="submit" name="editbt" id="editbt" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">
          แก้ไขรายงาน </button>
                 
         
             
            </div><!--end role main -->
            </form>
            
            
            
            
        </div>