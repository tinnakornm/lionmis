 <div data-role="header" data-position="fixed" data-fullscreen="false" style="overflow:hidden; background-color: rgb(85, 91, 162);color: #FFF; " 
   >
 
        <h1> 
     
        
        HR LEAD AMIN  <?php echo $_SESSION['name']; ?>
        
        
        </h1>
        


<script type="text/javascript">
			function getRefresh() {
			$("#userauto").show("slow");
					$("#userauto").load("components/connect-session.php?"+Math.random(), '', callback);
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
                    <li><a href="#leftpanel" data-icon="bars"  >Menu</a></li>
                    <li><a href="http://lionproduction.sli/pdmis/hr/leadadmin/?f=0" data-icon="home" data-ajax="false" <?php if($f==0){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>Home</a></li>
                    <li><a href="http://lionproduction.sli/pdmis/hr/leadadmin/?f=2" data-icon="clock" data-ajax="false" <?php if($f==2){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>Quiz topic</a></li>
                    <li><a href="http://lionproduction.sli/pdmis/hr/leadadmin/?f=1" data-icon="gear" data-ajax="false" <?php if($f==1){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>Quiz register</a></li>
                    
                     
                    <li><a href="#rightpanel" class="ui-link ui-btn ui-icon-user ui-btn-icon-top">Account</a></li>
                </ul>
            </div><!-- /navbar -->
         
</div><!--/data-role header-->
