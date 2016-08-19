<?php session_start(); 

echo 'สวัสดี | '; 
echo $_SESSION['login_true']; 
echo '<div style="font-size:10px; color:#666;"> เวลา session :';
echo date('Y/m/d H:i:s', time());
echo '</div>';
 ?>