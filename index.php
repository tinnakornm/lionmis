<?php session_start();
	if(!session_is_registered("login_true")){
	echo"กรุณาเข้าสู่ระบบ";
	echo"<meta http-equiv='refresh' content='0; url=sigin.php'>";
	}
	require('include/config.inc.php');
	$login_true = $_SESSION['login_true'];
	
	// show display
		if(!empty($_SESSION['display']))
		{
			echo '<div id="alert">' . $_SESSION['display'] . '</div>';
			unset($_SESSION['display']);
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mixing plant 200 | ยินดีต้อนรับ</title>
<link href="style/mainstyle.css" rel="stylesheet" type="text/css" /></head>
<script type="text/javascript" src="include/lib/jquery.min.js"></script>
<script type="text/javascript" src="include/lib/lionjqery.js"></script>

<body>
<?php require('components/header.php'); ?>


<div style="background-color:#ACBCFB; text-align:left;"><strong>เมนู</strong>หลัก</div>
<div style="margin-top:10px; height:520px;">
  <div align="left">
   <div class="link_ipad"><a href="hh/">ศูนย์ข้อมูลกลาง HH</a></div>
   <div class="link_ipad"><a href="mix200/index.php">แผนก mixing </a></div>
  <div class="link_ipad"><a href="gs/index.php">แผนก gs </a></li>
  </div>
  <div class="link_ipad"><a href="tw/index.php">แผนก Tower1</a></li>
  </div> 
</div>
<?php require('components/footer.php'); ?>
</body>


</html>
