<?php session_start();
// show display
		if(!empty($_SESSION['display']))
		{
			echo '<div id="alert">' . $_SESSION['display'] . '</div>';
			unset($_SESSION['display']);
		}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title>PDMIS</title>
	<link rel="stylesheet"  href="pdmis/include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	<style type="text/css">
	body {
	background-color: #FFFFFF;
}
    </style>
	<script src="pdmis/include/lib/jquery1.10.2.min.js"></script>
	<script src="pdmis/include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
 
 <script  language="javascript">
   // mozfullscreenerror event handler
function errorHandler() {
   alert('mozfullscreenerror');
}
document.documentElement.addEventListener('mozfullscreenerror', errorHandler, false);

// toggle full screen
function toggleFullScreen() {
  if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.cancelFullScreen) {
      document.cancelFullScreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitCancelFullScreen) {
      document.webkitCancelFullScreen();
    }
  }
}

// keydown event handler
/*
document.addEventListener('keydown', function(e) {
  if (e.keyCode == 13 || e.keyCode == 70) { // F or Enter key
    toggleFullScreen();
  }
}, false);
*/
  
 </script>
 
 
</head>



<body>
 
<div data-role="page" id="page1" style="text-align: center; margin: auto;  background-image: url(http://lionproduction.sli/pdmis/source/bg4.jpg); background-size: cover; background-position-x: inherit; background-repeat: no-repeat;" >
  
 
 <div style="max-width: 500px;  margin: auto; background: rgba(255, 255, 255, 0.44);
    margin-top: 50px;     
    -webkit-border-radius: 4px;
    border-radius: 4px;" class="block"> 
      
      <div style="height:30px;">      
      </div>    
         <div style="height:30px; text-align:center; padding-top:60px; color:#030;">
         <h3>
<span style="color: #485182;">
       LION<strong>  <em> MIS </em>    PRODUCTION SYSTEM</strong>
</span>
       
       </h3>
      </div>   
      <br/>
    <div data-role="content" style="text-align:center; margin:auto;   height:200px;">
 
 <span style="color:#F00">   
     *Tips : กด F11 เพื่อแสดงผลแบบเต็มจอ
     </span>
        
        <form action="pdmis/components/singin.php" method="post" data-ajax="false">
        <table style="margin:auto; text-align:center;">
       
           <tr><td>ชื่อผู้ใช้งาน </td><td> <input name="user_login" id="user_login"   placeholder="ชื่อผู้ใช้งานของคุณ" value="" type="text"></td></tr>
           <tr><td>รหัสผ่าน </td><td><input name="pwd_login" id="pwd_login" placeholder="รหัสผ่านของคุณ"  value="" type="password"></td></tr>
           <tr><td> </td><td>
           <div style="text-align:left;">
           <input type="submit" data-inline="true" data-theme="b" value="เข้าสู่ระบบ" >
           </div>
           </td></tr>
         </table>
         </form>   
         
    
        
  </div>
    <div style="padding:10px; margin:10px; height:100px;">
  <a href="http://lionproduction.sli/pdmis/user/index.php?dev=packing200" data-ajax="false">
    <img src="pdmis/mix200/img/icon_new2.gif" width="40" height="20">เพิ่ม / ตรวสอบ และแก้ไขบัญชีชื่อผู้ใช้งาน </a>
  <br/>
  
   <a href="http://lionweb.lct/php/qaiso/index.html" data-ajax="false" target="iso">
    <img src="pdmis/mix200/img/icon_new2.gif" width="40" height="20"> [ ISO Doc. ] ระบบเอกสาร ISO</a> 
  <br/>
  
   
  </div>
  </div><!--end block div -->
      
     
</div>
 
</body>
</html>
