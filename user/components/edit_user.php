  <?php 
/******************** MIS STANDARD HEADER ***********************	
File Name         : edit_user.php
    Project No    : 
    Create Date  : 15/10/2015
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            22/08/2016 : Start project reversion, By Tinnakorn.M
/****************************************************************/
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
        <?php require('../../include/config.inc.php'); ?>
        <?php
        mysql_select_db($db);

        $movepass = "lion" . date("Y");

        if ($_POST['keyedit'] != $movepass) {
            echo 'รัหสแก้ไขไม่ถูกต้อง';
            echo '<br/>';
            echo 'โปรดติดต่อ staff หรือ ออด (โทร 653) เพื่อขอรหัสแก้ไขข้อมูล';
            exit;
        }

        if (isset($_POST['deluser']) and $_POST['deluser'] == 1) {
            mysql_query("DELETE FROM `lionproduction`.`user` WHERE `user`.`id` = " . $_POST['id'] . "");
        } else {


//check url premission
            //search premis
            if ($_POST['dev'] == 'mix200') {
                $type = 'mx';
                if ($_POST['position'] == 'account') {
                    $premis = 'mix200/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'mix200/supadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'mix200/shiftadmin/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'mix200/leadadmin/?f=0';
                    $acclevel = 2;
                } //operator
            } elseif ($_POST['dev'] == 'packing200') {
                $type = 'pk';
                if ($_POST['position'] == 'account') {
                    $premis = 'coo/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'coo/supadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'coo/shiftadmin/?f=0';
                    $acclevel = 3;
                } elseif ($_POST['position'] == 'technical') {
                    $premis = 'coo/tpm/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'coo/leadadmin/?f=0';
                    $acclevel = 2;
                } //line leader
            } elseif ($_POST['dev'] == 'packing100') {
                $type = 'dk';
                if ($_POST['position'] == 'account') {
                    $premis = 'dk/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'dk/supadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'dk/shiftadmin/?f=0';
                    $acclevel = 3;
                } elseif ($_POST['position'] == 'technical') {
                    $premis = 'dk/teadmin/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'dk/leadadmin/?f=0';
                    $acclevel = 2;
                } //line leader
            } elseif ($_POST['dev'] == 'dy') {

                $type = 'dy';
                if ($_POST['position'] == 'account') {
                    $premis = 'dk/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'dy/supadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'dy/shiftadmin/?f=0';
                    $acclevel = 3;
                } elseif ($_POST['position'] == 'technical') {
                    $premis = 'dy/teadmin/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'dy/leadadmin/?f=0';
                    $acclevel = 2;
                } //line leader
            } elseif ($_POST['dev'] == 'ocmx300') {
                $type = 'oc';
                if ($_POST['position'] == 'account') {
                    $premis = 'ocmx300/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'ocmx300/supadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'ocmx300/shiftadmin/?f=0';
                    $acclevel = 3;
                } elseif ($_POST['position'] == 'technician') {
                    $premis = 'ocpk300/teadmin/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'ocmx300/leadadmin/?f=0';
                    $acclevel = 2;
                } //line leader
            } elseif ($_POST['dev'] == 'ocmx300-2') {
                $type = 'oc';
                if ($_POST['position'] == 'account') {
                    $premis = 'ocmx300-2/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'ocmx300-2/supadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'ocmx300-2/shiftadmin/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'ocmx300-2/leadadmin/?f=0';
                    $acclevel = 2;
                } //line leader	
            } elseif ($_POST['dev'] == 'ocpk300') {
                $type = 'oc';
                if ($_POST['position'] == 'account') {
                    $premis = 'ocpk300/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'ocpk300/supadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'ocpk300/shiftadmin/?f=0';
                    $acclevel = 3;
                } elseif ($_POST['position'] == 'technician') {
                    $premis = 'ocpk300/teadmin/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'ocpk300/leadadmin/?f=0';
                    $acclevel = 2;
                } //line leader 
            } elseif ($_POST['dev'] == 'tb300') {
                $type = 'tb';
                if ($_POST['position'] == 'technician') {
                    $premis = 'tb300/teadmin/?f=0';
                    $acclevel = 3;
                } else {
                    $premis = 'tb300/leadadmin/?f=0';
                    $acclevel = 2;
                } //line leader  
            } elseif ($_POST['dev'] == 'StaffHH') {
                $type = 'ss';
                $premis = 'staffadmin/staff/?f=0';
                $acclevel = 5;
            } elseif ($_POST['dev'] == 'qa') {
                $type = 'qa';
                if ($_POST['position'] == 'qa1') {
                    $premis = 'qa/qaadmin/qa1.php?f=0';
                    $acclevel = 2;
                } elseif ($_POST['position'] == 'qa2') {
                    $premis = 'qa/qaadmin/?f=0';
                    $acclevel = 2;
                } elseif ($_POST['position'] == 'qaoc') {
                    $premis = 'qa/qaadmin/qaoc.php?f=0';
                    $acclevel = 2;
                } else { //supervisor
                    $premis = 'qa/supadmin/?f=0';
                    $acclevel = 3;
                }
            } elseif ($_POST['dev'] == 'qc') {
                $type = 'qc';
                $premis = 'qc/qcadmin/?f=0';
                $acclevel = 3;
            } elseif ($_POST['dev'] == 'mt') {

                $type = $_POST['type'];
                if ($_POST['position'] == 'account') {
                    $premis = 'mt/accadmin/?f=1';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'supervisor') {
                    $premis = 'mt/supadmin/?f=0';
                    $acclevel = 4;
                } elseif ($_POST['position'] == 'shiftleader') {
                    $premis = 'mt/shiftadmin/?f=0';
                    $acclevel = 3;
                } elseif ($_POST['position'] == 'operator') {
                    $premis = 'mt/leadadmin/?f=0';
                    $acclevel = 1;
                }
            } else {
                $type = 'ss';
                $premis = 'staffadmin/staff/?f=0';
                $acclevel = 3;
            }

            mysql_query("UPDATE  `lionproduction`.`user` SET  `name` =  '" . $_POST['name'] . "',
		`lion_id` =  '" . $_POST['lion_id'] . "',
		`pwd` =  '" . $_POST['pwd'] . "',
		`type` =  '" . $type . "',
		`premis` =  '" . $premis . "',
		`position` =  '" . $_POST['position'] . "',
		`acclevel` =  '" . $acclevel . "',
		`s_name` =  '" . $_POST['s_name'] . "'  WHERE  `user`.`id` =" . $_POST['id'] . "");
        }

        echo"<meta http-equiv='refresh' content='0; url=../index.php?dev=" . $_POST['dev'] . "'>";
        ?>
    </body>
</html>
