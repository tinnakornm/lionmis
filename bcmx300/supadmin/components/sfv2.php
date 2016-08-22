<?php
/*	File Name    : sfv2.php
    	Project No   : P002
    	Create Date  : 03/05/2015
	Create by    : Tinnakorn.M
	Description  : OEE Save page Move server from srcinfo.sli
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
 		         
        - 31/03/2015 : [Card No:-], Ajax posted by class, By Tinnakorn.M
		-04-07-2015 : [Card No:-], Add free DW1, DW2 Downtime, By Tinnakorn.M
		
	    (Case backup)
            - DD/MM/YYYY : Backup, File name :  , By Tinnakorn.M
	       
*/
##########################################################################################
session_start();
	if(!session_is_registered("login_true")){
	echo"กรุณาเข้าสู่ระบบอีกครั้ง";
	exit;
	}
 require('../../../include/config.inc.php'); 
// echo $_GET['id']." and s = ".$_GET['a'];

 mysql_select_db($db); 
 

 //Posted 1
if(isset($_POST['T'])){ $T=$_POST['T']; }else{
	echo 'Error on posted v2.0, no value of T';
	exit;
}
if(isset($_POST['note'])){ $note = $_POST['note']; }else{ $note=""; }

 
 //repinfo & Autoloadbatch
 if(!isset($_SESSION["DD"])){
	$qinfo = mysql_query("SELECT *  FROM  `p2mx_f_rep`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' LIMIT 0 , 1");
	if(!mysql_num_rows($qinfo)){  echo "Error! No report on database"; exit();  }else{
	   $arrinfo = mysql_fetch_array($qinfo);	
	   //check if not session DD, MM, YYY
	    $_SESSION['DD'] = $arrinfo['DD'];
		$_SESSION['MM'] = $arrinfo['MM'];
		$_SESSION['YYYY'] = $arrinfo['YYYY'];
	 
	}
 }
 
 
 
	 //search history 
	 
	 $qh1 =mysql_query("SELECT GIDF, approved FROM  `p2mx_f_check`  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =$T LIMIT 0 , 1");
	 if(mysql_num_rows($qh1)){
		 $arrq = mysql_fetch_array($qh1);
		 if($arrq['approved']==1){
			 echo 'รายงานของคุณถูกตรวจสอบโดยบัญชีแล้ว โปรดติดต่อเจ้าหน้าที่บัญชีเพื่อดำเนินการแก้ไข';
			 exit;
		 }
	 }
	 
	 if(!mysql_num_rows($qh1)){
	 $q1 = "INSERT INTO `lionproduction`.`p2mx_f_check` (`id`, `GIDF`, `DD`, `MM`, `YYYY`, `order`, `product`, `batch_no`, `batch_ton`, `quality`, `storage`, `mix_be`, `mix_fi`, `analy_be`, `analy_fi`, `transf_be`, `transf_fi`, `AD19_be`, `AD19_fi`, `AD20_be`, `AD20_fi`, `AD25_be`, `AD25_fi`, `AD51_be`, `AD51_fi`, `AD54_be`, `AD54_fi`, `AK01_be`, `AK01_fi`, `AD53_be`, `AD53_fi`, `AD13_be`, `AD13_fi`, `AD61_be`, `AD61_fi`, `AD10_be`, `AD10_fi`, `AD97_be`, `AD97_fi`, `BMEX_be`, `BMEX_fi`, `AQ92_be`, `AQ92_fi`, `AQ94_be`, `AQ94_fi`, `AL92_be`, `AL92_fi`, `AU98_be`, `AU98_fi`, `AU99_be`, `AU99_fi`, `AU97_be`, `AU97_fi`, `AL93_be`, `AL93_fi`, `BMED_be`, `BMED_fi`, `BMEY_be`, `BMEY_fi`, `checkby`, `note`, `check_order`, `DW1_be`, `DW1_fi`, `DW2_be`, `DW2_fi`) VALUES (NULL, '".$_SESSION['GIDF']."', '".$_SESSION['DD']."', '".$_SESSION['MM']."', '".$_SESSION['YYYY']."', '".$_POST['order']."', '".$_POST['product']."', '".$_POST['batch_no']."', '".$_POST['batch_ton']."', '".$_POST['quality']."', '".$_POST['storage']."', '".$_POST['mix_be']."', '".$_POST['mix_fi']."', '".$_POST['analy_be']."', '".$_POST['analy_fi']."', '".$_POST['transf_be']."', '".$_POST['transf_fi']."', '".$_POST['AD19_be']."', '".$_POST['AD19_fi']."', '".$_POST['AD20_be']."', '".$_POST['AD20_fi']."', '".$_POST['AD25_be']."', '".$_POST['AD25_fi']."', '".$_POST['AD51_be']."', '".$_POST['AD51_fi']."', '".$_POST['AD54_be']."', '".$_POST['AD54_fi']."', '".$_POST['AK01_be']."', '".$_POST['AK01_fi']."', '".$_POST['AD53_be']."', '".$_POST['AD53_fi']."', '".$_POST['AD13_be']."', '".$_POST['AD13_fi']."', '".$_POST['AD61_be']."', '".$_POST['AD61_fi']."', '".$_POST['AD10_be']."', '".$_POST['AD10_fi']."', '".$_POST['AD97_be']."', '".$_POST['AD97_fi']."', '".$_POST['BMEX_be']."', '".$_POST['BMEX_fi']."', '".$_POST['AQ92_be']."', '".$_POST['AQ92_fi']."', '".$_POST['AQ94_be']."', '".$_POST['AQ94_fi']."', '".$_POST['AL92_be']."', '".$_POST['AL92_fi']."', '".$_POST['AU98_be']."', '".$_POST['AU98_fi']."', '".$_POST['AU99_be']."', '".$_POST['AU99_fi']."', '".$_POST['AU97_be']."', '".$_POST['AU97_fi']."', '".$_POST['AL93_be']."', '".$_POST['AL93_fi']."', '".$_POST['BMED_be']."', '".$_POST['BMED_fi']."', '".$_POST['BMEY_be']."', '".$_POST['BMEY_fi']."', '".$_SESSION['name']."', '".$note."', '$T', '".$_POST['DW1_be']."', '".$_POST['DW1_fi']."', '".$_POST['DW2_be']."', '".$_POST['DW2_fi']."')";  
	 }else{
	 //insert q1;
	 $q1 = "UPDATE  `lionproduction`.`p2mx_f_check` SET  `order` =  '".$_POST['order']."',
`product` =  '".$_POST['product']."',`batch_no` =  '".$_POST['batch_no']."',`batch_ton` =  '".$_POST['batch_ton']."',
`quality` =  '".$_POST['quality']."',`storage` =  '".$_POST['storage']."',
`mix_be` =  '".$_POST['mix_be']."',`mix_fi` =  '".$_POST['mix_fi']."',
`analy_be` =  '".$_POST['analy_be']."',`analy_fi` =  '".$_POST['analy_fi']."',
 `transf_be` =  '".$_POST['transf_be']."',`transf_fi` =  '".$_POST['transf_fi']."',
 `AD19_be` =  '".$_POST['AD19_be']."',`AD19_fi` =  '".$_POST['AD19_fi']."',
 `AD20_be` =  '".$_POST['AD20_be']."',`AD20_fi` =  '".$_POST['AD20_fi']."',
 `AD25_be` =  '".$_POST['AD25_be']."',`AD25_fi` =  '".$_POST['AD25_fi']."',
 `AD51_be` =  '".$_POST['AD51_be']."',`AD51_fi` =  '".$_POST['AD51_fi']."',
 `AD54_be` =  '".$_POST['AD54_be']."',`AD54_fi` =  '".$_POST['AD54_fi']."',
 `AK01_be` =  '".$_POST['AK01_be']."',`AK01_fi` =  '".$_POST['AK01_fi']."',
 `AD53_be` =  '".$_POST['AD53_be']."',`AD53_fi` =  '".$_POST['AD53_fi']."',
 `AD13_be` =  '".$_POST['AD13_be']."',`AD13_fi` =  '".$_POST['AD13_fi']."',
 `AD61_be` =  '".$_POST['AD61_be']."',`AD61_fi` =  '".$_POST['AD61_fi']."',
 `AD10_be` =  '".$_POST['AD10_be']."',`AD10_fi` =  '".$_POST['AD10_fi']."',
 `AD97_be` =  '".$_POST['AD97_be']."',`AD97_fi` =  '".$_POST['AD97_fi']."',
 `BMEX_be` =  '".$_POST['BMEX_be']."',`BMEX_fi` =  '".$_POST['BMEX_fi']."',
 `AQ92_be` =  '".$_POST['AQ92_be']."',`AQ92_fi` =  '".$_POST['AQ92_fi']."',
 `AQ94_be` =  '".$_POST['AQ94_be']."',`AQ94_fi` =  '".$_POST['AQ94_fi']."',
 `AL92_be` =  '".$_POST['AL92_be']."',`AL92_fi` =  '".$_POST['AL92_fi']."',
 `AU98_be` =  '".$_POST['AU98_be']."',`AU98_fi` =  '".$_POST['AU98_fi']."',
 `AU99_be` =  '".$_POST['AU99_be']."',`AU99_fi` =  '".$_POST['AU99_fi']."',
 `AU97_be` =  '".$_POST['AU97_be']."',`AU97_fi` =  '".$_POST['AU97_fi']."',
 `AL93_be` =  '".$_POST['AL93_be']."',`AL93_fi` =  '".$_POST['AL93_fi']."',
 `BMED_be` =  '".$_POST['BMED_be']."',`BMED_fi` =  '".$_POST['BMED_fi']."',
 `BMEY_be` =  '".$_POST['BMEY_be']."',`BMEY_fi` =  '".$_POST['BMEY_fi']."',
 `DW1_be` =  '".$_POST['DW1_be']."',`DW1_fi` =  '".$_POST['DW1_fi']."' ,
 `DW2_be` =  '".$_POST['DW2_be']."',`DW2_fi` =  '".$_POST['DW2_fi']."'  
  WHERE  `GIDF` LIKE  '".$_SESSION['GIDF']."' AND  `check_order` =$T LIMIT 1;";
	 }
	 
	 
      mysql_query("SET NAMES UTF8");  	 
	  if(mysql_query($q1)){ echo '1'; }else{ echo '0';//send return error
	  }
      
 


 
?>

