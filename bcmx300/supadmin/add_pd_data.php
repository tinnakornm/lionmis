<head>

<style type="text/css">
.textcolor {
	background-color: #FFF;
}
</style>


</head>
			
			
			
			
<?php if(!isset($_GET['mc'])){
	$mc = 'เลือก Mixer';
	}else{ $mc = $_GET['mc']; }
	?>


<script type="text/javascript" >



</script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>


<script type="text/javascript" src="js/mxqa.js"></script>
<div style="text-align:right; float:right;">
 
 
                  <table>
                  <tr>
                   <td>&nbsp;</td>
                    
                    
                  <td> <a href="#popupLogin" data-rel="popup" data-position-to="window" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-check ui-btn-icon-left ui-btn-a" data-transition="pop">Add Product</a>
<div data-role="popup" id="popupLogin" data-theme="a" class="ui-corner-all">
    <form>
        <div align="center" style="padding:10px 20px;">
              <h3 align="center">Production Data</h3>
              <input  type="hidden" name="txtdev" id="txtdev" value="<?php echo $_SESSION["user_dev"] ?>"  >
      
  <div align="center">
    <table width="100%" border="1">
      <tr>
        <td><div align="right">PD Group :</div></td>
        <td><select name="pd_group" required="required" id="pd_group">
               <option value="PD" > PD </option>
                <option value="LD" > LD </option>
                <option value="FS" > FS </option>
                <option value="SR" > SR </option>
                 <option value="DW" > DW </option>
                <option value="ST" > ST </option>
                 <option value="SH" > SH </option>
                <option value="CO" > CO </option>
                 <option value="LO" > LO </option>
                <option value="LS" > LS </option>
                 <option value="TD" > TD </option>
                <option value="TP" > TP </option>
                <option value="TB" > TB </option>
                <option value="DF" > DF </option>
                 <option value="FF" > FF </option>
                <option value="SO" > SO </option>
                <option value="VW" > VW </option>
                <option value="BC" > BC </option>
                <option value="KC" > KC </option>
                <option value="FC" > FC </option>
                 <option value="HT" > HT </option>
                <option value="HG" > HG </option>
                <option value="MW" > MW </option>
                 <option value="RM" > RM </option>
                <option value="SF*" > SF* </option>
                </select></td>
        <td><div align="right">Status :</div></td>
        <td><select name="status" required="required" id="status">
              
                <option value="1" > Use </option>
                <option value="2" > Cancel </option>
                </select></td>
        </tr>
      <tr>
        <td><div align="right">Process :</div></td>
       
        <td><select name="step2" required="required" id="step">
          <option value="2" > Semi </option>
          <option value="1" > Premix </option>
        </select></td>
        <td><div align="right">Product Name :</div></td>
        <td><input name="txtproduct_name"   id="txtproduct_name" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Formula :</div></td>
        <td><input name="txtformula"  style="text-transform: uppercase" id="txtformula" type="text" /></td>
        <td><div align="right">Create By :</div></td>
        <td><input name="txtcreate_by"   id="txtcreate_by" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Version :</div></td>
        <td><input name="txtversion"  id="txtversion"  type="text" maxlength="5" /></td>
        <td><div align="right">Create Date :</div></td>
        <td><label for="txtcreate_date"></label>
          <input  id="txtcreate_date" type="date" data-role="date"></td>
        </tr>
      <tr>
        <td><div align="right">Fullformula :</div></td>
        <td><input name="txtfullformula" style="text-transform: uppercase" id="txtfullformula"  type="text" maxlength="20" /></td>
        <td><div align="right">Effective Date :</div></td>
        <td><input  id="txteffective_date" type="date" data-role="date"></td>
        </tr>
      <tr>
        <td><div align="right">Mixer :</div></td>
        <td><input name="txtmixer" style="text-transform: uppercase" id="txtmixer" type="text" /></td>
        <td><div align="right">Revise :</div></td>
        <td><input name="txtrevise"   id="txtrevise" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Definition :</div></td>
        <td><strong>
          <textarea name="txtdefinition"  id="txtdefinition" ></textarea>
        </strong></td>
        <td><div align="right">Batch Size :</div></td>
        <td><input name="txtbatch_size"  id="txtbatch_size"  type="text" /></td>
        </tr>
    </table>




    <button type="button"  id="insert" class=" insert ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-edit">Add</button>
  </div>
  </div>
    </form>
