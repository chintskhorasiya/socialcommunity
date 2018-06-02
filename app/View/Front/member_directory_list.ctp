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
			<li>Member Directory</li>
		</ul>
	</div>
  </div>
</div>

<div class="welcome inner-page" id="about">	
	<div class="container">
		<h1 class="title">Member <span>Directory</span></h1>
		<?php
		echo $this->Form->create('MembersSearch', array('url' => array('controller' => 'front', 'action' => 'member_directory_list')));
		?>
		<div class="search-section">
			<div class="col-md-4" style="padding-bottom: 10px;">
				<label>State</label>
				<select class="form-control" name="search_state" type="text" id="MemberState">
				   <option>Select</option>
				   <?php
				   foreach ($states as $state) {
				   		if($this->Session->read('front_member_directory_state') == $state){
				   			$selectedStateStr = 'selected="selected"';
				   		} else {
				   			$selectedStateStr = '';
				   		}
				   		echo '<option '.$selectedStateStr.' value="'.$state.'">'.$this->Common->getStateName($state).'</option>';
				   }
				   ?>
				</select>
			</div>
			<div class="col-md-4" style="padding-bottom: 10px;">
				<label>City</label>
				<select class="form-control" name="search_city" type="text" id="MemberCity">
				   <option>Select</option> 
				</select>
			</div>
			<div class="col-md-3" style="padding-bottom: 10px;">
				<label>Area</label>
				<!-- <select class="form-control" name=" " type="text" required>
				   <option>Select</option> 
				</select> -->
				<input type="text" class="form-control" name="search_area" value="<?=$this->Session->read('front_member_directory_area');?>" />
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
		
		<?php
		foreach ($members_data as $members_data_key => $member_data) {
			$name = $member_data['Member']['first_name'].' '.$member_data['Member']['middle_name'].' '.$member_data['Member']['last_name'];
			$nameArr = explode(' ',trim($name));
			$firstname = $nameArr[0]; // will print Test
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
		}
		?>
		 
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