// JavaScript Document
 //Script by Tinnakorn.M Staff HH, Tel 0850017756, iam_rorrak@hotmail.com
 //02/05/2015
$(document).ready(function() 
{ //start all function here
 
	//startbtf
	$('#newreport').on("submit",function(){
		$.mobile.loading('show');
		 var date = $("#date").val();
		 var pd_group = $("#pd_group").val();
		 var main_mixer = $("#main_mixer").val();
		 var mainshift = $("#mainshift").val();
		 var shiftleader = $("#shiftleader").val();
		 var lineleader = $("#lineleader").val();
		 var operater1 = $("#operater1").val();
		 var operater2 = $("#operater2").val();
		// var start_tim_define = $("#start_tim_define").val();
		// var stop_tim_define = $("#stop_tim_define").val();
		 var tim_shift =  $("#tim_shift").val();
		 
		 var dataString = 'date='+date+'&pd_group='+pd_group+'&main_mixer='+main_mixer+'&mainshift='+mainshift+'&shiftleader='+shiftleader+'&lineleader='+lineleader+'&operater1='+operater1+'&operater2='+operater2+'&tim_shift='+tim_shift;
		 
	 	 
	 
	      $.ajax({ type: "POST", url: "components/startbtf.php",
			data: dataString, cache: false,
			success: function(html)
			{   
				  if(html==0){alert('สร้างรายงานใหม่สำเร็จ'); location.reload(); 
				 }else{ 
				  alert(html);
				  $.mobile.loading('hide');
				  location.reload();  }
 			}//end success
		  }); //end ajax posted
	});//end on click
	
 
	
	//event keypress  = enter
	$('input').on("keypress", function(e) {
            /* ENTER PRESSED*/
            if (e.keyCode == 13) {
                   
                 $(this).blur();
                return false;
            }
        });
		
	
}); //end $(document).ready

 