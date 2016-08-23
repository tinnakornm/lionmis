// JavaScript Document
 //Script by Tinnakorn.M Staff HH, Tel 0850017756, iam_rorrak@hotmail.com
 /** LAST UPDATE  **********
    -  12/02/2016 create file.
 
 ************************/
$(document).ready(function() 
{ //start all function here
  
 //recheck form databases mt_code
  $("#spr_mtcode").on("change",function(){
        
		var spr_mtcode = $(this).val();
		if(spr_mtcode!=""){
		var dataString = 'spr_mtcode='+spr_mtcode+'&flag=142';
	      $.ajax({ type: "POST", url: "components/check_mtcode.php",
			data: dataString, cache: false,
			success: function(html)
			{    
				 if(html==1){alert('Materail Code รหัสนี้มีอยู่ในระบบแล้ว กรุณาตรวจสอบบนเมนูค้นหา');
				    $("#spr_mtcode").removeClass("OK").addClass("BLOCK");
					$("#newsprt").attr('disabled', 'disabled');
				 }else if(html==0){ 
				 	$("#spr_mtcode").removeClass("BLOCK").addClass("OK");
					$("#newsprt").removeAttr("disabled");
				 }else{
					alert('Error:'+html);
					return false;
				 }
 			}//end success
		  }); //end ajax posted
		}//end if
  
  });
	      

	
}); //end $(document).ready

 // JavaScript Document