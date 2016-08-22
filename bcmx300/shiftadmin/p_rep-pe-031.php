
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>



 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>F-LCT-MX-030</title>
<style type="text/css">
<!--
 
   body,td,th {
	font-family: Tahoma;
	font-size: 14px;	
}

table { border-collapse:collapse;}
 .frame{ border: 1px solid black;	text-align: center; }
 .rec{
	color: #000000;
}
 
 
 <?php

 require('../../include/config.inc.php'); 
 mysql_select_db($db); 
    if(isset($_GET['qid'])){
		    
		  
		  
		$qrep =mysql_query("SELECT * FROM  `qamxbc_rep` WHERE  `QID` LIKE  '".$_GET['qid']."' LIMIT 0 , 1",$connect)or die(mysql_error());				
		if(!mysql_num_rows($qrep)){ echo 'Error, no report record'; exit; }
		$arrep = mysql_fetch_array($qrep);
		
		
		 $qck =mysql_query("SELECT * FROM  `qamxbc_check` WHERE  `QID` LIKE  '".$_GET['qid']."' LIMIT 0 , 1",$connect)or die(mysql_error());
 $arck = mysql_fetch_array($qck);
	}
		
 ?>
 
 
 
-->
   </style> 
</head>

<body>

<div>
<table border="0" align="center"  style="width: 650px; text-align: center;" class="frame"  >
  <!--DWLayoutTable-->
  <tr>
    <td colspan="2" valign="top">
    
    <h3>บริษัท ไลอ้อน (ประเทศไทย) จำกัด <br/>
    ใบส่งตัวอย่างและแจ้งผลการวิเคราะห์สำหรับ Check sheet electronic</h3>
 
    <hr/>
    <div style="padding-top:1px; text-align:center;">
      <strong>  ใบส่งตัวอย่างและแจ้งผลวิเคราะห์ </strong><strong>
      <hr/>
     </div>
    <div>
    <table width="100%" border="0">
  <tr>
    <td><div align="center">S/P Code : <?php echo $arrep['fullformula']; ?></div></td>
    <td><div align="left">Batch No :<?php echo $arrep['bt_no'];?></div></td>
    <td><div align="left">วันที่ : <?php $date = date_create($arrep['rep_date']) ; echo date_format($date,"d/m/Y"); ?></div></td>
  </tr>
  <tr>
    <td><div align="center">เวลา : <?php $date = date_create($arrep['timmx_sent_cnf']) ; echo date_format($date,"H:i:s"); ?></div></td>
    <td><div align="left">Line\Mixer :<?php echo $arrep['mix_no']; ?></div></td>
    <td><div align="left">Tank No :  <?php echo $arrep['tank_no']; ?> </div></td>
  </tr>
  <tr>
    <td><div align="center">Batch Size : <?php echo $arrep['bt_size']; ?></div></td>
    <td><div align="left">Order :  <?php echo $arrep['order_no']; ?></div></td>
    <td><div align="center"></div></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="5">
      <tr>
        
        <td width="17%">จุดเก็บตัวอย่าง</td>
        <td width="15%"><div align="left">
        [<?php if ($arrep['collection_point'] == 0) {echo "✔";} ?>  ]ก้น Tank</div></td>
        <td width="15%"><div align="left">
        [<?php if ($arrep['collection_point'] == 1) {echo "✔";} ?>   ] Hopper</div></td>
        <td width="16%"><div align="left">
        [<?php if ($arrep['collection_point'] == 2) {echo "✔";} ?>   ] Nozzle</div></td>
        <td width="13%"><div align="left">
        [<?php if ($arrep['collection_point'] == 3) {echo "✔";} ?>  ] Mixer</div></td>
        <td width="22%"><div align="left">
        [<?php if ($arrep['collection_point'] == 4) {echo "✔";} ?>   ] อื่นๆ 
        <u><?php echo $arrep['point'] ?></u></div></td>
      </tr>
      <tr>
        <td>ขั้นตอน</td>
        <td><div align="left">
        [<?php if ($arrep['step_type'] == 0) {echo "✔";} ?>    ] Premix</div></td>
        <td><div align="left">
        [<?php if ($arrep['step_type'] == 1) {echo "✔";} ?>   ] Semi</div></td>
        <td colspan="2"><div align="left">
        [  <?php if ($arrep['step_type'] == 2) {echo "✔";} ?> ] pH Adjust</div></td>
        <td><div align="left">
        [<?php if ($arrep['step_type'] == 3) {echo "✔";} ?>   ] Visc. Adjust</div></td>
        <td width="2%">&nbsp;</td>
        
      </tr>
    </table></td>
    </tr>
