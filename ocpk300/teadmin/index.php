
<?php session_start();
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
	
/*	File Name    : index.php
    	Project No   : 
    	Create Date  : 05/08/2016
	Create by    : Tinnakorn.M
	Description  : Index of TE Admin
	psd/File data flow:
        ---------------------------------------------------------------------------
        ---------------------------------------------------------------------------        
	Log:  DD/MM/YYYY : Description, [Card No: ], By 
            
            - 17/12/2012 : [Card No:-], Create , By Tinnakorn.M
	    
			
	    (Case backup)
            - DD/MM/YYYY : Backup, File name : xx.php, By Tinnakorn.M
	       
*/


 if(!$_SESSION['uname']){  echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>"; }
 
error_reporting(E_ALL);




 require('../../include/config.inc.php'); 
 mysql_select_db($db,$connect); 
 	
//menu get
		if(!isset($_GET['f'])){
			$f=0;
		}else{
			$f=$_GET['f'];
		}
		
//Initial setting
$dev_v1 = 'OCPK300';
$plant = '1300';		
$dev_root = 'ocpk300';
 
 ?>

<!DOCTYPE html>
<html>
<head>
<?php   !isset($_GET['mc']) ? $mc='ALL'   : $mc=$_GET['mc']   ;    ?>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title>Technician TPM</title>
	<link rel="stylesheet"  href="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	<style type="text/css">
	 .ui-responsive {
 display: table-row-group;
}
 
<?php if($_SESSION['uname']){ ?>
.ui-icon-user:after{ background-color:#060; }
<?php } ?>

  table { border-collapse:collapse;}
 .frame{ border: 1px solid black;	text-align: center; }
  
  .ui-filter-inset {
			margin-top: 0;
		}
    </style>
	<script type="text/javascript" src="../../include/lib/jquery1.10.2.min.js"> 	</script>
	<script src="../../include/lib/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js"></script>
    <!-- 
 <script type="text/javascript" src="../../components/lightbox/facebox.js" ></script>
 <link href="../../components/lightbox/facebox.css" media="screen" rel="stylesheet" type="text/css" />
 <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : '../../components/lightbox/loading.gif',
        closeImage   : '../../components/lightbox/closelabel.png'
      })
    })
    </script>
    -->
 
 
 <script type="text/javascript">
	$( document ).on( "pageinit", "#myPage", function() {
	 
    $( "#autocomplete" ).on( "filterablebeforefilter", function ( e, data ) {
        var $ul = $( this ),
            $input = $( data.input ),
            value = $input.val(),
            html = "";
        $ul.html( "" );
        if ( value && value.length > 1 ) {
            $ul.html( "<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>" );
            $ul.listview( "refresh" );
            $.ajax({
                url: "http://lionproduction.sli/pdmis/include/model-teadmin/components/ajax_searchsparepart.php",
                dataType: "jsonp",
                crossDomain: true,
                data: {
                    q: $input.val()
                }
            })
            .then( function ( response ) {
                $.each( response, function ( i, val ) {
                    html += "<li><a data-ajax=\"false\" href=?f=1&amp;q="+val.substring(0, 12)+" style=\"background-color:rgb(0, 188, 212); color:#FFF\">" + val + "</a></li>";
                });
                $ul.html( html );
                $ul.listview( "refresh" );
                $ul.trigger( "updatelayout");
            });
        }
    });
});
	</script>   
    
</head>

<body>
<div data-role="page" id="myPage" data-url="myPage" >
   <!-- panel -->
       <?php  require('../../include/model-teadmin/components/menu.php'); ?>
    <!-- header -->

    <?php require('../../include/model-teadmin/components/header.php'); ?>
   <?php 
		//Module requirement 
		//if($f==0){  require('components/page/index.php'); }
		 if($f==0){ require('../../include/model-teadmin/components/page/module_machine.php'); }  
		elseif($f==1){ require('../../include/model-teadmin/components/page/module_sparepart.php'); }
		elseif($f==2){ require('../../include/model-teadmin/components/page/module_workorder.php'); }
		 
		
	?>
        
        <!--/content-->
	 

	<div data-role="footer">
		<?php include('../../components/footer.php'); ?>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
