// JavaScript Document 11/10/2556
 //Script by Tinnakorn.M Staff HH, Tel 0850017756, iam_rorrak@hotmail.com
 // - 15/05/2014 Change time format to datetime format
 // - 15/05/2014 Add event enter keypress
 // - 31/03/2015 Class posted (Advance jquery)
 // - 10/07/2015 Add posted TOT, NOT
 
$(document).ready(function() 
{ //start all function here

//check approved 
IsApporved();


 var DW1 = $("#DW1").val();
 var DW2 = $("#DW2").val();
  	   if(DW1==""){
		    $(".DW1").attr("disabled", true);
	   }else{
		    $(".DW1").attr("disabled", false); 
	   }
  	   if(DW2==""){
		    $(".DW2").attr("disabled", true);
	   }else{
		    $(".DW2").attr("disabled", false); 
	   }



$(document).keypress(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		$(".check").click();
	}
});

//Class submit
 
 $('.T1').on("change",function() {  var T = 1; var GIDF = $(this).attr("id");	 var c =  $('#cdate').val()+' '; ClassPoste(T,GIDF,c); });
 $('.T2').on("change",function() {  var T = 2; var GIDF = $(this).attr("id");	 var c =  $('#cdate').val()+' '; ClassPoste(T,GIDF,c); });
 $('.T3').on("change",function() {  var T = 3; var GIDF = $(this).attr("id");	 var c =  $('#cdate').val()+' '; ClassPoste(T,GIDF,c); });
 $('.T4').on("change",function() {  var T = 4; var GIDF = $(this).attr("id");	 var c =  $('#cdate').val()+' '; ClassPoste(T,GIDF,c); });
 $('.T5').on("change",function() {  var T = 5; var GIDF = $(this).attr("id");	 var c =  $('#cdate').val()+' '; ClassPoste(T,GIDF,c); });
 $('.T6').on("change",function() {  var T = 6; var GIDF = $(this).attr("id");	 var c =  $('#cdate').val()+' '; ClassPoste(T,GIDF,c); });
	
 function ClassPoste(T,GIDF,c){
	   var mix_be = $('#mix_be'+T).val();   var mix_fi = $('#mix_fi'+T).val(); if(mix_be){ mix_be = c+mix_be; } if(mix_fi){ mix_fi = c+mix_fi; }
		var analy_be = $('#analy_be'+T).val();   var analy_fi = $('#analy_fi'+T).val();if(analy_be){ analy_be = c+analy_be; } if(analy_fi){ analy_fi = c+analy_fi; }
		var transf_be = $('#transf_be'+T).val();   var transf_fi = $('#transf_fi'+T).val(); if(transf_be){ transf_be = c+transf_be; } if(transf_fi){ transf_fi = c+transf_fi; }
		var AD19_be = $('#AD19_be'+T).val();   var AD19_fi = $('#AD19_fi'+T).val(); if(AD19_be){ AD19_be = c+AD19_be; } if(AD19_fi){ AD19_fi = c+AD19_fi; }
		var AD20_be = $('#AD20_be'+T).val();   var AD20_fi = $('#AD20_fi'+T).val(); if(AD20_be){ AD20_be = c+AD20_be; } if(AD20_fi){ AD20_fi = c+AD20_fi; }
		var AD25_be = $('#AD25_be'+T).val();   var AD25_fi = $('#AD25_fi'+T).val(); if(AD25_be){ AD25_be = c+AD25_be; } if(AD25_fi){ AD25_fi = c+AD25_fi; }
		var AD51_be = $('#AD51_be'+T).val();   var AD51_fi = $('#AD51_fi'+T).val(); if(AD51_be){ AD51_be = c+AD51_be; } if(AD51_fi){ AD51_fi = c+AD51_fi; }
		var AD54_be = $('#AD54_be'+T).val();   var AD54_fi = $('#AD54_fi'+T).val(); if(AD54_be){ AD54_be = c+AD54_be; } if(AD54_fi){ AD54_fi = c+AD54_fi; }
		var AK01_be = $('#AK01_be'+T).val();   var AK01_fi = $('#AK01_fi'+T).val(); if(AK01_be){ AK01_be = c+AK01_be; } if(AK01_fi){ AK01_fi = c+AK01_fi; }
		var AD53_be = $('#AD53_be'+T).val();   var AD53_fi = $('#AD53_fi'+T).val(); if(AD53_be){ AD53_be = c+AD53_be; } if(AD53_fi){ AD53_fi = c+AD53_fi; }
		var AD13_be = $('#AD13_be'+T).val();   var AD13_fi = $('#AD13_fi'+T).val(); if(AD13_be){ AD13_be = c+AD13_be; } if(AD13_fi){ AD13_fi = c+AD13_fi; }
		var AD61_be = $('#AD61_be'+T).val();   var AD61_fi = $('#AD61_fi'+T).val(); if(AD61_be){ AD61_be = c+AD61_be; } if(AD61_fi){ AD61_fi = c+AD61_fi; }
		var AD10_be = $('#AD10_be'+T).val();   var AD10_fi = $('#AD10_fi'+T).val(); if(AD10_be){ AD10_be = c+AD10_be; } if(AD10_fi){ AD10_fi = c+AD10_fi; }
		var AD97_be = $('#AD97_be'+T).val();   var AD97_fi = $('#AD97_fi'+T).val(); if(AD97_be){ AD97_be = c+AD97_be; } if(AD97_fi){ AD97_fi = c+AD97_fi; }
		var BMEX_be = $('#BMEX_be'+T).val();   var BMEX_fi = $('#BMEX_fi'+T).val(); if(BMEX_be){ BMEX_be = c+BMEX_be; } if(BMEX_fi){ BMEX_fi = c+BMEX_fi; }
		var AQ92_be = $('#AQ92_be'+T).val();   var AQ92_fi = $('#AQ92_fi'+T).val(); if(AQ92_be){ AQ92_be = c+AQ92_be; } if(AQ92_fi){ AQ92_fi = c+AQ92_fi; }
		var AQ94_be = $('#AQ94_be'+T).val();   var AQ94_fi = $('#AQ94_fi'+T).val();  if(AQ94_be){ AQ94_be = c+AQ94_be; } if(AQ94_fi){ AQ94_fi = c+AQ94_fi; }
		var AL92_be = $('#AL92_be'+T).val();   var AL92_fi = $('#AL92_fi'+T).val(); if(AL92_be){ AL92_be = c+AL92_be; } if(AL92_fi){ AL92_fi = c+AL92_fi; }
		var AU98_be = $('#AU98_be'+T).val();   var AU98_fi = $('#AU98_fi'+T).val(); if(AU98_be){ AU98_be = c+AU98_be; } if(AU98_fi){ AU98_fi = c+AU98_fi; }
		var AU99_be = $('#AU99_be'+T).val();   var AU99_fi = $('#AU99_fi'+T).val(); if(AU99_be){ AU99_be = c+AU99_be; } if(AU99_fi){ AU99_fi = c+AU99_fi; }
		var AU97_be = $('#AU97_be'+T).val();   var AU97_fi = $('#AU97_fi'+T).val(); if(AU97_be){ AU97_be = c+AU97_be; } if(AU97_fi){ AU97_fi = c+AU97_fi; }
		var AL93_be = $('#AL93_be'+T).val();   var AL93_fi = $('#AL93_fi'+T).val(); if(AL93_be){ AL93_be = c+AL93_be; } if(AL93_fi){ AL93_fi = c+AL93_fi; }
		var BMED_be = $('#BMED_be'+T).val();   var BMED_fi = $('#BMED_fi'+T).val(); if(BMED_be){ BMED_be = c+BMED_be; } if(BMED_fi){ BMED_fi = c+BMED_fi; }	
		var BMEY_be = $('#BMEY_be'+T).val();   var BMEY_fi = $('#BMEY_fi'+T).val(); if(BMEY_be){ BMEY_be = c+BMEY_be; } if(BMEY_fi){ BMEY_fi = c+BMEY_fi; }	
		var DW1_be = $('#DW1_be'+T).val();   var DW1_fi = $('#DW1_fi'+T).val(); if(DW1_be){ DW1_be = c+DW1_be; } if(DW1_fi){ DW1_fi = c+DW1_fi; }	    var DW2_be = $('#DW2_be'+T).val();   var DW2_fi = $('#DW2_fi'+T).val(); if(DW2_be){ DW2_be = c+DW2_be; } if(DW2_fi){ DW2_fi = c+DW2_fi; }	
		
		var order = $('#order'+T).val(); 
		var product = $('#product'+T).val(); 
		var batch_no = $('#batch_no'+T).val(); 
		var batch_ton = $('#batch_ton'+T).val(); 
		var quality = $('#quality'+T).val(); 
		var storage = $('#storage'+T).val(); 
		
		var dataString = 'T='+T+'&GIDF='+GIDF+'&mix_be='+mix_be+'&analy_be='+analy_be+'&transf_be='+transf_be+'&AD19_be='+AD19_be+'&AD20_be='+AD20_be+'&AD25_be='+AD25_be+'&AD51_be='+AD51_be+'&AD54_be='+AD54_be+'&AK01_be='+AK01_be+'&AD53_be='+AD53_be+'&AD13_be='+AD13_be+'&AD61_be='+AD61_be+'&AD10_be='+AD10_be+'&AD97_be='+AD97_be+'&BMEX_be='+BMEX_be+'&AQ92_be='+AQ92_be+'&AQ94_be='+AQ94_be+'&AL92_be='+AL92_be+'&AU98_be='+AU98_be+'&AU99_be='+AU99_be+'&AU97_be='+AU97_be+'&AL93_be='+AL93_be+'&BMED_be='+BMED_be+'&BMEY_be='+BMEY_be+'&mix_fi='+mix_fi+'&analy_fi='+analy_fi+'&transf_fi='+transf_fi+'&AD19_fi='+AD19_fi+'&AD20_fi='+AD20_fi+'&AD25_fi='+AD25_fi+'&AD51_fi='+AD51_fi+'&AD54_fi='+AD54_fi+'&AK01_fi='+AK01_fi+'&AD53_fi='+AD53_fi+'&AD13_fi='+AD13_fi+'&AD61_fi='+AD61_fi+'&AD10_fi='+AD10_fi+'&AD97_fi='+AD97_fi+'&BMEX_fi='+BMEX_fi+'&AQ92_fi='+AQ92_fi+'&AQ94_fi='+AQ94_fi+'&AL92_fi='+AL92_fi+'&AU98_fi='+AU98_fi+'&AU99_fi='+AU99_fi+'&AU97_fi='+AU97_fi+'&AL93_fi='+AL93_fi+'&BMED_fi='+BMED_fi+'&BMEY_fi='+BMEY_fi+'&DW1_be='+DW1_be+'&DW1_fi='+DW1_fi+'&DW2_be='+DW2_be+'&DW2_fi='+DW2_fi+'&order='+order+'&product='+product+'&batch_no='+batch_no+'&batch_ton='+batch_ton+'&quality='+quality+'&storage='+storage;
		 
		 
		  
	    	$.ajax({ type: "POST", url: "components/sfv2.php",
			data: dataString, cache: false,
			success: function(html)
			{   
			 
				if(html==1){
					 //std success information
				$('.inof_g').empty();
				$('.inof_g').append('<strong> <img src="../../source/images/check_24.png" width="24" height="24" align="absmiddle" />  บันทึกรายงานแล้ว </strong>');
				$('.inof_g').fadeIn("fast", function() { 
  				c_obj = $(this);
 			 	window.setTimeout(function() { $(c_obj).fadeOut("slow"); }, 1000); 
				});
					
				}else{ alert(html);
				/* alert('การบันทึกผิดพลาด กรุณาลองใหม่ หากคุณทดสอบแล้วไม่สำเร็จ กรุณาติดต่อ STAFF'); */
				 location.reload();
				}
 			}//end success
 	    }); //end ajax posted
 }
 


	//startbtf
	$('#editbt').on("submit",function(){
		$.mobile.loading('show');
		 var date = $("#date").val();
		 var pd_group = $("#pd_group").val();
		 var main_mixer = $("#main_mixer").val();
		 var mainshift = $("#mainshift").val();
		 var shiftleader = $("#shiftleader").val();
		 var start_tim_define = $("#start_tim_define").val();
		 var stop_tim_define = $("#stop_tim_define").val();
		 
		 var dataString = 'date='+date+'&pd_group='+pd_group+'&main_mixer='+main_mixer+'&mainshift='+mainshift+'&shiftleader='+shiftleader+'&start_tim_define='+start_tim_define+'&stop_tim_define='+stop_tim_define;
 
	      $.ajax({ type: "POST", url: "components/edit-oee.php",
			data: dataString, cache: false,
			success: function(html)
			{   
				  if(html==0){alert('แก้ไขรายงานสำเร็จ'); location.reload(); 
				 }else{ 
				  $.mobile.loading('hide');
				  location.reload();  }
 			}//end success
		  }); //end ajax posted
	});//end on click
	
 

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
	

