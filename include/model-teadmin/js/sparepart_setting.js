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
  
  //delete sparepart
  $(".del-sp").on("click",function(){
	 if (confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?")) {	
	 var spr_id = $(this).attr("id");
	 var sprg_name = $("#sprg_name").val();
	 var mn = $("#mn").val();
	 var dev_root = $("#dev_root").val();
	 var dataString = 'spr_id='+spr_id+'&flag=256';
	 
	      $.ajax({ type: "POST", url: "../../query/delete_sparepart.php",
			data: dataString, cache: false,
			success: function(html)
			{    
				 if(html==1){
					 window.location.href = 'http://lionproduction.sli/pdmis/'+dev_root+'/teadmin/?f=1&mn='+mn+'&gr='+sprg_name;
				 }else{ 
				 	 alert("ไม่สามารถลบ Sparepart นี้ได้ "+html);
				 } 
 			}//end success
		  }); //end ajax posted
	 }//end if confirm
		  
  });
  
	      

	
}); //end $(document).ready

 