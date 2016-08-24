<?php 
    /******************** MIS STANDARD HEADER ***********************	
File Name         : module_sparepart.php
    Project No    : 
    Create Date  : 05/08/2016
	Create by     : Tinnakorn.M
	Log:  DD/MM/YYYY : Description, By Name
            05/08/2016 : Module Template : sparepart, By Tinnakorn.M
/****************************************************************/
	//initial setting 
	 $modulename = 'mtsparepart';
     $plant=$_SESSION["plant"];
	 //Switch your component here
	if(!isset($_GET['c'])){ $c=1; }else{ $c=$_GET['c']; }

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

<!-- dinamic table -->  
<link rel="stylesheet" href="../../include/lib/jspkg/jquery.dynatable.css">
<script src="../../include/lib/jspkg/jquery.dynatable.js"></script>  
<script>
    $(document).ready(function ()
    { //start all function here
        //start dynatable
        $('#tlb').dynatable({
            table: {
                defaultColumnIdStyle: 'trimDash'
            }
        });

    });
</script> 

<?php
    
	if ($c ==1){
		//Start component 1
				 if (!isset($_GET['gr'])) {
				//find group by dev_v1
				$q0 = mysql_query("SELECT `sprg_name` FROM  `tpm_sprgrp` WHERE  `dev_v1` LIKE  '" . $dev_v1 . "' AND  `sprg_type` LIKE  'SPECIAL' ORDER BY  `tpm_sprgrp`.`sprg_name` ASC  LIMIT 0 , 1");
				if (mysql_num_rows($q0)) {
					$arr0 = mysql_fetch_array($q0);
					$gr = $arr0['sprg_name'];
				} else {
					$gr = 'CASE_PACKER';
				}
			} else {
				$gr = $_GET['gr'];
			}
			$sprg_type = 'SPECIAL';

	}else if ($c==2){
		//Start component 2
		   if (!isset($_GET['gr'])) {
      			  $gr = 'ELECTRICS';
			} else {
				$gr = $_GET['gr'];
			}
			$sprg_type = 'GENERAL';
	}else if ($c==3){
		//Start component 3
	}else if ($c==4){
		//Start component 4
	}else{
		
		 $gr = !isset($_GET['gr']) ? "NORMAL" : $_GET['gr'];
    	$sprg_type = 'NORMAL';
	
	}


//Check q
if (isset($_GET['q'])) {
    $q = mysql_query("SELECT * FROM  `tpm_sparepart` WHERE  `spr_mtcode` LIKE  '" . $_GET['q'] . "' LIMIT 0 , 1");

    $arrq = mysql_fetch_array($q);
    //change initial value
    $sprg_type = $arrq['spr_type'];
    $gr = $arrq['sprg_name'];
}

//query main spare part group detail.
if (isset($gr)) {
    $qgr = mysql_query("SELECT `sprg_describ` FROM  `tpm_sprgrp` WHERE  `sprg_name` LIKE  '$gr' LIMIT 0 , 1");
    $arrgn = mysql_fetch_array($qgr);
    $sprg_describ = $arrgn['sprg_describ'];
} else {
    $sprg_describ = '';
}
?>
<?php
//SAP RFC
include_once ("../../include/sap/sapclasses/sap.php");
include_once ("../../include/sap/sapclasses/examples/sapserverconnect.php");
?> 
<link href="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.1.css"  />
<script type="text/javascript" src="http://lionproduction.sli/pdmis/include/model-teadmin/js/sparepart.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#select-10-button').removeClass('ui-corner-all');
        $('#select-9-button').removeClass('ui-corner-all');
    });
//-->
    function MM_jumpMenu(targ, selObj, restore) { //v3.0
        eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
        if (restore)
            selObj.selectedIndex = 0;
    }
</script>       
<div id="content-sparepart" style="margin-left:10px; margin-right:10px; margin-top:10px;">              
    <table  border="0" cellpadding="0" style=" width: 100%;">
        <tr>

            <td style="margin:1px;" width="12%" ><a  style="width:90%;"  data-ajax="false"  href="?m=<?php echo $modulename; ?>&amp;c=1"  class="ui-btn ui-btn-inline <?php
