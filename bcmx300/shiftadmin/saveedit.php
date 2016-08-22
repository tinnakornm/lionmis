

<?php
require('../../include/config.inc.php'); 
 mysql_select_db($db); 
 
 
    $strSQL = "UPDATE `p3mx_pd` SET ";
	$strSQL .="pd_group = '".$_POST["pd_group"]."' ";
	$strSQL .=",process = '".$_POST["process"]."' ";
	$strSQL .=",formula = '".$_POST["formula"]."' ";
	$strSQL .=",version = '".$_POST["version"]."' ";
	$strSQL .=",fullformula = '".$_POST["fullformula"]."' ";
	$strSQL .=",mixer = '".$_POST["mixer"]."' ";
	$strSQL .=",definition = '".$_POST["definition"]."' ";
	$strSQL .=",status = '".$_POST["status"]."' ";
	$strSQL .=",product_name = '".$_POST["product_name"]."' ";
	$strSQL .=",create_by = '".$_POST["create_by"]."' ";
	$strSQL .=",create_date = '".$_POST["create_date"]."' ";
	$strSQL .=",effective_date = '".$_POST["effective_date"]."' ";
	$strSQL .=",rev = '".$_POST["rev"]."' ";
	$strSQL .=",batch_size = '".$_POST["batch_size"]."' ";
	$strSQL .=",dev = '".$_POST["dev"]."' ";
	$strSQL .="WHERE id = '".$_POST["id"]."' ";
	$objQuery = mysql_query($strSQL);
	
if($objQuery)
	{
		echo "0";
	}
	else
	{
		echo "<center>Error Save [".$strSQL."]</center>";
	}
?>
