// JavaScript Document
 //Script by Tinnakorn.M Staff HH, Tel 0850017756, iam_rorrak@hotmail.com
 /** LAST UPDATE  **********
    -  09/07/2016 create file.
 
 ************************/
$(document).ready(function() 
{ //start all function here
 
  //delete sparepart
  $(".del-item").on("click",function(){
	 if (confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?")) {	
	 var item_id = $(this).attr("id");
	 var main_id = $("#main_id").val();
	 var dev_root = $("#dev_root").val();
	 
	 var dataString = 'item_id='+item_id+'&flag=779';
	 
	      $.ajax({ type: "POST", url: "../../query/delete_mclocation.php",
			data: dataString, cache: false,
			success: function(html)
			{    
				 if(html==1){
					 window.location.href = 'http://lionproduction.sli/pdmis/'+dev_root+'/teadmin/index.php?f=0&mn=1&gr='+main_id;
				 }else{ 
				 	 alert("ไม่สามารถลบ Sparepart นี้ได้ "+html);
				 } 
 			}//end success
		  }); //end ajax posted
	 }//end if confirm
		  
  });
  
	      

	
}); //end $(document).ready

 