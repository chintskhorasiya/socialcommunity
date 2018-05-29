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
			<li>Donors List</li>
		</ul>
	</div>
  </div>
</div>

<div class="welcome inner-page" id="about">	
	<div class="container">
		<h1 class="title">Donors <span>List</span></h1>
		
		<?php
		foreach ($donations_data as $donations_data_key => $donor) {
			$name = $donor['Donations']['name'];
			$name = explode(' ',trim($name));
			$firstname = $name[0]; // will print Test
			?>
			<div class="col-md-6 member-list">
			  <div class="member-list-repeat">
				  <div class="col-md-3 member-list-img">
				  	<?php
				  	if(!empty($donor['Donations']['propic'])){
				  		?><img src="<?=DEFAULT_DONATION_IMAGE_URL.'front_'.$donor['Donations']['propic']?>" alt="" /><?php
				  	} else {
				  		?><img src="<?=DEFAULT_URL.'img/t1.jpg'?>" alt="" /><?php
				  	}
				  	?>
				  	<!-- <h2><?=$firstname?></h2> -->
				  </div>
				  <div class="col-md-9 member-list-details">
				    <h3><?=$donor['Donations']['name']?></h3>
					<ul>
					 <li><strong>Address :</strong> <?=$donor['Donations']['address']?></li>
					 <?php
					 if(!empty($donor['Donations']['phone'])){
					 	?><li><strong>Phone :</strong> <?=$donor['Donations']['phone']?></li><?php
					 }
					 ?>
					 <li><strong>Rs :</strong> <?=$donor['Donations']['amount']?></li>
					</ul>
				  </div> 
				  <div class="clear"> </div>
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
<?php
echo $this->element('frontfooter');
?>