</table>

    </div>
    <div style="text-align:left; padding-left:20px; font-size:14px; text-decoration: underline; padding-bottom:5px; "> <strong>ผลการวิเคราะห์ </strong></div>
    <div style="text-align:center;">  
      <table width="95%" align="center" cellpadding="5" class="frame">
        
            
          <tr>
            <td class="frame" width="265">Item</td>
                  <td class="frame" width="46">หน่วย</td>
                  <td width="67" class="frame">Standard</td>
                  <td class="frame" width="71">Result</td>
                  <td class="frame" width="97">Conclusion</td>
                 
                   
                   
            </tr>
          <tr>
            <td class="frame"><div style="text-align:left;">Appearance (ลักษณะ)</div></td>
            <td class="frame"><div align="center"></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"> 
              <div align="center"><?php echo $arck['app_spec_txt']; ?> </div>
            </div></td>
            <td class="frame"><div align="center"><?php echo $arck['app_act']; ?></div></td>
             <td class="frame"><div class="rec" style="text-align:center;">
               <div align="left"> [ <?php if($arck['check_result']==2){echo '✔';} ?> ] ผ่าน</div>
             </div></td>
           
           
          </tr>
          <tr>
            <td class="frame"><div style="text-align:center;">
              <div align="left">Odour (กลิ่น)<span style="text-align:left;"></span></div>
            </div></td>
            <td class="frame"><div align="center"></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"><?php echo $arck['odour_spec_txt']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['odour_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="left">[ <?php if($arck['check_result']==4){echo '✔';} ?> ] ไม่ผ่าน&nbsp;</div>
            </div></td>
            
          
          <tr>
            <td class="frame"><div style="text-align:left;">Color (สี)</div></td>
            <td class="frame"><div align="center"></div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="center"><?php echo $arck['clor_spec_txt']; ?></div>
            </div></td>
            <td class="frame"><div align="center"><?php echo $arck['clor_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="left">[ <?php if($arck['check_result']==3){echo '✔';} ?> ] รอผล</div>
            </div></td>
        
          
          <tr>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="left"><span style="text-align:left;">pH ที่อุณหภูมิ <?php echo $arck['ph_spec_temp']; ?> °C</span></div>
            </div></td>
            <td class="frame"><div align="center"></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"><?php echo $arck['ph_spec_min']; ?> - <?php echo $arck['ph_spec_max']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['ph_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="left">[ <?php if($arck['check_result']==1){echo '✔';} ?>] ปรับ 
			 <u><?php if($arck['check_result']==1){echo $arck['check_result_note'];} ?></u></div>
            </div></td>
           
           
          
          <tr>
            <td class="frame"><div style="text-align:left;">Viscosity (ความหนืด) ที่อุณหภูมิ <?php echo $arck['vis_spec_temp']; ?>   °C</div></td>
            <td class="frame"><div align="center">cp. , p.</div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="center"><?php echo $arck['vis_spec_min']; ?> -
              <?php echo $arck['vis_spec_max']; ?></div>
            </div></td>
            <td class="frame"><div align="center"><?php echo $arck['vis_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
         
           
          
          <tr>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="left">Sp.gr. (ความถ่วงจำเพาะ)ที่อุณหภูมิ  <?php echo $arck['spgr_spec_temp']; ?> °C</div>
            </div></td>
            <td class="frame"><div align="center"></div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
			<?php echo $arck['spgr_spec_min']; ?> - <?php echo $arck['spgr_spec_max']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['spgr_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;">&nbsp;</div></td>
        
           
          
          <tr>
            <td class="frame"><div style="text-align:left;">Foaming</div></td>
            <td class="frame"><div align="center">ml./g</div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="center"><?php echo $arck['foaming_spec_txt']; ?></div>
            </div></td>
            <td class="frame"><div align="center"><?php echo $arck['foaming_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
        
          
          <tr>
            <td class="frame"><div style="text-align:left;">Turbidity (ความขุ่น)</div></td>
            <td class="frame"><div align="center">NTU</div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="center"><?php echo $arck['turbidity_spec']; ?></div>
            </div></td>
            <td class="frame"><div align="center"><?php echo $arck['turbidity_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
           
          
          
          <tr>
            <td class="frame"><div style="text-align:left;">Transmittance</div></td>
            <td class="frame"><div align="center">cm.</div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
              <div align="center"><?php echo $arck['tran_spec']; ?></div>
            </div></td>
            <td class="frame"><div align="center"><?php echo $arck['tran_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
         
           
          
          <tr>
            <td class="frame"><div style="text-align:left;">%AI</div></td>
            <td class="frame"><div align="center">%</div></td>
            <td class="frame"><div class="rec" style="text-align:center;"><?php echo $arck['ai_spec_min']; ?> - <?php echo $arck['ai_spec_max']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['ai_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
          
           
          
          <tr>
            <td class="frame"><div style="text-align:left;">%Soap</div></td>
            <td class="frame"><div align="center">%</div></td>
            <td class="frame"><div class="rec" style="text-align:center;"><?php echo $arck['soap_spec_min']; ?>-<?php echo $arck['soap_spec_max']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['soap_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
          
           
          
          <tr>
            <td class="frame"><div style="text-align:left;">%Solid content</div></td>
            <td class="frame"><div align="center">%</div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
			<?php echo $arck['solid_cont_spec_min']; ?> - 
			<?php echo $arck['solid_cont_spec_max']; ?></div></td>
            <td class="frame"><div align="center">
			<?php echo $arck['solid_cont_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
        
            
          
          <tr>
            <td class="frame"><div style="text-align:left;">%ZPT</div></td>
            <td class="frame"><div align="center">%</div></td>
            <td class="frame"><div class="rec" style="text-align:center;"><?php echo $arck['zpt_spec_min']; ?> - <?php echo $arck['zpt_spec_max']; ?> </div></td>
            <td class="frame"><div align="center"><?php echo $arck['zpt_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
        
           
          
          <tr>
            <td height="30" class="frame"><div align="left"><span style="text-align:left;">%AV</span></div></td>
            <td class="frame"><div align="center">%</div></td>
            <td class="frame"><div align="center">
			<?php echo $arck['av_spec_min']; ?> - <?php echo $arck['av_spec_max']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['av_act']; ?></div></td>
            <td class="frame">&nbsp;</td>
          <tr>
            <td height="30" class="frame"><div align="left">%Fluoride</div></td>
            <td class="frame"><div align="center">%</div></td>
            <td class="frame"><div align="center">
			<?php echo $arck['fluoride_spec_min']; ?> - <?php echo $arck['fluoride_spec_max']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['fluoride_act']; ?></div></td>
            <td class="frame">&nbsp;</td>
          <tr>
            <td height="30" class="frame"><div style="text-align:left;">Microbial</div></td>
            <td class="frame"><div align="center"></div></td>
            <td class="frame"><div class="rec" style="text-align:center;">
            <?php echo $arck['micro_spec']; ?></div></td>
            <td class="frame"><div align="center"><?php echo $arck['micro_act']; ?></div></td>
            <td class="frame"><div class="rec" style="text-align:center;"></div></td>
         
           
          
          <tr>
            <td class="frame"><div style="text-align:left;">หมายเหตุ</div></td>
            <td colspan="4" class="frame">
             <div class="rec" style="height:30px;">
               <div align="left">PD Note: <?php echo $arrep['check_note_mx']; ?></div>
               <div align="left">QA Note: <?php echo $arck['check_note']; ?></div>
              </div>
            </td>
           
            </tr>
          <tr>
            <td class="frame"><div style="text-align:left;">ผู้ส่ง</div></td>
            <td colspan="4" class="frame"><div class="rec" style="text-align:left;">
            <?php echo $arrep['mix_name']; ?></div></td>
            
            </tr>
          <tr>
            <td class="frame"><div style="text-align:left;">วันที่ (เวลา)</div></td>
            <td colspan="4" class="frame"><div class="rec" style="text-align:left;">
             <?php echo $arrep['rep_date']; ?></div></td>
           
            </tr>
          <tr>
            <td class="frame"><div style="text-align:left;">ผู้วิเคราะห์</div></td>
            <td colspan="4" class="frame"><div class="rec" style="text-align:left;">  <?php echo $arrep['qa_name']; ?></div></td>
           
            </tr>
          <tr>
            <td class="frame"><div style="text-align:left;">วันที่ (เวลา)</div></td>
            <td colspan="4" class="frame"><div class="rec" style="text-align:left;">
             
   <?php echo $arrep['timqa_reciv_cnf']; ?>
    
            
			 
			 
			 
			 
            </div></td>
           
            </tr>
          <tr>
          
            </tr>
        
          
       </table>
      </div> 
       
       
        
       <div style="text-align:right; padding-right:20px;">
          F-LCT-PE-301</div>
     
    
    </td>
    </tr>
	 
</table>

</div>

</body>
</html>