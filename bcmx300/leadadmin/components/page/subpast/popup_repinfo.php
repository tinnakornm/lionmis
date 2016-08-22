<!-- pouup report info --> 
<?php

		$qckp0 = mysql_query("SELECT check_result, check_result_note FROM  `qamxbc_check` WHERE  `QID` LIKE  '".$arrep['QID']."' LIMIT 0 , 1");
		if(mysql_num_rows($qckp0)){
			$arrck0=mysql_fetch_array($qckp0);
			 
		}else{ $pri0=false;  }
	
		
		?>


<div data-role="popup" id="rep-info-<?php echo $arrep['rep_id']; ?>" data-theme="a" class="ui-corner-all" style="max-width:650px;">
  <div data-role="header" data-theme="b" style="min-width:450px; max-width:650px;">
            <h2>ข้อมูลใบส่งตัวอย่าง</h2>
            </div>
            <div>
               <table style="width:100%;">
               
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">รหัสอ้างอิงระบบ </div></td><td><div style="padding:5px;"><?php echo $arrep['QID']; ?></div></td></tr>
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">วัน/เดือน/ปี </div></td><td><div style="padding:5px;"><?php echo $arrep['DD'].'/'.$arrep['MM'].'/'.$arrep['YYYY']; ?></div></td></tr>
      <tr   onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">Mixer</div></td><td><div style="padding:5px;"><?php echo $arrep['mix_no']; ?></div></td></tr>
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
       <td><div style="padding:5px;">Formula</div></td><td><div style="padding:5px;"><?php echo $arrep['fullformula']; ?></div></td></tr>
      </tr>
       <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
       <td><div style="padding:5px;">Order No.</div></td><td><div style="padding:5px;"><?php echo $arrep['order_no']; ?></div></td></tr>
      </tr>
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
        <td><div style="padding:5px;">Batch size </div></td><td><div style="padding:5px;"><?php echo $arrep['bt_size']; ?></div></td></tr>
      </tr>
        <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''">
        <td><div style="padding:5px;">Batch.No </div></td><td><div style="padding:5px;"><?php echo $arrep['bt_no']; ?></div></td></tr>
      </tr>
        
        <tr
        
        <?php if($arrep['rep_status']==0){ echo 'style=" background-color:#FF0; "'; 
		}elseif($arrep['rep_status']==1){ echo 'style=" background-color:#FF0; "'; 
		}elseif($arrep['rep_status']==2){ echo 'style=" background-color:orange; "'; 
		}elseif($arrep['rep_status']==3){ 
		    if($arrep['result_status']==0){ //no result
				echo 'style=" background-color:#3388cc; color:#FFF;  "';
			}elseif($arrep['result_status']==1){ //adj..
				echo 'style=" background-color:#3388cc; color:#FFF;  "'; 
			}elseif($arrep['result_status']==2){ //pass
				echo 'style=" background-color:green; color:#FFF; "';
			}elseif($arrep['result_status']==3){ //wait
			echo 'style=" background-color:orange; "'; 
			}elseif($arrep['result_status']==4){ // reject
				echo 'style=" background-color:red;  color:#FFF;  "'; 
			}
		}
		 ?>
       
        
         ><td colspan="2"> 
         <div style="text-align:center; padding:5px;">สถานะ :
         
         <?php if($arrep['rep_status']==0){ echo 'รอรับแจ้ง'; 
		}elseif($arrep['rep_status']==1){ echo 'รับแจ้งแล้วรอตรวจสอบ'; 
		}elseif($arrep['rep_status']==2){ echo 'กำลังตรวจสอบ..'; 
		}elseif($arrep['rep_status']==3){ 
		    if($arrep['result_status']==0){ //no result
				echo 'รอผล';
			}elseif($arrep['result_status']==1){ //adj..
				echo 'ผลตรวจสอบ : ปรับ '; 
			}elseif($arrep['result_status']==2){ //pass
				echo 'ผลตรวจสอบ : ผ่าน ';
			}elseif($arrep['result_status']==3){ //wait
			echo 'ผลตรวจสอบ : รอผล'; 
			}elseif($arrep['result_status']==4){ // reject
				echo 'ผลตาวจสอบ : Reject'; 
			}
		}
		 ?>
         </div>
         
          </td></tr>
        
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">OP ผู้ส่ง</div></td><td><div style="padding:5px;"><?php echo $arrep['mix_sname']; ?></div></td></tr>
      <tr  onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">เวลาส่ง</div></td><td><div style="padding:5px;">
	  <?php 
	  
	  if($arrep['timmx_sent_cnf']=='0000-00-00 00:00:00'){ echo '-'; }else{
       echo date("d/m/Y H:i", strtotime($arrep['timmx_sent_cnf']));
		    } ?>
      
      
      </div></td></tr>
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">QA ผู้รับ</div></td><td><div style="padding:5px;"><?php echo $arrep['qa_sname']; ?></div></td></tr>
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">เวลา QA รับ</div></td><td><div style="padding:5px;">
      <?php 
	  if($arrep['timqa_reciv_cnf']=='0000-00-00 00:00:00'){ echo '-'; }else{
       echo date("d/m/Y H:i", strtotime($arrep['timqa_reciv_cnf']));
		    } ?>
      </div></td></tr>
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">เวลา QA ส่ง</div></td><td><div style="padding:5px;">

       <?php 
	  if($arrep['timqa_sent_cnf']=='0000-00-00 00:00:00'){ echo '-'; }else{
       echo date("d/m/Y H:i", strtotime($arrep['timqa_sent_cnf']));
		    } ?>
      
      </div></td></tr>
      <tr onmouseover="this.style.background='#E8F3F5'" onmouseout="this.style.background=''"><td><div style="padding:5px;">ผลการตรวจ</div></td><td><div style="padding:5px;">
      
      <?php if(isset($arrck0['check_result'])){
		  			if($arrck0['check_result']==0){
						 echo '-';
						}elseif($arrck0['check_result']==1){
							echo 'ปรับ '; echo $arrck0['check_result_note'];
						}elseif($arrck0['check_result']==2){
							echo '<span style="color:green">ผ่าน</span>';
						}elseif($arrck0['check_result']==3){
							echo '<span style="color:orange">รอ</span>';
						}elseif($arrck0['check_result']==4){	
							echo '<span style="color:red">ไม่ผ่าน</span>';
					}
		  
	  }else{ echo '-'; }
	  ?>
      
      </div></td></tr>
     
      
      <tr><td colspan="2"><hr/></td></tr>
        <tr><td colspan="2"><hr/></td></tr>
      
        
        <tr><td colspan="2">
       <div style="padding:10px;" >
       
        <a href="http://lionproduction.sli/pdmis/bcmx300/leadadmin/p_rep-pe-031.php?qid=<?php echo $arrep['QID']; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a ui-btn-icon-left ui-icon-search" data-ajax="false" style="background-color:#3388cc; color:#FFF;" target="<?php echo $arrep['QID']; ?>">ดูใบแจ้ง</a>
        
      
        
 
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-a ui-btn-icon-left ui-icon-delete" data-rel="back">ยกเลิก</a>
         
        </div>
         </td></tr>
        
               </table>
               				
              
            
            </div>
            
   
</div>
