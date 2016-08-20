 <div data-role="header" data-position="fixed" data-fullscreen="false" style="overflow:hidden; background-color: rgb(85, 91, 162);color: #FFF; " 
   >
 
        <h1> 
     
        
        TE ADMIN  <?php echo $_SESSION['name']; ?>
        
        
        </h1>
        


<script type="text/javascript">
			function getRefresh() {
			$("#userauto").show("slow");
					$("#userauto").load("http://lionproduction.sli/pdmis/include/model-teadmin/components/service/connect-session.php?"+Math.random(), '', callback);
			}
			
			function callback() { 
					$("#userauto").fadeIn("slow");
					setTimeout("getRefresh();", 30000); // every 30 sec reflesh.
			}
			
			$(document).ready( 
				function(){ 
					getRefresh(); 
				}
			);
</script>
<!-- Alert -->
 
<div id="userauto"> </div>       

            <!-- /navbar -->
            
                        <div data-role="navbar">
                <ul>
                    <li><a href="#leftpanel" data-icon="bars"  >เมนู</a></li>
                    <li><a href="?f=0" data-icon="home" data-ajax="false" <?php if($f==0){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>เครื่องจักร</a></li>
                    <li><a href="?f=2" data-icon="clock" data-ajax="false" <?php if($f==2){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>ใบแจ้งซ่อม</a></li>
                    <li><a href="?f=1" data-icon="gear" data-ajax="false" <?php if($f==1){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>สแปร์พาร์ท</a></li>
                    
                     
                    <li><a href="#rightpanel" class="ui-link ui-btn ui-icon-user ui-btn-icon-top">บัญชีผู้ใช้</a></li>
                </ul>
            </div><!-- /navbar -->
         
</div><!--/data-role header-->