if ($c == 1) {
    echo 'ui-link ui-btn ui-btn-active';
}
?> " > Special Type </a></td>
            <td  style="margin:1px;"  width="12%"><a  data-ajax="false" style="width:90%;"  href="?m=<?php echo $modulename; ?>&amp;c=2"  class="ui-btn ui-btn-inline <?php
                                                     if ($c == 2) {
                                                         echo 'ui-link ui-btn ui-btn-active';
                                                     }
                                                     ?> " > General Type  </a></td>
            <td style="margin:1px;" width="12%" > </td>
            <td style="margin:1px;" > 
                <div style="text-align:right; width: 80%;
                     float: right; margin-right:18px;">
                    <form class="ui-filterable" ><input id="autocomplete-input" data-type="search" placeholder="ค้นหาชื่อ หรือ Match Code..">
                    </form>
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
            <div style="float:left; font-size:24px; padding-top:15px;  padding-bottom:10px;"><strong>&raquo; <?php
                if ($c == 1) {
                    echo 'Special';
                } else {
                    echo 'General';
                }
                                                      ?> Sparepart of <?php echo $dev_v1; ?></strong></div>
            <div id="info"></div>
            <div style="text-align:right; float:right;">
                <table>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td> 
                        <td> <a href="#popupNewSparePart"  data-rel="popup" data-position-to="window" data-transition="pop" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" style="display: inline-flex; background-color: rgb(51, 136, 204); color: #FFF;"  >เพิ่ม Spare Part</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div><!-- end title-header -->
        <div style="margin-top:60px;  padding-bottom:5px;"> Spare Part <?php
                    if ($c == 1) {
                        echo ' เฉพาะกลุ่มเครื่องจักร  ';
                    } else {
                        echo 'ทั่วไปหมวหมู่ ';
                    }
                                                      ?><?php echo $gr; ?> - <?php echo $sprg_describ; ?></div>
        <div style="text-align:center; padding:5px; background-color:#CEE1F7;">
            <form id="form1" name="form1" method="get" action="?m=<?php echo $modulename; ?>&c=<?php echo $c; ?>" data-ajax="false"   >
                <input name="f" type="hidden" value="<?php echo $modulename; ?>" />
                ค้นหาตามหมวดหมู่ย่อย : 

                <select data-role="none" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent', this, 0)">
<?php
if ($c == 1) {//special 
    $qg = mysql_query("SELECT * FROM `tpm_sprgrp` WHERE  `dev_v1` LIKE  '$dev_v1' AND `sprg_type` LIKE  '$sprg_type' ORDER BY  `tpm_sprgrp`.`sprg_name` ASC  LIMIT 0 , 30");
} else {
    $qg = mysql_query("SELECT * FROM `tpm_sprgrp` WHERE  `sprg_type` LIKE  '$sprg_type' ORDER BY  `tpm_sprgrp`.`sprg_name` ASC  LIMIT 0 , 30");
}
while ($arrg = mysql_fetch_array($qg)) {
    ?>
                        <option value="?m=<?php echo $modulename; ?>&c=<?php echo $c; ?>&gr=<?php echo $arrg['sprg_name']; ?>" <?php
                        if ($gr == $arrg['sprg_name']) {
                            echo 'selected="selected"';
                        }
                        ?>><?php
                        if ($arrg['sub_gr'] != "") {
                            echo $arrg['sub_gr'] . '->';
                        } echo $arrg['sprg_name'];
                        ?></option>
                                <?php }//end while   ?>

                </select>
                <input type="submit" name="button" id="button" value="ค้นหา" data-role="none" />
            </form> 
        </div>
        <!-- tbl sparepart -->
        <div style="padding-top:5px; background: #FFF; padding-bottom:20px;">
            <table  style="width:100%;" id="tlb" class="ui-body-d ui-shadow table-stripe">
                <thead>
                    <tr style="height:40px; vertical-align:middle; text-align:center; font-weight:bold; background-color:#CFCFCF;">
                        <td>No</td>

                        <td>หมวดหมู่ย่อย</td>
                        <td>Material Code</td>

                        <td width="150">Imgage</td>
                        <td width="400"> Material Description </td>
                        <td>Lead Time</td>
                        <td> Min Stock </td>
                        <td><strong> Stock <br/> <span style="color:#03C;"> Store </span> | PK</strong> </td>
                        <td width="120">เครื่องมือ</td>
                    </tr>
                </thead>
                <tbody>
<?php
if (isset($_GET['q'])) {
    $qMatchCode = " AND spr_mtcode LIKE  '" . $_GET['q'] . "' ";
} else {
    $qMatchCode = '';
}
if ($c == 1) { //special
    $qsp = mysql_query("SELECT * FROM  `tpm_sparepart` WHERE  `spr_status` =1 $qMatchCode AND  `sprg_name` LIKE  '$gr' AND `dev_v1` LIKE  '$dev_v1'  ORDER BY  `tpm_sparepart`.`spr_id` DESC  LIMIT 0 , 1000");
} else if ($c == 2) { //general type
    $qsp = mysql_query("SELECT * FROM  `tpm_sparepart` WHERE  `spr_status` =1 $qMatchCode AND  `sprg_name` LIKE  '$gr'  ORDER BY  `tpm_sparepart`.`spr_id` DESC  LIMIT 0 , 1000");
} else {
    $qsp = mysql_query("SELECT * FROM  `tpm_sparepart` WHERE  `spr_status` =1 $qMatchCode AND  `sprg_name` LIKE  '$gr'  ORDER BY  `tpm_sparepart`.`spr_id` DESC  LIMIT 0 , 1000");
}

