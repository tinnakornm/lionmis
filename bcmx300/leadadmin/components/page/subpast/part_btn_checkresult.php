


<?php if($arrep['rep_status']==0){ //mx send, qa pending ?>

          <a href="#rep-info-<?php echo $arrep['rep_id']; ?>"  data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline" style="background-color:#FF0; width: 120px; padding: 8px; margin: 0px;"> รอรับแจ้ง </a>
<?php }

elseif($arrep['rep_status']==2){//qa check  
		 echo '<a href="#rep-info-'.$arrep['rep_id'].'"  data-rel="popup" data-position-to="window" data-transition="pop"   class="ui-btn ui-btn-inline" style="background-color:orange; width: 120px;  padding: 8px; margin: 0px;"> กำลังตรวจ </a>';	  
 }elseif($arrep['rep_status']==3 and $arrep['result_status']==1){ // ?>
        
            <a  href="#rep-info-<?php echo $arrep['rep_id']; ?>"  data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline" style="background-color:#3388cc;    width: 120px;  padding: 8px; margin: 0px;"> ปรับ (Adj)   </a>
<?php }



elseif($arrep['rep_status']==3 and $arrep['result_status']==2){ //qa confirmed ->pass! ?>

             <a  href="#rep-info-<?php echo $arrep['rep_id']; ?>"  data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline" style="background-color:green; color:#FFF; width: 120px;  padding: 8px; margin: 0px;"> ผ่าน </a>
<?php }



elseif($arrep['rep_status']==3 and $arrep['result_status']==3){ //qa confirm ->wait for result ?>
               <a href="#rep-info-<?php echo $arrep['rep_id']; ?>"  data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline" style="background-color:orange;   width: 120px;  padding: 8px; margin: 0px;" > รอผล    </a>
<?php }



elseif($arrep['rep_status']==3 and $arrep['result_status']==4){ //qa confirm ->reject ?>
               
                <a href="#rep-info-<?php echo $arrep['rep_id']; ?>"  data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline" style="background-color:red;  color:#FFF; width: 120px;  padding: 8px; margin: 0px;" > Reject </a>
<?php }


else{ ?>
           <a  href="#rep-info-<?php echo $arrep['rep_id']; ?>"  data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-btn-inline" style="background-color:orange;   width: 120px;  padding: 8px; margin: 0px;" > กำลังตรวจ </a>
<?php } ?>
          