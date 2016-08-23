 <?php 
   $qstring = mysql_query("SELECT * 
FROM  `qamx_rep` 
WHERE (
`qa_uname` LIKE  '".$_SESSION['uname']."'
OR  `qa_uname_p1` LIKE  '".$_SESSION['uname']."'
)
AND  `rep_status` =2
LIMIT 0 , 30");
 
 ?>
<script type="text/javascript" src="js/frm-pe-031.js"></script> 

<style type="text/css">
 
#tlb td, #tlb td th {
border: 1px solid #CCC;
padding: 4px;
background-color:#FFF;
}
 
input { border:none; color:#0000FF;  text-align:center; padding-top:0px; padding-bottom:0px; width:100%; }
input:hover { background:#FFCCCC;   color:#FF0000; }

.tim{ cursor:cell; }
.blur{ color:#CCC;}

 .checked{ padding-top:8px; padding-bottom:8px; color:#FFF; background-color:#060; font-weight:bold; }
 .pend-recive{
	padding-top: 8px;
	padding-bottom: 8px;
	color: #600;
	background-color: #FF3;
	font-weight: bold;
}

a.pend-recive {text-decoration:none;}

</style>


<div data-role="content">
 
  <div style="float:left; font-size:24px; padding-top:15px; padding-left:8px;">
<strong> 
  ระบบ HR Lead Admin
</strong>
 </div>
 
  
   
        

  <div class="ui-body ui-body-a ui-corner-all">
      

		<h3>ยินดีต้อนรับสู่ระบบการจัดการข้อสอบออนไลน์</h3>
        
        
         
           <strong>คุณสามารถ</strong>
      <ul>
      <li>สามารถเพิ่มเติม /แก้ไข /เปลี่ยนเเปลงระบบข้อสอบออนไลน์ได้</li>
<li>สามาถรตรวจสอบรายชื่อ และผลการสอบของผู้ทำข้อสอบได้</li>
        </ul>
        
          
		 <p><span style="color:red"><strong>ประกาศมายังหน่วยงาน HR ทุกท่าน</strong><br />
			** ระบบเพิ่มเริ่มใช้งาน</span></p>
		  
		  </div>  
        
        
 </div><!--end div data-role content -->
 
 
		
		
		
 

 


			
		
		
 
        

        