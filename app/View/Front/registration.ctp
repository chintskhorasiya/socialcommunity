<?php
session_start();
echo $this->element('frontheader');
?>
<div class="services-breadcrumb">
 <div class="container">	
	<div class="inner_breadcrumb">
		<ul class="short_ls">
			<li>
				<a href="<?=DEFAULT_URL?>" title="Home"> Home</a>
				<span>/ </span>
			</li>
			<li><?php echo $cms_page_title; ?></li>
		</ul>
	</div>
  </div>
</div>
<div class="welcome inner-page contact-page" id="about">	
	<div class="container"> 
		<div class="col-md-12">
		      <h1 class="title">Register <span>Form</span></h1>
			 <div class="col-md-7 login-form" style="float:left;">
			   	<?php
                    //print_r($_SESSION);
                    if(!empty($_SESSION['error_msg'])){
                        ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error_msg'];unset($_SESSION['error_msg']); ?>
                        </div>
                        <?php
                    }

                    if(!empty($_SESSION['warning_msg'])){
                        ?>
                        <div class="alert alert-warning" style="display: none;">
                            <?php
                            echo $_SESSION['warning_msg'];
                            unset($_SESSION['warning_msg']);
                            ?>
                        </div>
                        <?php
                    }

                    if(!empty($_SESSION['success_msg'])){
                        ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success_msg'];unset($_SESSION['success_msg']); ?>
                        </div>
                        <?php
                    }
                    echo $this->Form->create('Member', array('novalidate', 'type'=>'file'));
                    ?>
			    <!-- <form action="#" method="post"> -->
					    <div class="row">
						    
					    	<?php
					    	echo $this->Form->input('first_name', array('class' => 'form-control input-sm', 'div' => 'col-md-4'));
					    	echo $this->Form->input('middle_name', array('class' => 'form-control input-sm', 'div' => 'col-md-4'));
					    	echo $this->Form->input('last_name', array('class' => 'form-control input-sm', 'div' => 'col-md-4'));

					    	echo $this->Form->input('User.username', array('class' => 'form-control input-sm', 'div' => 'col-md-6'));
					    	echo $this->Form->input('User.password', array('class' => 'form-control input-sm', 'div' => 'col-md-6'));

					    	echo $this->Form->input('relation', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'options' => $relations, 'empty' => array('' => 'Select')));
					    	echo $this->Form->input('User.email', array('type'=>'email','class' => 'form-control input-sm', 'div' => 'col-md-6'));

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
						    	echo $this->Form->input('age', array('class' => 'form-control input-sm', 'div' => 'col-md-6'));

						   	?>
						   	</div>
						   	</div>
						   	<?php

					    	echo $this->Form->input('birth_place', array('class' => 'form-control input-sm', 'div' => 'col-md-4'));
					    	echo $this->Form->input('gender', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => array(''=> 'Select', 1=>'Male', 2=>'Female')));
					    	echo $this->Form->input('marital_status', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => array(''=>'Select', 1=>'Married', 2=>'Unmarried', 4=>'Widow')));

					    	echo $this->Form->input('native', array('class' => 'form-control input-sm', 'div' => 'col-md-6'));
					    	echo $this->Form->input('gotra', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'options' => $gotras, 'empty' => array('' => 'Select')));
					    	
							echo $this->Form->input('education', array('class' => 'form-control input-sm', 'div' => 'col-md-6'));
							echo $this->Form->input('blood_group', array('class' => 'form-control input-sm', 'div' => 'col-md-6', 'options' => array('B+','B-','A+','A-','AB+','AB-','O+','O-'), 'empty' => array('' => 'Select')));

							echo $this->Form->input('proffession', array('class' => 'form-control input-sm', 'div' => 'col-md-12', 'options' => $proffessions, 'empty' => array('' => 'Select')));
					    	echo $this->Form->input('proffession_details', array('type' => 'textarea','class' => 'form-control', 'div' => 'col-md-12'));

					    	echo $this->Form->input('phone', array('class' => 'form-control input-sm', 'div' => 'col-md-6'));
					    	echo $this->Form->input('mobile', array('class' => 'form-control input-sm', 'div' => 'col-md-6'));

					    	echo $this->Form->input('photo', array('type'=>'file','class' => 'form-control input-sm', 'div' => 'col-md-6'));
					    	echo $this->Form->input('doc', array('type'=>'file', 'label' => 'Document', 'accept'=>"application/pdf,application/msword", 'class' => 'form-control input-sm', 'div' => 'col-md-6'));

					    	echo $this->Form->input('address', array('type' => 'textarea','class' => 'form-control', 'div' => 'col-md-12'));
					    	echo $this->Form->input('country', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => $countries, 'empty' => array('' => 'Select')));
					    	echo $this->Form->input('state', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => $states, 'empty' => array('' => 'Select')));
					    	echo $this->Form->input('city', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => $cities, 'empty' => array('' => 'Select')));
					    	
					    	echo $this->Form->input('area', array('class' => 'form-control', 'div' => 'col-md-4'));
					    	echo $this->Form->input('hobbies', array('class' => 'form-control', 'div' => 'col-md-4'));
					    	echo $this->Form->input('relative_member_no', array('class' => 'form-control', 'div' => 'col-md-4'));
					    	?>
							<!--
							<div class="col-md-12" style="padding-bottom: 10px;">
							    <h3>Add Family Detail</h3>
							 </div> 
							<div class="col-md-12" style="padding-bottom: 10px;">
							  <input type="button" value="Add">
                              <input type="button" value="Remove">
							</div> -->
						 </div> 
						 <!--
						<div class="row extra-field"> 
                            <div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Name</label>
                                <input class="form-control" name="name" type="text" required autofocus />
                            </div> 
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Relation</label>
                                <select class="form-control" name="relation" type="text" required>
								   <option>Select</option>
								</select>
                            </div> 
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Education</label>
                               <input class="form-control" name="Education" type="text" required />
                            </div>
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>City</label>
                                <select class="form-control" name=" " type="text" required>
								   <option>Select</option> 
								</select>
                            </div>
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Blood Group</label>
                               <input class="form-control" name="Blood Group" type="text" required />
                            </div>
							<div class="col-md-6 date" style="padding-bottom: 10px;" id='datetimepicker1'>
							    <label>Date of Birth</label>
                               <input class="form-control" name="dob" type="text" required /> 
                            </div>
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Age</label>
                               <input class="form-control" name="age" type="text" required />
                            </div>
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Birth Place</label>
                               <input class="form-control" name="birthplace" type="text" required />
                            </div>
							<div class="col-md-4" style="padding-bottom: 10px;">
							    <label>Gender</label>
                                <select class="form-control" name="gender" type="text" required>
								   <option>Select</option>
								   <option>Male</option>
								   <option>Female</option>
								</select>
                            </div>
							<div class="col-md-4" style="padding-bottom: 10px;">
							    <label>Marital Status</label>
                                <select class="form-control" name="maritalstatus" type="text" required>
								   <option>Select</option>
								   <option>Married</option>
								   <option>Unmarried</option>
								   <option>Widow</option>
								</select>
                            </div> 
							<div class="col-md-4" style="padding-bottom: 10px;">
							    <label>Profession</label>
                                <select class="form-control" name="Profession" type="text" required>
								   <option>Select</option> 
								</select>
                            </div>
							<div class="col-md-12" style="padding-bottom: 10px;">
							    <label>Profession Detail</label>
                               <textarea class="form-control" name=" " type="text"></textarea>
                            </div>
							 
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Photo</label>
                               <input class="form-control" name=" " type="file" required />
                            </div> 
							<div class="col-md-6" style="padding-bottom: 10px;">
							    <label>Hobby</label>
                               <input class="form-control" name=" " type="text" required />
                            </div>  						
						 </div> -->
						 <div class="col-md-12" style="padding-bottom: 10px;">
							   <p><a href="login.html">If you already member? Login Now</a></p>
                             </div>	
						<!-- <div class="ab_button">
						<button class="btn btn-primary btn-lg hvr-underline-from-left" value="Register">Submit</button> 
					     </div>  -->
					     <?php
					     echo $this->Form->submit('Submit', array('class' => 'btn btn-info'));
					     ?>
				 </form>
			 </div>
			 
			 <div class="col-md-5 text-center"><img src="<?=DEFAULT_URL?>img/members.png" /></div>
			 
			 
			 
			 
		</div>
		
		<div class="clearfix"> </div>
	</div>
</div>
<?php
$today_date = date('Y-m-d');
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