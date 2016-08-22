
<?php

	require('../../include/config.inc.php'); 
	 mysql_select_db($db); 
	$strSQL = "DELETE FROM p3mx_pd ";
	$strSQL .="WHERE id = '".$_GET["id"]."' ";
	$objQuery = mysql_query($strSQL);
	if($objQuery)
	{
echo "<center>Record Deleted.</center>";
		echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli/pdmis/bcmx300/leadadmin/?f=0&page=2&mc=".$_GET['mc']."#&ui-state=dialog'>";
}
else
	{
		echo "<center>Error Delete [".$strSQL."]</center>";
	}
	


	
?>

