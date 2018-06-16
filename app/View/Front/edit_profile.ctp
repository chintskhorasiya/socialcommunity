<?php
echo $this->element('frontheader');
?>
<div class="services-breadcrumb">
	 <div class="container">	
		<div class="inner_breadcrumb">
			<ul class="short_ls">
				<li>
					<a href="<?=DEFAULT_URL?>">Home</a>
					<span>/ </span>
				</li>
				<li>Edit Profile</li>
			</ul>
		</div>
	  </div>
   </div>
	<!-- welcome -->
	<div class="welcome inner-page contact-page" id="about">	
		<div class="container"> 
			<div class="col-md-12">
				<?php
	            if(empty($errorarray) && isset($succhange) && !empty($succhange))
	            {
	                echo '<div class="alert alert-success sign-up suc-message" style="text-align: center; padding-bottom: 15px;">We will send you a password reset email within a few minutes.</div>';
	            }
	            ?>
				 <div class="col-md-8 login-form">
				    <h1 class="title">Edit <span>Profile</span></h1>
				    <!-- <form action="<?=DEFAULT_URL?>edit-profile" method="post"> -->
				    <?php
				    echo $this->Form->create('Member', array('novalidate', 'type'=>'file'));
				    ?>
						    <div class="row"> 
                                <?php
                                //var_dump($this->data);
                                
						    	echo $this->Form->input('first_name', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'value' => $this->data['Member']['first_name']));
						    	echo $this->Form->input('middle_name', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'value' => $this->data['Member']['middle_name']));
						    	echo $this->Form->input('last_name', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'value' => $this->data['Member']['last_name']));

						    	echo $this->Form->input('relation', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'options' => $relations, 'selected' => $this->data['Member']['relation'], 'empty' => array('' => 'Select')));

						    	//echo $this->Form->input('dob', array('class' => 'form-control input-sm', 'label'=>'Date Of Birth', 'div' => 'col-md-6'));
						    	?>
						    	<div class="col-md-12">
						    	<div class="row">
							    	<div class="col-md-6">
		                                <label>DOB</label>
		                                <div class='input-group date' id='datetimepicker6'>
		                                    <input name="data[Member][dob]" type='text' class="form-control" />
		                                    <span class="input-group-addon">
		                                        <span class="glyphicon glyphicon-calendar"></span>
		                                    </span>
		                                </div>
		                            </div>
		                            <?php
							    	echo $this->Form->input('age', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'value' => $this->data['Member']['age']));

							   	?>
							   	</div>
							   	</div>
							   	<?php

						    	echo $this->Form->input('birth_place', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'value' => $this->data['Member']['birth_place']));
						    	echo $this->Form->input('gender', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'selected' => $this->data['Member']['gender'], 'options' => array(''=> 'Select', 1=>'Male', 2=>'Female')));
						    	echo $this->Form->input('marital_status', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'selected' => $this->data['Member']['marital_status'],'options' => array(''=>'Select', 1=>'Married', 2=>'Unmarried', 4=>'Widow')));

						    	echo $this->Form->input('native', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'value' => $this->data['Member']['native']));
						    	echo $this->Form->input('gotra', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'selected' => $this->data['Member']['gotra'],'options' => $gotras, 'empty' => array('' => 'Select')));
						    	
								echo $this->Form->input('education', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'value' => $this->data['Member']['education']));
								echo $this->Form->input('blood_group', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'selected' => $this->data['Member']['blood_group'], 'options' => array('B+','B-','A+','A-','AB+','AB-','O+','O-'), 'empty' => array('' => 'Select')));

								echo $this->Form->input('proffession', array('class' => 'form-control input-sm', 'div' => 'col-md-12', 'selected' => $this->data['Member']['proffession'], 'options' => $proffessions, 'empty' => array('' => 'Select')));
						    	echo $this->Form->input('proffession_details', array('type' => 'textarea','class' => 'form-control', 'div' => 'col-md-12', 'value' => $this->data['Member']['proffession_details']));

						    	echo $this->Form->input('phone', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'value' => $this->data['Member']['phone']));
						    	echo $this->Form->input('mobile', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'value' => $this->data['Member']['mobile']));

						    	echo $this->Form->input('photo', array('type'=>'file','class' => 'form-control input-sm', 'div' => 'col-md-6'));
						    		
						    	$add_images = $this->data['Member']['photo'];

                                if(!empty($add_images))
                                {   
                                    echo '<div class="form-group col-md-12 padding-left-o">';
                                    echo '<div class="col-md-2"><label>Current Image:<label></div>';

                                    $add_images = explode(',', $add_images);

                                    echo '<div class="col-md-10">';
                                    
                                    foreach ($add_images as $add_img_num => $add_img) {
                                        echo '<div class="col-md-2 add_image_div">';
                                        echo '<img src="'.DEFAULT_MEMBER_IMAGE_URL.'thumb_'.$add_img.'" width="100" height="100" />&nbsp;&nbsp;&nbsp;';
                                        echo '<input type="hidden" name="data[Member][add_image][]" value="'.$add_img.'" />';
                                        //echo '<input type="button" class="remove-img btn-small btn-info" value="Remove">';
                                        echo '</div>';
                                    }

                                    echo '</div>';

                                    echo '</div>';                                        
                                }

						    	echo $this->Form->input('doc', array('type'=>'file', 'label' => 'Document', 'accept'=>"application/pdf,application/msword", 'class' => 'form-control input-sm', 'div' => 'col-md-6'));

						    	$add_files = $this->data['Member']['doc'];

                                if(!empty($add_files))
                                {   
                                    echo '<div class="form-group col-md-12 padding-left-o">';
                                    echo '<div class="col-md-2"><label>Current Image:<label></div>';

                                    $add_files = explode(',', $add_files);

                                    echo '<div class="col-md-10">';
                                    
                                    foreach ($add_files as $add_file_num => $add_file) {
                                        echo '<div class="col-md-2 add_image_div">';
                                        echo '<a href="'.DEFAULT_MEMBER_DOC_URL.$add_file.'"/>'.$add_file.'</a>';
                                        echo '<input type="hidden" name="data[Member][add_file][]" value="'.$add_file.'" />';
                                        //echo '<input type="button" class="remove-img btn-small btn-info" value="Remove">';
                                        echo '</div>';
                                    }

                                    echo '</div>';

                                    echo '</div>';                                        
                                }

						    	echo $this->Form->input('address', array('type' => 'textarea','class' => 'form-control', 'div' => 'col-md-12', 'value' => $this->data['Member']['address']));
						    	echo $this->Form->input('country', array('id' => 'MemberCountry', 'class' => 'form-control input-sm', 'div' => 'col-md-4', 'selected' => $this->data['Member']['country'], 'options' => $countries, 'empty' => array('' => 'Select')));
						    	echo $this->Form->input('state', array('id' => 'MemberState', 'class' => 'form-control input-sm', 'div' => 'col-md-4', 'selected' => $this->data['Member']['state'], 'options' => $states, 'empty' => array('' => 'Select')));
						    	echo $this->Form->input('city', array('id' => 'MemberCity', 'class' => 'form-control input-sm', 'div' => 'col-md-4', 'selected' => $this->data['Member']['city'], 'options' => $cities, 'empty' => array('' => 'Select')));
						    	
						    	echo $this->Form->input('area', array('class' => 'form-control', 'div' => 'col-md-4', 'value' => $this->data['Member']['area']));
						    	echo $this->Form->input('hobbies', array('class' => 'form-control', 'div' => 'col-md-4', 'value' => $this->data['Member']['hobbies']));
						    	echo $this->Form->input('relative_member_no', array('class' => 'form-control', 'div' => 'col-md-4', 'value' => $this->data['Member']['relative_member_no']));

						    	?>
						    	<input type="hidden" name="prevState" id="prevState" value="<?=$this->data['Member']['state']?>">
						    	<input type="hidden" name="prevCity" id="prevCity" value="<?=$this->data['Member']['city']?>">
						    	<div class="col-md-12" style="padding-bottom: 10px;">
							    	<div class="checkbox">
									  <label><input id="MemberForMatrimonial" name="data[Member][for_matrimonial]" <?php if(!empty($this->data['Member']['for_matrimonial'])) { echo 'checked="checked"'; } ?> value="1" type="checkbox">Yes, I want to register for matrimonial also.</label>
									</div> 
								</div> 								   
                            </div> 
							<div class="ab_button">
							<input type="submit" class="btn btn-primary btn-lg hvr-underline-from-left" style="width:100%;" value="Save"> 
						     </div> 
					 </form>
					 
				 </div>
				 
				 
			</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //welcome -->
