 <?php 
/******************** MIS STANDARD HEADER ***********************	
File Name         : frm_edit_user.php
    Project No    : 
    Create Date  : 15/10/2015
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            22/08/2016 : Start project reversion, By Tinnakorn.M
/****************************************************************/
?>
<?php require('../../include/config.inc.php'); ?>
<?php mysql_select_db($db); 

  $quser =mysql_query("SELECT * FROM `user` WHERE `id` = '".$_GET['id']."'");  
  $arr = mysql_fetch_array($quser);

?>
<html>
<head>
</head>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}

select { font-size:14px;
}
-->
</style>


<body>


<form name="form1" id="form1" method="post" action="components/edit_user.php">
  <table width="600" align="center" cellpadding="0" cellspacing="0" >
    <!--DWLayoutTable-->
  <tr>
		<td height="33" colspan="3" align="center" valign="middle" bgcolor="#666666"><div align="left" class="style2" style="padding:5px;">แก้ไข หรือ ลบข้อมูลบัญชีผู้ใช้งาน</div></td>
    </tr>
  
<tr>
		<td width="163" height="24" align="center" valign="middle">รหัสหน่วยงาน</td>
	    <td width="365" valign="middle"><div style=" padding:5px; text-align:left;">
        <?php echo $arr['dev']; ?> <input name="dev" type="hidden" value="<?php echo $arr['dev']; ?>">
      </div></td>
       
    </tr>
	<tr bgcolor="#E1E1E1">
		<td height="24" align="center" valign="middle">รหัสพนักงาน</td>
	    <td valign="middle"><div style=" padding:5px; text-align:left;"><input type="text" name="lion_id" style="width:150px;" value="<?php echo $arr['lion_id']; ?> " required />
	     <small> * เช่น 002004</small> 
	    </div></td>
	  
	</tr>
    
    
    <?php if($arr['dev']=='mt'){ ?>      
                
                <tr >
                    <td height="24" align="center" valign="middle">หน่วยงานย่อย</td>
                    <td valign="middle"><div style=" padding:5px; text-align:left;">
                    
                     <select name="type" style="width:150px;">
                       <option value="mt" <?php if($arr['type']=='mt'){ echo ' selected'; } ?>>Maintenance</option>
                       <option value="st" <?php if($arr['type']=='st'){ echo ' selected'; } ?>>Store</option>
                       <option value="ut" <?php if($arr['type']=='ut'){ echo ' selected'; } ?>>Utility</option>
                     </select>
                    
                    
                            <small> </small> 
                        </div></td>

                </tr>
                
<?php } ?>          
    
    
	<tr bgcolor="#E1E1E1">
		<td height="24" align="center" valign="middle">ชื่อ นามสกุลจริง</td>
	    <td valign="middle"><div style=" padding:5px; text-align:left;">
	        <input type="text" name="name" value="<?php echo $arr['name']; ?> "  style="width:150px;" required />
	       <small> * เช่น ทินกร หมอยา</small>
	      </div></td>
         
    </tr>
	<tr>
		<td height="24" align="center" valign="middle">ชื่อย่อ</td>
	    <td valign="middle"><div style=" padding:5px; text-align:left;">
	        <input type="text" value="<?php echo $arr['s_name']; ?>" name="s_name" id="s_name" style="width:150px;" required />
	       <small> * เช่น ทินกร</small>
	      </div></td>
       
    </tr>
    <tr bgcolor="#E1E1E1">
		<td height="19" align="center" valign="middle">ชื่อผู้ใช้งาน (เข้าระบบ)</td>
	      <td valign="top"><div style=" padding:5px; text-align:left;"><input type="text" name="uname" id="uname" value="<?php echo $arr['uname']; ?>" style="width:150px;"  disabled />
	     <small> * อักษรอังกฤษตัวเล็ก เช่น tinnakorn_m</small></div></td>
             
    </tr>
     <tr>
		<td height="30" align="center" valign="middle">รหัสผ่าน</td>
	      <td valign="middle"><div style=" padding:5px; text-align:left;"><input type="password" name="pwd"  value="<?php echo $arr['pwd']; ?>"  style="width:150px;" required /> 
	     <small> * รหัสผ่าน </small>
	    </div></td>
             
    </tr>
	   <tr bgcolor="#E1E1E1">
		<td height="22" align="center" valign="middle">ตำแหน่ง</td>
         <td align="left" valign="top"><div style=" padding:5px; text-align:left;">
         <select name="position" >
           <?php if($arr['dev']=='StaffHH'){ ?>
	          <option value="staff" selected>Staff</option> 
		  <?php }elseif($arr['dev']=='packing200'){ ?>
			 <option value="lineleader" <?php if($arr['position']=='lineleader'){ echo 'selected'; } ?>>Line leader</option>
             <option value="shiftleader" <?php if($arr['position']=='shiftleader'){ echo 'selected'; } ?>>Shift Leader</option>
	         <option value="supervisor" <?php if($arr['position']=='supervisor'){ echo 'selected'; } ?>>Supervisor</option>
			 <option value="account" <?php if($arr['position']=='account'){ echo 'selected'; } ?>>Accounting</option> 
		     <?php  }elseif($arr['dev']=='mix200'){ ?>
			    <option value="operator"  <?php if($arr['position']=='operator'){ echo 'selected'; } ?>>Operator</option>
             <option value="shiftleader" <?php if($arr['position']=='shiftleader'){ echo 'selected'; } ?>>Shift Leader</option>
	         <option value="supervisor" <?php if($arr['position']=='supervisor'){ echo 'selected'; } ?>>Supervisor</option>
			 <option value="account" <?php if($arr['position']=='account'){ echo 'selected'; } ?>>Accounting</option> 
             <?php  }elseif($arr['dev']=='ocmx300'){ ?>
			    <option value="operator"  <?php if($arr['position']=='operator'){ echo 'selected'; } ?>>Operator</option>
             <option value="shiftleader" <?php if($arr['position']=='shiftleader'){ echo 'selected'; } ?>>Shift Leader</option>
	         <option value="supervisor" <?php if($arr['position']=='supervisor'){ echo 'selected'; } ?>>Supervisor</option>
			 <option value="account" <?php if($arr['position']=='account'){ echo 'selected'; } ?>>Accounting</option> 
			 <option value="technician"  <?php if($arr['position']=='technician'){ echo 'selected'; } ?>>Technical</option>
             <?php  }elseif($arr['dev']=='ocpk300'){ ?>
			 <option value="operator"  <?php if($arr['position']=='operator'){ echo 'selected'; } ?>>Operator</option>
			 <option value="technician"  <?php if($arr['position']=='technician'){ echo 'selected'; } ?>>Technical</option>
             <option value="shiftleader" <?php if($arr['position']=='shiftleader'){ echo 'selected'; } ?>>Shift Leader</option>
	         <option value="supervisor" <?php if($arr['position']=='supervisor'){ echo 'selected'; } ?>>Supervisor</option>
			 <option value="account" <?php if($arr['position']=='account'){ echo 'selected'; } ?>>Accounting</option> 
			 <?php  }elseif($arr['dev']=='ocmx300-2'){ ?>
			    <option value="operator"  <?php if($arr['position']=='operator'){ echo 'selected'; } ?>>Operator</option>
             <option value="shiftleader" <?php if($arr['position']=='shiftleader'){ echo 'selected'; } ?>>Shift Leader</option>
	         <option value="supervisor" <?php if($arr['position']=='supervisor'){ echo 'selected'; } ?>>Supervisor</option>
			 <option value="account" <?php if($arr['position']=='account'){ echo 'selected'; } ?>>Accounting</option> 
			 <?php  }elseif($arr['dev']=='tb300'){ ?>
			 <option value="operator"  <?php if($arr['position']=='operator'){ echo 'selected'; } ?>>Operator</option>
             <option value="technician"  <?php if($arr['position']=='technician'){ echo 'selected'; } ?>>Technical</option>

		     <?php  }elseif($arr['dev']=='qa'){ ?>
               
               <option value="qa1"  <?php if($arr['position']=='qa1'){ echo 'selected'; } ?>>QA 1100</option> 
			   <option value="qa2"  <?php if($arr['position']=='qa2'){ echo 'selected'; } ?>>QA 1200</option> 
               <option value="qaoc"  <?php if($arr['position']=='qa2'){ echo 'selected'; } ?>>QAOC</option> 
               <option value="supervisor" <?php if($arr['position']=='supervisor'){ echo 'selected'; } ?>>Supervisor</option>
               
               <?php  }elseif($arr['dev']=='mt'){ ?>
			    <option value="operator"  <?php if($arr['position']=='operator'){ echo 'selected'; } ?>>Operator</option>
          <!--     <option value="shiftleader" <?php if($arr['position']=='shiftleader'){ echo 'selected'; } ?>>Shift Leader</option> -->
	         <option value="supervisor" <?php if($arr['position']=='supervisor'){ echo 'selected'; } ?>>Supervisor</option>
			 <option value="account" <?php if($arr['position']=='account'){ echo 'selected'; } ?>>Accounting</option> 
             
		    <?php  }else{ ?>
			    <option value="operator">Operator</option> 
		    <?php  }?>
              
         </select>
         </div></td>
             
    </tr>
     <tr >
		<td height="35" align="center" valign="middle">รหัสแก้ไข</td>
	      <td align="left" valign="middle"> <div style=" padding:5px; text-align:left;">
          <input type="password" name="keyedit" id="keyedit"   required> 
          <span style="color:red">
          <small>
          *โปรดติดต่อ ทินกร โทร 653 เพื่อแก้ไข
          </small>
          </span>
          </div>
          </td>
             
    </tr>
     <tr bgcolor="#E1E1E1">
		<td height="26" align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
	      <td colspan="3" valign="middle"><div style=" padding:5px; text-align:left;"><label>
		  <input type="checkbox" name="deluser" id="deluser" value="1">
          
          : ลบชื่อผู้ใช้งานนี้ 
		   <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
	      <input type="submit" name="Submit" value=" ตกลง " />
	     
	      </label></div>
		   </td>
    </tr>
     
  </table>
</form>


</body>
</html>