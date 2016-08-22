  <style type="text/css">

#alert {

    float:left;
    width:300px;
    height:100px;
    border:solid 2px red;
    text-align:center;
	background-color: #FFEAC6;
	margin-top:12%;
	margin-left:35%;
	position:fixed;
	padding:10px;
   color : red;
}

#btn {
    margin-left: auto;
    margin-right: auto;
    
}
</style>



 <div data-role="header" data-position="fixed" data-fullscreen="false" style="overflow:hidden; background-color: rgb(85, 91, 162);color: #FFF; " 
   >
 
        <h1> 
  
 
        
         QA REPORT  <BR>  
		 
		 ยินดีต้อนรับ คุณ <?php echo $_SESSION['name']; ?> 
        
        
        </h1>
        


    <script type="text/javascript">
		 $(document).ready(function() { //start all function here
			// set timeout
			
			
			$("#alert").hide(); // hide alert box
			var IntervalSec = 10; //set interval ping sec
			var tid = setTimeout(getPosted, IntervalSec*1000); //
		   
			 function getPosted(){
			  var dataString = "flag=start";
					$.ajax({ type: "POST", url: "components/ajax-service.php",
					data: dataString, cache: false,
					success: function(html)
					{   
						 if(html==1){
							 
							 
							 $("#alert").show();		 
					var audio1 = document.createElement('audio');
						audio1.setAttribute('src', 'components/sound/alert.mp3');
			
						audio1.addEventListener('ended', function() {
							 this.currentTime = 0;
							 this.play();
						}, true);
						
						audio1.play();
			
			
			
						$("#OKADIO").on("click",function(){
							audio1.addEventListener('ended', function() {
							 this.currentTime = 1;
							 this.play();
							 
							 
						}, false);
							$("#alert").hide();
							 window.location.href = 'http://lionproduction.sli/pdmis/bcmx300/leadadmin/?f=2';
						});
							/* //data update -> action to refresh.
							 alert('มีใบแจ้งใหม่หน่วยงาน QA');
							 window.location.href = 'http://lionproduction.sli/pdmis/bcmx300/leadadmin/?f=2'; */
						 }else{
							 //do nothing
						 }
						 
					}//end success
				}); //end ajax posted
				tid = setTimeout(getPosted, IntervalSec*1000); // repeat myself
			 }
			 
			 function abortTimer() { // to be called when you want to stop the timer
			  clearTimeout(tid);
			}
		 
		 }); //end $(document).ready
</script>
<!-- Alert -->
 
<div id="userauto"> </div>       
        
 
            
 <!-- navbar -->           
            
            <div data-role="navbar">
                <ul>
                    <li><a href="#leftpanel" data-icon="bars">เมนู</a></li>
                    
                    
                    <li><a href="?f=2" data-icon="grid" data-ajax="false" <?php if($f==2){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>QA REPORT</a></li>
                    
                    <li><a href="?f=0" data-icon="clock" data-ajax="false" <?php if($f==0){ echo 'class="ui-link ui-btn ui-btn-active"'; } ?>>Welcome</a></li>
                   
                    <li><a href="#rightpanel" class="ui-link ui-btn ui-icon-user ui-btn-icon-top">บัญชีผู้ใช้</a></li>
                </ul>
            </div><!-- /navbar -->
         
</div><!--/data-role header-->
<div   data-position="fixed" id="alert"  data-role="header" >
               มีใบแจ้งจากหน่วยงาน QA 
               </br>
               </br>
    <input type="button" class='btn' data-theme="b"    value=" &nbsp;&nbsp;  OK&nbsp;&nbsp;" id="OKADIO" />
        
    </div>