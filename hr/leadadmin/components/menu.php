<div data-role="panel" id="leftpanel">
    
      <ul data-role="listview" data-inset="true" data-filter="true" data-input="#filter-for-listview">
    
    <li> <a href="#" data-role="button" data-icon="info" data-iconpos="left" data-corners="false"  data-theme="c" data-ajax="false"> เมนูหลัก </a></li>
 
   
 
     
    </ul>
      
</div><!-- /panel -->

<div data-role="panel" id="rightpanel" data-position="right" >
            <div class="ui-corner-all custom-corners" >
               <div class="ui-bar ui-bar-a   ui-btn-icon-left ui-icon-lock" style="background-color:#000; color:#FFF;">
              <?php if(!$_SESSION['uname']){ echo '<h3>เข้าสู่ระบบ</h3>'; }else{ echo '<h3>ข้อมูลบัญชี</h3>'; }; ?>
               </div>
               <div class="ui-body ui-body-a">
               
               <?php if($_SESSION['uname']){ ?>
               <p><strong>ชื่อผู้ใช้ :</strong> <?php echo $_SESSION['uname']; ?> </p>
               <p><strong>ชื่อ :</strong> <?php echo $_SESSION['name']; ?></p>
               <p><strong>ตำแหน่ง :</strong> <?php echo $_SESSION['position']; ?> </p>
               <p><strong>หน่วยงาน :</strong> <?php echo $_SESSION['dev']; ?> </p>
                 <a href="../../components/signout.php" data-role="button" data-icon="lock" data-iconpos="left" data-corners="false"  data-theme="c" data-ajax="false" >ออกจากระบบ</a>
               <?php }else{ ?>
              
               
               <form action="../../components/singin.php" method="post" enctype="multipart/form-data" data-ajax="false">
                
               <input name="user_login" type="text" required="required" placeholder="ชื่อผู้ใช้งาน" />
               
               <input name="pwd_login" type="password" required="required" placeholder="รหัสผ่าน" />
               <input name="submit" type="submit" value="เข้าสู่ระบบ" />
                
               </form>
               <?php } ?>
               
               
             
               
             </div>
        </div>
        <br/> 
  <div class="ui-body ui-body-a ui-corner-all">
      <h3>Tip &amp; Tips. :)</h3>
       <p>TPM คือระบบที่จะเอาไว้เก็บข้อมูลคาบเวลาที่เปลี่ยนอะไหล่ของเครื่องจักรเพื่อนำมาใช้ในการออกแบบตารางPM ชึ่งมีจุดประสงค์เพื่อให้มีการลดDowntime  B จึ่งขอความร่วมมือ Technician ของ plant 100,200 ช้วยทำการบันทึกข้อมูล  กรณีใช้งานโปรแกรมมีปัญหา หรือไม่สะดวกต่อการใช้งาน ฯ กรุณาติดต่อทีมงาน Staff เพื่อที่จะปรับปรุงโปรแกรมให้มีประสิทธิ์ภาพขึ้นไปครับ 
       
       <hr/>
       Staff ผู้รับผิดชอบโครงการ : สุรชัย (เบิร์ด) โทร 659, 630</p>
  </div>
  

</div><!-- /panel -->