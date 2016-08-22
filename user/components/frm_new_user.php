 <?php 
/******************** MIS STANDARD HEADER ***********************	
File Name         : frm_new_user.php
    Project No    : 
    Create Date  : 15/10/2015
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            22/08/2016 : Start project reversion, By Tinnakorn.M
/****************************************************************/
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
        <?php
        if (isset($_GET['dev'])) {
            $dev = $_GET['dev'];
        } else {
            $dev = 'pk';
        }
        ?>

        <form name="form1" id="form1" method="post" action="components/add_user.php">
            <table width="600"  cellpadding="0" cellspacing="0" style="text-align:left;">
                <!--DWLayoutTable-->
                <tr>
                    <td height="33" colspan="4" align="center" valign="middle" bgcolor="#666666"><div align="left" class="style2" style="padding:5px;"> + Add new user </div></td>
                </tr>

                <tr>
                    <td width="161" height="24" align="center" valign="middle">รหัสหน่วยงาน </td>
                    <td width="437" valign="middle"><div style=" padding:5px; text-align:left;"><?php echo $dev; ?>
                            <input type="hidden" name="dev" id="dev" value="<?php echo $dev; ?>">
                        </div></td>

                </tr>

                <?php if ($dev == 'mt') { ?>      

                    <tr bgcolor="#E1E1E1">
                        <td height="24" align="center" valign="middle">หน่วยงานย่อย</td>
                        <td valign="middle"><div style=" padding:5px; text-align:left;">

                                <select name="type" style="width:150px;">
                                    <option value="mt" selected>Maintenance</option>
                                    <option value="st">Store</option>
                                    <option value="ut">Utility</option>
                                </select>


                                <small> </small> 
                            </div></td>

                    </tr>

                <?php } ?>                
                <tr bgcolor="#FFF">
                    <td height="24" align="center" valign="middle">รหัสพนักงาน</td>
                    <td valign="middle"><div style=" padding:5px; text-align:left;"><input type="text" name="lion_id" style="width:150px;" required />
                            <small> * เช่น 002004</small> 
                        </div></td>

                </tr>
                <tr bgcolor="#E1E1E1">
                    <td height="19" align="center" valign="middle">ชื่อ นามสกุลจริง</td>
                    <td valign="top"><div style=" padding:5px; text-align:left;">
                            <input type="text" name="name" style="width:150px;" required />
                            <small> * เช่น ทินกร หมอยา</small>
                        </div></td>

                </tr>
                <tr bgcolor="#E1E1E1">
                    <td height="19" align="center" valign="middle">ชื่อย่อ</td>
                    <td valign="top"><div style=" padding:5px; text-align:left;">
                            <input type="text" name="s_name" id="s_name" style="width:150px;" required />
                            <small> * เช่น ทินกร</small>
                        </div></td>

                </tr>
                <tr>
                    <td height="24" align="center" valign="middle">ชื่อผู้ใช้งาน (เข้าระบบ) </td>
                    <td valign="middle"><div style=" padding:5px; text-align:left;"><input type="text" name="uname" id="uname" style="width:150px;" required />
                            <small> * อักษรอังกฤษตัวเล็ก เช่น tinnakorn </small>
                        </div></td>

                </tr>
                <tr>
                    <td height="24" align="center" valign="middle">รหัสผ่าน</td>
                    <td valign="middle"><div style=" padding:5px; text-align:left;"><input type="password" name="pwd" style="width:150px;" required /> 
                            <small> * รหัสผ่าน </small>
                        </div></td>

                </tr>
                <tr>
                    <td height="30" align="center" valign="middle">ตำแหน่ง</td>
                    <td valign="middle"><div style=" padding:5px; text-align:left;">
                            <select name="position" >
                                <?php
                                if ($dev == 'StaffHH') {
                                    echo '<option value="staff" selected>Staff</option>';
                                } elseif ($dev == 'packing100') {
                                    echo '<option value="lineleader">Line leader</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option> 
                       <option value="technical">Technical</option> 
			  ';
                                } elseif ($dev == 'packing200') {
                                    echo '<option value="lineleader">Line leader</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option> 
			 <option value="technical">Technical</option> 
			  ';
                                } elseif ($dev == 'mix200') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option> 
			 <option value="technician">Technician</option> 
			  ';
                                } elseif ($dev == 'bcmx300') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option> 
			  ';
                                } elseif ($dev == 'bcpk300') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option> 
			  ';
                                } elseif ($dev == 'ocmx300') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option> 
			 <option value="technician">Technical</option> 
			  ';
                                } elseif ($dev == 'ocmx300-2') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option> 
			  ';
                                } elseif ($dev == 'ocpk300') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			 <option value="account">Accounting</option>
			 <option value="technician">Technical</option> 
			  ';
                                } elseif ($dev == 'tb300') {
                                    echo '<option value="operator">Operator</option>
			 <option value="technician">Technical</option> 
			  ';
                                } elseif ($dev == 'qa') {
                                    echo '<option value="qa1">QA 1100</option>';
                                    echo '<option value="qa2">QA 1200</option>';
                                    echo '<option value="qaoc">QA OC</option>';
                                    echo '<option value="supervisor">QA Supervisor</option>';
                                } elseif ($dev == 'dy') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
                  <option value="technician">Technical</option> 
			  ';
                                } elseif ($dev == 'gs') {
                                    echo '<option value="operator">Operator</option>
             <option value="shiftleader">Shift Leader</option>
	         <option value="supervisor">Supervisor</option>
			  ';
                                } else if ($dev = "utility") {
                                    echo '<option value="operator">Operator</option>
	        <option value="supervisor">Supervisor</option>
			  ';
                                } else if ($dev = "mt") {
                                    echo '<option value="operator">Operator</option>
	        <option value="supervisor">Supervisor</option>';
                                } else {
                                    echo '<option value="operator">Operator</option>';
                                }
                                ?>

                            </select>
                            <small> </small></div></td>

                </tr>
                <tr bgcolor="#E1E1E1">
                    <td height="22" align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td align="left" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>

                </tr>

                <tr bgcolor="#E1E1E1">
                    <td height="26" align="center" valign="middle"><!--DWLayoutEmptyCell-->&nbsp;</td>
                    <td colspan="3" valign="middle"><div style=" padding:5px; text-align:left;">
                            <input type="submit" name="Submit" value="เพิ่มผู้ใช้งาน" />
                        </div></td>
                </tr>

            </table>
        </form>


    </body>
</html>