if (mysql_num_rows($qsp)) {
    $i = 1;
    while ($arrsp = mysql_fetch_array($qsp)) {
        /*

          //CALL SAP RFC Update data realtime before show
          if(isset($arrsp['spr_mtcode'])){

          $fce = &$sap->NewFunction ("ZINVENTORY_SPARE_PART");
          $fce->P_WERKS = '1100';
          $fce->P_MATNR = $arrsp['spr_mtcode']; //Material code or spare part code
          $fce->P_LGORT  = 'MT01';
          $fce->Call();
          $fce->Call();
          if (($fce->status)==SAPRFC_OK) {
          $fce->I_ZMM106->Reset();
          while ( $fce->I_ZMM106->Next() ){
          $tstock = $fce->I_ZMM106->row['LABST'];
          if($tstock>=0.1){
          mysql_query("UPDATE  `lionproduction`.`tpm_sparepart` SET  `spr_stock_sap` =  '".$tstock."', `last_rfccall` = '".date("Y-m-d H:i:s")."', `last_rfccalluname` = '".$_SESSION['uname']."' WHERE  `tpm_sparepart`.`spr_mtcode` LIKE '".$arrsp['spr_mtcode']."' ");
          $stock = $tstock;
          }
          }
          }else{ //if fail
          $stock = $arrsp['spr_stock_sap'];
          }

          }//end if call rfc


          if(!isset($stock)){
          $stock = 0;
          }
         */
        $stock = $arrsp['spr_stock_sap'];
        $stock = number_format($stock);
        ?>

                            <tr  onmouseover="this.style.background = '#E8F3F5'" onmouseout="this.style.background = ''" >
                                <td><div style="text-align:center;"><?php echo $i; ?></div></td>
                                <td style="width:120px;"><div style="text-align:center;"><?php echo $arrsp['sprg_name']; ?></div></td>

                                <td style="width:120px;"><div style="text-align:center;"><?php echo $arrsp['spr_mtcode']; ?></div></td>

                                <td>

                                    <div style="text-align:center;">
                                        <a href="#<?php echo $arrsp['img_id']; ?>" data-rel="popup" data-position-to="window" data-transition="fade">

        <?php
        //find img

        $qimg = mysql_query("SELECT `img_filename` ,  `img_filepart`   FROM  `tpm_img`  WHERE  `img_id` =" . $arrsp['img_id'] . " LIMIT 0 , 1");
        $arrimg = mysql_fetch_array($qimg);
        ?>

                                            <img class="popphoto" src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $arrimg['img_filepart']; ?>/<?php echo $arrimg['img_filename']; ?>" alt="<?php echo $arrimg['img_filename']; ?>" style="width:120px;">


                                        </a>
                                        <div data-role="popup" id="<?php echo $arrsp['img_id']; ?>" data-overlay-theme="b" data-theme="b" data-corners="false">
                                            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">ปิด</a><img class="popphoto" src="http://lionproduction.sli/pdmis/tpm/images/<?php echo $arrimg['img_filepart']; ?>/<?php echo $arrimg['img_filename']; ?>" style="max-height:512px;" alt="<?php echo $arrsp['spr_img']; ?>">
                                        </div>
                                    </div>

                                </td>
                                <td><div style="text-align:center;">
        <?php echo $arrsp['spr_name_en']; ?>
                                    </div>
                                    <div style="text-align:center;">
        <?php echo $arrsp['spr_name_th']; ?>
                                    </div>
                                </td>
                                <td><div style="text-align:center;">
        <?php echo $arrsp['spr_leadtime']; ?>
                                    </div>
                                    <div style="text-align:center;">
        <?php echo $arrsp['spr_leadtime_unit']; ?>
                                    </div>
                                </td>
                                <td> <div style="text-align:center;">
        <?php echo $arrsp['spr_stock_min']; ?>
                                    </div></td>
                                <td><div style="text-align:center;">
                                        <span style="color:#03C;"><strong> <?php echo $stock; ?> </strong></span> |   <strong> <?php echo $arrsp['spr_stock_loc']; ?> </strong>
                                    </div></td>
                                <td>
                                    <div style="text-align:center;">
                                        <a href="http://lionproduction.sli/pdmis/include/model-teadmin/components/page/subpast/popup_edit_frm_new_sparepart.php?id=<?php echo $arrsp['spr_id']; ?>&dev_root=<?php echo $dev_root; ?>" data-ajax="false" id="editForm" data-transition="pop" class="ui-btn ui-shadow ui-corner-all ui-icon-edit ui-btn-icon-notext " style="display: inline-flex;">Edit list</a>
                                        <a href="http://lionproduction.sli/pdmis/tpm/rep/sparepart.php?id=<?php echo $arrsp['spr_mtcode']; ?>"  target="#" data-ajax="false" class="ui-btn ui-shadow ui-corner-all ui-icon-search ui-btn-icon-notext" style="display: inline-flex;" title="Print">Print</a>
                                    </div> 
                                </td>

                            </tr>
        <?php
        $i++;
    }//end while
} else {
    ?>
                        <tr>   
                            <td colspan="9">
                                <div style="text-align:center;"> ไม่มีรายงานที่ท่านค้นหา  </div></td> 
                        </tr>
<?php } ?>
                </tbody>
            </table>
        </div>
        <!-- //end tlb sparepart -->
    </div><!-- End data-role content -->

</div><!--- end content-sparepart -- >

<!-- Popup -->
<?php include("../../include/model-teadmin/components/page/subpast/popup_frm_new_sparepart.php");
?>