</div>
                  
                  </td>
                 </tr>
                 </table>
</div>
<div style="margin-top:60px;  padding-bottom:5px;"><h1><strong>Product List</strong></h1></span></div>
  <div style="text-align:center; padding:5px; background-color:#CEE1F7;">
       <p><strong style="font-size:20px">เลือก Mixer :</strong>
       
        
  
       
       
         <select id="mc" name="mc" data-role="none" onchange="MM_jumpMenu('parent',this,0)">
           <option  disabled="disabled">เลือก mixer</option>
           
           <?php 
		   $dev = $_SESSION["user_dev"];
		   
		    $stm="SELECT DISTINCT `mixer` FROM `p3mx_pd` WHERE dev = '$dev'";
$q=mysql_query($stm);
while($arr=mysql_fetch_array($q)){
 ?>
           <option value="?f=0&page=2&mc=<?php echo($arr['mixer']); ?>"<?php if($mc==$arr['mixer']){ echo "selected=\"selected\""; } ?>><?php echo $arr['mixer']; ?></option>
           <?php } ?>
         </select>
       </p>
      
    <p><div>*Status คือสถานะของ Product ว่ายังคงถูกผลิตอยู่หรือไม่โดย 1= ยังคงผลิตอยู่ 2 = ยกเลิกแล้ว </div></p>
     
	</div>



<div id="table" >
  <table width="100%" cellpadding="0" cellspacing="0" border="1">
    <tr bgcolor="#999999" >
      <th scope="col">ID</th>
      <th scope="col" width="10%">PD Group</th>
      <th scope="col">Process</th>
      <th scope="col">Formula</th>
      <th scope="col">Version</th>
      <th scope="col">Fullformula</th>
      <th scope="col">Mixer</th>
      <th scope="col">Definition</th>
      <th scope="col">Status</th>
      <th scope="col">Product_name</th>
      <th scope="col">Create by</th>
      <th scope="col">Create date</th>
      <th scope="col">Effective date</th>
      <th scope="col">Rev</th>
      <th scope="col">Batch size</th>
      <th  width="auto" scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
    <?php
require('../../include/config.inc.php'); 
 mysql_select_db($db);
  
$strSQL = "SELECT * FROM p3mx_pd where mixer = '".$mc."'";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");

