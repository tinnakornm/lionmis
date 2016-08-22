// JavaScript Document
 //Script by Tinnakorn.M Staff HH, Tel 0850017756, iam_rorrak@hotmail.com
 //02/05/2015
 //18-07-2015 Add check_note_mx on newreport 
$(document).ready(function() 
{ //start all function here
 	//startbtf
	$('#newreport').on("submit",function(){
		
		$.mobile.loading('show');
		 var step = $("#step").val();
		 var main_mixer = $("#main_mixer").val();
		 var fullformula =  $('#fullformula').val();
		  var col_point = $("#col_point").val();
		 var point = $("#point").val();
		  var order_no = $("#order_no").val();
		 var bt_no = $("#bt_no").val();
		 var bt_size = $("#bt_size").val();
		   var tank_no = $("#tank_no").val();
		 var mix_uname = $("#mix_uname").val();
		  var check_note_mx = $("#check_note_mx").val();
		 
		 var dataString = 'step='+step+'&main_mixer='+main_mixer+'&fullformula='+fullformula+'&col_point='+col_point
		 +'&point='+point+'&order_no='+order_no+'&bt_no='+bt_no+'&bt_size='+bt_size+'&tank_no='+tank_no+'&mix_uname='+mix_uname+'&check_note_mx='+check_note_mx;
		
		  $.ajax({ type: "POST", url: "components/startmxqa.php",
			data: dataString, cache: false,
			success: function(html)
			{    
				 $("#info").text(html);
				
				 return false;
				
				  if(html==0){alert('ใบส่งตัวอย่างถูกส่งไปยังแผนก QA แล้ว');
				   location.reload(); 
				 }else{ 
			
				//  $.mobile.loading('hide');
				 // location.reload();
				   }
 			}//end success
		  }); //end ajax posted
	});//end on click
	
 
 
 
    //point select
	$("#col_point").on("change",function(){
	var value = $(this).val();
	if(value != 4)
	$("#div_point").css("display","none");
 	else
 	$("#div_point").css("display","block");		
		});

  
	//point select in copy menu
	$("#col_point2").on("change",function(){
	var value = $(this).val();
	if(value != 4)
	$("#div_point2").css("display","none");
 	else
 	$("#div_point2").css("display","block");		
		});

 
	
	//event keypress  = enter
	$('input').on("keypress", function(e) {
            /* ENTER PRESSED*/
            if (e.keyCode == 13) {
                   
                 $(this).blur();
                return false;
            }
			
			
        });
		

		
		
	
	  
	  
	  

	  
	  
		
	
	  
	  

 	
		
		
	//update edit pd-standard
		$(".update").on("click",function()  
      {  
var ID = $(this).attr("id");
var pd_group = $("#txtpd_group-"+ID).val();
var step = $("#step-"+ID).val();
var formula = $("#txtformula-"+ID).val();
var version = $("#txtversion-"+ID).val();
var fullformula = $("#txtfullformula-"+ID).val();
var mixer = $("#txtmixer-"+ID).val();
var definition = $("#txtdefinition-"+ID).val();
var status = $("#txtstatus-"+ID).val();
var product_name = $("#txtproduct_name-"+ID).val();
var create_by = $("#txtcreate_by-"+ID).val();
var create_date = $("#txtcreate_date-"+ID).val();
var effective_date = $("#txteffective_date-"+ID).val();
var rev = $("#txtrevise-"+ID).val();
var batch_size = $("#txtbatch_size-"+ID).val();
var dev = $("#txtdev-"+ID).val();
var dev = $("#txtdev").val();
	var dataString ='id='+ID+ '&pd_group='+pd_group+'&process='+step+'&formula='+formula+'&version='+version+'&fullformula='+fullformula+'&mixer='+mixer+'&definition='+definition+'&status='+status+'&product_name='+product_name+'&create_by='+create_by+'&create_date='+create_date+'&effective_date='+effective_date+'&rev='+rev+'&batch_size='+batch_size+'&dev='+dev;
	 
			
	      $.ajax({ type: "POST", url: "saveedit.php",
			data: dataString, cache: false,
			success: function(html)
			{    
				  if(html==0){alert('Save Done.'); location.reload(); 
				 }else{ 
				 alert(html);
				  
				  $.mobile.loading('hide');
				  location.reload();  }
 			}//end success
		  }); //end ajax postedแ
	
		
	  });
		
		
		
		
		
		
		//insert new product
		$(".insert").on("click",function()  
      {  
	 
var ID = $(this).attr("id");


var pd_group = $("#pd_group").val();

var step = $("#step").val();
var formula = $("#txtformula").val();
var version = $("#txtversion").val();
var fullformula = $("#txtfullformula").val();
var mixer = $("#txtmixer").val();
var definition = $("#txtdefinition").val();
var status = $("#status").val();
var product_name = $("#txtproduct_name").val();
var create_by = $("#txtcreate_by").val();
var create_date = $("#txtcreate_date").val();
var effective_date = $("#txteffective_date").val();
var rev = $("#txtrevise").val();
var batch_size = $("#txtbatch_size").val();
var dev = $("#txtdev").val();

	var dataString ='id='+ID+'&pd_group='+pd_group+'&process='+step+'&formula='+formula+'&version='+version+'&fullformula='+fullformula+'&mixer='+mixer+'&definition='+definition+'&status='+status+'&product_name='+product_name+'&create_by='+create_by+'&create_date='+create_date+'&effective_date='+effective_date+'&rev='+rev+'&batch_size='+batch_size+'&dev='+dev;
	 

	      $.ajax({ type: "POST", url: "components/save_insert_pd.php",
			data: dataString, cache: false,
			success: function(html)
			{    
				  if(html==0){alert('Insert Sucess'); location.reload(); 
				 }else{ 
				  prompt(text,html);
				  $.mobile.loading('hide');
				  location.reload();  }
 			}//end success
		  }); //end ajax posted
	
		
	  });	
		
		
		
		
		
		
		
		
		
		
		
}); //end $(document).ready

 