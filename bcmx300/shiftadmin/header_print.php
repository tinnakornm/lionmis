<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบส่งตัวอย่าง</title>


</head>
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
	else
	echo 'No Report ID';		
 ?>
</head>

<body>
<div align="center">

  
  
  
  
  <table width="68%" border="1">
  <tr>
    <td width="61%"><div style="font-size:25px" align="center"><strong>วันที่ :
      <?php $date = date_create($arrep['rep_date']) ; echo date_format($date,"d/m/Y"); ?>
    </strong></div></td>
    <td width="39%"><div align="center" style="font-size:25px""><strong>Tank No : <?php echo $arrep['tank_no']; ?></strong></div></td>
   
  </tr>
  <tr>
    <td width="61%"><div align="center" style="font-size:25px"><strong>S/P Code : <?php echo $arrep['fullformula']; ?></strong></div></td>
    <td width="39%"><div align="center" style="font-size:25px"><strong>Batch No :<?php echo $arrep['bt_no'];?></strong></div></td>
   
  </tr>
  <tr>
    <td><div align="center" style="font-size:25px"><strong>เวลา :
      <?php $date = date_create($arrep['timmx_sent_cnf']) ; echo date_format($date,"H:i:s"); ?>
    </strong></div></td>
    <td><div align="center" style="font-size:25px"><strong>Line\Mixer :<?php echo $arrep['mix_no']; ?></strong></div></td>
   
  </tr>
  <tr>
    <td height="33"><div align="center" style="font-size:25px"><strong>Batch Size : <?php echo $arrep['bt_size']; ?></strong></div></td>
    <td><div align="center" style="font-size:25px"><strong>Order :  <?php echo $arrep['order_no']; ?></strong></div></td>
   
  </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0" cellpadding="5">
      <tr>
        
        <td width="17%">จุดเก็บตัวอย่าง</td>
        <td width="15%"><div align="left"  >
        [
          <?php if ($arrep['collection_point'] == 0) {echo "✔";} ?>  ] ก้นTank</div></td>
        <td width="15%"><div align="left" >
        [
          <?php if ($arrep['collection_point'] == 1) {echo "✔";} ?>   ] Hopper</div></td>
        <td width="16%"><div align="left" >
        [
          <?php if ($arrep['collection_point'] == 2) {echo "✔";} ?>   ] Nozzle</div></td>
        <td width="13%"><div align="left" >
        [
          <?php if ($arrep['collection_point'] == 3) {echo "✔";} ?>  ] Mixer</div></td>
        <td width="22%"><div align="left">
        [
          <?php if ($arrep['collection_point'] == 4) {echo "✔";} ?>   ] อื่นๆ 
          <u><?php echo $arrep['point'] ?></u></div></td>
      </tr>
      <tr>
        <td>ขั้นตอน</td>
        <td><div align="left">
        [
          <?php if ($arrep['step_type'] == 0) {echo "✔";} ?>    ] Premix</div></td>
        <td><div align="left">
        [
          <?php if ($arrep['step_type'] == 1) {echo "✔";} ?>   ] Semi</div></td>
        <td colspan="2"><div align="left">
        [  
          <?php if ($arrep['step_type'] == 2) {echo "✔";} ?> ] pH Adjust</div></td>
        <td><div align="left">
        [
          <?php if ($arrep['step_type'] == 3) {echo "✔";} ?>   ] Visc. Adjust</div></td>
        <td width="2%">&nbsp;</td>
    
    
  
</table>

  
  </tr>
  
 
</table>
  <div>
  
 
 <style type="text/css">
@media print {
    #printbtn {
        display :  none;
    }
}
</style>
<input id ="printbtn" type="button" value="Print this page" onclick="window.print();" >
</div>
 







</body>
</html>