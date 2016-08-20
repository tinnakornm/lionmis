<!-- Tab Contain : tab_machine_gr_manual.php by Tinnakorn.M 18/07/2016 -->
 <div style="width:100%; padding:5px; background-color: #E6EDF5;
    color: #38C;">
 ประวัติการแจ้งซ่อม อ้างอิงจากรายการการแจ้งซ่อมทั้งหมดในระบบ
 </div>
  <div style="width:100%; min-height:400px; background-color:#FFF; padding:5px;">
    <strong>ประวัติการแจ้งซ่อม</strong>
      
       <ul>
       <?php
	            require('../../../../../include/config.inc.php'); 
				mysql_select_db($db,$connect); 
				 
	           $qj = mysql_query("SELECT * FROM  `tpm_jobreq` WHERE  `mc_mainid` =".$_GET['main_id']." ORDER BY  `tpm_jobreq`.`jobreq_id` DESC  LIMIT 0 , 300");
	           while($arrj = mysql_fetch_array($qj)){
	    ?>
        <?php if($arrj['job_status']=='Pending'){ echo '<span style="color:red;">'; } ?>
            <li> <?php echo $arrj['date_send']; ?> - <?php echo $arrj['machine']; ?>: <?php echo $arrj['jobreq_detail']; ?> <strong> สถานะ </strong> : <?php echo $arrj['job_status']; ?> </li>
         <?php if($arrj['job_status']=='Pending'){ echo '</span>'; } ?>   
         <?php }//end while ?>
       		
            
       </ul>
    
    
  </div>
   

 
