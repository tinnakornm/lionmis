<?php session_start();
##########################################################################################
/*	File Name : std_rep.php		Log : v.1.0		Lase update : 17/12/2012
	MIS by    : Tinnakorn.M
	Description : Mixing operator UI, Move from srcinfo.sli
	Log : v1.0 - friendly operator UI. @date < 05/07/2012
	     - 17/12/2012 - Update 'p2mx_check' by add [tem_sent_insp] and [tem_get_insp]
		 - 15/05/2014 Change time format to datetime format
		 - 15/05/2014 Adjust css for 1 page set print area
		 - 03/05/2015 Move from srcinfo.sli to lionproduction.sli
		 - 10/07/2015 : add OEE Checkt (OEE Check note), By Tinnakorn.M		 
*/
##########################################################################################

	if(!session_is_registered("login_true")){
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
	if($_GET['id']){  $GIDF = $_GET['id'];  $_SESSION['GIDF'] = $_GET['id']; }else{
	$GIDF = $_SESSION['GIDF']; }
	if(!$GIDF){ echo "Error! No required report"; exit(); }
	
 
	
	//repinfo & Autoloadbatch
	$qinfo = mysql_query("SELECT *  FROM  `p2mx_f_rep`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' LIMIT 0 , 1");
	if(!mysql_num_rows($qinfo)){  echo "Error! No report on database"; exit();  }else{
	   $arrinfo = mysql_fetch_array($qinfo);	
	   //check if not session DD, MM, YYY
	   if(!session_is_registered("DD")){ $SESSION['DD'] = $arrinfo['DD']; }
	   if(!session_is_registered("MM")){  $SESSION['MM'] = $arrinfo['MM'];  }
	   if(!session_is_registered("YYYY")){  $SESSION['YYYY'] = $arrinfo['YYYY'];  }
	}
	//query product
	 
 		$qf =mysql_query("SELECT DISTINCT (fullformula) FROM `p2mx_pd` WHERE `status` = 1");
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
 
	
	function checkem($data){
		if($data=='0'){ return '-'; }
		else{ return $data; }
	}
	
	//preparing array of TOT, NOT String
		$qar = mysql_query("SELECT * FROM  `p2mx_f_checkt` WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' LIMIT 0 , 60");
		if(mysql_num_rows($qar)){
			while($arrt = mysql_fetch_array($qar)){
				$AR["".$arrt['causekey'.""]]=$arrt['check_val'];
				 
			}
		}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ใบสรุปการผลิต</title>
<link href="../../components/lightbox/faceboxmx.css" media="screen" rel="stylesheet" type="text/css" />
 
 
 
	
<!-- Ajax auto update -->    
		

<style type="text/css">
<!--
 
input { border:none; color:#0000FF;  text-align:center; padding-top:5px; padding-bottom:5px; }
input:hover { background:#FFCCCC; font-weight:bold; color:#FF0000; }

.inputb{
	background-color:#F3DE96;
	border: 1px dashed #999999;
}
.style2 {font-size:11px;}

   body,td,th {
	font-family: Tahoma;
	font-size: 11px;
}

table
{
border-collapse:collapse;
}
table,th, td
{
	border: 1px solid black;
	text-align: center;
}
td .incell{ text-align:center; vertical-align:middle; }
.line {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CCC;
	margin:4px;
	text-align:left;
}
.detail{ color:#009; }

input[type="time"]::-webkit-calendar-picker-indicator,
input[type="time"]::-webkit-inner-spin-button{
    display: none;
}

-->
   </style> 
   
<!-- time piker -->
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
 
	<!-- cancled alert box since  19/09/2013  -->
	<!-- 	var answer = confirm ("ใช้เวลาปัจุบัน " + timeValue)  -->
	<!-- 	if (answer) return timeValue; -->
	<!-- 	else exit(); -->
	    return timeValue;
	    exit();
	
}


function whatDate(){
    var now = new Date();
	var monthnumber = now.getMonth();
	var monthday    = now.getDate();
	var year        = now.getFullYear();
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
	
var timeValue = hours + ":" + minutes + ":" +seconds;
	
	monthnumber = monthnumber+1;

	<!-- cancled alert box since  19/09/2013  -->	
	<!--var answer = confirm ("ใช้เวลาปัจุบัน " + year+'-'+monthnumber+'-'+monthday+' '+timeValue)
    <!--if (answer) return year+'-'+monthnumber+'-'+monthday+' '+timeValue;
    <!-- else exit();
    return year+'-'+monthnumber+'-'+monthday+' '+timeValue;
	exit();
	
}

function whatTimeIsIt() 
    { 
    var m=new Date(); 
    var minute=m.getMinutes(); 
    var second=m.getSeconds(); 
    var ampm=false; 
     
    if (minute >=0 && minute < 10) 
    { 
        minute=("0" + minute);     
    } 
     
    if (second >= 0 && second < 10 )     
    { 
        second=('0' + second); 
    } 
     
    var hours=m.getHours(); 
    if (hours > 12)         
    { 
        ampm=true; 
        hours=hours-12; 
    } 
     
    if (hours==12) 
    { 
        ampm=true; 
    } 

    if (hours == 0)     
    { 
    hours=hours+12;         
    ampm=false; 
    } 
    if (ampm)     
    {         ampm=' PM'; 
    } 
    else         
    {         ampm=' AM'; 
    } 
    var myTime=hours + ':' + minute + ':' + second  + ampm; 
   // var span = document.getelementbyid('Label1'); 
   // span.value = myTime; 
	
	return myTime;
	
    } 

// End -->
</SCRIPT>

  
</head>

<body>

<?php require('../../include/config.inc.php'); ?>
<?php mysql_select_db($db);	?>

 
<div>
<table border="0" align="center"  style="width:100%; text-align:left;"  >
  <!--DWLayoutTable-->
  <tr>
    <td colspan="2" valign="top">
 <div style="text-align:center; float:left; width: 100%; position: absolute;">   
    <strong>ใบสรุปการผลิตสำหรับ Check Sheet Electronic 
    </strong>
   </div> 
    <div style="text-align:right; float:right;">
   <strong>F-LCT-MX-031</strong>
   </div> 
    </td>
    </tr>
	<tr><td width="385" valign="top">
  <div align="left" class="line" style="font-size:small;">Report id : <?php echo $_SESSION["GIDF"]; ?> 
  <strong>Mixer No.</strong> 
  <span class="detail">
  <?php echo $arrinfo['main_mixer']; ?>
  </span>
  </div>
	  
	  <div class="line" align="left">
	    <strong>Shift Report Team </strong>: <span class="detail"><?php echo $arrinfo['pd_group']; ?></span> 
        
       <strong> Date</strong> : <span class="detail"><?php echo $arrinfo['date']; ?> </span>
        
       <strong> Shift</strong> : ( <span class="detail"><?php echo $arrinfo['shift']; ?></span> )
        
        <strong>เวลา</strong> : <span class="detail"><?php echo $arrinfo['start_tim_define']; ?> - <?php echo $arrinfo['stop_tim_define']; ?> </span>
	    </div>
	  
	  </td>
	  <td width="238" valign="top">
      
       <?php if($arrinfo['shift_appr']=='0'){ ?>
   <div align="center" style="padding-top:10px; text-align:center;  color:#FF0000;"><strong>
WAIT FOR APPROVE (รอตรวจสอบโดย Shift Leader)</strong></div>
   <?php }else{ ?>
   <div align="center" style="padding-top:10px; text-align:center;   color:#006600;"><strong>
<img src="../../source/images/check_24.png" width="24" height="24" align="absmiddle" /> รายงานผ่านการตรวจสอบแล้ว โดย <?php echo $arrinfo['shift_sname']; ?> เวลา <?php echo $arrinfo['shift_apprtim']; ?></strong></div>
   <?php } ?>
	     
      </td>
	</tr>
</table>

</div>
         <?php
	 //query report
 
		 
		?> 
          <table  cellpadding="0" cellspacing="0" style="text-align:left; table-layout:fixed; width:100%;  border: 1px solid black;" >
	  <!--Layout-->
 <tr >
   <td width="27" rowspan="6" valign="middle" >&nbsp;</td>
   <td width="178" valign="middle"  >Work Order No.</td>
   <td style="width:70px;" rowspan="6" valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td height="15" colspan="2" valign="middle"  ><div  class="incell">
    <?php if(isset($arrck1['order'])){ echo checkem($arrck1['order']); } ?> 
   </div></td>
   <td colspan="2"   valign="middle"><div  class="incell"> 
   <?php if(isset($arrck2['order'])){  echo checkem($arrck2['order']); }  ?> 
   </div></td>
   <td colspan="2"  valign="middle" ><div  class="incell"> 
   <?php if(isset($arrck3['order'])){  echo checkem($arrck3['order']); }  ?> 
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"> 
   <?php if(isset($arrck4['order'])){  echo checkem($arrck4['order']); }  ?> 
   </div></td>
   <td colspan="2" valign="middle" ><div  class="incell"> 
   <?php if(isset($arrck5['order'])){  echo checkem($arrck5['order']); }  ?> 
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"> 
   <?php if(isset($arrck6['order'])){  echo checkem($arrck6['order']); }  ?> 
   </div></td>
   <td colspan="2" rowspan="6" valign="middle" bgcolor="#CCCCCC">&nbsp; 
    
    </td>
   </tr>
 <tr >
   <td valign="middle"  >ผลิตภัณฑ์</td>
   <td height="15" colspan="2" valign="middle"  >
   <div  class="incell"> <?php if(isset($arrck1['product'])){ echo  checkem($arrck1['product']); }     	 ?> </div>    
   </td>
   <td colspan="2"   valign="middle">
    <div  class="incell"> <?php if(isset($arrck2['product'])){ echo  checkem($arrck2['product']); }      	 ?> </div>       
   </td>
   <td colspan="2"  valign="middle" >
        <div  class="incell"><?php if(isset($arrck3['product'])){ echo checkem($arrck3['product']); }  ?></div>
   </td>
   <td colspan="2" valign="middle">  
        <div  class="incell"><?php if(isset($arrck4['product'])){ echo checkem($arrck4['product']); }  ?>  </div>   
   </td>
   <td colspan="2" valign="middle" >
      <div  class="incell"><?php if(isset($arrck5['product'])){  echo checkem($arrck5['product']); }  ?></div>   
   </td>
   <td colspan="2" valign="middle">
    <div  class="incell"><?php if(isset($arrck6['product'])){  echo checkem($arrck6['product']); }  ?></div>
 </td>
   </tr>
 <tr  >
   <td valign="middle"  >Batch No.</td>
   <td height="15" colspan="2" valign="middle"  ><div  class="incell"> 
   <?php if(isset($arrck1['batch_no'])){ echo checkem($arrck1['batch_no']); } ?> 
   </div></td>
   <td colspan="2"   valign="middle"><div  class="incell"> 
   <?php if(isset($arrck2['batch_no'])){  echo checkem($arrck2['batch_no']); }  ?>
   </div></td>
   <td colspan="2"  valign="middle" ><div  class="incell"> 
   <?php if(isset($arrck3['batch_no'])){  echo checkem($arrck3['batch_no']); } ?> 
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"> 
   <?php if(isset($arrck4['batch_no'])){  echo checkem($arrck4['batch_no']); } ?> 
   </div></td>
   <td colspan="2" valign="middle" ><div  class="incell"> 
   <?php if(isset($arrck5['batch_no'])){  echo checkem($arrck5['batch_no']); } ?> 
   </div></td>
   <td colspan="2" valign="middle"><div  class="incell"> 
   <?php if(isset($arrck6['batch_no'])){  echo checkem($arrck6['batch_no']); } ?> 
   </div></td>
   </tr>
 <tr  >
   <td valign="middle"  >ผลผลิต (Ton)</td>
   <td height="15" colspan="2" valign="middle" > <div  class="incell"
   ><?php if(isset($arrck1['batch_ton'])){ echo checkem($arrck1['batch_ton']); } ?> </div></td>
   <td colspan="2"   valign="middle">  <div  class="incell">
   <?php if(isset($arrck2['batch_ton'])){  echo checkem($arrck2['batch_ton']); }  ?></div> </td>
   <td colspan="2"  valign="middle" >  <div  class="incell">
   <?php if(isset($arrck3['batch_ton'])){  echo checkem($arrck3['batch_ton']); }  ?> </div></td>
   <td colspan="2" valign="middle">  <div  class="incell">
   <?php if(isset($arrck4['batch_ton'])){  echo checkem($arrck4['batch_ton']); }  ?> </div></td>
   <td colspan="2" valign="middle" >  <div  class="incell">
   <?php if(isset($arrck5['batch_ton'])){  echo checkem($arrck5['batch_ton']); }  ?> </div></td>
   <td colspan="2" valign="middle">  <div  class="incell">
   <?php if(isset($arrck6['batch_ton'])){  echo checkem($arrck6['batch_ton']); }  ?></div> </td>
   </tr>
 <tr  >
   <td valign="middle"  >คุณภาพ (ผ่าน/รอผล)</td>
   <td height="15" colspan="2" valign="middle" ><div  class="incell">
   
     <?php 
	  if(isset($arrck1['quality'])){
	  if($arrck1['quality']==0){ echo ''; }
	 elseif($arrck1['quality']==1){ echo 'ผ่าน'; }
	 elseif($arrck1['quality']==2){ echo 'ไม่ผ่าน'; }
	 elseif($arrck1['quality']==3){ echo 'รอผล'; } 
	  }
	   ?>
    </div>
   </td>
   <td colspan="2"   valign="middle"><div  class="incell">
   <?php 
    if(isset($arrck2['quality'])){
    if($arrck2['quality']==0){ echo ''; }
	 elseif($arrck2['quality']==1){ echo 'ผ่าน'; }
	 elseif($arrck2['quality']==2){ echo 'ไม่ผ่าน'; }
	 elseif($arrck2['quality']==3){ echo 'รอผล'; } 
	}
	   ?></div></td>
   <td colspan="2"  valign="middle" ><div  class="incell"><?php 
    if(isset($arrck3['quality'])){
    if($arrck3['quality']==0){ echo ''; }
	 elseif($arrck3['quality']==1){ echo 'ผ่าน'; }
	 elseif($arrck3['quality']==2){ echo 'ไม่ผ่าน'; }
	 elseif($arrck3['quality']==3){ echo 'รอผล'; } 
	}
	   ?></div></td>
   <td colspan="2" valign="middle"><div  class="incell"><?php 
    if(isset($arrck4['quality'])){
    if($arrck4['quality']==0){ echo ''; }
	 elseif($arrck4['quality']==1){ echo 'ผ่าน'; }
	 elseif($arrck4['quality']==2){ echo 'ไม่ผ่าน'; }
	 elseif($arrck4['quality']==3){ echo 'รอผล'; } 
	}
	   ?></div></td>
   <td colspan="2" valign="middle" ><div  class="incell"><?php
    if(isset($arrck5['quality'])){
     if($arrck5['quality']==0){ echo ''; }
	 elseif($arrck5['quality']==1){ echo 'ผ่าน'; }
	 elseif($arrck5['quality']==2){ echo 'ไม่ผ่าน'; }
	 elseif($arrck5['quality']==3){ echo 'รอผล'; } 
	}
	   ?></div></td>
   <td colspan="2" valign="middle"><div  class="incell">
   <?php 
   if(isset($arrck6['quality'])){
    if($arrck6['quality']==0){ echo ''; }
	 elseif($arrck6['quality']==1){ echo 'ผ่าน'; }
	 elseif($arrck6['quality']==2){ echo 'ไม่ผ่าน'; }
	 elseif($arrck6['quality']==3){ echo 'รอผล'; } 
   }  ?></div></td>
   </tr>
 <tr  >
   <td valign="middle"  >Storage No.</td>
   <td height="15" colspan="2" valign="middle" ><div  class="incell">
  <?php if(isset($arrck1['storage'])){ echo checkem($arrck1['storage']);} ?> </div></td>
   <td colspan="2"   valign="middle"><div  class="incell"><?php if(isset($arrck2['storage'])){  echo checkem($arrck2['storage']);} ?></div></td>
   <td colspan="2"  valign="middle" ><div  class="incell"><?php if(isset($arrck3['storage'])){  echo checkem($arrck3['storage']);} ?></div></td>
   <td colspan="2" valign="middle"><div  class="incell"><?php if(isset($arrck4['storage'])){  echo checkem($arrck4['storage']);} ?></div></td>
   <td colspan="2" valign="middle" ><div  class="incell"><?php if(isset($arrck5['storage'])){  echo checkem($arrck5['storage']);} ?></div></td>
   <td colspan="2" valign="middle"><div  class="incell"><?php if(isset($arrck6['storage'])){ echo checkem($arrck6['storage']); } ?></div></td>
   </tr>
 <tr  >
   <td rowspan="15" valign="middle" >INT</td>
   <td valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
   <td rowspan="4" valign="middle" bgcolor="#CCCCCC"  >&nbsp;</td>
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
 <tr style="height:17px;">
   <td valign="middle"  >เวลาผสม</td>
   <td><div  class="incell"> 
   <?php 
        function tim($tim){
	    if($tim=='0000-00-00 00:00:00'){  $data = '-'; }elseif($tim==''){ $data=''; }else{ $date = date_create($tim);  $data = date_format($date,'H:i'); }
		return $data; 
		}
 		
   if(isset($arrck1['mix_be'])){ echo tim($arrck1['mix_be']); }
     
    ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['mix_fi'])){  echo tim($arrck1['mix_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['mix_be'])){ echo tim($arrck2['mix_be']); } ?> 
   </div></td>
   <td><div  class="incell">  <?php if(isset($arrck2['mix_fi'])){ echo tim($arrck2['mix_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['mix_be'])){ echo tim($arrck3['mix_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['mix_fi'])){ echo tim($arrck3['mix_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['mix_be'])){ echo tim($arrck4['mix_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['mix_fi'])){ echo tim($arrck4['mix_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['mix_be'])){ echo tim($arrck5['mix_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['mix_fi'])){ echo tim($arrck5['mix_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['mix_be'])){ echo tim($arrck6['mix_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['mix_fi'])){ echo tim($arrck6['mix_fi']); } ?> 
   
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR["mix_tot"])){ echo $AR["mix_tot"]; } ?> 
   </div></td>
   <td>
   <div  class="incell"> <?php if(isset($AR["mix_note"])){ echo $AR["mix_note"]; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >เวลาวิเคราะห์</td>
   <td><div  class="incell"> <?php if(isset($arrck1['analy_be'])){ echo tim($arrck1['analy_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['analy_fi'])){  echo tim($arrck1['analy_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['analy_be'])){  echo tim($arrck2['analy_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck2['analy_fi'])){ echo tim($arrck2['analy_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['analy_be'])){  echo tim($arrck3['analy_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['analy_fi'])){  echo tim($arrck3['analy_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['analy_be'])){  echo tim($arrck4['analy_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['analy_fi'])){  echo tim($arrck4['analy_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['analy_be'])){  echo tim($arrck5['analy_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['analy_fi'])){  echo tim($arrck5['analy_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['analy_be'])){  echo tim($arrck6['analy_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['analy_fi'])){  echo tim($arrck6['analy_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['analy_tot'])){ echo $AR['analy_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['analy_note'])){ echo $AR['analy_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >เวลาถ่ายเก็บ</td>
  <td><div  class="incell"> <?php if(isset($arrck1['transf_be'])){ echo tim($arrck1['transf_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['transf_fi'])){  echo tim($arrck1['transf_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['transf_be'])){  echo tim($arrck2['transf_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['transf_fi'])){  echo tim($arrck2['transf_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['transf_be'])){  echo tim($arrck3['transf_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['transf_fi'])){  echo tim($arrck3['transf_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['transf_be'])){  echo tim($arrck4['transf_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['transf_fi'])){  echo tim($arrck4['transf_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['transf_be'])){  echo tim($arrck5['transf_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['transf_fi'])){  echo tim($arrck5['transf_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['transf_be'])){  echo tim($arrck6['transf_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['transf_fi'])){  echo tim($arrck6['transf_fi']);} ?> 
   </div></td>
   <td><div  class="incell">

    <?php if(isset($AR['transf_tot'])){ echo $AR['transf_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['transf_note'])){ echo $AR['transf_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ปรับ AI</td>
   <td valign="middle"  >AD19</td>
    <td><div  class="incell"> <?php if(isset($arrck1['AD19_be'])){ echo tim($arrck1['AD19_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD19_fi'])){  echo tim($arrck1['AD19_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD19_be'])){  echo tim($arrck2['AD19_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD19_fi'])){  echo tim($arrck2['AD19_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD19_be'])){  echo tim($arrck3['AD19_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD19_fi'])){  echo tim($arrck3['AD19_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD19_be'])){  echo tim($arrck4['AD19_be']);  }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD19_fi'])){  echo tim($arrck4['AD19_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD19_be'])){  echo tim($arrck5['AD19_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD19_fi'])){  echo tim($arrck5['AD19_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD19_be'])){  echo tim($arrck6['AD19_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD19_fi'])){  echo tim($arrck6['AD19_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD19_tot'])){ echo $AR['AD19_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD19_note'])){  echo $AR['AD19_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ปรับ PH</td>
   <td valign="middle"  >AD20</td>
   <td><div  class="incell"><?php if(isset($arrck1['AD20_be'])){ echo tim($arrck1['AD20_be']); } ?> 
   </div></td>
   <td ><div  class="incell"><?php if(isset($arrck1['AD20_fi'])){  echo tim($arrck1['AD20_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck2['AD20_be'])){  echo tim($arrck2['AD20_be']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck2['AD20_fi'])){  echo tim($arrck2['AD20_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AD20_be'])){  echo tim($arrck3['AD20_be']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AD20_fi'])){  echo tim($arrck3['AD20_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck4['AD20_be'])){  echo tim($arrck4['AD20_be']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck4['AD20_fi'])){  echo tim($arrck4['AD20_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck5['AD20_be'])){  echo tim($arrck5['AD20_be']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck5['AD20_fi'])){  echo tim($arrck5['AD20_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck6['AD20_be'])){  echo tim($arrck6['AD20_be']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck6['AD20_fi'])){  echo tim($arrck6['AD20_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD20_tot'])){ echo $AR['AD20_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD20_note'])){ echo $AR['AD20_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ปรับ VISC.</td>
   <td valign="middle"  >AD25</td>
<td><div  class="incell"> <?php if(isset($arrck1['AD25_be'])){ echo tim($arrck1['AD25_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD25_fi'])){  echo tim($arrck1['AD25_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD25_be'])){  echo tim($arrck2['AD25_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD25_fi'])){  echo tim($arrck2['AD25_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD25_be'])){  echo tim($arrck3['AD25_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD25_fi'])){  echo tim($arrck3['AD25_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD25_be'])){  echo tim($arrck4['AD25_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD25_fi'])){  echo tim($arrck4['AD25_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD25_be'])){  echo tim($arrck5['AD25_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD25_fi'])){  echo tim($arrck5['AD25_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD25_be'])){  echo tim($arrck6['AD25_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD25_fi'])){  echo tim($arrck6['AD25_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD25_tot'])){ echo $AR['AD25_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD25_note'])){ echo $AR['AD25_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >Stock เต็ม (ผลิตปกติ)</td>
   <td valign="middle"  >AD51</td>
   <td><div  class="incell"> <?php if(isset($arrck1['AD51_be'])){ echo tim($arrck1['AD51_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php  if(isset($arrck1['AD51_fi'])){ echo tim($arrck1['AD51_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD51_be'])){ echo tim($arrck2['AD51_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD51_fi'])){ echo tim($arrck2['AD51_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD51_be'])){ echo tim($arrck3['AD51_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck3['AD51_fi'])){echo tim($arrck3['AD51_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD51_be'])){ echo tim($arrck4['AD51_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck4['AD51_fi'])){echo tim($arrck4['AD51_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD51_be'])){ echo tim($arrck5['AD51_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck5['AD51_fi'])){echo tim($arrck5['AD51_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck6['AD51_be'])){echo tim($arrck6['AD51_be']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck6['AD51_fi'])){echo tim($arrck6['AD51_fi']);} ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD51_tot'])){ echo $AR['AD51_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD51_note'])){ echo $AR['AD51_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >แผนผลิตเปลี่ยนต้องรอถ่าย Semi</td>
   <td valign="middle"  >AD54</td>
   <td><div  class="incell"> <?php if(isset($arrck1['AD54_be'])){ echo tim($arrck1['AD54_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD54_fi'])){  echo tim($arrck1['AD54_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD54_be'])){  echo tim($arrck2['AD54_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD54_fi'])){  echo tim($arrck2['AD54_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD54_be'])){  echo tim($arrck3['AD54_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD54_fi'])){  echo tim($arrck3['AD54_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD54_be'])){  echo tim($arrck4['AD54_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD54_fi'])){  echo tim($arrck4['AD54_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD54_be'])){  echo tim($arrck5['AD54_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD54_fi'])){  echo tim($arrck5['AD54_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD54_be'])){  echo tim($arrck6['AD54_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD54_fi'])){  echo tim($arrck6['AD54_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD54_tot'])){ echo $AR['AD54_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD54_note'])){ echo $AR['AD54_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >พท.เต็ม(รอถ่ายจากการเปลี่ยนสูตร)</td>
   <td valign="middle"  >AK01</td>
   <td><div  class="incell"> <?php if(isset($arrck1['AK01_be'])){ echo tim($arrck1['AK01_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AK01_fi'])){  echo tim($arrck1['AK01_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AK01_be'])){  echo tim($arrck2['AK01_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AK01_fi'])){  echo tim($arrck2['AK01_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AK01_be'])){  echo tim($arrck3['AK01_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AK01_fi'])){  echo tim($arrck3['AK01_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AK01_be'])){  echo tim($arrck4['AK01_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AK01_fi'])){  echo tim($arrck4['AK01_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AK01_be'])){  echo tim($arrck5['AK01_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AK01_fi'])){  echo tim($arrck5['AK01_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AK01_be'])){  echo tim($arrck6['AK01_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AK01_fi'])){  echo tim($arrck6['AK01_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AK01_tot'])){ echo $AR['AK01_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AK01_note'])){ echo $AR['AK01_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >รอ Premix</td>
   <td valign="middle"  >AD53</td>
    <td><div  class="incell"> <?php if(isset($arrck1['AD53_be'])){ echo tim($arrck1['AD53_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD53_fi'])){  echo tim($arrck1['AD53_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD53_be'])){  echo tim($arrck2['AD53_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD53_fi'])){  echo tim($arrck2['AD53_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD53_be'])){  echo tim($arrck3['AD53_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AD53_fi'])){  echo tim($arrck3['AD53_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD53_be'])){  echo tim($arrck4['AD53_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD53_fi'])){  echo tim($arrck4['AD53_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD53_be'])){  echo tim($arrck5['AD53_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD53_fi'])){  echo tim($arrck5['AD53_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD53_be'])){  echo tim($arrck6['AD53_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD53_fi'])){  echo tim($arrck6['AD53_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD53_tot'])){ echo $AR['AD53_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD53_note'])){ echo $AR['AD53_note']; } ?> 
   </div></td>
   </tr>
   <tr style="height:17px;">
   <td valign="middle"  >รออุณหภูมิ AG</td>
   <td valign="middle"  >AD13</td>
    <td><div  class="incell"> <?php if(isset($arrck1['AD13_be'])){ echo tim($arrck1['AD13_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD13_fi'])){  echo tim($arrck1['AD13_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD13_be'])){  echo tim($arrck2['AD13_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD13_fi'])){  echo tim($arrck2['AD13_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD13_be'])){  echo tim($arrck3['AD13_be']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AD13_fi'])){  echo tim($arrck3['AD13_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD13_be'])){  echo tim($arrck4['AD13_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD13_fi'])){  echo tim($arrck4['AD13_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD13_be'])){  echo tim($arrck5['AD13_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD13_fi'])){  echo tim($arrck5['AD13_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD13_be'])){  echo tim($arrck6['AD13_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD13_fi'])){  echo tim($arrck6['AD13_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD13_tot'])){ echo $AR['AD13_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD13_note'])){ echo $AR['AD13_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ล้าง M/C เนื่องจากการเปลี่ยนสูตร</td>
   <td valign="middle"  >AD61</td>
   <td><div  class="incell"> <?php if(isset($arrck1['AD61_be'])){ echo tim($arrck1['AD61_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD61_fi'])){  echo tim($arrck1['AD61_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD61_be'])){  echo tim($arrck2['AD61_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD61_fi'])){  echo tim($arrck2['AD61_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD61_be'])){  echo tim($arrck3['AD61_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD61_fi'])){  echo tim($arrck3['AD61_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD61_be'])){  echo tim($arrck4['AD61_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD61_fi'])){  echo tim($arrck4['AD61_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD61_be'])){  echo tim($arrck5['AD61_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD61_fi'])){  echo tim($arrck5['AD61_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD61_be'])){  echo tim($arrck6['AD61_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD61_fi'])){  echo tim($arrck6['AD61_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD61_tot'])){ echo $AR['AD61_tot']; }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD61_note'])){ echo $AR['AD61_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ประชุม</td>
   <td valign="middle"  >AD10</td>
    <td><div  class="incell"> <?php if(isset($arrck1['AD10_be'])){ echo tim($arrck1['AD10_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD10_fi'])){  echo tim($arrck1['AD10_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD10_be'])){  echo tim($arrck2['AD10_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD10_fi'])){  echo tim($arrck2['AD10_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD10_be'])){  echo tim($arrck3['AD10_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD10_fi'])){  echo tim($arrck3['AD10_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck4['AD10_be'])){  echo tim($arrck4['AD10_be']); }  ?>
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck4['AD10_fi'])){  echo tim($arrck4['AD10_fi']); }  ?>
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck5['AD10_be'])){  echo tim($arrck5['AD10_be']); }  ?>
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck5['AD10_fi'])){  echo tim($arrck5['AD10_fi']); }  ?>
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck6['AD10_be'])){  echo tim($arrck6['AD10_be']); }  ?>
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck6['AD10_fi'])){  echo tim($arrck6['AD10_fi']); }  ?>
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['AD10_tot'])){ echo  $AR['AD10_tot']; } ?>
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['AD10_note'])){ echo  $AR['AD10_note']; } ?>
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >รอชาร์ทน้ำ</td>
   <td valign="middle"  >AD97</td>
    <td><div  class="incell"> <?php if(isset($arrck1['AD97_be'])){ echo tim($arrck1['AD97_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AD97_fi'])){  echo tim($arrck1['AD97_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD97_be'])){  echo tim($arrck2['AD97_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AD97_fi'])){  echo tim($arrck2['AD97_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD97_be'])){  echo tim($arrck3['AD97_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AD97_fi'])){  echo tim($arrck3['AD97_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD97_be'])){  echo tim($arrck4['AD97_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AD97_fi'])){  echo tim($arrck4['AD97_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD97_be'])){  echo tim($arrck5['AD97_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AD97_fi'])){  echo tim($arrck5['AD97_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD97_be'])){  echo tim($arrck6['AD97_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AD97_fi'])){  echo tim($arrck6['AD97_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD97_tot'])){ echo $AR['AD97_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AD97_note'])){ echo $AR['AD97_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td rowspan="12" valign="middle" >EXT</td>
   <td valign="middle"  >ปั้มเสีย/รั่ว</td>
   <td valign="middle"  >BMEX</td>
    <td><div  class="incell"> <?php if(isset($arrck1['BMEX_be'])){ echo tim($arrck1['BMEX_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['BMEX_fi'])){  echo tim($arrck1['BMEX_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck2['BMEX_be'])){  echo tim($arrck2['BMEX_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['BMEX_fi'])){  echo tim($arrck2['BMEX_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['BMEX_be'])){  echo tim($arrck3['BMEX_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['BMEX_fi'])){  echo tim($arrck3['BMEX_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['BMEX_be'])){  echo tim($arrck4['BMEX_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['BMEX_fi'])){  echo tim($arrck4['BMEX_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['BMEX_be'])){  echo tim($arrck5['BMEX_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['BMEX_fi'])){  echo tim($arrck5['BMEX_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['BMEX_be'])){  echo tim($arrck6['BMEX_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['BMEX_fi'])){  echo tim($arrck6['BMEX_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['BMEX_tot'])){ echo $AR['BMEX_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['BMEX_note'])){  echo $AR['BMEX_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >รอผลวิเคราะห์ตัวอย่าง</td>
   <td valign="middle"  >AQ92</td>
     <td><div  class="incell"> <?php if(isset($arrck1['AQ92_be'])){ echo tim($arrck1['AQ92_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AQ92_fi'])){  echo tim($arrck1['AQ92_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AQ92_be'])){  echo tim($arrck2['AQ92_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AQ92_fi'])){  echo tim($arrck2['AQ92_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AQ92_be'])){  echo tim($arrck3['AQ92_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AQ92_fi'])){  echo tim($arrck3['AQ92_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AQ92_be'])){  echo tim($arrck4['AQ92_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AQ92_fi'])){  echo tim($arrck4['AQ92_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AQ92_be'])){  echo tim($arrck5['AQ92_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AQ92_fi'])){  echo tim($arrck5['AQ92_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AQ92_be'])){  echo tim($arrck6['AQ92_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AQ92_fi'])){  echo tim($arrck6['AQ92_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AQ92_tot'])){  echo $AR['AQ92_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AQ92_note'])){ echo $AR['AQ92_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >รอ QA Swab Test</td>
   <td valign="middle"  >AQ94</td>
    <td><div  class="incell"> <?php if(isset($arrck1['AQ94_be'])){ echo tim($arrck1['AQ94_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AQ94_fi'])){  echo tim($arrck1['AQ94_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AQ94_be'])){  echo tim($arrck2['AQ94_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AQ94_fi'])){  echo tim($arrck2['AQ94_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AQ94_be'])){  echo tim($arrck3['AQ94_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AQ94_fi'])){  echo tim($arrck3['AQ94_fi']);  }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AQ94_be'])){  echo tim($arrck4['AQ94_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AQ94_fi'])){  echo tim($arrck4['AQ94_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck5['AQ94_be'])){ echo tim($arrck5['AQ94_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AQ94_fi'])){  echo tim($arrck5['AQ94_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AQ94_be'])){  echo tim($arrck6['AQ94_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck6['AQ94_fi'])){ echo tim($arrck6['AQ94_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AQ94_tot'])){ echo $AR['AQ94_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AQ94_note'])){ echo $AR['AQ94_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >รอ RM จาก Supplier</td>
   <td valign="middle"  >AL92</td>
    <td><div  class="incell"><?php if(isset($arrck1['AL92_be'])){ echo tim($arrck1['AL92_be']); } ?> 
   </div></td>
   <td ><div  class="incell"><?php if(isset($arrck1['AL92_fi'])){  echo tim($arrck1['AL92_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck2['AL92_be'])){  echo tim($arrck2['AL92_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck2['AL92_fi'])){  echo tim($arrck2['AL92_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AL92_be'])){  echo tim($arrck3['AL92_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AL92_fi'])){  echo tim($arrck3['AL92_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck4['AL92_be'])){ echo tim($arrck4['AL92_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php  if(isset($arrck4['AL92_fi'])){ echo tim($arrck4['AL92_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php  if(isset($arrck5['AL92_be'])){ echo tim($arrck5['AL92_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php  if(isset($arrck5['AL92_fi'])){ echo tim($arrck5['AL92_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php  if(isset($arrck6['AL92_be'])){ echo tim($arrck6['AL92_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php  if(isset($arrck6['AL92_fi'])){ echo tim($arrck6['AL92_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AL92_tot'])){ echo $AR['AL92_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AL92_note'])){  echo $AR['AL92_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ระบบไฟฟ้าขัดข้อง</td>
   <td valign="middle"  >AU98</td>
   <td><div  class="incell"> <?php if(isset($arrck1['AU98_be'])){ echo tim($arrck1['AU98_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AU98_fi'])){  echo tim($arrck1['AU98_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AU98_be'])){  echo tim($arrck2['AU98_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AU98_fi'])){  echo tim($arrck2['AU98_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AU98_be'])){  echo tim($arrck3['AU98_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AU98_fi'])){  echo tim($arrck3['AU98_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AU98_be'])){  echo tim($arrck4['AU98_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AU98_fi'])){  echo tim($arrck4['AU98_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AU98_be'])){  echo tim($arrck5['AU98_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AU98_fi'])){  echo tim($arrck5['AU98_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AU98_be'])){  echo tim($arrck6['AU98_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AU98_fi'])){  echo tim($arrck6['AU98_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AU98_tot'])){ echo $AR['AU98_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AU98_note'])){  echo $AR['AU98_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ระบบลม/STEAM</td>
   <td valign="middle"  >AU99</td>
  <td><div  class="incell"> <?php if(isset($arrck1['AU99_be'])){ echo tim($arrck1['AU99_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AU99_fi'])){  echo tim($arrck1['AU99_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AU99_be'])){  echo tim($arrck2['AU99_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AU99_fi'])){  echo tim($arrck2['AU99_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AU99_be'])){  echo tim($arrck3['AU99_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AU99_fi'])){  echo tim($arrck3['AU99_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AU99_be'])){  echo tim($arrck4['AU99_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AU99_fi'])){  echo tim($arrck4['AU99_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AU99_be'])){  echo tim($arrck5['AU99_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php  if(isset($arrck5['AU99_fi'])){ echo tim($arrck5['AU99_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AU99_be'])){ echo tim($arrck6['AU99_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AU99_fi'])){  echo tim($arrck6['AU99_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AU99_tot'])){ echo $AR['AU99_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['AU99_note'])){ echo $AR['AU99_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >รอน้ำ(Cool,Hot,Pure,Chilled)</td>
   <td valign="middle"  >AU97</td>
   <td><div  class="incell"> <?php if(isset($arrck1['AU97_be'])){ echo tim($arrck1['AU97_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['AU97_fi'])){  echo tim($arrck1['AU97_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AU97_be'])){  echo tim($arrck2['AU97_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['AU97_fi'])){  echo tim($arrck2['AU97_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AU97_be'])){  echo tim($arrck3['AU97_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['AU97_fi'])){  echo tim($arrck3['AU97_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AU97_be'])){  echo tim($arrck4['AU97_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['AU97_fi'])){  echo tim($arrck4['AU97_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AU97_be'])){  echo tim($arrck5['AU97_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['AU97_fi'])){  echo tim($arrck5['AU97_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AU97_be'])){  echo tim($arrck6['AU97_be']); }  ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['AU97_fi'])){  echo tim($arrck6['AU97_fi']); }  ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['AU97_tot'])){ echo $AR['AU97_tot']; } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['AU97_tot'])){ echo $AR['AU97_note']; } ?> 
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >รอ IR</td>
   <td valign="middle"  >AL93</td>
   <td><div  class="incell"><?php if(isset($arrck1['AL93_be'])){ echo tim($arrck1['AL93_be']); } ?> 
   </div></td>
   <td ><div  class="incell"><?php if(isset($arrck1['AL93_fi'])){  echo tim($arrck1['AL93_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck2['AL93_be'])){  echo tim($arrck2['AL93_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck2['AL93_fi'])){  echo tim($arrck2['AL93_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AL93_be'])){  echo tim($arrck3['AL93_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck3['AL93_fi'])){  echo tim($arrck3['AL93_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck4['AL93_be'])){  echo tim($arrck4['AL93_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck4['AL93_fi'])){  echo tim($arrck4['AL93_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck5['AL93_be'])){  echo tim($arrck5['AL93_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck5['AL93_fi'])){  echo tim($arrck5['AL93_fi']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck6['AL93_be'])){  echo tim($arrck6['AL93_be']); } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck6['AL93_fi'])){  echo tim($arrck6['AL93_fi']);  } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['AL93_tot'])){ echo $AR['AL93_tot']; } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['AL93_tot'])){  echo $AR['AL93_note']; } ?>
   </div></td>
   </tr>
 <tr style="height:17px;">
   <td valign="middle"  >ระบบ UV ขัดข้อง</td>
   <td valign="middle"  >BMED</td>
   <td><div  class="incell"> <?php if(isset($arrck1['BMED_be'])){ echo tim($arrck1['BMED_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['BMED_fi'])){ echo tim($arrck1['BMED_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['BMED_be'])){ echo tim($arrck2['BMED_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['BMED_fi'])){ echo tim($arrck2['BMED_fi']); }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['BMED_be'])){ echo tim($arrck3['BMED_be']); }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['BMED_fi'])){ echo tim($arrck3['BMED_fi']); }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['BMED_be'])){ echo tim($arrck4['BMED_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['BMED_fi'])){ echo tim($arrck4['BMED_fi']); }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['BMED_be'])){ echo tim($arrck5['BMED_be']); }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['BMED_fi'])){ echo tim($arrck5['BMED_fi']); }?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['BMED_be'])){ echo tim($arrck6['BMED_be']); }?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($arrck6['BMED_fi'])){ echo tim($arrck6['BMED_fi']); }?>
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['BMED_tot'])){ echo $AR['BMED_tot']; } ?> 
   </div></td>
   <td><div  class="incell"><?php if(isset($AR['BMED_note'])){  echo $AR['BMED_note']; } ?> 
   </div></td>
   </tr>
   <tr style="height:17px;">
   <td valign="middle"  >Load Cell/เครื่องชั่งชำรุด</td>
   <td valign="middle"  >BMEY</td>
   <td><div  class="incell"> <?php if(isset($arrck1['BMEY_be'])){ echo tim($arrck1['BMEY_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['BMEY_fi'])){  echo tim($arrck1['BMEY_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['BMEY_be'])){  echo tim($arrck2['BMEY_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['BMEY_fi'])){  echo tim($arrck2['BMEY_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['BMEY_be'])){  echo tim($arrck3['BMEY_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['BMEY_fi'])){  echo tim($arrck3['BMEY_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['BMEY_be'])){  echo tim($arrck4['BMEY_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['BMEY_fi'])){  echo tim($arrck4['BMEY_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['BMEY_be'])){  echo tim($arrck5['BMEY_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['BMEY_fi'])){  echo tim($arrck5['BMEY_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['BMEY_be'])){  echo tim($arrck6['BMEY_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['BMEY_fi'])){  echo tim($arrck6['BMEY_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['BMEY_tot'])){ echo $AR['BMEY_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['BMEY_note'])){  echo $AR['BMEY_note']; } ?> 
   </div></td>
   </tr>
   <tr style="height:17px;">
   <td valign="middle"  >
   <?php if(isset($arrinfo['DW1_code'])){ 
		if($arrinfo['DW1_code']=='MX001'){
			echo 'Stock full ประเมินไม่ผลิตต่อ';
		}elseif($arrinfo['DW1_code']=='MX002'){
			echo 'รอปั้มถ่ายเก็บ semi';
			}elseif($arrinfo['DW1_code']=='MX003'){
				echo 'รอปั้ม IR';
				}elseif($arrinfo['DW1_code']=='MX004'){
					echo 'Confirm semi';
					}elseif($arrinfo['DW1_code']=='MX100'){
			echo 'อื่นๆ';
		}else{ echo '-'; }
    } 
   
   ?>
   </td>
   <td valign="middle"  ><div id="inDW1"><?php if(isset($arrinfo['DW1_code'])){ echo $arrinfo['DW1_code']; } ?></div></td>
   <td><div  class="incell"> <?php if(isset($arrck1['DW1_be'])){ echo tim($arrck1['DW1_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['DW1_fi'])){  echo tim($arrck1['DW1_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['DW1_be'])){  echo tim($arrck2['DW1_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['DW1_fi'])){  echo tim($arrck2['DW1_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['DW1_be'])){  echo tim($arrck3['DW1_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['DW1_fi'])){  echo tim($arrck3['DW1_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['DW1_be'])){  echo tim($arrck4['DW1_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['DW1_fi'])){  echo tim($arrck4['DW1_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['DW1_be'])){  echo tim($arrck5['DW1_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['DW1_fi'])){  echo tim($arrck5['DW1_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['DW1_be'])){  echo tim($arrck6['DW1_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['DW1_fi'])){  echo tim($arrck6['DW1_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['DW1_tot'])){ echo $AR['DW1_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['DW1_note'])){  echo $AR['DW1_note']; } ?> 
   </div></td>
   </tr>
   <tr style="height:17px;">
   <td valign="middle"  ><?php if(isset($arrinfo['DW2_code'])){ 
		if($arrinfo['DW2_code']=='MX001'){
			echo 'Stock full ประเมินไม่ผลิตต่อ';
		}elseif($arrinfo['DW2_code']=='MX002'){
			echo 'รอปั้มถ่ายเก็บ semi';
			}elseif($arrinfo['DW2_code']=='MX003'){
				echo 'รอปั้ม IR';
				}elseif($arrinfo['DW2_code']=='MX004'){
					echo 'Confirm semi';
					}elseif($arrinfo['DW2_code']=='MX100'){
			echo 'อื่นๆ';
		}else{ echo '-'; }
    } 
   
   ?></td>
   <td valign="middle"  ><div id="inDW1"><?php if(isset($arrinfo['DW2_code'])){ echo $arrinfo['DW2_code']; } ?></div></td>
   <td><div  class="incell"> <?php if(isset($arrck1['DW2_be'])){ echo tim($arrck1['DW2_be']); } ?> 
   </div></td>
   <td ><div  class="incell"> <?php if(isset($arrck1['DW2_fi'])){  echo tim($arrck1['DW2_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['DW2_be'])){  echo tim($arrck2['DW2_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck2['DW2_fi'])){  echo tim($arrck2['DW2_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['DW2_be'])){  echo tim($arrck3['DW2_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck3['DW2_fi'])){  echo tim($arrck3['DW2_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['DW2_be'])){  echo tim($arrck4['DW2_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck4['DW2_fi'])){  echo tim($arrck4['DW2_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['DW2_be'])){  echo tim($arrck5['DW2_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck5['DW2_fi'])){  echo tim($arrck5['DW2_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['DW2_be'])){  echo tim($arrck6['DW2_be']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($arrck6['DW2_fi'])){  echo tim($arrck6['DW2_fi']); } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['DW2_tot'])){ echo $AR['DW2_tot']; } ?> 
   </div></td>
   <td><div  class="incell"> <?php if(isset($AR['DW2_note'])){  echo $AR['DW2_note']; } ?> 
   </div></td>
   </tr>
   <tr style="height:17px;">
   <td colspan="11" valign="middle"  >
   <div class="line">
   PRODUCTION TIME = Total Time - AW.BDT.-M/C.BDT.
   </div>
   <div class="line">
   %ROP = (Production Time *100)/Total time
   </div>
   <div class="line">
   MACHINE EFF. = (Production Time * 100)/( Production time + M/C BDT.INT)
   </div>
   </td>
   <td colspan="6">
   <div class="line">
   <strong>Shift Leader</strong> : <?php echo $arrinfo['shiftleader']; ?> <strong>Line Leader</strong> : <?php echo $arrinfo['lineleader']; ?></div>
   <div class="line">&nbsp;
    :</div>
    <div class="line"><strong>พนักงาน</strong> : <?php echo $arrinfo['operater']; ?>
    </div>
    </td>
   </tr>
  </table>


 

	      <hr/>
<span id="layer">
 
</span>

</body>
</html>
