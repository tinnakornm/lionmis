<?php   !isset($_GET['mn']) ? $mn=1   : $mn=$_GET['mn']   ;    ?>
  <?php   !isset($_GET['mc']) ? $mc='ALL'   : $mc=$_GET['mc']   ;
  
  
  
   !isset($_GET['JID']) ? $JID='null'   : $JID=$_GET['JID']   ;
     !isset($_GET['step']) ? $step='null'   : $step=$_GET['step']   ;
  
      ?>
<style type="text/css">
 
#tlb td, #tlb td th {
border: 1px solid #CCC;
padding: 4px;
font-size:13px;
}

.HIDDEN_LINE{ display:none; }
.BLOCK { background-color: #EFAEAE; }
.OK { background-color:#C6F5CA; } 
 

</style>
<?php
	//initial value
    if(!isset($_GET['mn'])){ $mn=1; }else{ $mn=$_GET['mn']; }
	if($mn==1){
		if(!isset($_GET['gr'])){ $gr = 'quiz_name'; }else{ $gr = $_GET['gr']; }	
		$sprg_type = 'quiz_name';
	}else{
		if(!isset($_GET['gr'])){ $gr = 'quiz_name'; }else{ $gr = $_GET['gr']; }
		$sprg_type = 'quiz_name';
	}
	
	//Check q
	if(isset($_GET['q'])){
		$q = mysql_query("SELECT * FROM  `hr_quiztopic` WHERE  `quiz_name` LIKE  '".$_GET['q']."' LIMIT 0 , 1");
		$arrq = mysql_fetch_array($q);
		$e_status = $arrq['quiz_status'];
		$gr = $arrq['quiz_status'];
		
	}
	
 	


//query main spare part group detail.
 if(isset($gr)){
	 
 	$qgr = mysql_query("SELECT DISTINCT `quiz_name` FROM  `hr_quiztopic` ORDER BY  `hr_quiztopic`.`quiz_name` ASC ");
  //echo ("SELECT DISTINCT `quiz_name` FROM  `hr_quiztopic` ORDER BY  `quiz_name`.`quiz_name` ASC ");
	
	$arrgn = mysql_fetch_array($qgr);
	$sprg_describ = $arrgn['quiz_name'];
 }else{
	 $sprg_describ = '';
 }

?>
		 

     
<?php //SAP RFC
 include_once ("../../include/sap/sapclasses/sap.php");
 include_once ("../../include/sap/sapclasses/examples/sapserverconnect.php");?>
 
<link href="../../../leadamin/include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.1.css"  />
<script type="text/javascript" src="../../../leadadmin/components/page/js/register.js"></script>

  <script type="text/javascript">
$(document).ready(function(){
			$('#select-10-button').removeClass('ui-corner-all');
	$('#select-9-button').removeClass('ui-corner-all');
	});
	
	
 
//-->
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
  </script>       
  
  
 

 
 
<div id="content-sparepart" style="margin-left:10px; margin-right:10px; margin-top:10px;">              
<table  border="0" cellpadding="0" style=" width: 100%;">
 <tr>



    <div style="text-align:right; width: 80%;
    float: right; margin-right:18px;">
 
<ul id="autocomplete" data-role="listview" data-inset="true" data-filter="true" data-input="#autocomplete-input" 
style="position: absolute; z-index: 1110;"
></ul>
          
    </div>  </td>
    </tr>
</table>

<!-- Sub menu -->
 
<!--//End sub menu -->
<div data-role="content">
   <div class="title-header">
  <div style="float:left; font-size:24px; padding-top:15px;  padding-bottom:10px;"><strong>&raquo; <?php if($mn==1){ echo 'Special'; }else{ echo 'General'; } ?> Human result quiz topic</strong></div>
  <div id="info"></div>
 <div style="text-align:right; float:right;">
 
 
                  <table>
                  <tr>
                   <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                     
                    
                  <td> <a href="#popupNewQuiz"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex; background-color: rgb(51, 136, 204); color: #FFF;"  >Add quick topic</a>
 
               
                  
                  </td>
                 </tr>
                 </table>
 </div>
  </div><!-- end title-header -->
  <div style="margin-top:60px;  padding-bottom:5px;"> ระบบข้อสอบออนไลน์ </div>
    

<!-- tbl sparepart -->
  <table  style="width:100%;" id="tlb">
        <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
          <td width="50">No</td>
           
          <td width="400">ชื่อชุดข้อสอบ</td>
        	<td>สถานะ</td>
          
            <td width="300">เปิดใช้เมื่อ</td>
            
            <td width="100">เครื่องมือ</td>
         </tr>
         
         
        <?php if(isset($_GET['q'])){
			 $qMatchCode = " AND spr_mtcode LIKE  '".$_GET['q']."' ";
		 }else{
			 $qMatchCode = '';
		 }
		
		 $qsp = mysql_query("SELECT * FROM  `hr_quiztopic` WHERE 1"); 
		 if(mysql_num_rows($qsp)){
			 $i=1;
		 
			 
			 while($arrq = mysql_fetch_array($qsp)){ 		 
		?>
        
     
     	
      
            <tr  onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
           <td><div style="text-align:center;"><?php echo $i; ?></div></td>
           <td style="width:300px;"><div style="text-align:center;"><?php echo $arrq['quiz_name']; ?></div></td>
              <td>
            <div style="text-align:center;">
             <?php if($arrq['quiz_status']=='0'){
				 echo '<span style="color:black;" >ร่าง<span></a>';
			 }elseif($arrq['quiz_status']=='1'){
				 echo '<span style="color: green;">ใช้งาน</span>';
			 
			 }elseif($arrq['quiz_status']=='3'){
				 echo '<span style="color: red;">ยกเลิก</span>';
			 }
			 
			  ?>  
             </div>
             </td>
           
            
            <td style="width:250px;"><div style="text-align:center;"><?php echo $arrq['quiz_date']; ?></div></td>
            
           
            
           
            <td>
			
           <div style="text-align:center;">
		   
           <a href="?f=3&amp;mn=<?php echo $arrq['quiz_id']; ?>"data-ajax="false" id="editForm" data-transition="pop"  class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext " style="display: inline-flex;">แก้ไขข้อสอบ</a>
            <a href="../../hr/leadadmin/rep/topic.php"<?php if($mn==2)?>  target="#" data-ajax="false" class="ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext" style="display: inline-flex;" title="Print">ดูข้อสอบ</a>
           </div> 
            </td>
            
        </tr>
        
          <?php $i++; }//end while
		  }else{ ?>
        <tr>   <td colspan="11"><div style="text-align:center;"> ไม่มีรายงานที่ท่านค้นหา  </div></td> </tr>
          <?php } ?>
        
        </table>
<!-- //end tlb sparepart -->
</div><!-- End data-role content -->

</div><!--- end content-sparepart -- >
<!-- Popup -->
 <?php include("components/page/subpast/popup_new_quiz.php");
 
 
    

 
   
                    
                 
                   
               
       
         
   
              
              
              
              
              
              
              
              
              
           