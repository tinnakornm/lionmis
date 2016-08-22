<?php  
##########################################################################################
/*	File Name    : ckfrm-oee.php (Extends from std_repf.php since 05/07/2012)
    	Project No   : P002
    	Create Date  : 02/05/2015
	Create by    : Tinnakorn.M
	Description  : OEE Check page
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
    
		Log : v1.0 - friendly operator UI. @date < 05/07/2012
	     - 17/12/2012 - Update 'p2mx_check' by add [tem_sent_insp] and [tem_get_insp]
		 - 17/08/2013 : [Card No:V1.25/14OP01], OEE Product Auto complest, By Tinnakorn.M
		 - 17/08/2013 : [Card No:V1.16/14OP02], Fix bug OEE Save report, By Tinnakorn.M 
		 - 15/05/2014 : Change time format to datetime format
		 - 15/05/2014 : smoot submit form style by jquery
		 - 16/08/2014 : [Card No:V1.24/14AD01], Add AD13 new reason code, By Tinnakorn.M
		 - 31/03/2015 : [], Change AJAX http post method (Using class)
		 - 02/05/2015 : Move server from srcinfo.sli to lionproduction.sli
		 - 10/07/2015 : add OEE Checkt (OEE Check note), By Tinnakorn.M
		 
 
			
	    (Case backup)
           - DD/MM/YYYY : Backup, File name :  , By Tinnakorn.M
	       
*/
##########################################################################################





	if(!$_SESSION["uname"]){
	echo"กรุณาเข้าสู่ระบบ";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";

	}
	
	require('../../include/config.inc.php'); 
	mysql_select_db($db);	
	
	//imput require
	// 1. Session of 'login_ture' -> checking permission of user
	// 2. Session of 'GID' -> query the report from database
	$login_true = $_SESSION['login_true'];
	//Get GID if not session
	if(isset($_GET['id'])){  $GIDF = $_GET['id'];  $_SESSION['GIDF'] = $_GET['id']; }else{
	$GIDF = $_SESSION['GIDF'];
	//chang status to pending
	  mysql_query("UPDATE `p2mx_f_rep` SET  `rep_status` =  'pending' WHERE  `p2mx_f_rep`.`GIDF` LIKE '".$_SESSION['GIDF']."' LIMIT 1 ");
	 }
	if(!$GIDF){ echo "Error! No required report"; exit(); }
	
 
	
	//repinfo & Autoloadbatch
	$qinfo = mysql_query("SELECT *  FROM  `p2mx_f_rep`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' LIMIT 0 , 1");
	if(!mysql_num_rows($qinfo)){  echo "Error! No report on database"; exit();  }else{
	   $arrinfo = mysql_fetch_array($qinfo);	
	   //check if not session DD, MM, YYY
	   if(!isset($_SESSION["DD"])){ $_SESSION['DD'] = $arrinfo['DD']; }
	   if(!isset($_SESSION["MM"])){  $_SESSION['MM'] = $arrinfo['MM'];  }
	   if(!isset($_SESSION["YYYY"])){  $_SESSION['YYYY'] = $arrinfo['YYYY'];  }
	   
	}
	//query product [v1.25/14OP01] Autocomplete OEE Product report :17/08/2014
 		$qf =mysql_query("SELECT DISTINCT (fullformula) FROM `p2mx_pd` WHERE `mixer` LIKE '".$arrinfo['main_mixer']."' AND `status` !=2 ORDER BY  `p2mx_pd`.`fullformula` ASC ");
		$i=1;
		while($arrp = mysql_fetch_array($qf)){
			$arrf[$i] = $arrp['fullformula'];
			$i++;
		}
 
    //check query
 
	$qc1 =mysql_query("SELECT * FROM  `p2mx_f_check`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =1 LIMIT 0 , 1");
		if(mysql_num_rows($qc1)){ $arrck1 = mysql_fetch_array($qc1); }
	$qc2 =mysql_query("SELECT * FROM  `p2mx_f_check`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =2 LIMIT 0 , 1");
		if(mysql_num_rows($qc2)){ $arrck2 = mysql_fetch_array($qc2); }
	$qc3 =mysql_query("SELECT * FROM  `p2mx_f_check`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =3 LIMIT 0 , 1");
		if(mysql_num_rows($qc3)){ $arrck3 = mysql_fetch_array($qc3); }
	$qc4 =mysql_query("SELECT * FROM  `p2mx_f_check`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =4 LIMIT 0 , 1");
		if(mysql_num_rows($qc4)){ $arrck4 = mysql_fetch_array($qc4); }
	$qc5 =mysql_query("SELECT * FROM  `p2mx_f_check`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =5 LIMIT 0 , 1");
		if(mysql_num_rows($qc5)){ $arrck5 = mysql_fetch_array($qc5); }
	$qc6 =mysql_query("SELECT * FROM  `p2mx_f_check`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =6 LIMIT 0 , 1");
		if(mysql_num_rows($qc6)){ $arrck6 = mysql_fetch_array($qc6); }
		
		
		//preparing array of TOT, NOT String
		$qar = mysql_query("SELECT * FROM  `p2mx_f_checkt` WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' LIMIT 0 , 60");
		if(mysql_num_rows($qar)){
			while($arrt = mysql_fetch_array($qar)){
				$AR["".$arrt['causekey'.""]]=$arrt['check_val'];
			}
		}
		
?>



	<style type="text/css">
 
 
