// JavaScript Document
 //Script by Tinnakorn.M Staff HH, Tel 0850017756, iam_rorrak@hotmail.com
 /** LAST UPDATE  **********
    -  11/06/2016 create file.
 
 ************************/
$(document).ready(function() 
{ //start all function here
  
  
  
  //delete sparepart
  $(".del-jrq").on("click",function(){
	 if (confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?")) {	
	 var JRID = $(this).attr("id");
	 var dev_root = $("#dev_root").val();
	 var dataString = 'JRID='+JRID+'&flag=826';
	 
	      $.ajax({ type: "POST", url: "../../query/delete_workorder.php",
			data: dataString, cache: false,
			success: function(html)
			{    
				 if(html==1){
					 window.location.href = 'http://lionproduction.sli/pdmis/'+dev_root+'/teadmin/?f=2&mn=1';
				 }else{ 
				 	 alert("ไม่สามารถลบ Sparepart นี้ได้ "+html);
				 } 
 			}//end success
		  }); //end ajax posted
	 }//end if confirm
		  
  });
  
	      

	
}); //end $(document).ready

 