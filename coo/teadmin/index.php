<?php session_start(); ?>
<?php 
/******************** MIS STANDARD HEADER ***********************	
File Name         : index.php
    Project No    : 
    Create Date  : 05/08/2016
	Create by     : MIS Name
	Log:  DD/MM/YYYY : Description, By Name
            05/08/2016 : Example description reversion, By MIS Name
/****************************************************************/
?>
<?php
 if(!isset($_SESSION["name"])){
	echo"Session คุณหมดอายุ กรุณาเข้าสู่ระบบอีกครั้ง";
	echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>";
	exit();
	}
 if(!$_SESSION['uname']){  echo"<meta http-equiv='refresh' content='0; url=http://lionproduction.sli'>"; }
 
error_reporting(E_ALL);
 
 require('../../include/config.inc.php'); 
 mysql_select_db($db,$connect); 
 	
//menu get
		if(!isset($_GET['m'])){
			$m='mtmachine';
		}else{
			if($_GET['m']=='0')
			{
			$m='mtmachine';
			}else{
			$m=$_GET['m'];	
			}
		}
		
//Initial setting
$dev_v1 = 'PK200';
$plant = '1200';		
$dev_root = 'coo';
 
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
       <?php  require('components/menu.php'); ?>
    <!-- header -->

    <?php require('components/header.php'); ?>
   <?php 
		//Module requirement 
		 if($m=='mtmachine'){ require('../../include/model-teadmin/components/page/module_machine.php'); }  
		elseif($m=='mtsparepart'){ require('../../include/model-teadmin/components/page/module_sparepart.php'); }
		elseif($m=='mtworkorder'){ require('../../include/model-teadmin/components/page/module_workorder.php'); }
		 
		
	?>
        
        <!--/content-->
	 

	<div data-role="footer">
		<?php include('../../components/footer.php'); ?>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>
