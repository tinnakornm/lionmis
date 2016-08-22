 <?php 
/******************** MIS STANDARD HEADER ***********************	
File Name         : index.php
    Project No    : 
    Create Date  : 15/10/2015
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            22/08/2016 : Start project reversion, By Tinnakorn.M
/****************************************************************/
?>
<?
    if(!isset($_GET['dev'])){ $dev = 'StaffHH'; }else{ $dev=$_GET['dev']; }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LION PRODUCTION USER SETTING</title>
<link href="../style/mainstyle.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
	body{
		 font-size:14px;
	}
 
 
  table { border-collapse:collapse;}
	 table, th, td {
	border: 1px solid black;
	text-align: center;
	padding-top:1.5px;
	padding-bottom:1.5px;
	}

    </style>


<link href="../components/lightbox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../include/lib/jquery.min.js"></script>
<script type="text/javascript" src="../include/lib/lionjqery.js"></script>
<!-- facebox -->
  <script src="../components/lightbox/facebox.js" type="text/javascript"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '../components/lightbox/loading.gif',
        closeImage   : '../components/lightbox/closelabel.png'
      })
    })
    </script>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
</head>
<body>
<?php require('../include/config.inc.php'); ?>
<?php mysql_select_db($db); ?>
 
<center>
 
<div style="background-color:#999999; text-align:left; width:900; margin:5px; padding:5px;"><strong><a href="http://lionproduction.sli">&laquo; กลับไปหน้าหลัก</a></strong>| <a href="components/frm_new_user.php?dev=<?php echo $dev; ?>" rel="facebox"> +เพิ่มผู้ใช้งาน </a></div>	
	<table style="width:900px;">
	  <!--DWLayoutTable-->
	  <tr style="background-color:#CCCCCC;">
	<th width="164">หน่วยงาน</th>
	<th width="624">ข้อมูลบัญชีผู้ใช้งานหน่วยงาน <?php echo $dev; ?></th>
	</tr>
	  <tr>
	    <td height="489" valign="top">
		  <form name="form1">
		    <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
              <option value="?dev=StaffHH" <?php if($dev=='StaffHH'){ echo "selected=\"selected\""; } ?>>Staff Household</option>
              <option value="?dev=dy" <?php if($dev=='dy'){ echo "selected=\"selected\""; } ?>>dy</option>
              <option value="?dev=qa" <?php if($dev=='qa'){ echo "selected=\"selected\""; } ?>>qa</option>
              <option value="?dev=gs" <?php if($dev=='gs'){ echo "selected=\"selected\""; } ?>>gs</option>   
             
			  <option value="?dev=mix200" <?php if($dev=='mix200'){ echo "selected=\"selected\""; } ?>>mix200</option>
              <option value="?dev=packing100" <?php if($dev=='packing100'){ echo "selected=\"selected\""; } ?>>packing100</option>
			  <option value="?dev=packing200" <?php if($dev=='packing200'){ echo "selected=\"selected\""; } ?>>packing200</option>
              <option value="?dev=ocpk300" <?php if($dev=='ocpk300'){ echo "selected=\"selected\""; } ?>>ocpk300</option>
              <option value="?dev=bcpk300" <?php if($dev=='bcpk300'){ echo "selected=\"selected\""; } ?>>bcpk300</option>
              <option value="?dev=bcmx300" <?php if($dev=='bcmx300'){ echo "selected=\"selected\""; } ?>>bcmx300</option>
              <option value="?dev=ocmx300" <?php if($dev=='ocmx300'){ echo "selected=\"selected\""; } ?>>ocmx300</option>
              <option value="?dev=ocmx300-2" <?php if($dev=='ocmx300-2'){ echo "selected=\"selected\""; } ?>>ocmx300/2</option>
			   <option value="?dev=tb300" <?php if($dev=='tb300'){ echo "selected=\"selected\""; } ?>>tb300</option>
              <option value="?dev=mt" <?php if($dev=='mt'){ echo "selected=\"selected\""; } ?>>Maintenance</option>
            </select>
        </form>		</td>
	    <td valign="top">
		<div style="padding-left:5px; border:1px;" >
			<table style="width:100%; font-size:12px;" border="0" >
			<tr style="background:#E3E4E6;">
			<th width="13%">LION ID </th>
			<th width="15%">Username</th>
			<th width="26%">Name</th>
			<th width="14%">s_name</th>
			
			<th width="14%">Position</th>
			<th width="5%">Division</th>
			<th width="15%"> Tools </th>
			</tr>
				<?php 
 				 $qo ="SELECT * FROM `user` WHERE `dev` LIKE '$dev' ORDER BY  `user`.`lion_id` ASC ";  
		         $qro = mysql_query($qo);
	              while($arro = mysql_fetch_array($qro)){
			  
			?>
			
			<tr style="text-align:center;" onMouseOver="this.style.background='#E8F3F5'" onMouseOut="this.style.background=''">
			<td > <div style=" padding:3px; text-align:left;"><?php echo $arro['lion_id']; ?> </div></td>
			<td > <div style=" padding:3px; text-align:left;"><?php echo $arro['uname']; ?> </div></td>
			<td > <div style=" padding:3px; text-align:left;"><?php echo $arro['name']; ?> </div></td>
			<td > <div style=" padding:3px; text-align:left;"><?php echo $arro['s_name']; ?> </div></td>
		
			<td > <div style=" padding:3px; text-align:left;"><?php echo $arro['position']; ?> </div> </td>
			<td ><div style=" padding:3px; text-align:center;"><?php echo $arro['type']; ?> </div></td>
			<td><a href="components/frm_edit_user.php?id=<?php echo $arro['id']; ?>" rel="facebox">Edit</a> | เปลี่ยนรหัส </td>
			</tr>
			<?php } ?>
			
			</table>
		</div>
		</td>
      </tr>
	</table>
</center>
<?php include("../components/footer.php"); ?>
</body>
</html>