<?php
if(!empty($this->data['Member']['dob'])){
	$today_date = $this->data['Member']['dob'];
} else {
	$today_date = date('Y-m-d');
}
$min_date = '1900-01-01';
$max_date = date('Y-m-d');
?>
<script type="text/javascript">
    $(function () {

        var todayDate = new Date('<?=$today_date?>');
        
        $('#datetimepicker6').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format: 'YYYY-MM-DD',
            defaultDate: todayDate,
            minDate: new Date('<?=$min_date?>'),
			maxDate: new Date('<?=$max_date?>'),
        });

        $("#datetimepicker6").on("dp.change", function (e) {
            //$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            console.log(e.date);
            var dob = e.date
			var today = new Date();
			var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
			console.log(age+' years old');
            $("#MemberAge").val(age);
        });

    });
</script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		//alert("fgdfgfghfgh");

		console.log(jQuery('#MemberCountry').val());
		var country = jQuery('#MemberCountry').val();
		var prevState = jQuery('#prevState').val();

		var postData = {
			"country_id":country,
			"current_state":prevState
      	};

	    $.ajax({
	        url: "<?=DEFAULT_URL?>get-states",
	        type: "POST",
	        data: {myData:postData},
	        success: function(data)
	         {
	          //alert(data);
	          jQuery('#MemberState').html(data);
	         },
	    });

		jQuery('#MemberCountry').change(function(){
			console.log(jQuery(this).val());
			var country = jQuery(this).val();

			var postData = {
				"country_id":country
          	};

		    $.ajax({
		        url: "<?=DEFAULT_URL?>get-states",
		        type: "POST",
		        data: {myData:postData},
		        success: function(data)
		         {
		          //alert(data);
		          jQuery('#MemberState').html(data);
		         },
		    });

		});

		console.log(jQuery('#MemberState').val());
		var state = jQuery('#prevState').val();
		var prevCity = jQuery('#prevCity').val();

		var postData = {
			"state_id":state,
			"current_city":prevCity
      	};

	    $.ajax({
	        url: "<?=DEFAULT_URL?>get-cities",
	        type: "POST",
	        data: {myData:postData},
	        success: function(data)
	         {
	          //alert(data);
	          jQuery('#MemberCity').html(data);
	         },
	    });

		jQuery('#MemberState').change(function(){
			console.log(jQuery(this).val());
			var state = jQuery(this).val();

			var postData = {
				"state_id":state
          	};

		    $.ajax({
		        url: "<?=DEFAULT_URL?>get-cities",
		        type: "POST",
		        data: {myData:postData},
		        success: function(data)
		         {
		          //alert(data);
		          jQuery('#MemberCity').html(data);
		         },
		    });

		});
	});
</script>
<?php
echo $this->element('frontfooter');
?>