while($arr=mysql_fetch_array($objQuery))
{
?>
     <tr onMouseOver="this.bgColor='#99FFFF'" onMouseOut ="this.bgColor = ''">
      <th scope="col"><?php echo $arr["id"]; ?></th>
      <th scope="col"><?php echo $arr["pd_group"];?></th>
      <th scope="col">
	  <?php if ($arr["process"]==1){echo "Premix";}
	   elseif ($arr["process"]==2){echo "Semi";}?>
      </th>
      <th scope="col"><?php echo $arr["formula"];?></th>
      <th scope="col"><?php echo $arr["version"];?></th>
      <th scope="col"><?php echo $arr["fullformula"];?></th>
      <th scope="col"><?php echo $arr["mixer"];?></th>
      <th scope="col"><?php echo $arr["definition"];?></th>
      <th scope="col"><?php echo $arr["status"];?></th>
      <th scope="col"><?php echo $arr["product_name"];?></th>
      <th scope="col"><?php echo $arr["create_by"];?></th>
      <th scope="col"><?php echo $arr["create_date"];?></th>
      <th scope="col"><?php echo $arr["effective_date"];?></th>
      <th scope="col"><?php echo $arr["rev"];?></th>
      <th scope="col"><?php echo $arr["batch_size"];?></th>
      
      
      <td align="center"><div align="center"><a href="#popupLogin-<?php echo $arr['id']; ?>" data-rel="popup" data-position-to="window"   class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-edit ui-btn-icon-left ui-btn-a"  data-transition="fade">Edit</a>
      </div>
        <div  data-role="popup" id="popupLogin-<?php echo $arr['id']; ?>" data-theme="a" class="ui-corner-all">
          <form  data-ajax="false">
         
   
         
              
            <div align="center" style="padding:10px 20px;">
              <h3 align="center">Production Data</h3>
             
              
  <div align="center">
    <table width="100%" border="1">
      <tr>
        <td><div align="right">PD Group :</div></td>
        <td><input  style="text-transform: uppercase" name="txtpd_group" value="<?php echo $arr["pd_group"];?>" id="txtpd_group-<?php echo $arr["id"]; ?>" type="text" /></td>
        <td><div align="right">Status :</div></td>
        <td><input name="txtstatus" value="<?php echo $arr["status"];?>" id="txtstatus-<?php echo $arr["id"]; ?>" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Process :</div></td>
       
        <td><select name="step" required="required" id="step-<?php echo $arr["id"]; ?>">
              
                <option value="2" <?php if ($arr['process'] == 2) { echo ' selected="selected"'; } ?>> Semi </option>
                <option value="1"  <?php if ($arr['process'] == 1) { echo ' selected="selected"'; } ?>  > Premix </option>
                </select>
                
                </td>
        <td><div align="right">Product Name :</div></td>
        <td><input name="txtproduct_name"  value="<?php echo $arr["product_name"];?>" id="txtproduct_name-<?php echo $arr["id"]; ?>" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Formula :</div></td>
        <td><input name="txtformula" value="<?php echo $arr["formula"];?>" id="txtformula-<?php echo $arr["id"]; ?>" type="text" /></td>
        <td><div align="right">Create By :</div></td>
        <td><input name="txtcreate_by" value="<?php echo $arr["create_by"];?>"   id="txtcreate_by-<?php echo $arr["id"]; ?>" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Version :</div></td>
        <td><input name="txtversion" value="<?php echo $arr["version"];?>" id="txtversion-<?php echo $arr["id"]; ?>" type="text" /></td>
        <td><div align="right">Create Date :</div></td>
        <td><label for="txtcreate_date"></label>
          <input type="text" name="txtcreate_date" value="<?php echo $arr["create_date"];?>" id="txtcreate_date-<?php echo $arr["id"]; ?>" /></td>
        </tr>
      <tr>
        <td><div align="right">Fullformula :</div></td>
        <td><input name="txtfullformula" id="txtfullformula-<?php echo $arr["id"]; ?>" value="<?php echo $arr["fullformula"];?>" type="text" /></td>
        <td><div align="right">Effective Date :</div></td>
        <td><input name="txteffective_date" value="<?php echo $arr["effective_date"];?>" id="txteffective_date-<?php echo $arr["id"]; ?>" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Mixer :</div></td>
        <td><input name="txtmixer" value="<?php echo $arr["mixer"];?>" id="txtmixer-<?php echo $arr["id"]; ?>" type="text" /></td>
        <td><div align="right">Revise :</div></td>
        <td><input name="txtrevise" value="<?php echo $arr["rev"];?>"  id="txtrevise-<?php echo $arr["id"]; ?>" type="text" /></td>
        </tr>
      <tr>
        <td><div align="right">Definition :</div></td>
        <td><textarea name="txtdefinition"  id="txtdefinition-<?php echo $arr["id"]; ?>" ><?php echo $arr["definition"];?></textarea></td>
        <td><div align="right">Batch Size :</div></td>
        <td><input name="txtbatch_size" value="<?php echo $arr["batch_size"];?>" id="txtbatch_size-<?php echo $arr["id"]; ?>"  type="text" /></td>
        </tr>
    </table>




    <button type="button"  id="<?php echo $arr["id"]; ?>" class=" update ui-btn ui-corner-all ui-shadow ui-btn-b ui-btn-icon-left ui-icon-edit">Update</button>
  </div>
  </div>
  <div align="center">  </div>
  </form>
</div></td>






























      <td align="center"><a href="#popupDialog-<?php echo $arr["id"]; ?>" data-rel="popup" data-position-to="window"  style="background-color: #CCC "data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Delete</a>
<div data-role="popup" id="popupDialog-<?php echo $arr["id"]; ?>" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
   
    <div role="main" style= "background-color:#FFF"class="ui-content">
        <h3 style="color:black;" class="ui-title">Are you sure you want to delete Standard ID <?php echo $arr["id"]; ?> ?</h3>
    
 <a href="delete.php?id=<?php echo $arr["id"]; ?>&mc=<?php echo $mc ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false">Delete</a>
        <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Cancel</a>
       
    </div>
</div>


</td>
    </tr>
    <?php
  }
  
  ?>
  </table>
</div>
