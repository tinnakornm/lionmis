<div data-role="panel" id="leftpanel">
     <ul data-role="listview" data-inset="true" data-filter="true" data-input="#filter-for-listview">
    
     <li> <a href="#" data-role="button" data-icon="info" data-iconpos="left" data-corners="false"  data-theme="c" data-ajax="false"> MAIN MENU </a></li>
  <li> <a href="?f=0&page=2" data-role="button" data-icon="plus" data-iconpos="left" data-corners="false"  data-theme="c" data-ajax="false"> Add PD Data </a></li>
  
  
<li> <a href="?f=0&page=3" data-role="button" data-icon="action" data-iconpos="left" data-corners="false"  data-theme="c" data-ajax="false"> Create Routing </a></li>
    </ul>
      
      
</div><!-- /panel -->



<div data-role="panel" id="rightpanel" data-position="right" >
    
 
    <div class="ui-corner-all custom-corners" >
               <div class="ui-bar ui-bar-a   ui-btn-icon-left ui-icon-lock" style="background-color:rgb(85, 91, 162); color:#FFF;">
              <?php if(!$_SESSION['uname']){ echo '<h3>เข้าสู่ระบบ</h3>'; }else{ echo '<h3>ข้อมูลบัญชี</h3>'; }; ?>
               </div>
               <div class="ui-body ui-body-a">
               
               <?php if($_SESSION['uname']){ ?>
               <p><strong>ชื่อผู้ใช้ :</strong> <?php echo $_SESSION['uname']; ?> </p>
               <p><strong>ชื่อ :</strong> <?php echo $_SESSION['name']; ?></p>
               <p><strong>ตำแหน่ง :</strong> <?php echo $_SESSION['position']; ?> </p>
               <p><strong>หน่วยงาน :</strong> 
			   <?php if ($_SESSION['dev']== "bcmx300")			
			   echo  "ห้องผสม Beauty Care" ; ?> </p>
                 <a href="../../components/signout.php" data-role="button" data-icon="power"  data-iconpos="left" data-corners="false"  data-theme="c" data-ajax="false" >ออกจากระบบ</a>
               <?php }else{ ?>
              
               
               <form action="../../../components/singin.php" method="post" enctype="multipart/form-data" data-ajax="false">
                
               <input name="user_login" type="text" required="required" placeholder="ชื่อผู้ใช้งาน" />
               
               <input name="pwd_login" type="password" required="required" placeholder="รหัสผ่าน" />
               <input name="submit" type="submit" value="เข้าสู่ระบบ" />
                
               </form>
               <?php } ?>
               
               
             
               
             </div>
        </div>
       
      
</div><!-- /panel -->