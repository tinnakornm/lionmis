<?php
    /******************** MIS STANDARD HEADER ***********************	
File Name        : component_machine_gr.php
    Project No   : 
    Create Date  : 05/08/2016
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            05/08/2016 : Component Template : mtmachine, By Tinnakorn.M
/****************************************************************/
?>
<style type="text/css">
#tlb td, #tlb td th {
border: 1px solid #CCC;
padding: 4px;
font-size:13px;
}
</style>
<!-- Manual Reference : https://jqueryui.com/tabs/ -->
<link rel="stylesheet" href="../../include/lib/jquery-ui/1.12.0/jquery-ui-mod180716.css">
 <script src="../../include/lib/jquery-ui/1.12.0/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "ขออภัย ยังไม่มีเนื้อหาในส่วนนี้ เรากำลังดำเนินการเพื่อเพิ่มเนื้อหาดังกล่าวโดยเร็วที่สุด <br/>" +
            "หากมีข้อเสนอแนะกรุณาติดต่อ MIS STAFF" );
        });
      }
    });
  } );
  </script>
 

<?php 
$qg = mysql_query("SELECT * FROM  `tpm_item` WHERE  `item_id` =".$gr." AND  `item_type` LIKE  'mc_group' LIMIT 0 , 1");
   if(!mysql_num_rows($qg)){
	   
	   echo 'Error, No machine group'; exit;
   }else{
	   $arrgr = mysql_fetch_array($qg);
   }

?>