input, select { border:none; color:#0000FF;  text-align:center; padding-top:0px; padding-bottom:0px; width:100%; }
input:hover { background:#FFCCCC;   color:#FF0000; }
input[type=time]::-webkit-inner-spin-button,
input[type=time]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

 

    </style>

<script type="text/javascript" src="js/std_repf_check.js"></script> 

 <div style="height:1px; text-align:right; ">
<div class="inof_g" style="text-align: center; width: 200px; margin: auto; padding: 10px; background: rgb(184, 232, 171);  border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; display:none;"><strong> <img src="components/source/images/check_24.png" width="24" height="24" align="absmiddle">  บันทึกรายงานสำเร็จ </strong></div>
</div>

<div>
<table border="0" align="center"  style="width:100%; text-align:left;">
  <!--DWLayoutTable-->
	<tr>
	  <td width="50%" valign="top"><div style="padding-left:5px;">
      
     <?php
	  
	 
	  $qsession = mysql_query("SELECT GIDF, main_mixer FROM  `p2mx_f_rep` WHERE  `rep_status` LIKE  'pending' AND  `rep_uname` LIKE  '".$_SESSION['uname']."' LIMIT 0 , 3");
	 		if(mysql_num_rows($qsession)){
				while($arrsrep = mysql_fetch_array($qsession)){
	 ?> 
      <a href="components/join-oee.php?id=<?php echo $arrsrep['GIDF']; ?>"   data-role="button" data-icon="action" data-iconpos="left" data-corners="false" data-theme="c" style="width:100px; display: inline-flex; <?php if($arrsrep['GIDF']==$_SESSION['GIDF']){ echo ' background: green; color: #FFF;" '; } ?>"  class="ui-link ui-btn ui-btn-c ui-icon-action ui-btn-icon-left ui-shadow" role="button" data-ajax="false"> <?php echo $arrsrep['main_mixer']; ?> </a>
      <?php }} ?>
       
        <?php if(mysql_num_rows($qsession)<=1){ ?> 
         <a href="#popupLogin"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex;"   >สร้างรายงาน</a>
 		<?php } ?>
      
      </td>
	  <td width="50%" valign="top"> 
	    <div align="right">
	      <div class="buttons" >
	        
            
            
            <a onclick="return confirm('คุณต้องการบันทึกพร้อมส่งรายงานนี้ใช่หรือไม่?')" href="components/save_oee.php?id=<?php echo $_SESSION['GIDF']; ?>"   data-ajax="false" data-role="button" data-icon="check" data-iconpos="left" data-corners="false" data-theme="c" style="width:100px; display: inline-flex;" class="ui-link ui-btn ui-btn-c ui-icon-check ui-btn-icon-left ui-shadow" role="button">ส่งรายงาน</a>
	        
	         <a href="#popupEdit"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="edit" data-iconpos="left" data-corners="false" data-theme="c" style="width:100px; display: inline-flex;" class="ui-link ui-btn ui-btn-c ui-icon-edit ui-btn-icon-left ui-shadow" role="button"> Edit batch </a>
 
  <a href="p_repf.php?id=<?php echo $_SESSION['GIDF']; ?>" target="_blank" data-ajax="false" data-role="button" data-icon="search" data-iconpos="left" data-corners="false" data-theme="c" style="width:100px; display: inline-flex;" class="ui-link ui-btn ui-btn-c ui-icon-search ui-btn-icon-left ui-shadow" role="button"> Print </a>
   
           
          </div>
        </div>
      </td>
	</tr>
</table>

</div>
<div>
<table border="0" align="center"  style="width:100%; text-align:left;">
  <!--DWLayoutTable-->
	<tr><td width="50%" valign="top">
  <div style="margin-top:15px;" align="left" ><strong>Report id </strong>: <?php echo $_SESSION["GIDF"]; ?> 
  <strong>Mixer No.</strong> <?php echo $arrinfo['main_mixer']; ?>
  </div>
	  <?php 
   
	?>
	  <div>
	    <strong>Shift Report Team </strong>: <?php echo $arrinfo['pd_group']; ?> 
        
       <strong> Date</strong> : <?php echo $arrinfo['date']; ?> 
       <input data-role="none" name="cdate" id="cdate"  type="hidden"  value="<?php echo $arrinfo['date']; ?>">
        
       <strong> Shift</strong> : ( <?php echo $arrinfo['shift']; ?> )
        
        <strong>เวลา</strong> : <?php echo $arrinfo['start_tim_define']; ?> - <?php echo $arrinfo['stop_tim_define']; ?> 
	    </div>
	  
	  </td>
	  <td width="50%" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
	</tr>
</table>

</div>
         <?php
	 //query report
 
		 
		?> 
          <table  cellpadding="0" cellspacing="0" style="text-align:left; table-layout:fixed; width:100%;" id="tlb" >
	  <!--Layout-->
      <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
        <td width="210" valign="middle"  >&nbsp;</td>
        <td  valign="middle"  >&nbsp;</td>
        <td height="24" colspan="2" valign="middle"  >
        <?php if(isset($arrck1['approved']) and $arrck1['approved']==1){  ?>
        <div style="text-align:center; color:#999;"><img src="../../source/icons/lock.png" width="16" height="16" style="vertical-align:central;" /> Acc Approved</div>
        <?php }else{ ?>
        <div style="text-align:center; color:#569B71;"><img src="../../source/icons/tick.png" width="16" height="16" style="vertical-align:central;" /> Please valid </div>
        <?php } ?> 
        
        <input name="SCKT1" class="SCKT1" id="1" value="<?php if(isset($arrck1['approved'])){ echo $arrck1['approved']; }else{ echo '0'; } ?>" type="hidden">
        
        </td>
        <td colspan="2"   valign="middle"><?php if(isset($arrck2['approved']) and $arrck2['approved']==1){  ?>
        <div style="text-align:center; color:#999;"><img src="../../source/icons/lock.png" width="16" height="16" style="vertical-align:central;" /> Acc Approved</div>
        <?php }else{ ?>
        <div style="text-align:center; color:#569B71;"><img src="../../source/icons/tick.png" width="16" height="16" style="vertical-align:central;" /> Please valid </div>
        <?php } ?><input name="SCKT2" class="SCKT2" id="2" value="<?php if(isset($arrck2['approved'])){ echo $arrck2['approved']; }else{ echo '0'; } ?>" type="hidden"> </td>
        <td colspan="2"  valign="middle" ><?php if(isset($arrck3['approved']) and $arrck3['approved']==1){  ?>
        <div style="text-align:center; color:#999;"><img src="../../source/icons/lock.png" width="16" height="16" style="vertical-align:central;" /> Acc Approved</div>
        <?php }else{ ?>
        <div style="text-align:center; color:#569B71;"><img src="../../source/icons/tick.png" width="16" height="16" style="vertical-align:central;" /> Please valid </div>
        <?php } ?> <input name="SCKT3" class="SCKT3" id="3" value="<?php if(isset($arrck3['approved'])){ echo $arrck3['approved']; }else{ echo '0'; } ?>" type="hidden"> </td>
        <td colspan="2" valign="middle"><?php if(isset($arrck4['approved']) and $arrck4['approved']==1){  ?>
        <div style="text-align:center; color:#999;"><img src="../../source/icons/lock.png" width="16" height="16" style="vertical-align:central;" /> Acc Approved</div>
        <?php }else{ ?>
        <div style="text-align:center; color:#569B71;"><img src="../../source/icons/tick.png" width="16" height="16" style="vertical-align:central;" /> Please valid </div>
        <?php } ?> <input name="SCKT4" class="SCKT4" id="4" value="<?php if(isset($arrck4['approved'])){ echo $arrck4['approved']; }else{ echo '0'; } ?>" type="hidden"></td>
        <td colspan="2" valign="top" ><?php if(isset($arrck5['approved']) and $arrck5['approved']==1){  ?>
        <div style="text-align:center; color:#999;"><img src="../../source/icons/lock.png" width="16" height="16" style="vertical-align:central;" /> Acc Approved</div>
        <?php }else{ ?>
        <div style="text-align:center; color:#569B71;"><img src="../../source/icons/tick.png" width="16" height="16" style="vertical-align:central;" /> Please valid </div>
        <?php } ?> <input name="SCKT5" class="SCKT5" id="5" value="<?php if(isset($arrck5['approved'])){ echo $arrck5['approved']; }else{ echo '0'; } ?>" type="hidden"></td>
        <td colspan="2" valign="middle"><?php if(isset($arrck6['approved']) and $arrck6['approved']==1){  ?>
        <div style="text-align:center; color:#999;"><img src="../../source/icons/lock.png" width="16" height="16" style="vertical-align:central;" /> Acc Approved</div>
        <?php }else{ ?>
        <div style="text-align:center; color:#569B71;"><img src="../../source/icons/tick.png" width="16" height="16" style="vertical-align:central;" /> Please valid </div>
        <?php } ?> <input name="SCKT6" class="SCKT6" id="6" value="<?php if(isset($arrck6['approved'])){ echo $arrck6['approved']; }else{ echo '0'; } ?>" type="hidden"></td>
        <td colspan="2" rowspan="7" valign="middle" bgcolor="#CCCCCC"> 
          
        </td>
      </tr>
      <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   
   <td  valign="middle"  >Work Order No.</td>
   <td width="38"  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td height="24" colspan="2" valign="middle"  ><div  class="incell"><input data-role="none" name="order1" id="order1" class="T1"   type="number" style="width:100%;"  value="<?php  if(isset($arrck1['order'])){ echo $arrck1['order']; } ?>">
   </div></td>
   <td colspan="2"   valign="middle"><div  class="incell"><input data-role="none" name="order2" id="order2"  class="T2"  type="number" style="width:100%;"  value="<?php  if(isset($arrck2['order'])){ echo $arrck2['order']; } ?>">
   </div></td>
   <td colspan="2"  valign="middle" ><div  class="incell"><input data-role="none" name="order3" id="order3" class="T3"  type="number" style="width:100%;"  value="<?php  if(isset($arrck3['order'])){ echo $arrck3['order']; } ?>">
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"><input data-role="none" name="order4" id="order4" class="T4"  type="number" style="width:100%;"  value="<?php  if(isset($arrck4['order'])){ echo $arrck4['order']; } ?>">
   </div></td>
   <td colspan="2" valign="top" ><div  class="incell"><input data-role="none" name="order5" id="order5" class="T5"  type="number" style="width:100%;"  value="<?php  if(isset($arrck5['order'])){ echo $arrck5['order']; } ?>">
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"><input data-role="none" name="order6" id="order6" class="T6"  type="number" style="width:100%;"  value="<?php  if(isset($arrck6['order'])){ echo $arrck6['order']; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ผลิตภัณฑ์</td>
   <td width="38"  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td height="24" colspan="2" valign="middle"  >
    <select  data-role="none" name="product1" style="width:100%;" id="product1" class="T1" >
  <option value=""> </option>
 <?php    foreach ($arrf as &$product) {  
 echo "<option value=\"".$product."\" "; 
 if(isset($arrck1['product']) and $product==$arrck1['product']){ echo 'selected="selected"'; };
 echo ">".$product."</option>";	}     	 ?>
	       </select>  
   </td>
   <td colspan="2"   valign="middle">
   <select data-role="none" name="product2" style="width:100%;" id="product2" class="T2"  >
  <option value=""> </option>
	 <?php    foreach ($arrf as &$product) {  
 echo "<option value=\"".$product."\" "; 
 if(isset($arrck2['product']) and $product==$arrck2['product']){ echo 'selected="selected"'; };
 echo ">".$product."</option>";	}     	 ?>
	       </select>
   </td>
   <td colspan="2"  valign="middle" >
     <select data-role="none" name="product3" style="width:100%;" id="product3" class="T3" >
  <option value=""> </option>
    <?php    foreach ($arrf as &$product) {  
 echo "<option value=\"".$product."\" "; 
 if(isset($arrck3['product']) and $product==$arrck3['product']){ echo 'selected="selected"'; };
 echo ">".$product."</option>";	}     	 ?>
	       </select>
   </td>
   <td colspan="2" valign="middle">
        <select data-role="none"  name="product4" style="width:100%;" id="product4" class="T4" >
        <option value=""> </option>
      <?php    foreach ($arrf as &$product) {  
 echo "<option value=\"".$product."\" "; 
 if(isset($arrck4['product']) and $product==$arrck4['product']){ echo 'selected="selected"'; };
 echo ">".$product."</option>";	}     	 ?>
	       </select>
   </td>
   <td colspan="2" valign="top" >
           <select data-role="none"  name="product5" style="width:100%;" id="product5" class="T5" >
           <option value=""> </option>
    <?php    foreach ($arrf as &$product) {  
 echo "<option value=\"".$product."\" "; 
 if(isset($arrck5['product']) and $product==$arrck5['product']){ echo 'selected="selected"'; };
 echo ">".$product."</option>";	}     	 ?>
	       </select>
   </td>
   <td colspan="2" valign="middle">
           <select data-role="none"  name="product6" style="width:100%;"  id="product6" class="T6" >
           <option value=""> </option>
    <?php    foreach ($arrf as &$product) {  
 echo "<option value=\"".$product."\" "; 
 if(isset($arrck6['product']) and $product==$arrck6['product']){ echo 'selected="selected"'; };
 echo ">".$product."</option>";	}     	 ?>
	       </select>
   </td>
   </tr>
 <tr   style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >Batch No.</td>
   <td width="38"  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td height="24" colspan="2" valign="middle"  ><div  class="incell"><input data-role="none" name="batch_no1" id="batch_no1"  type="number" style="width:100%;"  value="<?php  if(isset($arrck1['batch_no'])){ echo $arrck1['batch_no']; } ?>" class="T1">
   </div></td>
   <td colspan="2"   valign="middle"><div  class="incell"><input data-role="none" name="batch_no1" id="batch_no2" class="T2"  type="number" style="width:100%;"  value="<?php  if(isset($arrck2['batch_no'])){ echo $arrck2['batch_no']; } ?>">
   </div></td>
   <td colspan="2"  valign="middle" ><div  class="incell"><input data-role="none" name="batch_no3" id="batch_no3" class="T3"  type="number" style="width:100%;"  value="<?php  if(isset($arrck3['batch_no'])){ echo $arrck3['batch_no']; } ?>">
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"><input data-role="none" name="batch_no4" id="batch_no4" class="T4"  type="number" style="width:100%;"  value="<?php  if(isset($arrck4['batch_no'])){ echo $arrck4['batch_no']; } ?>">
   </div></td>
   <td colspan="2" valign="top" ><div  class="incell"><input data-role="none" name="batch_no5" id="batch_no5" class="T5"  type="number" style="width:100%;"  value="<?php  if(isset($arrck5['batch_no'])){ echo $arrck5['batch_no']; } ?>">
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"><input data-role="none" name="batch_no6" id="batch_no6" class="T6"  type="number" style="width:100%;"  value="<?php  if(isset($arrck6['batch_no'])){ echo $arrck6['batch_no']; } ?>">
   </div></td>
   </tr>
 <tr   style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ผลผลิต (Ton)</td>
   <td width="38"  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td height="24" colspan="2" valign="middle" ><input data-role="none" name="batch_ton1" id="batch_ton1"   type="number" style="width:100%;"  value="<?php  if(isset($arrck1['batch_ton'])){ echo $arrck1['batch_ton']; } ?>" class="T1"></td>
   <td colspan="2"   valign="middle"><input data-role="none" name="batch_ton2" id="batch_ton2" class="T2"  type="number" style="width:100%;"  value="<?php  if(isset($arrck2['batch_ton'])){ echo $arrck2['batch_ton']; } ?>"></td>
   <td colspan="2"  valign="middle" ><input data-role="none" name="batch_ton3" id="batch_ton3" class="T3"  type="number" style="width:100%;"  value="<?php  if(isset($arrck3['batch_ton'])){ echo $arrck3['batch_ton']; } ?>"></td>
   <td colspan="2" valign="middle"><input data-role="none" name="batch_ton4" id="batch_ton4" class="T4"  type="number" style="width:100%;"  value="<?php  if(isset($arrck4['batch_ton'])){ echo $arrck4['batch_ton']; } ?>"></td>
   <td colspan="2" valign="middle" ><input data-role="none" name="batch_ton5" id="batch_ton5" class="T5"  type="number" style="width:100%;"  value="<?php  if(isset($arrck5['batch_ton'])){ echo $arrck5['batch_ton']; } ?>"></td>
   <td colspan="2" valign="middle"><input data-role="none" name="batch_ton6" id="batch_ton6" class="T6"  type="number" style="width:100%;"  value="<?php  if(isset($arrck6['batch_ton'])){ echo $arrck6['batch_ton']; } ?>"></td>
   </tr>
 <tr   style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >คุณภาพ (ผ่าน/รอผล)</td>
   
   <td width="38"  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td height="24" colspan="2" valign="middle" >
     <select data-role="none"  name="quality1" style="width:100%;" id="quality1" class="T1" >
           <option value=""> </option>
           <option value="1" <?php  if(isset($arrck1['quality']) and $arrck1['quality']==1){ echo 'selected="selected"'; }; ?>>ผ่าน</option>
           <option value="2" <?php  if(isset($arrck1['quality']) and $arrck1['quality']==2){ echo 'selected="selected"'; }; ?>>ไม่ผ่าน</option>
           <option value="3" <?php  if(isset($arrck1['quality']) and $arrck1['quality']==3){ echo 'selected="selected"'; }; ?>>รอผล</option>
       </select>
   </td>
   <td colspan="2"   valign="middle">
     <select data-role="none"  name="quality2" style="width:100%;" id="quality2"  class="T2">
           <option value=""> </option>
           <option value="1" <?php  if(isset($arrck2['quality']) and $arrck2['quality']==1){ echo 'selected="selected"'; }; ?>>ผ่าน</option>
           <option value="2" <?php  if(isset($arrck2['quality']) and $arrck2['quality']==2){ echo 'selected="selected"'; }; ?>>ไม่ผ่าน</option>
           <option value="3" <?php  if(isset($arrck2['quality']) and $arrck2['quality']==3){ echo 'selected="selected"'; }; ?>>รอผล</option>
       </select>
   </td>
   <td colspan="2"  valign="middle" >
     <select data-role="none"  name="quality3" style="width:100%;" id="quality3"  class="T3">
           <option value=""> </option>
           <option value="1" <?php  if(isset($arrck3['quality']) and $arrck3['quality']==1){ echo 'selected="selected"'; }; ?>>ผ่าน</option>
           <option value="2" <?php  if(isset($arrck3['quality']) and $arrck3['quality']==2){ echo 'selected="selected"'; }; ?>>ไม่ผ่าน</option>
           <option value="3" <?php  if(isset($arrck3['quality']) and $arrck3['quality']==3){ echo 'selected="selected"'; }; ?>>รอผล</option>
       </select>
   </td>
   <td colspan="2" valign="middle">
     <select data-role="none"  name="quality4" style="width:100%;" id="quality4" class="T4">
           <option value=""> </option>
           <option value="1" <?php  if(isset($arrck4['quality']) and $arrck4['quality']==1){ echo 'selected="selected"'; }; ?>>ผ่าน</option>
           <option value="2" <?php  if(isset($arrck4['quality']) and $arrck4['quality']==2){ echo 'selected="selected"'; }; ?>>ไม่ผ่าน</option>
           <option value="3" <?php  if(isset($arrck4['quality']) and $arrck4['quality']==3){ echo 'selected="selected"'; }; ?>>รอผล</option>
       </select>
   </td>
   <td colspan="2" valign="top" >
     <select data-role="none"  name="quality5" style="width:100%;" id="quality5"  class="T5">
           <option value=""> </option>
           <option value="1" <?php  if(isset($arrck5['quality']) and $arrck5['quality']==1){ echo 'selected="selected"'; }; ?>>ผ่าน</option>
           <option value="2" <?php  if(isset($arrck5['quality']) and $arrck5['quality']==2){ echo 'selected="selected"'; }; ?>>ไม่ผ่าน</option>
           <option value="3" <?php  if(isset($arrck5['quality']) and $arrck5['quality']==3){ echo 'selected="selected"'; }; ?>>รอผล</option>
       </select>
   </td>
   <td colspan="2" valign="middle">
     <select data-role="none"  name="quality6" style="width:100%;" id="quality6"  class="T6">
           <option value=""> </option>
           <option value="1" <?php  if(isset($arrck6['quality']) and $arrck6['quality']==1){ echo 'selected="selected"'; }; ?>>ผ่าน</option>
           <option value="2" <?php  if(isset($arrck6['quality']) and $arrck6['quality']==2){ echo 'selected="selected"'; }; ?>>ไม่ผ่าน</option>
           <option value="3" <?php  if(isset($arrck6['quality']) and $arrck6['quality']==3){ echo 'selected="selected"'; }; ?>>รอผล</option>
       </select>
   </td>
   </tr>
 <tr   style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >Storage No.</td>
   <td width="38"  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td height="24" colspan="2" valign="middle" ><input data-role="none" name="storage1" id="storage1"  class="T1"  type="text" style="width:100%;"  value="<?php if(isset($arrck1['storage'])){ echo $arrck1['storage']; } ?>"></td>
   <td colspan="2"   valign="middle"><input data-role="none" name="storage2" id="storage2" class="T2"  type="text" style="width:100%;"  value="<?php if(isset($arrck2['storage'])){ echo $arrck2['storage']; } ?>"></td>
   <td colspan="2"  valign="middle" ><input data-role="none" name="storage3" id="storage3" class="T3"  type="text" style="width:100%;"  value="<?php if(isset($arrck3['storage'])){ echo $arrck3['storage']; } ?>"></td>
   <td colspan="2" valign="middle"><input data-role="none" name="storage4" id="storage4" class="T4" type="text" style="width:100%;"  value="<?php if(isset($arrck4['storage'])){ echo $arrck4['storage']; } ?>"></td>
   <td colspan="2" valign="top" ><input data-role="none" name="storage5" id="storage5" class="T5" type="text" style="width:100%;"  value="<?php if(isset($arrck5['storage'])){ echo $arrck5['storage']; } ?>"></td>
   <td colspan="2" valign="middle"><input data-role="none" name="storage6" id="storage6" class="T6" type="text" style="width:100%;"  value="<?php if(isset($arrck6['storage'])){ echo $arrck6['storage']; } ?>"></td>
   </tr>
 <tr style="text-align:center;">
  
   <td valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td bgcolor="#EAEAEA"  ><div  class="incell"><strong>เริ่ม</strong></div></td>
   <td bgcolor="#EAEAEA" ><div  class="incell"><strong>เสร็จ</strong></div></td>
   <td bgcolor="#EAEAEA"><div  class="incell"><strong>เริ่ม</strong></div></td>
   <td bgcolor="#EAEAEA"  ><div  class="incell"><strong>เสร็จ</strong></div></td>
   <td bgcolor="#EAEAEA" ><div  class="incell"><strong>เริ่ม</strong></div></td>
   <td bgcolor="#EAEAEA" ><div  class="incell"><strong>เสร็จ</strong></div></td>
   <td bgcolor="#EAEAEA"><div  class="incell"><strong>เริ่ม</strong></div></td>
   <td bgcolor="#EAEAEA" ><div  class="incell"><strong>เสร็จ</strong></div></td>
   <td bgcolor="#EAEAEA" ><div  class="incell"><strong>เริ่ม</strong></div></td>
   <td bgcolor="#EAEAEA"><div  class="incell"><strong>เสร็จ</strong></div></td>
   <td bgcolor="#EAEAEA"><div  class="incell"><strong>เริ่ม</strong></div></td>
   <td bgcolor="#EAEAEA" ><div  class="incell"><strong>เสร็จ</strong></div></td>
   <td bgcolor="#EAEAEA">รวมเวลา</td>
   <td bgcolor="#EAEAEA">หมายเหตุ</td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >เวลาผสม</td>
   <td  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td>
   <?php
   function tim($tim){
	    if($tim=='0000-00-00 00:00:00'){  $data = '-'; }elseif($tim==''){ $data=''; }else{ $date = date_create($tim);  $data = date_format($date, 'H:i'); }
		return $data; 
		}
		?>
   <div  class="incell"><input data-role="none" name="mix_be1" id="mix_be1" class="T1" type="time" style="width:100%;"  
   value="<?php if(isset($arrck1['mix_be'])){  if($arrck1['mix_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['mix_be']); }  }?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="mix_fi1" id="mix_fi1" class="T1"  type="time" style="width:100%" 
    value="<?php if(isset($arrck1['mix_fi'])){    if($arrck1['mix_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['mix_fi']); }   }?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_be2" id="mix_be2" class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['mix_be'])){    if($arrck2['mix_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['mix_be']); }  } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_fi2"  id="mix_fi2" class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['mix_fi'])){    if($arrck2['mix_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['mix_fi']); }  } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_be3"  id="mix_be3"  class="T3" type="time" style="width:100%"  
   value="<?php if(isset($arrck3['mix_be'])){    if($arrck3['mix_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['mix_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_fi3"  id="mix_fi3" class="T3" type="time" style="width:100%"  
   value="<?php if(isset($arrck3['mix_fi'])){    if($arrck3['mix_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['mix_fi']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_be4"  id="mix_be4" class="T4" type="time" style="width:100%"  
   value="<?php if(isset($arrck4['mix_be'])){    if($arrck4['mix_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['mix_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_fi4"  id="mix_fi4" class="T4" type="time" style="width:100%"  
   value="<?php if(isset($arrck4['mix_fi'])){    if($arrck4['mix_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['mix_fi']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_be5"  id="mix_be5" class="T5" type="time" style="width:100%"   
   value="<?php if(isset($arrck5['mix_be'])){    if($arrck5['mix_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['mix_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_fi5"  id="mix_fi5" class="T5" type="time" style="width:100%"  
   value="<?php if(isset($arrck5['mix_fi'])){    if($arrck5['mix_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['mix_fi']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_be6"  id="mix_be6" class="T6" type="time" style="width:100%"  
   value="<?php if(isset($arrck6['mix_be'])){    if($arrck6['mix_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['mix_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="mix_fi6"  id="mix_fi6" class="T6" type="time" style="width:100%"  
   value="<?php if(isset($arrck6['mix_fi'])){   if($arrck6['mix_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['mix_fi']); } } ?>">
   
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="mix_tot"  class="TOT" id="mix_tot"   type="text" style="width:100%"  
   value="<?php if(isset($AR["mix_tot"])){ echo $AR["mix_tot"]; } ?>">
   </div></td>
   <td>
   <div  class="incell"><input data-role="none" name="mix_note" class="NOT"   id="mix_note" type="text" style="width:100%;"  
   value="<?php if(isset($AR["mix_note"])){ echo $AR["mix_note"]; } ?>">
   </div></td>
   </tr>
 <tr   style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >เวลาวิเคราะห์</td>
   <td  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td><div  class="incell">
 
   <input data-role="none" name="analy_be1" id="analy_be1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['analy_be'])){  if($arrck1['analy_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['analy_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="analy_fi1" id="analy_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['analy_fi'])){  if($arrck1['analy_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['analy_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_be2" id="analy_be2" class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['analy_be'])){  if($arrck2['analy_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['analy_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_fi2"  id="analy_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['analy_fi'])){  if($arrck2['analy_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['analy_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_be3"  id="analy_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['analy_be'])){  if($arrck3['analy_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['analy_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_fi3"  id="analy_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['analy_fi'])){  if($arrck3['analy_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['analy_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_be4"  id="analy_be4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['analy_be'])){  if($arrck4['analy_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['analy_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_fi4"  id="analy_fi4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['analy_fi'])){  if($arrck4['analy_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['analy_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_be5"  id="analy_be5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['analy_be'])){  if($arrck5['analy_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['analy_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_fi5"  id="analy_fi5" class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['analy_fi'])){  if($arrck5['analy_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['analy_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_be6"  id="analy_be6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['analy_be'])){  if($arrck6['analy_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['analy_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_fi6"  id="analy_fi6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['analy_fi'])){ if($arrck6['analy_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['analy_fi']); }}  ?>">
   </div></td>
   <td>
   
   <div  class="incell"><input data-role="none" name="analy_tot"  class="TOT" id="analy_tot"  type="text"  style="width:100%"  
   value="<?php if(isset($AR["analy_tot"])){ echo $AR["analy_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="analy_note"  id="analy_note"   type="text"  class="NOT" style="width:100%;"  
   value="<?php if(isset($AR["analy_note"])){ echo $AR["analy_note"]; } ?>">
   </div></td>
   </tr>
 <tr   style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >เวลาถ่ายเก็บ</td>
   <td  valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
  <td><div  class="incell"><input data-role="none" name="transf_be1" id="transf_be1" class="T1"  type="time" style="width:100%"  
  value="<?php  if(isset($arrck1['transf_fi'])){  if($arrck1['transf_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['transf_be']); } }  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="transf_fi1" id="transf_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['transf_fi'])){  if($arrck1['transf_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['transf_fi']); }  } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_be2" id="transf_be2" class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['transf_fi'])){  if($arrck2['transf_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['transf_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_fi2"  id="transf_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['transf_fi'])){  if($arrck2['transf_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['transf_fi']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_be3"  id="transf_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['transf_fi'])){  if($arrck3['transf_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['transf_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_fi3"  id="transf_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php if(isset($arrck3['transf_fi'])){  if($arrck3['transf_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['transf_fi']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_be4"  id="transf_be4" class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['transf_fi'])){   if($arrck4['transf_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['transf_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_fi4"  id="transf_fi4" class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['transf_fi'])){   if($arrck4['transf_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['transf_fi']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_be5"  id="transf_be5" class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['transf_fi'])){   if($arrck5['transf_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['transf_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_fi5"  id="transf_fi5" class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['transf_fi'])){   if($arrck5['transf_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['transf_fi']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_be6"  id="transf_be6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['transf_fi'])){   if($arrck6['transf_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['transf_be']); } }  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_fi6"  id="transf_fi6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['transf_fi'])){  if($arrck6['transf_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['transf_fi']); } }  ?>">
   </div></td>
   <td> <div  class="incell">

   <input data-role="none" name="transf_tot"  class="TOT" id="transf_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["transf_tot"])){ echo $AR["transf_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="transf_note" class="NOT"  id="transf_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["transf_note"])){ echo $AR["transf_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ปรับ AI</td>
   <td valign="middle"  >AD19</td>
    <td><div  class="incell"><input data-role="none" name="AD19_be1" id="AD19_be1"  class="T1"  type="time" style="width:100%"  
    value="<?php   if(isset($arrck1['AD19_be'])){ if($arrck1['AD19_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD19_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD19_fi1" id="AD19_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php   if(isset($arrck1['AD19_fi'])){ if($arrck1['AD19_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD19_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_be2" id="AD19_be2" class="T2"  type="time" style="width:100%"  
   value="<?php   if(isset($arrck2['AD19_be'])){ if($arrck2['AD19_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD19_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_fi2"  id="AD19_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD19_fi'])){  if($arrck2['AD19_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD19_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_be3"  id="AD19_be3" class="T3"   type="time" style="width:100%"  
   value="<?php   if(isset($arrck3['AD19_be'])){ if($arrck3['AD19_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD19_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_fi3"  id="AD19_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php   if(isset($arrck3['AD19_fi'])){ if($arrck3['AD19_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD19_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_be4"  id="AD19_be4" class="T4"   type="time" style="width:100%" 
    value="<?php  if(isset($arrck4['AD19_be'])){ if($arrck4['AD19_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD19_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_fi4"  id="AD19_fi4"  class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD19_fi'])){ if($arrck4['AD19_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD19_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_be5"  id="AD19_be5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD19_be'])){ if($arrck5['AD19_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD19_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_fi5"  id="AD19_fi5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD19_fi'])){ if($arrck5['AD19_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD19_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_be6"  id="AD19_be6"  class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AD19_be'])){ if($arrck6['AD19_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD19_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_fi6"  id="AD19_fi6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD19_fi'])){ if($arrck6['AD19_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD19_fi']); }}  ?>">
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="AD19_tot"  class="TOT"  id="AD19_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD19_tot"])){ echo $AR["AD19_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD19_note"  class="NOT"   id="AD19_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD19_note"])){ echo $AR["AD19_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ปรับ PH</td>
   <td valign="middle"  >AD20</td>
   <td><div  class="incell"><input data-role="none" name="AD20_be1" id="AD20_be1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD20_be'])){  if($arrck1['AD20_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD20_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD20_fi1" id="AD20_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD20_fi'])){  if($arrck1['AD20_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD20_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_be2" id="AD20_be2" class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD20_be'])){  if($arrck2['AD20_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD20_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_fi2"  id="AD20_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD20_fi'])){  if($arrck2['AD20_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD20_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_be3"  id="AD20_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD20_be'])){  if($arrck3['AD20_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD20_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_fi3"  id="AD20_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD20_fi'])){  if($arrck3['AD20_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD20_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_be4"  id="AD20_be4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD20_be'])){  if($arrck4['AD20_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD20_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_fi4"  id="AD20_fi4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD20_fi'])){  if($arrck4['AD20_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD20_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_be5"  id="AD20_be5" class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD20_be'])){  if($arrck5['AD20_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD20_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_fi5"  id="AD20_fi5" class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD20_fi'])){  if($arrck5['AD20_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD20_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_be6"  id="AD20_be6" class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AD20_be'])){  if($arrck6['AD20_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD20_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_fi6"  id="AD20_fi6" class="T6" type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD20_fi'])){ if($arrck6['AD20_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD20_fi']); }}  ?>">
   </div></td>
   <td>
   
   <div  class="incell"><input data-role="none" name="AD20_tot"  class="TOT"  id="AD20_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD20_tot"])){ echo $AR["AD20_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD20_note"  class="NOT"   id="AD20_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD20_note"])){ echo $AR["AD20_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ปรับ VISC.</td>
   <td valign="middle"  >AD25</td>
<td><div  class="incell"><input data-role="none" name="AD25_be1" id="AD25_be1"  class="T1"  type="time" style="width:100%"  
value="<?php  if(isset($arrck1['AD25_be'])){  if($arrck1['AD25_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD25_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD25_fi1" id="AD25_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD25_fi'])){  if($arrck1['AD25_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD25_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_be2" id="AD25_be2"  class="T2" type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD25_be'])){  if($arrck2['AD25_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD25_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_fi2"  id="AD25_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD25_fi'])){  if($arrck2['AD25_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD25_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_be3"  id="AD25_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD25_be'])){  if($arrck3['AD25_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD25_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_fi3"  id="AD25_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD25_fi'])){  if($arrck3['AD25_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD25_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_be4"  id="AD25_be4"  class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD25_be'])){  if($arrck4['AD25_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD25_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_fi4"  id="AD25_fi4"  class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD25_fi'])){  if($arrck4['AD25_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD25_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_be5"  id="AD25_be5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD25_be'])){  if($arrck5['AD25_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD25_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_fi5"  id="AD25_fi5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD25_fi'])){  if($arrck5['AD25_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD25_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_be6"  id="AD25_be6"  class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD25_be'])){   if($arrck6['AD25_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD25_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_fi6"  id="AD25_fi6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD25_fi'])){ if($arrck6['AD25_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD25_fi']); }}  ?>">
   </div></td>
   <td>
   
   <div  class="incell"><input data-role="none" name="AD25_tot"  class="TOT"  id="AD25_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD25_tot"])){ echo $AR["AD25_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD25_note"  class="NOT"   id="AD25_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD25_note"])){ echo $AR["AD25_note"]; } ?>">
   </div></td>
   </tr>
 <tr style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >Stock เต็ม (ผลิตปกติ)</td>
   <td valign="middle"  >AD51</td>
   <td><div  class="incell"><input data-role="none" name="AD51_be1" id="AD51_be1"  class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD51_be'])){  if($arrck1['AD51_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD51_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD51_fi1" id="AD51_fi1"  class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD51_fi'])){  if($arrck1['AD51_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD51_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_be2" id="AD51_be2"   class="T2" type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD51_be'])){  if($arrck2['AD51_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD51_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_fi2"  id="AD51_fi2"  class="T2"  type="time" style="width:100%" 
   value="<?php  if(isset($arrck2['AD51_fi'])){  if($arrck2['AD51_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD51_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_be3"  id="AD51_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD51_be'])){  if($arrck3['AD51_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD51_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_fi3"  id="AD51_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD51_fi'])){  if($arrck3['AD51_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD51_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_be4"  id="AD51_be4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD51_be'])){  if($arrck4['AD51_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD51_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_fi4"  id="AD51_fi4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD51_fi'])){  if($arrck4['AD51_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD51_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_be5"  id="AD51_be5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD51_be'])){  if($arrck5['AD51_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD51_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_fi5"  id="AD51_fi5"   class="T5" type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD51_fi'])){  if($arrck5['AD51_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD51_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_be6"  id="AD51_be6"  class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AD51_be'])){  if($arrck6['AD51_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD51_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_fi6"  id="AD51_fi6"  class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD51_fi'])){ if($arrck6['AD51_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD51_fi']); }}  ?>">
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="AD51_tot"  class="TOT"  id="AD51_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD51_tot"])){ echo $AR["AD51_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD51_note"  class="NOT"   id="AD51_note"    type="text" style="width:100%;" 
   value="<?php if(isset($AR["AD51_note"])){ echo $AR["AD51_note"]; } ?>">
   </div></td>
   </tr>
 <tr style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >แผนผลิตเปลี่ยน รอถ่าย Semi</td>
   <td valign="middle"  >AD54</td>
   <td><div  class="incell"><input data-role="none" name="AD54_be1" id="AD54_be1"  class="T1"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD54_be'])){ if($arrck1['AD54_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD54_be']); }} ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD54_fi1" id="AD54_fi1"  class="T1"   type="time" style="width:100%"  
   value="<?php   if(isset($arrck1['AD54_fi'])){ if($arrck1['AD54_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD54_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_be2" id="AD54_be2"   class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD54_be'])){  if($arrck2['AD54_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD54_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_fi2"  id="AD54_fi2"   class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD54_fi'])){  if($arrck2['AD54_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD54_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_be3"  id="AD54_be3"  class="T3"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD54_be'])){  if($arrck3['AD54_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD54_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_fi3"  id="AD54_fi3"   class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD54_fi'])){  if($arrck3['AD54_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD54_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_be4"  id="AD54_be4"  class="T4"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD54_be'])){  if($arrck4['AD54_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD54_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_fi4"  id="AD54_fi4"   class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD54_fi'])){  if($arrck4['AD54_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD54_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_be5"  id="AD54_be5"   class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD54_be'])){  if($arrck5['AD54_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD54_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_fi5"  id="AD54_fi5"  class="T5"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD54_fi'])){  if($arrck5['AD54_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD54_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_be6"  id="AD54_be6"   class="T6"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AD54_be'])){  if($arrck6['AD54_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo tim($arrck6['AD54_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_fi6"  id="AD54_fi6"   class="T6"   type="time" style="width:100%" 
    value="<?php if(isset($arrck6['AD54_fi'])){  if($arrck6['AD54_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD54_fi']); }}  ?>">
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="AD54_tot"  class="TOT"  id="AD54_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD54_tot"])){ echo $AR["AD54_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD54_note"  class="NOT"   id="AD54_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD54_note"])){ echo $AR["AD54_note"]; } ?>">
   </div></td>
   </tr>
 <tr style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >พท.เต็ม(รอถ่ายจากเปลี่ยนสูตร)</td>
   <td valign="middle"  >AK01</td>
   <td><div  class="incell"><input data-role="none" name="AK01_be1" id="AK01_be1"    class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AK01_be'])){  if($arrck1['AK01_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AK01_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AK01_fi1" id="AK01_fi1"  class="T1"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AK01_fi'])){  if($arrck1['AK01_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AK01_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_be2" id="AK01_be2"  class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AK01_be'])){  if($arrck2['AK01_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AK01_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_fi2"  id="AK01_fi2"  class="T2"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AK01_fi'])){  if($arrck2['AK01_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AK01_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_be3"  id="AK01_be3"  class="T3"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AK01_be'])){  if($arrck3['AK01_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AK01_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_fi3"  id="AK01_fi3"  class="T3"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AK01_fi'])){  if($arrck3['AK01_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AK01_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_be4"  id="AK01_be4"  class="T4"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AK01_be'])){  if($arrck4['AK01_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AK01_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_fi4"  id="AK01_fi4"  class="T4"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AK01_fi'])){  if($arrck4['AK01_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AK01_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_be5"  id="AK01_be5"  class="T5"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AK01_be'])){  if($arrck5['AK01_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AK01_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_fi5"  id="AK01_fi5"  class="T5"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AK01_fi'])){  if($arrck5['AK01_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AK01_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_be6"  id="AK01_be6"  class="T6"    type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AK01_be'])){  if($arrck6['AK01_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AK01_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_fi6"  id="AK01_fi6"  class="T6"    type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AK01_fi'])){ if($arrck6['AK01_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AK01_fi']); }}  ?>">
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="AK01_tot"   class="TOT" id="AK01_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AK01_tot"])){ echo $AR["AK01_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AK01_note"  class="NOT"   id="AK01_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AK01_note"])){ echo $AR["AK01_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >รอ Premix</td>
   <td valign="middle"  >AD53</td>
    <td><div  class="incell"><input data-role="none" name="AD53_be1" id="AD53_be1"  class="T1"  type="time" style="width:100%"  
    value="<?php  if(isset($arrck1['AD53_be'])){  if($arrck1['AD53_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD53_be']); } } ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD53_fi1" id="AD53_fi1"  class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD53_fi'])){  if($arrck1['AD53_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD53_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_be2" id="AD53_be2"  class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD53_be'])){  if($arrck2['AD53_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD53_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_fi2"  id="AD53_fi2"  class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD53_fi'])){  if($arrck2['AD53_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD53_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_be3"  id="AD53_be3"  class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD53_be'])){  if($arrck3['AD53_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD53_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_fi3"  id="AD53_fi3"  class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD53_fi'])){  if($arrck3['AD53_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD53_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_be4"  id="AD53_be4"  class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD53_be'])){  if($arrck4['AD53_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD53_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_fi4"  id="AD53_fi4"  class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD53_fi'])){  if($arrck4['AD53_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD53_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_be5"  id="AD53_be5"  class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD53_be'])){  if($arrck5['AD53_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD53_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_fi5"  id="AD53_fi5"  class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD53_fi'])){  if($arrck5['AD53_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD53_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_be6"  id="AD53_be6"  class="T6"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AD53_be'])){  if($arrck6['AD53_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD53_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_fi6"  id="AD53_fi6"   class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD53_fi'])){ if($arrck6['AD53_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD53_fi']); }}  ?>">
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="AD53_tot"  class="TOT"  id="AD53_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD53_tot"])){ echo $AR["AD53_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD53_note"  class="NOT"  id="AD53_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD53_note"])){ echo $AR["AD53_note"]; } ?>">
   </div></td>
   </tr>
   <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >รออุณหภูมิ AG</td>
   <td valign="middle"  >AD13</td>
    <td><div  class="incell"><input data-role="none" name="AD13_be1" id="AD13_be1"   class="T1"  type="time" style="width:100%"  
    value="<?php  if(isset($arrck1['AD13_be'])){  if($arrck1['AD13_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD13_be']); } } ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD13_fi1" id="AD13_fi1"   class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD13_fi'])){  if($arrck1['AD13_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD13_fi']); }} ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_be2" id="AD13_be2"   class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AD13_be'])){   if($arrck2['AD13_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD13_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_fi2"  id="AD13_fi2"   class="T2"   type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AD13_fi'])){   if($arrck2['AD13_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD13_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_be3"  id="AD13_be3"   class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD13_be'])){  if($arrck3['AD13_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD13_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_fi3"  id="AD13_fi3"    class="T3"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD13_fi'])){  if($arrck3['AD13_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD13_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_be4"  id="AD13_be4"   class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AD13_be'])){   if($arrck4['AD13_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD13_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_fi4"  id="AD13_fi4"   class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD13_fi'])){  if($arrck4['AD13_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD13_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_be5"  id="AD13_be5"   class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD13_be'])){  if($arrck5['AD13_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD13_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_fi5"  id="AD13_fi5"    class="T5"  type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AD13_fi'])){   if($arrck5['AD13_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD13_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_be6"  id="AD13_be6"    class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD13_be'])){  if($arrck6['AD13_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD13_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_fi6"  id="AD13_fi6"  class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD13_fi'])){ if($arrck6['AD13_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD13_fi']); }}  ?>">
   </div></td>
   <td>
   
   <div  class="incell"><input data-role="none" name="AD13_tot"  class="TOT"  id="AD13_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD13_tot"])){ echo $AR["AD13_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD13_note"  class="NOT" id="AD13_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD13_note"])){ echo $AR["AD13_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ล้าง M/C จากการเปลี่ยนสูตร</td>
   <td valign="middle"  >AD61</td>
   <td><div  class="incell"><input data-role="none" name="AD61_be1" id="AD61_be1"  class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD61_be'])){ if($arrck1['AD61_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD61_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD61_fi1" id="AD61_fi1"  class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AD61_fi'])){ if($arrck1['AD61_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD61_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_be2" id="AD61_be2"  class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD61_be'])){ if($arrck2['AD61_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD61_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_fi2"  id="AD61_fi2"  class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD61_fi'])){ if($arrck2['AD61_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD61_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_be3"  id="AD61_be3"  class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD61_be'])){ if($arrck3['AD61_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD61_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_fi3"  id="AD61_fi3"  class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD61_fi'])){ if($arrck3['AD61_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD61_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_be4"  id="AD61_be4"  class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD61_be'])){ if($arrck4['AD61_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD61_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_fi4"  id="AD61_fi4"   class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD61_fi'])){ if($arrck4['AD61_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD61_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_be5"  id="AD61_be5"  class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD61_be'])){ if($arrck5['AD61_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD61_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_fi5"  id="AD61_fi5"  class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD61_fi'])){ if($arrck5['AD61_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD61_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_be6"  id="AD61_be6"   class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AD61_be'])){ if($arrck6['AD61_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD61_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_fi6"  id="AD61_fi6"   class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD61_fi'])){ if($arrck6['AD61_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD61_fi']); }}  ?>">
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="AD61_tot"  class="TOT"  id="AD61_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["AD61_tot"])){ echo $AR["AD61_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD61_note"  class="NOT" id="AD61_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD61_note"])){ echo $AR["AD61_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ประชุม</td>
   <td valign="middle"  >AD10</td>
    <td><div  class="incell"><input data-role="none" name="AD10_be1" id="AD10_be1"   class="T1"   type="time" style="width:100%"  
    value="<?php if(isset($arrck1['AD10_be'])){  if($arrck1['AD10_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD10_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD10_fi1" id="AD10_fi1"   class="T1"   type="time" style="width:100%"  
   value="<?php if(isset($arrck1['AD10_fi'])){   if($arrck1['AD10_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD10_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_be2" id="AD10_be2"    class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AD10_be'])){   if($arrck2['AD10_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD10_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_fi2"  id="AD10_fi2"    class="T2"   type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AD10_fi'])){   if($arrck2['AD10_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD10_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_be3"  id="AD10_be3"   class="T3"    type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AD10_be'])){   if($arrck3['AD10_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD10_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_fi3"  id="AD10_fi3"   class="T3"    type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AD10_fi'])){   if($arrck3['AD10_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD10_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_be4"  id="AD10_be4"   class="T4"    type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AD10_be'])){   if($arrck4['AD10_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD10_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_fi4"  id="AD10_fi4"   class="T4"    type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AD10_fi'])){   if($arrck4['AD10_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AD10_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_be5"  id="AD10_be5"    class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AD10_be'])){   if($arrck5['AD10_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD10_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_fi5"  id="AD10_fi5"    class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AD10_fi'])){   if($arrck5['AD10_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck5['AD10_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_be6"  id="AD10_be6"   class="T6"    type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD10_be'])){   if($arrck6['AD10_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD10_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_fi6"  id="AD10_fi6"   class="T6"    type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD10_fi'])){   if($arrck6['AD10_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck6['AD10_fi']); }}  ?>">
   </div></td>
   <td>
    
    <div  class="incell"><input data-role="none" name="AD10_tot"  class="TOT"  id="AD10_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AD10_tot"])){ echo $AR["AD10_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD10_note"  class="NOT" id="AD10_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD10_note"])){ echo $AR["AD10_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >รอชาร์ทน้ำ</td>
   <td valign="middle"  >AD97</td>
    <td><div  class="incell"><input data-role="none" name="AD97_be1" id="AD97_be1"   class="T1"  type="time" style="width:100%"  
    value="<?php if(isset($arrck1['AD97_be'])){ if($arrck1['AD97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD97_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AD97_fi1" id="AD97_fi1"   class="T1"  type="time" style="width:100%"  
   value="<?php if(isset($arrck1['AD97_fi'])){   if($arrck1['AD97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['AD97_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_be2" id="AD97_be2"   class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AD97_be'])){   if($arrck2['AD97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD97_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_fi2"  id="AD97_fi2"   class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AD97_fi'])){  if($arrck2['AD97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck2['AD97_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_be3"  id="AD97_be3"   class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD97_be'])){  if($arrck3['AD97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck3['AD97_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_fi3"  id="AD97_fi3"   class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AD97_fi'])){  if($arrck3['AD97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AD97_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_be4"  id="AD97_be4"   class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AD97_be'])){   if($arrck4['AD97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AD97_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_fi4"  id="AD97_fi4"    class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AD97_fi'])){  if($arrck4['AD97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AD97_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_be5"  id="AD97_be5"   class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AD97_be'])){  if($arrck5['AD97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AD97_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_fi5"  id="AD97_fi5"    class="T5"  type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AD97_fi'])){   if($arrck5['AD97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AD97_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_be6"  id="AD97_be6"   class="T6"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AD97_be'])){  if($arrck6['AD97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AD97_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_fi6"  id="AD97_fi6"   class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AD97_fi'])){   if($arrck6['AD97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AD97_fi']); }}  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AD97_tot"  class="TOT"  id="AD97_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AD97_tot"])){ echo $AR["AD97_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AD97_note"  class="NOT" id="AD97_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AD97_note"])){ echo $AR["AD97_note"]; } ?>">
   </div></td>
   </tr>
 <tr   style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   
   <td valign="middle"  >ปั้มเสีย/รั่ว</td>
   <td valign="middle"  >BMEX</td>
    <td><div  class="incell"><input data-role="none" name="BMEX_be1" id="BMEX_be1" class="T1" type="time" style="width:100%"  
    value="<?php if(isset($arrck1['BMEX_be'])){  if($arrck1['BMEX_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck1['BMEX_be']); } } ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="BMEX_fi1" id="BMEX_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php if(isset($arrck1['BMEX_fi'])){    if($arrck1['BMEX_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['BMEX_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_be2" id="BMEX_be2" class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['BMEX_be'])){    if($arrck2['BMEX_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['BMEX_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_fi2"  id="BMEX_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['BMEX_fi'])){   if($arrck2['BMEX_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['BMEX_fi']); }} ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_be3"  id="BMEX_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['BMEX_be'])){   if($arrck3['BMEX_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['BMEX_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_fi3"  id="BMEX_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php if(isset($arrck3['BMEX_fi'])){    if($arrck3['BMEX_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['BMEX_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_be4"  id="BMEX_be4" class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['BMEX_be'])){    if($arrck4['BMEX_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['BMEX_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_fi4"  id="BMEX_fi4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['BMEX_fi'])){   if($arrck4['BMEX_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['BMEX_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_be5"  id="BMEX_be5" class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['BMEX_be'])){   if($arrck5['BMEX_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['BMEX_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_fi5"  id="BMEX_fi5"  class="T5"  type="time" style="width:100%"  
   value="<?php if(isset($arrck5['BMEX_fi'])){    if($arrck5['BMEX_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['BMEX_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_be6"  id="BMEX_be6"  class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['BMEX_be'])){  if($arrck6['BMEX_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['BMEX_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_fi6"  id="BMEX_fi6"  class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['BMEX_fi'])){  if($arrck6['BMEX_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  $arrck6['BMEX_fi']; }}  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="BMEX_tot"  class="TOT"  id="BMEX_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["BMEX_tot"])){ echo $AR["BMEX_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEX_note"  class="NOT" id="BMEX_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["BMEX_note"])){ echo $AR["BMEX_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >รอผลวิเคราะห์ตัวอย่าง</td>
   <td valign="middle"  >AQ92</td>
     <td><div  class="incell"><input data-role="none" name="AQ92_be1" id="AQ92_be1"  class="T1"   type="time" style="width:100%"  
     value="<?php if(isset($arrck1['AQ92_be'])){  if($arrck1['AQ92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AQ92_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AQ92_fi1" id="AQ92_fi1"  class="T1"   type="time" style="width:100%"  
   value="<?php if(isset($arrck1['AQ92_fi'])){    if($arrck1['AQ92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AQ92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_be2" id="AQ92_be2"  class="T2"   type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AQ92_be'])){    if($arrck2['AQ92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AQ92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_fi2"  id="AQ92_fi2"  class="T2"    type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AQ92_fi'])){    if($arrck2['AQ92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AQ92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_be3"  id="AQ92_be3"  class="T3"    type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AQ92_be'])){    if($arrck3['AQ92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AQ92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_fi3"  id="AQ92_fi3"  class="T3"    type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AQ92_fi'])){    if($arrck3['AQ92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AQ92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_be4"  id="AQ92_be4"  class="T4"    type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AQ92_be'])){    if($arrck4['AQ92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AQ92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_fi4"  id="AQ92_fi4"   class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AQ92_fi'])){    if($arrck4['AQ92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo  tim($arrck4['AQ92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_be5"  id="AQ92_be5"   class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AQ92_be'])){    if($arrck5['AQ92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AQ92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_fi5"  id="AQ92_fi5"   class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AQ92_fi'])){    if($arrck5['AQ92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AQ92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_be6"  id="AQ92_be6"  class="T6"    type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AQ92_be'])){    if($arrck6['AQ92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AQ92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_fi6"  id="AQ92_fi6"   class="T6"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AQ92_fi'])){   if($arrck6['AQ92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AQ92_fi']); }}  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AQ92_tot"  class="TOT"  id="AQ92_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AQ92_tot"])){ echo $AR["AQ92_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ92_note" class="NOT" id="AQ92_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AQ92_note"])){ echo $AR["AQ92_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >รอ QA Swab Test</td>
   <td valign="middle"  >AQ94</td>
    <td><div  class="incell"><input data-role="none" name="AQ94_be1" id="AQ94_be1"   class="T1"  type="time" style="width:100%"  
    value="<?php if(isset($arrck1['AQ94_be'])){  if($arrck1['AQ94_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AQ94_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AQ94_fi1" id="AQ94_fi1"   class="T1"  type="time" style="width:100%"  
   value="<?php if(isset($arrck1['AQ94_fi'])){   if($arrck1['AQ94_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AQ94_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_be2" id="AQ94_be2"   class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AQ94_be'])){   if($arrck2['AQ94_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AQ94_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_fi2"  id="AQ94_fi2"   class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AQ94_fi'])){  if($arrck2['AQ94_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AQ94_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_be3"  id="AQ94_be3"   class="T3"   type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AQ94_be'])){   if($arrck3['AQ94_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AQ94_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_fi3"  id="AQ94_fi3"    class="T3"  type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AQ94_fi'])){   if($arrck3['AQ94_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AQ94_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_be4"  id="AQ94_be4"   class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AQ94_be'])){   if($arrck4['AQ94_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AQ94_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_fi4"  id="AQ94_fi4"    class="T4"  type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AQ94_fi'])){   if($arrck4['AQ94_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AQ94_fi']); }} ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_be5"  id="AQ94_be5"    class="T5"  type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AQ94_be'])){   if($arrck5['AQ94_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AQ94_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_fi5"  id="AQ94_fi5"   class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AQ94_fi'])){   if($arrck5['AQ94_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AQ94_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_be6"  id="AQ94_be6"    class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AQ94_be'])){   if($arrck6['AQ94_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AQ94_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_fi6"  id="AQ94_fi6"    class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AQ94_fi'])){  if($arrck6['AQ94_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AQ94_fi']); }}  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AQ94_tot"  class="TOT"  id="AQ94_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AQ94_tot"])){ echo $AR["AQ94_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AQ94_note" class="NOT" id="AQ94_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AQ94_note"])){ echo $AR["AQ94_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >รอ RM จาก Supplier</td>
   <td valign="middle"  >AL92</td>
    <td><div  class="incell"><input data-role="none" name="AL92_be1" id="AL92_be1"    class="T1"  type="time" style="width:100%"  
    value="<?php if(isset($arrck1['AL92_be'])){  if($arrck1['AL92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AL92_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AL92_fi1" id="AL92_fi1"    class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AL92_fi'])){  if($arrck1['AL92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AL92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_be2" id="AL92_be2"    class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AL92_be'])){  if($arrck2['AL92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AL92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_fi2"  id="AL92_fi2"     class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AL92_fi'])){  if($arrck2['AL92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AL92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_be3"  id="AL92_be3"    class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AL92_be'])){  if($arrck3['AL92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AL92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_fi3"  id="AL92_fi3"    class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AL92_fi'])){  if($arrck3['AL92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AL92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_be4"  id="AL92_be4"    class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AL92_be'])){  if($arrck4['AL92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AL92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_fi4"  id="AL92_fi4"     class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AL92_fi'])){  if($arrck4['AL92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AL92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_be5"  id="AL92_be5"    class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AL92_be'])){   if($arrck5['AL92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AL92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_fi5"  id="AL92_fi5"     class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AL92_fi'])){  if($arrck5['AL92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AL92_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_be6"  id="AL92_be6"     class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AL92_be'])){  if($arrck6['AL92_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AL92_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_fi6"  id="AL92_fi6"     class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AL92_fi'])){   if($arrck6['AL92_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AL92_fi']); }}  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AL92_tot"  class="TOT" id="AL92_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AL92_tot"])){ echo $AR["AL92_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL92_note"  class="NOT" id="AL92_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AL92_note"])){ echo $AR["AL92_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ระบบไฟฟ้าขัดข้อง</td>
   <td valign="middle"  >AU98</td>
   <td><div  class="incell"><input data-role="none" name="AU98_be1" id="AU98_be1"    class="T1"  type="time" style="width:100%"  
   value="<?php if(isset($arrck1['AU98_be'])){  if($arrck1['AU98_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AU98_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AU98_fi1" id="AU98_fi1"     class="T1" type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AU98_fi'])){   if($arrck1['AU98_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AU98_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_be2" id="AU98_be2"    class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AU98_be'])){   if($arrck2['AU98_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AU98_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_fi2"  id="AU98_fi2"    class="T2"   type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AU98_fi'])){    if($arrck2['AU98_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AU98_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_be3"  id="AU98_be3"    class="T3"   type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AU98_be'])){    if($arrck3['AU98_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AU98_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_fi3"  id="AU98_fi3"    class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AU98_fi'])){   if($arrck3['AU98_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AU98_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_be4"  id="AU98_be4"     class="T4"  type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AU98_be'])){    if($arrck4['AU98_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AU98_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_fi4"  id="AU98_fi4"     class="T4"  type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AU98_fi'])){    if($arrck4['AU98_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AU98_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_be5"  id="AU98_be5"    class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AU98_be'])){    if($arrck5['AU98_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AU98_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_fi5"  id="AU98_fi5"     class="T5"  type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AU98_fi'])){    if($arrck5['AU98_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AU98_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_be6"  id="AU98_be6"     class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AU98_be'])){    if($arrck6['AU98_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AU98_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_fi6"  id="AU98_fi6"    class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AU98_fi'])){    if($arrck6['AU98_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AU98_fi']); }}  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AU98_tot"  class="TOT"  id="AU98_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AU98_tot"])){ echo $AR["AU98_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU98_note"  class="NOT" id="AU98_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AU98_note"])){ echo $AR["AU98_note"]; } ?>">
   </div></td>
   </tr>
 <tr style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >ระบบลม/STEAM</td>
   <td valign="middle"  >AU99</td>
  <td><div  class="incell"><input data-role="none" name="AU99_be1" id="AU99_be1"    class="T1"  type="time" style="width:100%"  
  value="<?php  if(isset($arrck1['AU99_be'])){   if($arrck1['AU99_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AU99_be']); } } ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AU99_fi1" id="AU99_fi1"    class="T1"  type="time" style="width:100%"  
   value="<?php   if(isset($arrck1['AU99_fi'])){  if($arrck1['AU99_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AU99_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_be2" id="AU99_be2"    class="T2"  type="time" style="width:100%"  
   value="<?php   if(isset($arrck2['AU99_be'])){  if($arrck2['AU99_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AU99_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_fi2"  id="AU99_fi2"    class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AU99_fi'])){  if($arrck2['AU99_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AU99_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_be3"  id="AU99_be3"    class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AU99_be'])){   if($arrck3['AU99_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AU99_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_fi3"  id="AU99_fi3"    class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AU99_fi'])){   if($arrck3['AU99_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AU99_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_be4"  id="AU99_be4"    class="T4"   type="time" style="width:100%"  
   value="<?php   if(isset($arrck4['AU99_be'])){   if($arrck4['AU99_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AU99_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_fi4"  id="AU99_fi4"    class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AU99_fi'])){  if($arrck4['AU99_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AU99_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_be5"  id="AU99_be5"    class="T5"   type="time" style="width:100%" 
    value="<?php  if(isset($arrck5['AU99_be'])){   if($arrck5['AU99_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AU99_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_fi5"  id="AU99_fi5"    class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AU99_fi'])){   if($arrck5['AU99_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AU99_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_be6"  id="AU99_be6"    class="T6"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['AU99_be'])){   if($arrck6['AU99_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AU99_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_fi6"  id="AU99_fi6"     class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AU99_fi'])){  if($arrck6['AU99_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AU99_fi']); } }  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AU99_tot"  class="TOT"  id="AU99_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AU99_tot"])){ echo $AR["AU99_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU99_note"  class="NOT" id="AU99_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AU99_note"])){ echo $AR["AU99_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
   <td valign="middle"  >รอน้ำ(Cool,Hot,Pure,Chilled)</td>
   <td valign="middle"  >AU97</td>
   <td><div  class="incell"><input data-role="none" name="AU97_be1" id="AU97_be1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AU97_be'])){  if($arrck1['AU97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AU97_be']); }}   ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AU97_fi1" id="AU97_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['AU97_fi'])){  if($arrck1['AU97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AU97_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_be2" id="AU97_be2" class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AU97_be'])){  if($arrck2['AU97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AU97_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_fi2"  id="AU97_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['AU97_fi'])){  if($arrck2['AU97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AU97_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_be3"  id="AU97_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AU97_be'])){  if($arrck3['AU97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AU97_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_fi3"  id="AU97_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['AU97_fi'])){  if($arrck3['AU97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AU97_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_be4"  id="AU97_be4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AU97_be'])){  if($arrck4['AU97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AU97_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_fi4"  id="AU97_fi4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['AU97_fi'])){  if($arrck4['AU97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AU97_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_be5"  id="AU97_be5" class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AU97_be'])){  if($arrck5['AU97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AU97_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_fi5"  id="AU97_fi5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['AU97_fi'])){  if($arrck5['AU97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AU97_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_be6"  id="AU97_be6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AU97_be'])){  if($arrck6['AU97_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AU97_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_fi6"  id="AU97_fi6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AU97_fi'])){ if($arrck6['AU97_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AU97_fi']); }}   ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AU97_tot"  class="TOT"  id="AU97_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AU97_tot"])){ echo $AR["AU97_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AU97_note" class="NOT" id="AU97_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AU97_note"])){ echo $AR["AU97_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
   <td valign="middle"  >รอ IR</td>
   <td valign="middle"  >AL93</td>
   <td><div  class="incell"><input data-role="none" name="AL93_be1" id="AL93_be1" class="T1"  type="time" style="width:100%"  
   value="<?php if(isset($arrck1['AL93_be'])){ if($arrck1['AL93_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AL93_be']); }}  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="AL93_fi1" id="AL93_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php if(isset($arrck1['AL93_fi'])){   if($arrck1['AL93_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['AL93_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_be2" id="AL93_be2" class="T2"  type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AL93_be'])){   if($arrck2['AL93_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AL93_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_fi2"  id="AL93_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php if(isset($arrck2['AL93_fi'])){   if($arrck2['AL93_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['AL93_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_be3"  id="AL93_be3" class="T3"   type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AL93_be'])){   if($arrck3['AL93_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AL93_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_fi3"  id="AL93_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php if(isset($arrck3['AL93_fi'])){   if($arrck3['AL93_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['AL93_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_be4"  id="AL93_be4" class="T4"   type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AL93_be'])){   if($arrck4['AL93_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AL93_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_fi4"  id="AL93_fi4"  class="T4"  type="time" style="width:100%"  
   value="<?php if(isset($arrck4['AL93_fi'])){   if($arrck4['AL93_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['AL93_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_be5"  id="AL93_be5" class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AL93_be'])){   if($arrck5['AL93_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AL93_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_fi5"  id="AL93_fi5" class="T5"   type="time" style="width:100%"  
   value="<?php if(isset($arrck5['AL93_fi'])){   if($arrck5['AL93_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['AL93_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_be6"  id="AL93_be6" class="T6"   type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AL93_be'])){   if($arrck6['AL93_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AL93_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_fi6"  id="AL93_fi6"  class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['AL93_fi'])){   if($arrck6['AL93_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['AL93_fi']); }}  ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="AL93_tot"  class="TOT"  id="AL93_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["AL93_tot"])){ echo $AR["AL93_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="AL93_note"  class="NOT" id="AL93_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["AL93_note"])){ echo $AR["AL93_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
   <td valign="middle"  >ระบบ UV ขัดข้อง</td>
   <td valign="middle"  >BMED</td>
   <td><div  class="incell"><input data-role="none" name="BMED_be1" id="BMED_be1"  class="T1" type="time" style="width:100%"  
   value="<?php if(isset($arrck1['BMED_be'])){ if($arrck1['BMED_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['BMED_be']); } }  ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="BMED_fi1" id="BMED_fi1"  class="T1" type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['BMED_fi'])){  if($arrck1['BMED_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['BMED_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_be2" id="BMED_be2"  class="T2" type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['BMED_be'])){  if($arrck2['BMED_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['BMED_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_fi2"  id="BMED_fi2"  class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['BMED_fi'])){  if($arrck2['BMED_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['BMED_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_be3"  id="BMED_be3"  class="T3" type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['BMED_be'])){  if($arrck3['BMED_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['BMED_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_fi3"  id="BMED_fi3"  class="T3"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['BMED_fi'])){  if($arrck3['BMED_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['BMED_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_be4"  id="BMED_be4"  class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['BMED_be'])){  if($arrck4['BMED_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['BMED_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_fi4"  id="BMED_fi4"  class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['BMED_fi'])){  if($arrck4['BMED_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['BMED_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_be5"  id="BMED_be5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['BMED_be'])){  if($arrck5['BMED_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['BMED_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_fi5"  id="BMED_fi5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['BMED_fi'])){  if($arrck5['BMED_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['BMED_fi']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_be6"  id="BMED_be6"  class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['BMED_be'])){  if($arrck6['BMED_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['BMED_be']); }}   ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_fi6"  id="BMED_fi6"  class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['BMED_fi'])){  if($arrck6['BMED_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['BMED_fi']); }}   ?>">
   </div></td>
   <td> 
    <div  class="incell"><input data-role="none" name="BMED_tot"  class="TOT" id="BMED_tot"  type="text" style="width:100%"  
    value="<?php if(isset($AR["BMED_tot"])){ echo $AR["BMED_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMED_note" class="NOT" id="BMED_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["BMED_note"])){ echo $AR["BMED_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
   <td valign="middle"  >Load Cell/เครื่องชั่งชำรุด</td>
   <td valign="middle"  >BMEY</td>
   <td><div  class="incell"><input data-role="none" name="BMEY_be1" id="BMEY_be1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['BMEY_be'])){  if($arrck1['BMEY_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['BMEY_be']); } } ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="BMEY_fi1" id="BMEY_fi1" class="T1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['BMEY_fi'])){  if($arrck1['BMEY_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['BMEY_fi']); }} ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_be2" id="BMEY_be2" class="T2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['BMEY_be'])){  if($arrck2['BMEY_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['BMEY_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_fi2"  id="BMEY_fi2" class="T2"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['BMEY_fi'])){  if($arrck2['BMEY_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['BMEY_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_be3"  id="BMEY_be3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['BMEY_be'])){  if($arrck3['BMEY_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['BMEY_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_fi3"  id="BMEY_fi3" class="T3"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['BMEY_fi'])){  if($arrck3['BMEY_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['BMEY_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_be4"  id="BMEY_be4"  class="T4"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['BMEY_be'])){  if($arrck4['BMEY_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['BMEY_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_fi4"  id="BMEY_fi4" class="T4"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['BMEY_fi'])){  if($arrck4['BMEY_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['BMEY_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_be5"  id="BMEY_be5" class="T5"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['BMEY_be'])){  if($arrck5['BMEY_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['BMEY_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_fi5"  id="BMEY_fi5"  class="T5"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['BMEY_fi'])){  if($arrck5['BMEY_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['BMEY_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_be6"  id="BMEY_be6"  class="T6"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['BMEY_be'])){  if($arrck6['BMEY_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['BMEY_be']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_fi6"  id="BMEY_fi6"  class="T6"  type="time" style="width:100%"  
   value="<?php if(isset($arrck6['BMEY_fi'])){ if($arrck6['BMEY_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['BMEY_fi']); }}  ?>">
   </div></td>
   <td>
    
   <div  class="incell"><input data-role="none" name="BMEY_tot"  class="TOT" id="BMEY_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["BMEY_tot"])){ echo $AR["BMEY_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="BMEY_note"  class="NOT" id="BMEY_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["BMEY_note"])){ echo $AR["BMEY_note"]; } ?>">
   </div></td>
   </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
   <td valign="middle"  >
   <div style="text-align:left;"> 
			   <select name="DW1" style="width:100%;" id="DW1" data-role="none" class="DW"  >
               <option value="" <?php if($arrinfo['DW1_code']==""){ echo 'selected="selected"'; } ?>>-</option>
			   <option value="MX001"  <?php if($arrinfo['DW1_code']=="MX001"){ echo 'selected="selected"'; } ?>>Stock full ประเมินไม่ผลิตต่อ</option>
			   <option value="MX002"  <?php if($arrinfo['DW1_code']=="MX002"){ echo 'selected="selected"'; } ?>>รอปั้มถ่ายเก็บ semi</option>
               <option value="MX003"  <?php if($arrinfo['DW1_code']=="MX003"){ echo 'selected="selected"'; } ?>>รอปั้ม IR</option>
               <option value="MX004"  <?php if($arrinfo['DW1_code']=="MX004"){ echo 'selected="selected"'; } ?>>Confirm semi</option>
               <option value="MX100"  <?php if($arrinfo['DW1_code']=="MX100"){ echo 'selected="selected"'; } ?>>อื่นๆ</option>
			   </select>
     </div>
   </td>
   <td valign="middle"  ><div id="inDW1"><?php if(isset($arrinfo['DW1_code'])){ echo $arrinfo['DW1_code']; } ?></div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_be1" id="DW1_be1" class="T1 DW1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['DW1_be'])){  if($arrck1['DW1_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['DW1_be']); } } ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="DW1_fi1" id="DW1_fi1" class="T1 DW1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['DW1_fi'])){  if($arrck1['DW1_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['DW1_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_be2" id="DW1_be2" class="T2 DW1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['DW1_be'])){  if($arrck2['DW1_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['DW1_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_fi2"  id="DW1_fi2" class="T2 DW1"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['DW1_fi'])){  if($arrck2['DW1_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['DW1_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_be3" id="DW1_be3" class="T3 DW1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['DW1_be'])){  if($arrck3['DW1_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['DW1_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_fi3"  id="DW1_fi3" class="T3 DW1"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['DW1_fi'])){  if($arrck3['DW1_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['DW1_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_be4" id="DW1_be4" class="T4 DW1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['DW1_be'])){  if($arrck4['DW1_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['DW1_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_fi4"  id="DW1_fi4" class="T4 DW1"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['DW1_fi'])){  if($arrck4['DW1_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['DW1_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_be5" id="DW1_be5" class="T5 DW1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['DW1_be'])){  if($arrck5['DW1_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['DW1_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_fi5"  id="DW1_fi5" class="T5 DW1"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['DW1_fi'])){  if($arrck5['DW1_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['DW1_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_be6" id="DW1_be6" class="T6 DW1"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['DW1_be'])){  if($arrck6['DW1_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['DW1_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_fi6"  id="DW1_fi6" class="T6 DW1"   type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['DW1_fi'])){  if($arrck6['DW1_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['DW1_fi']); }}  ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_tot"  class="TOT" id="DW1_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["DW1_tot"])){ echo $AR["DW1_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW1_note"  class="NOT" id="DW1_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["DW1_note"])){ echo $AR["DW1_note"]; } ?>">
   </div></td>
 </tr>
 <tr  style="background:#FFF;" onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
   <td valign="middle"  >
    <div style="text-align:left;">  
			      <select name="DW2" style="width:100%;" id="DW2" data-role="none" class="DW"  >
               <option value="" <?php if($arrinfo['DW2_code']==""){ echo 'selected="selected"'; } ?>>-</option>
			   <option value="MX001"  <?php if($arrinfo['DW2_code']=="MX001"){ echo 'selected="selected"'; } ?>>Stock full ประเมินไม่ผลิตต่อ</option>
			   <option value="MX002"  <?php if($arrinfo['DW2_code']=="MX002"){ echo 'selected="selected"'; } ?>>รอปั้มถ่ายเก็บ semi</option>
               <option value="MX003"  <?php if($arrinfo['DW2_code']=="MX003"){ echo 'selected="selected"'; } ?>>รอปั้ม IR</option>
               <option value="MX004"  <?php if($arrinfo['DW2_code']=="MX004"){ echo 'selected="selected"'; } ?>>Confirm semi</option>
               <option value="MX100"  <?php if($arrinfo['DW2_code']=="MX100"){ echo 'selected="selected"'; } ?>>อื่นๆ</option>
			   </select>
     </div>
   </td>
   <td valign="middle"  ><div id="inDW2"><?php if(isset($arrinfo['DW2_code'])){ echo $arrinfo['DW2_code']; } ?></div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_be1" id="DW2_be1" class="T1 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['DW2_be'])){  if($arrck1['DW2_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['DW2_be']); } } ?>">
   </div></td>
   <td ><div  class="incell"><input data-role="none" name="DW2_fi1" id="DW2_fi1" class="T1 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck1['DW2_fi'])){  if($arrck1['DW2_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck1['DW2_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_be2" id="DW2_be2" class="T2 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['DW2_be'])){  if($arrck2['DW2_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['DW2_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_fi2" id="DW2_fi2" class="T2 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck2['DW2_fi'])){  if($arrck2['DW2_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck2['DW2_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_be3" id="DW2_be3" class="T3 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['DW2_be'])){  if($arrck3['DW2_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['DW2_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_fi3" id="DW2_fi3" class="T3 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck3['DW2_fi'])){  if($arrck3['DW2_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck3['DW2_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_be4" id="DW2_be4" class="T4 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['DW2_be'])){  if($arrck4['DW2_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['DW2_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_fi4" id="DW2_fi4" class="T4 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck4['DW2_fi'])){  if($arrck4['DW2_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck4['DW2_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_be5" id="DW2_be5" class="T5 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['DW2_be'])){  if($arrck5['DW2_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['DW2_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_fi5" id="DW2_fi5" class="T5 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck5['DW2_fi'])){  if($arrck5['DW2_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck5['DW2_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_be6" id="DW2_be6" class="T6 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['DW2_be'])){  if($arrck6['DW2_be']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['DW2_be']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_fi6" id="DW2_fi6" class="T6 DW2"  type="time" style="width:100%"  
   value="<?php  if(isset($arrck6['DW2_fi'])){  if($arrck6['DW2_fi']=='0000-00-00 00:00:00'){ echo ''; }else{ echo   tim($arrck6['DW2_fi']); } } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_tot"  class="TOT" id="DW2_tot"  type="text" style="width:100%"  
   value="<?php if(isset($AR["DW2_tot"])){ echo $AR["DW2_tot"]; } ?>">
   </div></td>
   <td><div  class="incell"><input data-role="none" name="DW2_note"  class="NOT" id="DW2_note"    type="text" style="width:100%;"  
   value="<?php if(isset($AR["DW2_note"])){ echo $AR["DW2_note"]; } ?>">
   </div></td>
 </tr>
  </table>



 <div style="height:50px;">
    &nbsp;
 </div>
    <!-- pouup -->
          <?php  include('components/page/subpast/popup_start_oee.php'); ?>
        <!-- endpoupu --> 
 <!-- Popup Edit bt -->
 <?php  include('components/page/subpast/popup_edit_oee.php'); ?>
 <!-- End popup Edit bt -->
 