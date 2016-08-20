 
<style type="text/css">
 
#tlb td, #tlb td th {
border: 1px solid #CCC;
padding: 4px;
font-size:13px;
}

</style>

<div data-role="content" style="    padding-left: 20px;"  >
 
   <div style=" font-size:24px; padding-top:5px;">
       <strong>&raquo; กลุ่มเครื่องจักร  </strong>
       
       <div style="text-align:right; float:right;">
     <table>
     <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td> 
        <td>&nbsp;
        </td>
        <td> <a href="#popupNewMCGroup"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex;"  >เพิ่มกลุ่มหลัก</a>
        </td>
      </tr>
      </table>
 </div>


    </div>
   
  <br/>
  กลุ่มเครื่องจักรหลัก <?php echo $dev_v1; ?>
  
  
  
 <table  width="100%"  id="tlb" class="ui-body-d ui-shadow table-stripe">
 <!--
  <tr>
    <th colspan="6" style="text-align:center" scope="col">
    <div style="text-align:center; padding:5px; background-color:#D3E5F7;">
      <strong> </strong> 
      
      Filter</div>
    </th>
    </tr>
  -->  
  <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
    <th width="4%" >No.</th>
    <th width="5%">รูปภาพ</th>
    <th  width="16%" >กลุ่มหลัก &raquo; กลุ่มย่อย เครื่องจักร</th>
    <th   width="37%" >ข้อมูล</th>
     
    <th   width="14%" >เครื่องมือ</th>
    </tr>
   <?php
    $q1 = mysql_query("SELECT * FROM  `tpm_item` WHERE  `dev_v1` LIKE '$dev_v1' AND  `item_type` LIKE  'main_group' ORDER BY  `tpm_item`.`item_id` ASC   LIMIT 0 , 100");
 
	$i=1;
    if(mysql_num_rows($q1)){
		while($arrg = mysql_fetch_array($q1)){ 
			//select img
	  $q2 = mysql_query("SELECT img_filepart, img_filename  FROM  `tpm_img` WHERE  `img_id` =".$arrg['img_id']." LIMIT 0 , 1");
	  if(mysql_num_rows($q2)){
		  $arrimg = mysql_fetch_array($q2);
		  $img_filepart = $arrimg['img_filepart'];
		  $img_filename = $arrimg['img_filename'];
	  }else{
		  $img_filepart = '';
		  $img_filename = 'no-img.png';
		   }
   ?>
  <tr>
     <td ><div style="text-align:center;"><?php echo $i; ?></div></td>
    <td >
    <div style="text-align:center;">
    <a href="#<?php echo $img_filename; ?>" data-rel="popup" data-position-to="window" data-transition="fade">
     <img src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $img_filepart.'/'.$img_filename; ?>" width="100" border="1" />
     </a>
     <div data-role="popup" id="<?php echo $img_filename; ?>" data-overlay-theme="b" data-theme="b" data-corners="false">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">ปิด</a><img class="popphoto" src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $img_filepart.'/'.$img_filename; ?>" style="max-height:512px;" alt="<?php echo $img_filename; ?>">
</div>
    </div>
    </td>
    <td >
	<?php echo '<strong>'.$arrg['item_name'].'</strong>'; 
 
	    $q2 = mysql_query("SELECT * FROM  `tpm_item` WHERE  `main_id` =".$arrg['item_id']." LIMIT 0 , 30");
		while($arrm = mysql_fetch_array($q2)){
			echo '<div><a href="?f=0&mn='.$mn.'&gr='.$arrm['item_id'].'" data-ajax="false"> &raquo; '.$arrm['item_name'].'</a></div>';
		}
	
	?>
     
    </td>
    <td  >
    <div><?php echo $arrg['descrip_th']; ?> 
      (<?php echo $arrg['descrip_en']; ?>) </div></td>
    
    <td >
    <div style="text-align:center;">
    <a href="#" data-ajax="false" id="editForm" data-transition="pop" class="ui-disabled ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext " style="display: inline-flex;"  title="แก้ไขกลุ่มเครื่องจักร">Edit list</a>
    
    <a   href="#sub-<?php echo $arrg['item_id']; ?>"  data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-shadow ui-corner-all ui-icon-plus ui-btn-icon-notext " style="display: inline-flex;" title="เพิ่มกลุ่มย่อย">Add </a>
    <!-- popup area -->
    <?php //popup
	   
	    include("../../include/model-teadmin/components/page/subpast/popup_frm_new_mcsubgroup.php"); 
	
	?>
    
    
    </div>
    </td>
  </tr>
   <?php 
		$i++; }//end while
   }else{ ?>
  
  <tr>   <td colspan="6"><div style="text-align:center;"> ไม่มีรายงานที่ท่านค้นหา  </div></td> </tr>
    <?php }//end if ?>

</table>

    
    
      </div>
      
<?php include("../../include/model-teadmin/components/page/subpast/popup_frm_new_mcgroup.php"); ?>      
      
 

  
  
    
    