<div data-role="content" style="  padding-left: 20px;" >
 
    
    <div class="title-header">
  <div style="float:left; font-size:24px; padding-top:15px;  padding-bottom:10px;"><strong> <a href="http://lionproduction.sli/pdmis/<?php echo $dev_root; ?>/teadmin/index.php?m=<?php echo $modulename; ?>&c=1" data-ajax="false"> กลุ่มเครื่องจักร </a>&raquo;  <?php echo $arrgr['item_name']; ?></strong></div>
  <div id="info"></div>
 <div style="text-align:right; float:right;">
 
 
                  <table>
                  <tr>
                   <td>&nbsp;</td>
                    <td>
                    
                    <a href="#"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="gear" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex;"  >สแปร์พาร์ท</a>
                    
                    </td> 
                     
                    
                  <td> <a href="#popupNewMCLocation"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex; background-color: rgb(51, 136, 204); color: #FFF;"  >เพิ่มเครื่องจักร</a>
 
               
                  
                  </td>
                 </tr>
                 </table>
 </div>
  </div><!-- end title-header -->
  <div style="margin-top:60px;  padding-bottom:5px;"> 
   เครื่องจักรที่มีภายได้กลุ่ม  <?php echo $arrgr['item_name']; ?> สำหรับหน่วยงาน 
  </div>
  
  <!--- tabs start -->
 <div id="tabs">
  <ul>
    <li><a href="#tabs-1">เครื่องจักร</a></li>
    <li><a href="#tabs-2">ข้อมูลพื้นฐาน</a></li>
     <li><a href="components/page/subpast/tab_machine_gr_manual.php">คู่มือ Operate</a></li>
    <li><a href="components/page/subpast/tab_machine_gr_workorder_his.php?main_id=<?php echo $gr; ?>">ประวัติการซ่อม</a></li>
    <li><a href="ajax/content3-slow.php">แผน PM</a></li>
    <li><a href="ajax/content4-broken.php">การแจ้งเตือน</a></li>
  </ul>
  <div id="tabs-1">
 <table  width="100%"  id="tlb" class="ui-body-d ui-shadow table-stripe">
 
  <thead style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
     <tr>
    <th width="4%" >No.</th>
    <th width="5%">รูปภาพ</th>
    <th  width="26%" >เครื่องจักร</th>
    <th   width="27%" >ข้อมูล</th>
     
    <th   width="14%" >เครื่องมือ</th>
    </tr>
    </thead>
   <?php
    $q1 = mysql_query("SELECT * FROM  `tpm_item` WHERE  `main_id` =".$gr." AND  `item_type` LIKE  'mc_location' LIMIT 0 , 300");
	$i=1;
    if(mysql_num_rows($q1)){
		while($arrg = mysql_fetch_array($q1)){ 
		//search img
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
   <tbody>
  <tr>
     <td ><div style="text-align:center;"><?php echo $i; ?></div></td>
    <td >
    
    <div style="text-align:center;">
    <a href="#<?php echo $arrg['sap_id']; ?>" data-rel="popup" data-position-to="window" data-transition="fade">
     <img src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $img_filepart.'/'.$img_filename; ?>" width="100" border="1" />
     </a>
     
     <div data-role="popup" id="<?php echo $arrg['sap_id']; ?>" data-overlay-theme="b" data-theme="b" data-corners="false">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">ปิด</a><img class="popphoto" src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $img_filepart.'/'.$img_filename; ?>" style="max-height:512px;" alt="<?php echo $arrsp['spr_img']; ?>">
</div>


    </div>
    

	
    </td>
    <td >
	<?php
	
	 echo '
	 <div style="color:blue;"> <strong> SAP ID : </strong> '.$arrg['sap_id'].' </div>
	 <div> <strong> ชื่อเครื่องจักร : </strong> '.$arrg['item_name'].' </div>
	 
	 <div>  <strong> กลุ่ม Spare Parts :  </strong>
	 <a href="http://lionproduction.sli/pdmis/coo/teadmin/index.php?m='.$modulename.'&c=1&gr='.$arrg['sprg_name'].'" data-ajax="false">'.$arrg['sprg_name'].'</a>
	  </div>
	 
	'; 
 
	    $q2 = mysql_query("SELECT * FROM  `tpm_item` WHERE  `main_id` =".$arrg['item_id']." LIMIT 0 , 30");
		while($arrm = mysql_fetch_array($q2)){
			echo '<div> SAP ID :  <a href="?m='.$modulename.'&gr='.$arrm['item_id'].'"> &raquo; '.$arrm['sap_id'].'</a></div>';
			echo '<div> ชื่องเครื่องจักร :  <a href="?m='.$modulename.'&gr='.$arrm['item_id'].'"> &raquo; '.$arrm['item_name'].'</a></div>';
			echo '<div> รหัสเครื่องจักร :  <a href="?m='.$modulename.'&gr='.$arrm['item_id'].'"> &raquo; '.$arrm['item_name'].'</a></div>';
			
		}
	
	?>
     
    </td>
    <td  >
    <div><?php echo $arrg['descrip_th']; ?> 
      (<?php echo $arrg['descrip_en']; ?>) </div></td>
    
    <td >
    <div style="text-align:center;">
    
     <a href="#" data-ajax="false"   data-transition="pop" class="ui-disabled ui-btn ui-shadow ui-corner-all ui-icon-gear ui-btn-icon-notext " style="display: inline-flex;">Detail</a>
    
    
    
   <a href="../../include/model-teadmin/components/page/subpast/popup_edit_mclocation.php?id=<?php echo $arrg['item_id']; ?>&dev_root=<?php echo $dev_root; ?>" data-ajax="false" id="editForm" data-transition="pop" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext " style="display: inline-flex;">Edit list</a>
    
    
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
    </tbody>

</table>
</div><!-- end tabs-1 -->
  
  <div id="tabs-2">
		<div class="ui-grid-a">
			<div class="ui-block-a">
        <span><h3>M/C item Layout</h3></span>
  <div>
 <table  width="100%"  id="tlb" class="ui-body-d ui-shadow table-stripe">
 
  <thead style="height:40px; vertical-align:middle; text-align:left; font-weight:bold; background-color:rgb(51, 136, 204); color: #FFF;">
     <tr>
    <th><h3>&nbsp;Machine layout model</h3></th>
    </tr>
    </thead>
   <?php
    $q1 = mysql_query("SELECT * FROM  `tpm_item` WHERE  `main_id` =".$gr." AND  `item_type` LIKE  'mc_location' LIMIT 0 , 300");
	$i=1;
    if(mysql_num_rows($q1)){
		while($arrg = mysql_fetch_array($q1)){ 
		//search img
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
   <tbody>
  <tr>
    <td >
    
    <div style="text-align:center;">
    <a href="#<?php echo $arrg['sap_id']; ?>" data-rel="popup" data-position-to="window" data-transition="fade">
     <img src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $img_filepart.'/'.$img_filename; ?>"width="580" border="1" />
     </a>
     
     <div data-role="popup" id="<?php echo $arrg['sap_id']; ?>" data-overlay-theme="b" data-theme="b" data-corners="false">
    <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">ปิด</a><img class="popphoto" src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $img_filepart.'/'.$img_filename; ?>" style="max-height:512px;" alt="<?php echo $arrsp['spr_img']; ?>">
</div>
    </div>
    </td>
  </tr>
   <?php 
		$i++; }//end while
   }else{ ?>
  
  <tr>   <td colspan="6"><div style="text-align:center;"> ไม่มีรายงานที่ท่านค้นหา  </div></td> </tr>
    <?php }//end if ?>
    </tbody>

</table>
</div>
			</div>
				<div class="ui-block-b">
		<div style="text-align:right; float:right;">
                  <table>
                  <tr>
                  <td> <a href="#popupNewMCLocation"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex; background-color: rgb(51, 136, 204); color: #FFF;"  >Add mc / layout</a>
                  </td> 
                  <td> <a href="#popupNewMCItem"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex; background-color: rgb(51, 136, 204); color: #FFF;"  >Add new item</a>
                  </td>
                  </tr>
                  </table>
				</div>
				 <div style="padding-top:5px; background: #FFF; padding-bottom:20px;">
  <table  style="width:100%;" id="tlb" class="ui-body-d ui-shadow table-stripe">
     <thead>
        <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color: rgb(51, 136, 204); color: #FFF;">
          <td>Item</td>
          <td>Item name</td>
        	<td width="310">Item description en/th</td>
            <td width="110">Tools</td>
         </tr>
     </thead>
     <tbody>
           <?php
    $q1 = mysql_query("SELECT * FROM  `tpm_item` WHERE  `main_id` =".$gr." AND  `item_type` LIKE  'mc_item' LIMIT 0 , 300");
	$i=1;
    if(mysql_num_rows($q1)){
		while($arrg = mysql_fetch_array($q1)){ 
		//search img
		//select img

   ?>
   <tbody>
  <tr>
     <td ><div style="text-align:center;"><?php echo $i; ?></div></td>
    <td >
    <div><?php echo $arrg['item_name']; ?> </div>

    </td>

    <td  >
    <div><?php echo $arrg['descrip_th']; ?> 
      (<?php echo $arrg['descrip_en']; ?>) </div></td>
    
    <td >
    <div style="text-align:center;">
    
     <a href="#" data-ajax="false"   data-transition="pop" class="ui-disabled ui-btn ui-shadow ui-corner-all ui-icon-gear ui-btn-icon-notext " style="display: inline-flex;">Detail</a>
    
    
    
   <a href="../../include/model-teadmin/components/page/subpast/popup_edit_mclocation.php?id=<?php echo $arrg['item_id']; ?>&dev_root=<?php echo $dev_root; ?>" data-ajax="false" id="editForm" data-transition="pop" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext " style="display: inline-flex;">Edit list</a>
    
    
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
    </tbody>

</table>
  </div>

			</div><!--end tabs2-->
		</div>
    </div>  
</div> <!-- end tabs -->
</div>
<?php 
    //Popup area
	include("../../include/model-teadmin/components/page/subpast/popup_frm_new_mcloaction.php");
	include("../../include/model-teadmin/components/page/subpast/popup_new_machine_item.php");
?>      
 

  
  
    
    