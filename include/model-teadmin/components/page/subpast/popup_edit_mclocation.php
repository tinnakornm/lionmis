<!-- popup popup_edit_mclocation by Tinnakorn.M 09/07/2016 -->
 <?php session_start(); ?>
<script type="text/javascript" src="../../../../../include/lib/jquery1.10.2.min.js"></script>
	<script src="../../../../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="../../../../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" >
<div data-role="page" id="popupEditSpareParts" data-dialog="true" data-url="" data-external-page="true" tabindex="0" class="ui-page ui-page-theme-a ui-page-active" style="margin-bottom:20px">
<style>
.ui-dialog-contain{
	margin: 2% auto 1em;
}
</style>

  <script type="text/javascript" src="../../../js/mclocation_setting.js"></script>  
<?php 
   require('../../../../../include/config.inc.php'); 
   mysql_select_db($db,$connect); 
   
    if(isset($_GET['id'])){ $item_id = $_GET['id']; }else{ echo 'Error, no id '; exit; }
	if(isset($_GET['dev_root'])){ $dev_root = $_GET['dev_root']; }else{ echo 'Error, dev_root '; exit; }
	
 	$q = mysql_query("SELECT * FROM  `tpm_item` WHERE  `item_id` =$item_id AND  `plant` =".$_SESSION["plant"]." AND `item_type` LIKE  'mc_location'  LIMIT 0 , 30");
	 
	 if(mysql_num_rows($q)){
		 
		 $arritem = mysql_fetch_array($q);
		 
	 }else{
		 
		 echo 'Error, no record found'; 
		 exit;
		 
	 }
	 
   if($arritem['img_id']>0) {
	 	//select img
	  $q2 = mysql_query("SELECT img_filepart, img_filename  FROM  `tpm_img` WHERE  `img_id` =".$arritem['img_id']." LIMIT 0 , 1");
		  if(mysql_num_rows($q2)){
			  $arrimg = mysql_fetch_array($q2);
			  $img_filepart = $arrimg['img_filepart'];
			  $img_filename = $arrimg['img_filename'];
		  }
		  
   }else{
		  $img_filepart = '';
		  $img_filename = 'no-img.png';
   }

