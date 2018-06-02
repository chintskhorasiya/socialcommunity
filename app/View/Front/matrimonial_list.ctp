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
			<li>Matrimonial List</li>
		</ul>
	</div>
  </div>
</div>

<div class="welcome inner-page" id="about">	
	<div class="container">
		<h1 class="title">Matrimonial <span>List</span></h1>
		<?php
		echo $this->Form->create('MembersSearch', array('url' => array('controller' => 'front', 'action' => 'matrimonial_list')));
		?>
		<div class="search-section matrimonial-search-box">
			<div class="col-md-4" style="padding-bottom: 10px;">
				<label>Gender</label>
				<select class="form-control" name="search_gender" type="text" id="MemberGender">
				   <option value="">Select</option> 
				   <option <?php if($this->Session->read('front_matrimonial_list_gender') == "1"){ echo 'selected="selected"'; } ?> value="1">Male</option> 
				   <option <?php if($this->Session->read('front_matrimonial_list_gender') == "2"){ echo 'selected="selected"'; } ?> value="2">Female</option>
				</select>
			</div>
			<div class="col-md-4" style="padding-bottom: 10px;">
				<label>Age</label>
				<select class="form-control" name="search_age" type="text" id="MemberAge">
				   <option value="">Select</option> 
				   <option <?php if($this->Session->read('front_matrimonial_list_age') == "18 AND 25"){ echo 'selected="selected"'; } ?> value="18 AND 25">18-25</option> 
				   <option <?php if($this->Session->read('front_matrimonial_list_age') == "25 AND 30"){ echo 'selected="selected"'; } ?>  value="25 AND 30">25-30</option> 
				   <option <?php if($this->Session->read('front_matrimonial_list_age') == "30 AND 35"){ echo 'selected="selected"'; } ?>  value="30 AND 35">30-35</option> 
				   <option <?php if($this->Session->read('front_matrimonial_list_age') == "35 AND 40"){ echo 'selected="selected"'; } ?>  value="35 AND 40">35-40</option>
				   <option <?php if($this->Session->read('front_matrimonial_list_age') == "40 AND 50"){ echo 'selected="selected"'; } ?>  value="40 AND 50">40-50</option>
				   <option <?php if($this->Session->read('front_matrimonial_list_age') == "50 AND 200"){ echo 'selected="selected"'; } ?>  value="50 AND 200">Above 50</option>
				</select>
			</div>
			<div class="col-md-3" style="padding-bottom: 10px;">
				<label>Proffession</label>
				<select class="form-control" name="search_proffession" type="text" id="MemberProffession">
				   <option value="">Select</option>
				   <?php
				   foreach ($profs as $prof) {
				   		if($this->Session->read('front_matrimonial_list_proffession') == $prof){
				   			$selectedProfStr = 'selected="selected"';
				   		} else {
				   			$selectedProfStr = '';
				   		}
				   		echo '<option '.$selectedProfStr.' value="'.$prof.'">'.$this->Common->getProfName($prof).'</option>';
				   }
				   ?>
				</select>
			</div> 
			 
			<div class="col-md-1" style="padding-bottom: 10px;"> 
				<div class="ab_button">
				   <button class="btn btn-primary btn-lg hvr-underline-from-left" value="Register">GO</button> 
				 </div>
			</div>
			<div class="clear"></div>
		</div>
		<?php
		echo $this->Form->end();
		?>
		
		<div class="clear"></div>

		<div class="col-md-12">
			  <div class="direc-list-repeat">
				 <table class="dire-listing">
                    <tr> 
						<th class="de-photo">Photo</th>
						<th class="de-name">Name</th> 
						<th class="de-ms">Marital Status</th>
						<th class="de-edu">Education</th>
						<th class="de-add">Address</th> 
						<th class="de-dob">Date of Barth</th>
						<th class="de-mno">Mobile No.</th>
					</tr>
		
					<?php
					foreach ($members_data as $members_data_key => $member_data) {
						$name = $member_data['Member']['first_name'].' '.$member_data['Member']['middle_name'].' '.$member_data['Member']['last_name'];
						$nameArr = explode(' ',trim($name));
						$firstname = $nameArr[0]; // will print Test

						if($member_data['Member']['marital_status'] == "1"){
							$marital_status = "Married";
						} elseif($member_data['Member']['marital_status'] == "2"){
							$marital_status = "Unmarried";
						} elseif($member_data['Member']['marital_status'] == "4"){
							$marital_status = "Widow";
						}
						/*
						?>
						<div class="col-md-6 member-list">
						  <div class="member-list-repeat">
							  <div class="col-md-3 member-list-img">
							  	<?php
							  	if(!empty($member_data['Member']['photo'])){
							  		?><img src="<?=DEFAULT_MEMBER_IMAGE_URL.'front_'.$member_data['Member']['photo']?>" alt="" /><?php
							  	} else {
							  		?><img src="<?=DEFAULT_URL.'img/t1.jpg'?>" alt="" /><?php
							  	}
							  	?>
							  	<h2><?=$firstname?></h2>
							  </div>
							  <div class="col-md-9 member-list-details">
							    <h3><?=$name?></h3>
								<ul>
								 <li><strong>Area :</strong> <?=$member_data['Member']['area']?></li>
								 <li><strong>City :</strong> <?=$this->Common->getCityName($member_data['Member']['city'])?></li>
								 <li><strong>Phone :</strong> <?=$member_data['Member']['mobile']?></li>
								</ul>
							  </div> 
							  <div class="clear"> </div>
							  <?php
							  //var_dump($this->Common->test());
							  ?>
							</div>
						</div>
						<?php
						*/
						?>
						<tr> 
							<td>
								<?php
							  	if(!empty($member_data['Member']['photo'])){
							  		?><img width="150px" src="<?=DEFAULT_MEMBER_IMAGE_URL.'front_'.$member_data['Member']['photo']?>" alt="" /><?php
							  	} else {
							  		?><img src="<?=DEFAULT_URL.'img/t1.jpg'?>" width="150px" alt="" /><?php
							  	}
							  	?>
								<!-- <img src="<?=DEFAULT_URL.'img/t1.jpg'?>" width="150px" alt=""> -->
							</td>
							<td><?=$name?></td>  
							<td><?=$marital_status?></td>
							<td><?=$member_data['Member']['education']?></td>
							<td><?=$member_data['Member']['address']?></td>
							<td><?=$member_data['Member']['dob']?></td>
							<td><?=$member_data['Member']['mobile']?></td> 
					   	</tr>
						<?php
					}
					?>

				</table>
			</div>
		</div>
		 
		<div class="clearfix"> </div>
		<div class="clear"></div>
	  	<div class="front-pagination1" style="position: relative;">
	    <?php echo $this->Paginator->prev('« Previous', array('class' => 'btn btn-default front-pagi-prev'), null, 
	                array('class' => 'disabled front-pagi-prev')); ?>
	  	<!-- Shows the page numbers -->
	    <?php echo $this->Paginator->numbers(); ?>
	    <!-- Shows the next and previous links -->
	    <?php echo $this->Paginator->next('Next »', array('class' => 'btn btn-default front-pagi-next'), null,
	        array('class' => 'disabled front-pagi-next')); ?> 
	    <!-- prints X of Y, where X is current page and Y is number of pages -->
	    <?php echo $this->Paginator->counter(); ?>
	    </div>
	</div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		//alert("fgdfgfghfgh");
		/*jQuery('#MemberCountry').change(function(){
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

		});*/
		var member_state = jQuery('#MemberState').val();
		if(member_state != ''){
			var state = member_state;

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
		}

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