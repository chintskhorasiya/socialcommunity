<?php 
session_start();
include('configure/configure.php');

include('auth.php');

accessPermission('1,7','page');

$error_message = '';

$error = 0;	

if(count($_POST) > 0)

{

	if(trim($_POST['coupon_name']) == '')

	{

		$coupon_code_error = '<span class="notification-input ni-error">Enter Coupon Name.</span>';	

		$error = 1;

	}

	if(trim($_POST['coupon_code']) == '')

	{

		$coupon_code_error = '<span class="notification-input ni-error">Enter Coupon Code.</span>';	

		$error = 1;

	}

	if(trim($_POST['coupon_type']) == '')

	{

		$coupon_type_error = '<span class="notification-input ni-error">Select Coupon Type.</span>';	

		$error = 1;

	}

	/*if(!is_numeric($_POST['coupon_discount']))

	{

		echo $coupon_discount_error = '<span class="notification-input ni-error">This field is required.</span>';	

		$error = 1;

	}*/

	if($_POST['coupon_for_type'] == 1)

	{

		$_POST['coupon_for'] = 0;

	}

	

	if($error == 1)

	{

		$error_message = ' <div>

                                <span class="notification n-error">Please fillup all required information.</span>

                            </div>';

	}

	

	else

	{

		

			if($_POST['coupon_limit'] == 0)

			{

				$_POST['coupon_valid_from'] = '';

				$_POST['coupon_valid_to'] = '';

			}

			else if($_POST['coupon_limit'] == 1)

			{

				if($_POST['coupon_valid_from'] == '')

				{

					$_POST['coupon_limit'] = 0;

				}	

				else if($_POST['coupon_valid_to'] == '')

				{

					$_POST['coupon_valid_from']	=	date("Y-m-d", strtotime($_POST['coupon_valid_from']));

					$_POST['coupon_valid_to']	=	date("Y-m-d", strtotime($_POST['coupon_valid_to']));

					$_POST['coupon_valid_to']	= $_POST['coupon_valid_from'];

				}	

			}	

			$_POST['coupon_date'] = $current_date;

			$insert_id = insert_data('coupons',$_POST);

			if($insert_id)

			{

				header('location:coupons.php');

				exit;

			}

	}	

}

$styles 	 = include_styles('bootstrap.min.css,assets/jquery-ui/jquery-ui-1.10.1.custom.min.css,bootstrap-reset.css,font-awesome.css,DT_bootstrap.css,demo_page.css,demo_table.css,bootstrap-datepicker/css/datepicker.css,bootstrap-datetimepicker/css/datetimepicker.css,validationEngine.jquery.css,style.css,style-responsive.css');

$javascripts = include_js('lib/jquery.js,lib/jquery-1.8.3.min.js,bootstrap.min.js,accordion-menu/jquery.dcjqaccordion.2.7.js,scrollTo/jquery.scrollTo.min.js,nicescroll/jquery.nicescroll.js,scripts.js,gritter/gritter.js,jquery-1.10.2.js,jquery-ui-1.10.4.custom.js,bootstrap-datepicker/js/bootstrap-datepicker.js,bootstrap-datetimepicker/js/bootstrap-datetimepicker.js,jquery.validationEngine-en.js,jquery.validationEngine.js,acco-nav.js');

?>
<?=DOCTYPE;?>
<?=XMLNS;?>
<head>
<?=CONTENTTYPE;?>
<title>Listing Settings</title>
<?=$styles?>
<?=$javascripts?>
<script type="text/javascript">

$(document).ready(function(){

	$("#coupon_validate").validationEngine();

	 $( "#from" ).datepicker({

	 	minDate:0,

		changeMonth: true,

		dateFormat:'yy-mm-dd',

		numberOfMonths: 1,

		onClose: function( selectedDate ) {

			$( "#to" ).datepicker( "option", "minDate", selectedDate );

		}

	});

	$( "#to" ).datepicker({

	 	minDate:0,

		changeMonth: true,

		dateFormat:'yy-mm-dd',

		numberOfMonths: 1,

		onClose: function( selectedDate ) {

			$( "#from" ).datepicker( "option", "maxDate", selectedDate );

		}

	});

	$(".show_dates").hide();

	$("#coupon_limit").change(function(){

		$(".show_dates").toggle();

	});

	

	$(".show_category").hide();

	$("#coupon_for_type").change(function(){

		$(".show_category").toggle();

	});

	$(".amount").hide();

	//$(".discount").hide();

	$(".apply_on").change(function(){

		var val = $(this).val();

		

		if(val==1)

		{

			$(".discount").show();

			$(".amount").hide();

			$(".percentage").show();

		}

		else

		{

			$(".amount").show();

			//$(".discount").hide();

			$(".percentage").hide();

		}

	});

});

</script>
<script>

$(".form_datetime").datepicker({format: 'yyyy-mm-dd hh:ii'});

$(".form_datetime-component").datetimepicker({

    format: "dd MM yyyy - hh:ii"

});

</script> <script>        function toggle_visibility(id) {            var e = document.getElementById(id);            if (e.style.display == 'block')                e.style.display = 'none';            else                e.style.display = 'block';        }    </script><style>#panel-body {display:none;}</style>	
</head>

<body>
<section id="container"> 
  
  <?php  	include('header.php');?>
 
  
  <?php include('sidebar.php');?>
  
  
  <section id="main-content">
    <section class="wrapper">
      <div class="row">
        <div class="col-lg-12"> 				   <section class="panel">             <header class="panel-heading btn-primary">General Listing Settings              			</header>            <div class="panel-body">               <div class="position-center">                <form  role="form" action="#" method="post" enctype="multipart/form-data" id="coupon_validate">                   
				  <div class="clear"></div>
                   <div class="form-group col-md-6 padding-left-o">
                    <label>Additional title keywords</label>
                    <div class="input-group">
					<input type="number" class="form-control validate required" name="coupon_name" value="" />
                    
                    </div> 
				    				   <div class="clear"></div>				    <div class="form-group">                        <div class="checkbox">                        <label>                          <input type="checkbox" name="enable-repricing" value="1">                         Allow cross-store duplicates</label>
						 <span class="h-tooltip" aria-hidden="true">?</span>  
						  <div class="tooltip"><span>Allow 3rd party offers fulfilled by amazon to be considered.</span>
						  </div>						 </div>                     </div> 				    <div class="clear"></div>                   				    <div class="form-group">                        <div class="checkbox">                        <label>                          <input type="checkbox" name="enable-repricing"  checked value="1">                         PriceYak Listing Watcher</label>						 <span class="h-tooltip" aria-hidden="true">?</span>  						  <div class="tooltip"><span>Allow 3rd party offers fulfilled by amazon to be considered.</span>						  </div>						 </div>                     </div> 				    <div class="clear"></div>				                                     <input class="btn btn-info" type="submit" value="Save Listing Settings" />                 </form>              </div>            </div>          </section>		  		  
        </div>
      	  </div>
    </section>
  </section>
  
  <!--main content end--> 
  
  <!--right sidebar start-->
  
  <div class="right-sidebar">
    <div class="search-row">
      <input type="text" placeholder="Search" class="form-control">
    </div>
  </div>
  
  <!--right sidebar end--> 
  
</section>
</body>
</html>