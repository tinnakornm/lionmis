<?php
require('../../../include/config.inc.php'); 
 mysql_select_db($db);
 
 
$strSQL = "INSERT INTO `p3mx_pd` ";
$strSQL .="(`id`, `pd_group`, `process`,`formula`,`version`, `fullformula`, `mixer`, `definition`, `status`, `product_name`, `create_by`, `create_date`, `effective_date`, `rev`, `batch_size`, `dev`)";
$strSQL .="VALUES";
$strSQL .="('','".$_POST["pd_group"]."','".$_POST["process"]."','".$_POST["formula"]."',";
$strSQL .="'".$_POST["version"]."','".$_POST["fullformula"]."','".$_POST["mixer"]."',";
$strSQL .="'".$_POST["definition"]."','".$_POST["status"]."','".$_POST["product_name"]."',";
$strSQL .="'".$_POST["create_by"]."','".$_POST["create_date"]."','".$_POST["effective_date"]."', ";
$strSQL .="'".$_POST["rev"]."','".$_POST["batch_size"]."','".$_POST["dev"]."') ";
$objQuery = mysql_query($strSQL);

if($objQuery)
{
	echo "0";
}
else
{
	echo "Error Save [".$strSQL."]";
}
 ?> 