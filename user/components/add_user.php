 <?php 
/******************** MIS STANDARD HEADER ***********************	
File Name         : add_user.php
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

//check dup username
        $q1 = mysql_query("SELECT * FROM  `user` WHERE  `uname` LIKE  '" . $_POST['uname'] . "' LIMIT 0 , 1");
        if (mysql_num_rows($q1)) {

            echo 'มีชื่อผู้ใช้งานชื่อ ' . $_POST['uname'] . ' อยู่ในระบบแล้ว โปรดใช้วิธีเปลี่ยนชื่อผู้ใช้งานใหม่ เช่น ' . $_POST['uname'] . '_s';
            echo '<br/> กดปุ่ม Back เพื่อย้อนกลับและดำเนินการต่อ ';
            exit;
        }

        //search premis
        if ($_POST['dev'] == 'mix200') {
            $type = 'mx';
            $plant = '1200';
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
        } elseif ($_POST['dev'] == 'packing100') {
            $type = 'dk';
            $plant = '1100';
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
        } elseif ($_POST['dev'] == 'packing200') {
            $type = 'pk';
            $plant = '1200';
            if ($_POST['position'] == 'account') {
                $premis = 'coo/accadmin/?f=1';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'supervisor') {
                $premis = 'coo/supadmin/?f=1';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'shiftleader') {
                $premis = 'coo/shiftadmin/?f=0';
                $acclevel = 3;
            } elseif ($_POST['position'] == 'technician') {
                $premis = 'coo/teadmin/?f=0';
                $acclevel = 3;
            } else {
                $premis = 'coo/leadadmin/?f=0';
                $acclevel = 2;
            } //line leader
        } elseif ($_POST['dev'] == 'StaffHH') {
            $type = 'ss';
            $plant = '1200';
            $premis = 'staffadmin/staff/?f=0';
            $acclevel = 5;
        } elseif ($_POST['dev'] == 'qa') {
            $plant = '-';
            $type = 'qa';
            if ($_POST['position'] == 'qa1') {
                $premis = 'qa/qaadmin/qa1.php?f=0';
                $acclevel = 2;
                $plant = '1100';
            }
            if ($_POST['position'] == 'qa2') {
                $premis = 'qa/qaadmin/?f=0';
                $acclevel = 2;
                $plant = '1200';
            }
            if ($_POST['position'] == 'qaoc') {
                $premis = 'qa/qaadmin/qaoc.php?f=0';
                $acclevel = 2;
                $plant = '1300';
            } else { //supervisor
                $premis = 'qa/supadmin/?f=0';
                $acclevel = 3;
            }
        } elseif ($_POST['dev'] == 'qc') {
            $type = 'qc';
            $plant = '1200';
            $premis = 'qc/qcadmin/?f=0';
            $acclevel = 3;
        } elseif ($_POST['dev'] == 'bcmx300') {
            $type = 'bc';
            $plant = '1300';
            if ($_POST['position'] == 'account') {
                $premis = 'bcmx300/accadmin/?f=1';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'supervisor') {
                $premis = 'bcmx300/supadmin/?f=1';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'shiftleader') {
                $premis = 'bcmx300/shiftadmin/?f=0';
                $acclevel = 3;
            } else {
                $premis = 'bcmx300/leadadmin/?f=0';
                $acclevel = 2;
            } //line leader		
        } elseif ($_POST['dev'] == 'bcpk300') {
            $type = 'bc';
            $plant = '1300';
            if ($_POST['position'] == 'account') {
                $premis = 'bcpk300/accadmin/?f=1';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'supervisor') {
                $premis = 'bcpk300/supadmin/?f=1';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'shiftleader') {
                $premis = 'bcpk300/shiftadmin/?f=0';
                $acclevel = 3;
            } else {
                $premis = 'bcpk300/leadadmin/?f=0';
                $acclevel = 2;
            } //line leader	
        } elseif ($_POST['dev'] == 'ocmx300') {
            $type = 'oc';
            $plant = '1300';
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
                $premis = 'ocmx300/teadmin/?f=0';
                $acclevel = 3;
            } else {
                $premis = 'ocmx300/leadadmin/?f=0';
                $acclevel = 2;
            } //line leader	
        } elseif ($_POST['dev'] == 'ocmx300-2') {
            $type = 'oc';
            $plant = '1300';
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
            $plant = '1300';
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
            $plant = '1300';
            if ($_POST['position'] == 'technician') {
                $premis = 'tb300/teadmin/?f=0';
                $acclevel = 3;
            } else {
                $premis = 'tb300/leadadmin/?f=0';
                $acclevel = 2;
            } //line leader	
        } elseif ($_POST['dev'] == 'dy') {
            $type = 'dy';
            $plant = '1100';
            if ($_POST['position'] == 'supervisor') {
                $premis = 'dy/shiftadmin/?f=0';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'shiftleader') {
                $premis = 'dy/shiftadmin/?f=0';
                $acclevel = 3;
            } elseif ($_POST['position'] == 'technician') {
                $premis = 'dy/teadmin/?f=0';
                $acclevel = 3;
            } else {
                $premis = 'dy/RmBarcode/?f=0';
                $acclevel = 2;
            } //OP Barcode
        } elseif ($_POST['dev'] == 'gs') {
            $type = 'gs';
            $plant = '1100';
            if ($_POST['position'] == 'supervisor') {
                $premis = 'gs/007_rep.php';
                $acclevel = 4;
            } elseif ($_POST['position'] == 'shiftleader') {
                $premis = 'gs/007_rep.php';
                $acclevel = 3;
            } else {
                $premis = 'gs/007_rep.php';
                $acclevel = 2;
            } //OP Barcode
        } else if ($_POST['dev'] == 'mt') {

            $type = $_POST['type'];
            $plant = '-';

            if ($_POST['position'] == "operator") {
                $premis = 'mt/leadadmin/?f=0';
                $acclevel = 2;
            } else {
                $premis = 'mt/supadmin/?f=0';
                $acclevel = 4;
            }
        } else {
            $type = 'ss';
            $plant = '1200';
            $premis = 'staffadmin/staff/?f=0';
            $acclevel = 3;
        }

        mysql_query("INSERT INTO  `lionproduction`.`user` (
`id` ,
`uname` ,
`name` ,
`lion_id` ,
`dev` ,
`pwd` ,
`type` ,
`premis` ,
`position` ,
`acclevel` ,
`user_blocked` ,
`plant` ,
`e_status` ,
`e_possition` ,
`e_lionmail` ,
`e_lastlogin` ,
`e_contact` ,
`e_numlogin` ,
`cross_coo` ,
`s_name`
)
VALUES (
NULL ,  '" . $_POST['uname'] . "',  '" . $_POST['name'] . "',  '" . $_POST['lion_id'] . "',  '" . $_POST['dev'] . "',  '" . $_POST['pwd'] . "',  '$type',  '$premis',  '" . $_POST['position'] . "',  '$acclevel',  '',  '$plant',  '',  '',  '',  '',  '',  '',  '',  '" . $_POST['s_name'] . "'
)");

        echo"<meta http-equiv='refresh' content='0; url=../index.php?dev=" . $_POST['dev'] . "'>";
        ?>

    </body>
</html>
