<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dupplicate</title>
</head>

<body>

<?php

require('../../include/config.inc.php'); 
 mysql_select_db($db); 

$strSQL = "SELECT * FROM p3mx_pd WHERE id = '".$_GET["id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Not found ID=".$_GET["id"];
}
else
{
}
?>
<form action="insert_dup.php" method="post" >
<table width="100%" border="1">
  <tr>
    <th width="2%"> <div align="center">PD Group </div></th>
    <th width="35"> <div align="center">Process</div></th>
    <th width="74"> <div align="center">Formula </div></th>
    <th width="56"> <div align="center">Version </div></th>
    <th width="80"> <div align="center">Fullformula </div></th>
    <th width="30"> <div align="center">Mixer </div></th>
    <th  width="80"> <div align="center">Definition </div></th>
    <th  width="30"> <div align="center">Status </div></th>
    <th  width="30"> <div align="center">Product Name </div></th>
    <th  width="30"> <div align="center">Create By </div></th>
    <th  width="30"> <div align="center">Create Date </div></th>
    <th  width="30"> <div align="center">Effective Date </div></th>
    <th  width="30"> <div align="center">Revision </div></th>
    <th  width="30"> <div align="center">Batch Size </div></th>
  </tr>
  <tr>
    <td><input type="text" name="txtpdgroup" size="10" value="<?php echo $objResult["pd_group"];?>" /></td>
    <td><input type="text" name="txtprocess" size="10" value="<?php echo $objResult["process"];?>" /></td>
    <td><div align="center">
      <input type="text" name="txtformula" size="5" value="<?php echo $objResult["formula"];?>" />
    </div></td>
    <td align="right"><input type="text" name="txtversion" size="5" value="<?php echo $objResult["version"];?>" /></td>
    <td align="right"><input type="text" name="txtfullformula" size="10" value="<?php echo $objResult["fullformula"];?>" /></td>
    <td align="right"><input type="text" name="txtmixer" size="10" value="<?php echo $objResult["mixer"];?>" /></td>
    <td align="right"><input type="text" name="txtdefinition" size="5" value="<?php echo $objResult["definition"];?>" /></td>
    <td align="right"><input type="text" name="txtstatus" size="5" value="<?php echo $objResult["status"];?>" /></td>
    <td align="right"><input type="text" name="txtproductname" size="5" value="<?php echo $objResult["product_name"];?>" /></td>
    <td align="right"><input type="text" name="txtcreateby" size="5" value="<?php echo $objResult["create_by"];?>" /></td>
    <td align="right"><input type="text" name="txtcreatedate" size="5" value="<?php echo $objResult["create_date"];?>" /></td>
    <td align="right"><input type="text" name="txteffectivedate" size="5" value="<?php echo $objResult["effective_date"];?>" /></td>
    <td align="right"><input type="text" name="txtrev" size="5" value="<?php echo $objResult["rev"];?>" /></td>
    <td align="right"><input type="text" name="txtbatchsize" size="5" value="<?php echo $objResult["batch_size"];?>" /></td>
  </tr>
</table>
<div  align="center">
    <input type="submit"  align="middle" name="submit" value="submit" />
  </div>
  </form>
</body>
</html>