//Spare DW 
    $('.DW').on("change",function() { 
	   var val = $(this).val();
	   var ID = $(this).attr("id");
	   var dataString = 'ID='+ID+'&val='+val;
	   
	     $.ajax({ type: "POST", url: "components/onchange_dw.php",
			data: dataString, cache: false,
			success: function(html)
			{   
				 
				   location.reload();  
 			}//end success
		  }); //end ajax posted
	   
	   
   });

	//Post TOT
	$('.TOT').on("change",function() { 
	var val = $(this).val();
	var key = $(this).attr("id"); 
 	var dataString2='key='+key+'&val='+val+'&type=TOT';
		$.ajax({ type: "POST",
			url: "components/sft.php",
			data: dataString2,cache: false,
			success: function(html)
			{ //std success information
				 
 			}//end success
 		}); //end ajax posted		
	});//end TOT Post
 
	//Post NOT
	$('.NOT').on("change",function() { 
	var val = $(this).val();
	var key = $(this).attr("id"); 
 	var dataString2='key='+key+'&val='+val+'&type=NOT';
		$.ajax({ type: "POST",
			url: "components/sft.php",
			data: dataString2,cache: false,
			success: function(html)
			{ //std success information
				    
 			}//end success
 		}); //end ajax posted		
	});//end NOT Post 
	    
}); //end $(document).ready



//loop check approved
   function IsApporved(){
	   for(var i=1;i<=6;i++){
	   var T = $(".SCKT"+i).val();
	   //Three status of T: 0,1,2
	   <!-- 0 : pending account -->  
	   <!-- 1 : account checked -->  
	   <!-- 2 : operate not checked -->    
	    if(T==0){ $(".T"+i).prop('disabled', false);  }else if(T==1){$(".T"+i).prop('disabled', true);}else{ } //locked cell
		
	   }
   }