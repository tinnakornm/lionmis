<?php
    !isset($_GET['JID']) ? $JID='null'   : $JID=$_GET['JID'];
	?>
	<?php   !isset($_GET['mc']) ? $mc='ALL'   : $mc=$_GET['mc'];
  
  
  
   !isset($_GET['JID']) ? $JID='null'   : $JID=$_GET['JID']   ;
     !isset($_GET['step']) ? $step='null'   : $step=$_GET['step'];
  
	?>


 
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
		$q = mysql_query("SELECT * 
				FROM  `hr_quiztopic` AS d1
				INNER JOIN  `hr_quizlist` AS d2 ON ( d1.quiz_id = d2.quiz_id ) 
				INNER JOIN  `hr_quizchoice` AS d3 ON ( d2.list_id = d3.list_id ) 
				LIMIT 0 , 30".$_GET['q']."' LIMIT 0 , 1");
		$arrq = mysql_fetch_array($q);
		$e_status = $arrq['quiz_status'];
		$gr = $arrq['quiz_status'];
		
	}
	
 	


//query main spare part group detail.
 if(isset($gr)){
	 
 	$qgr = mysql_query("SELECT * 
				FROM  `hr_quiztopic` AS d1
				INNER JOIN  `hr_quizlist` AS d2 ON ( d1.quiz_id = d2.quiz_id ) 
				INNER JOIN  `hr_quizchoice` AS d3 ON ( d2.list_id = d3.list_id ) 
				LIMIT 0 , 30"); 
  //echo ("SELECT DISTINCT `quiz_name` FROM  `hr_quiztopic` ORDER BY  `quiz_name`.`quiz_name` ASC ");
	
	$arrgn = mysql_fetch_array($qgr);
	$sprg_describ = $arrgn['quiz_name'];
 }else{
	 $sprg_describ = '';
 }

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

<div data-role="content">
   <div class="title-header">
  <div style="float:left; font-size:24px; padding-top:15px;  padding-bottom:10px;"><strong>&raquo; <?php if($mn==1){ echo 'Special'; }else{ echo 'General'; } ?> Human result quiz topic</strong></div>
  <div id="info"></div>
 <div style="text-align:right; float:right;">
 
 
                  <table>
                  <tr>
                   <td>&nbsp;</td>
                    <td>&nbsp;</td> 
                      
                 	 <td>   
                     
                     <a href="#popupaddnewquiz"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex; background-color: rgb(51, 136, 204); color: #FFF;"  >เพิ่มข้อสอบ</a>
                     
                  </td>
                 </tr>
                 </table>
 </div>

 </div><!-- end title-header -->
  <div style="margin-top:60px;  padding-bottom:5px;"> ระบบข้อสอบออนไลน์  <?php echo $sprg_describ; ?></div>
    
  
 <table  style="width:100%;" id="tlb">
        <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
          <td width="20">No</td>
           
          <td width="500">List TITLE</td>
        	<td width="150">Img</td>
          
            <td width="50">Ans</td>
            
            <td width="50">เครื่องมือ</td>
         </tr>
         
         
        <?php if(isset($_GET['q'])){
			 $qquiztopic = " AND spr_mtcode LIKE  '".$_GET['q']."' ";
		 }else{
			 $qquiztopic = '';
		 }
		
		 $qsp = mysql_query("SELECT `list_title` FROM `hr_quizlist`");			
		if(mysql_num_rows($qsp)){
			$i=1;
		 
			 
			 while($arrq = mysql_fetch_array($qsp)){ 		 
		?>
     
     	
      
            <tr  onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''" >
           <td><div style="text-align:center;"><?php echo $i; ?></div></td>
           
           <td style="width:300px;"><div style="text-align:left;"><?php echo $arrq['list_title']; ?></div></td>
           
           
            <td>
            </td> 
            <td style="width:300px;"><div style="text-align:right;">
             <a href="#popupNewQuiz"  data-ajax="false" id="plusForm" class="ui-btn ui-shadow ui-corner-all ui-icon-plus ui-btn-icon-notext " style="display: inline-flex;" data-iconpos="right" ></a></div> 
            <?php $qs = mysql_query("SELECT DISTINCT`choice_prefix`,`choice_title` FROM `hr_quizchoice`");
			
			 while($arrq = mysql_fetch_array($qs)){ 
			 
			 ?>
             <div>
              <?php echo $arrq['choice_prefix'];?>
			<?php echo $arrq['choice_title']; ?>
     
          
           
 			<a href="#popupEQuiz"data-rel="popup" data-position-to="window" data-transition="pop"  data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c"  >(Edit)</a>
            </div>
          
           <?php  } ?>
          
		   
    		</td>
           
           
           <td>
           <div style="text-align:center;">
           <a href="#" data-ajax="false" id="editForm" data-transition="pop"  class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext " style="display: inline-flex;">แก้ไขข้อสอบ</a>
            
           </div> 
            </td>
       </tr>
        
          <?php $i++; } }else{ ?>
          <?php } ?>
        
        </table>
<!-- //end tlb sparepart -->
</div><!-- End data-role content -->

<!-- Popup Start -->
 <?php include("components/page/subpast/popup_new_quiz_list.php"); ?>

</div><!--- end content-sparepart -- >


 
  

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
	