?>

 

  <div data-role="header" data-theme="b" style="min-width:450px; max-width:650px; margin:25px auto lem;">
    <h2>แก้ไขข้อมูลเครื่องจักร</h2>
  </div>
  <div>
            <form action="http://lionproduction.sli/pdmis/include/model-teadmin/components/query/update_mclocation.php" method="post" enctype="multipart/form-data" data-ajax="false" class="NewMCGroup" >
              <input name="dev_v1" type="hidden" value="<?php echo $arritem['dev_v1']; ?>" />
               <table style="width:100%;  padding:15px;">
               
      <tr ><td >
      <div style="padding:10px;">
        
        <div style=" padding-right: 15px;" >
        <table style="width:100%;">
        <tr>
          <td  width="40%"><div style="text-align:right; padding-right:5px;">
            <label for="process">สร้างโดย :</label></div></td>
          <td><div > <?php echo $arritem['rec_uname'];  ?>   
             <input name="plant" type="hidden" value="<?php echo $arritem['plant']; ?>" />
              <input name="item_id" type="hidden" value="<?php echo $arritem['item_id']; ?>" />
              <input name="main_id" id="main_id" type="hidden" value="<?php echo $arritem['main_id']; ?>" />
              <input name="dev_root" id="dev_root" type="hidden" value="<?php echo $dev_root; ?>" />
          </div></td>
        </tr>
        
        
      
        
        

        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="process">วันที่ :</label> </div> </td>
        	<td><?php echo $arritem['rec_date'];  ?></td>
        </tr>
        <tr>
          <td  width="40%"><div style="text-align:right; padding-right:5px;">
            <label for="process">แก้ไขเดทโดย :</label></div></td>
          <td><div > <?php echo $arritem['edit_uname'];  ?>   
              
              
          </div></td>
        </tr>
        
        
      
        
        

        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="process">วันแก้ไข :</label> </div> </td>
        	<td><?php echo $arritem['edit_date'];  ?></td>
        </tr>
        
         <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="process"> กลุ่มเครื่องจักร :</label> </div> </td>
        	<td>
			
            <select name="smain_id" id="smain_id" style="width:100%;" data-role="none"  >
            <?php 
			
			 $qgr = mysql_query("SELECT item_id, item_name FROM  `tpm_item` WHERE  `dev_v1` LIKE  '".$arritem['dev_v1']."' AND  `item_type` LIKE  'mc_group' ORDER BY  `tpm_item`.`item_name` ASC  LIMIT 0 , 300");
			 
			 while($arrg = mysql_fetch_array($qgr)){
				
				 echo '<option value="'.$arrg['item_id'].'" ';
				if($arritem['main_id']==$arrg['item_id']){ echo 'selected'; }
				echo '>'.$arrg['item_name'].'</option>';  
 
			 }//end while 1      
			  ?>
            </select>
            
            </td>
        </tr>
        
         <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px;"> <label for="process"> กลุ่ม Spare Parts :</label> </div> </td>
        	<td>
			
            <select name="sprg_name" id="sprg_name" style="width:100%;" data-role="none"  >
              <option value=""></option>
            
            <?php 
			
			 $qgrsp = mysql_query("SELECT sprg_name 
FROM  `tpm_sprgrp` 
WHERE  `dev_v1` LIKE  '".$arritem['dev_v1']."'
ORDER BY  `tpm_sprgrp`.`sprg_name` ASC 
LIMIT 0 , 100");
			 
			 while($arrsp = mysql_fetch_array($qgrsp)){
			    echo '<option value="'.$arrsp['sprg_name'].'" ';
				if($arritem['sprg_name']==$arrsp['sprg_name']){ echo 'selected'; }
				echo '>'.$arrsp['sprg_name'].'</option>';  
 
			 }//end while 1
			   
			         
			  ?>
              
              
            </select>
            
            </td>
        </tr>
        
        
           <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px; color:#00F;"> <label for="process">  <strong>SAP ID</strong>: </label> </div> </td>
        	<td>
            <input type="text" name="sap_id" id="sap_id"  value="<?php echo $arritem['sap_id'];  ?>"  data-role="none" style="text-transform: uppercase; width:100%; color:blue;" placeholder="ไม่มีให้ว่างไว้" />
            </td>
        </tr>
        
        <tr id="line_special" ><td ><!-- batch_size --><div style="text-align:right;  padding-right:5px; "> <label for="process"> ชื่อเครื่องจักร : </label> </div> </td>
        	<td><input type="text" name="item_name" id="item_name"  value="<?php echo $arritem['item_name'];  ?>"  data-role="none" style="text-transform: uppercase; width:100%;" /></td>
        </tr>
        
     
 
        <tr>
          <td><!-- gr --><div style="text-align:right; padding-right:5px;">
          
          <img src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $img_filepart.'/'.$img_filename; ?>" width="100" border="1" />
          
          </div></td>
          <td><input name="img" id="img" type="file" />
          
          
          
          </td>
        </tr>
        
        <tr>
          <td> <!-- mixer -->   
          <div style="text-align:right; padding-right:5px;"> 
         <label for="spr_name_en"> ข้อมูล ภาษาอังกฤษ  :<span style="color:red;">*</span></label></div></td>
          <td><textarea name="descrip_en"  id="descrip_en" rows="2" style="width:100%;"  data-role="none" placeholder="EX: Caes Packer and Auto Case Packer Machine" required="required"><?php echo $arritem['descrip_en']; ?></textarea></td>
        </tr>
        <tr>
          <td><!-- formula --> <div style="text-align:right; padding-right:5px;">
          <label for="spr_name_th">ข้อมูล ภาษาไทย : </label></div></td>
          <td>  <textarea name="descrip_th"  id="descrip_th" rows="2" style="width:100%;"  data-role="none" placeholder="เช่น : เครื่องขึ้นรูปหีบ และเครื่องขึ้นรูปหีบอัตโนมัติ"><?php echo $arritem['descrip_th']; ?></textarea></td>
        </tr>
        <tr>
          <td colspan="2">
            <div style="text-align:right;">
            
            <a href="#" id="<?php echo $arritem['item_id']; ?>" class="del-item ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a ui-btn-icon-left ui-icon-delete"  style=" background-color:#F03; color:#FFF;" data-ajax="false" >ลบ</a>  
            
 
              <button type="submit" name="editmc" id="editmc" class="ui-btn ui-corner-all ui-shadow   ui-btn-icon-left ui-icon-check  ui-btn-inline" style="background:green; color:#FFF;">
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

 
