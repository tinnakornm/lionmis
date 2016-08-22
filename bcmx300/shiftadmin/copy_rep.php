<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<h3><title>ใบส่งตัวอย่าง</title></h3>

<style type="text/css">
@media print
{
.noprint {visibility:hidden;}
}
</style>

<script type="text/javascript" src="../../include/lib/jquery1.10.2.min.js"></script>

<script language="javascript" type="text/javascript">



<!--
 //   $(document).ready(function() 
//      { //jquery will worke only on this function
	  
	    //point select in copy menu
//	$("#col_point2").on("change",function(){
//	var value = $(this).val();
//	if(value != 4)
//	$("#div_point2").css("display","none");
 //	else
 //	$("#div_point2").css("display","block");		
//		});




    //  });
	
	  
// -->
</script>

 
</head>

<?php

 require('../../include/config.inc.php'); 
 mysql_select_db($db); 
    if(isset($_GET['qid'])){
		    
		  
		  
		$qrep =mysql_query("SELECT * FROM  `qamxbc_rep` WHERE  `QID` LIKE  '".$_GET['qid']."' LIMIT 0 , 1",$connect)or die(mysql_error());				
		if(!mysql_num_rows($qrep)){ echo 'Error, no report record'; exit; }
		$arrep = mysql_fetch_array($qrep);
		
		
		 $qck =mysql_query("SELECT * FROM  `qamxbc_check` WHERE  `QID` LIKE  '".$_GET['qid']."' LIMIT 0 , 1",$connect)or die(mysql_error());
 $arck = mysql_fetch_array($qck);
	}
	else
	echo 'No Report ID';		
 ?>
 

    
    
   









<body >
<table width="100%" border="1">
  <tr>
    <td colspan="2"><div align="center">
      <p><strong>ใบส่งตัวอย่าง</strong></p>
       <form action="insert_copy.php?qid=<?php echo $arrep['QID']; ?>" method="post" >
      <p  style="color:#F00" "font-size:15px">**คือจุดที่จะต้องตรวจสอบก่อนจะส่งซ้ำ</p>
   
  <tr>
    <td width="52%"><p align="center"><strong>Date </strong></p>
      <p align="center">
        <input type="text"  readonly name="txtdate" style="text-align: center;"  value="<?php echo $arrep['DD'].'-'.$arrep['MM'].'-'.$arrep['YYYY']; ?>" id="txtdate">
    </p></td>
    <td width="48%"><p align="center"><strong>Tank No.</strong></p>
      <p align="center"><strong>
        <label for="txtorder"></label>
        <input type="text" readonly name="txttank_no" style="text-align:center;" value="<?php echo $arrep['tank_no']; ?>"  id="txttank_no">
    </strong></p></td>
  </tr>
  <tr>
    <td><p align="center" ><strong>Col Point </strong></p>
        <div class="ui-title" style="padding-top:5px;">
          <div align="center"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;"><span class="ui-title" style="padding-top:5px;">
            <label for="txtcolpoint"></label>
            <input type="text"  readonly value=" <?php if ($arrep['collection_point'] == 0) {echo "ก้น Tank";} 
			 elseif ($arrep['collection_point'] == 1) {echo "Hopper" ;}elseif ($arrep['collection_point'] == 2) {echo "Nozzle" ;}
			 elseif ($arrep['collection_point'] == 3) {echo "Mixer" ;} elseif ($arrep['collection_point'] == 4) {echo 
			 $arrep['point'] ;}
			   ?>"  style="text-align:center" name="txtcolpoint" id="txtcolpoint">
          </span></span></span></span></span></span></span></div>
        </div>
            <div align="center">
              </div>
            
            <div id="div_point2"  class="ui-title" style="padding-top:5px; display:none;">
              <div align="center"><strong>   Point  </strong>
                
                <span class="ui-title" style="padding-top:5px;" >
                <input type="text" name="point2" id="point2" value="" style="font-size:16px;" placeholder="point" />
                </span></div>
        </div>
   </td>
    <td><p align="center" ><strong>Mix No. </strong></p>
      <p align="center">
      
      
      
           <div align="center" class="ui-title" style="padding-top:5px;">
             <label for="txtmixer"></label>
             <input type="text"  readonly value="<?php echo $arrep['mix_no']; ?>" style="text-align:center"name="txtmixer" id="txtmixer">
           </div>
            
            <div class="ui-title" style="padding-top:5px;">
             <div class="ui-title" style="padding-top:5px;">
               
               
               
           
            </div>
    </p></td>
  </tr>
  <tr>
    <td><p align="center"><strong>Formula </strong></p>
      <p align="center">
        <input type="text" readonly  value="<?php echo $arrep['fullformula']; ?>" style="text-align: center;"  name="txtformula" id="txtformula">
    </p></td>
    <td><p align="center" style="color:#F00"><strong>Step</strong></p>
      <p align="center">    <select name="step" required="required" id="step">
                <option value=""> เลือก Step </option>
                <option value="0"> Premix </option>
                <option value="1"> Semi </option>
                <option value="2"> PH. Adjust </option>
                <option value="3"> Visc. Adjust </option>
              

              </select>
      </p></td>
  </tr>
  <tr>
    <td><p align="center"><strong>Bt No.</strong></p>
      <p align="center">
        <input type="text" readonly name="txtbt_no" value="<?php echo $arrep['bt_no']; ?>" style="text-align: center;" id="txtbt_no">
    </p></td>
    <td><p align="center" ><strong>ผู้ส่ง</strong></p>
      <p align="center">
         <div class="ui-title" style="padding-top:5px;">
            
            <div align="center">
              <label for="txtmix_name"></label>
                <?php 
 		$qo ="SELECT * FROM `user` WHERE  `dev` ='bcmx300' AND `position` LIKE 'operator'";
		   ?>
              <select name="txtmix_name"  required="required"  id="txtmix_name" >
  <option value=""> เลือก ผู้ส่ง </option>
	       <?php    
		         $qro = mysql_query($qo);
	              while($arro = mysql_fetch_array($qro)){
			  
	 echo "<option value=\"".$arro['s_name']."\">".$arro['name']."</option>";
	    		
	            }?>
	       </select>  
            </div>
         </div>
      <div align="center">
        </p>
    </div></td>
  </tr>
  <tr>
    <td><p align="center"><strong>Order No</strong></p>
      <p align="center">
        <input type="text"  readonly name="txtorder_no" value="<?php echo $arrep['order_no']; ?>"  style="text-align: center;"  id="txtorder_no">
      </p></td>
    <td><div align="center"><strong>
     PD GROUP </strong>
      <p>
        <label for="txtpd_group"></label>
        <input type="text" readonly value="<?php echo $arrep['pd_group']; ?>"  style="text-align:center"name="txtpd_group" id="txtpd_group">
      </p>
    </div></td>
  </tr>
  <tr>
    <td><p align="center"><strong>Bt Size </strong></p>
      <p align="center">
        <input type="text"  readonly style="text-align: center;" name="txtbt_size" value="<?php echo $arrep['bt_size']; ?>" id="txtbt_size" >
    </p></td>
    <td><div align="center"> ส่งข้อความถึง QA

    
    <input name="txtcomment"  id="txtcomment" type="text">
    
      
    </div></td>
  </tr>
</table>


<p><div align="center">


<button type="submit"  name="newreport" id="startbtf" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-check">
          ส่งตัวอย่าง </button>
</div></p>
</form>

</body>
</html>
