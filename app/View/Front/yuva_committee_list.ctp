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
			<li>Yuva Committee</li>
		</ul>
	</div>
  </div>
</div>

<div class="welcome inner-page" id="about">	
	<div class="container">
		<h1 class="title">Yuva <span>Committee</span></h1>
		
		<?php
		foreach ($yuva_commitee_data as $yuva_commitee_data_key => $yuva_commitee_member) {
			$name = $yuva_commitee_member['Committeemember']['name'];
			$name = explode(' ',trim($name));
			$firstname = $name[0]; // will print Test
			?>
			<div class="col-md-6 member-list">
			  <div class="member-list-repeat">
				  <div class="col-md-3 member-list-img"><img src="<?=DEFAULT_COMMITTEEMEMBER_IMAGE_URL.'front_'.$yuva_commitee_member['Committeemember']['source']?>" alt="" /><h2><?=$firstname?></h2></div>
				  <div class="col-md-9 member-list-details">
				    <h3><?=$yuva_commitee_member['Committeemember']['name']?></h3>
					<ul>
					 <li><strong>Area :</strong> <?=$yuva_commitee_member['Committeemember']['area']?></li>
					 <li><strong>City :</strong> <?=$yuva_commitee_member['Committeemember']['city']?></li>
					 <li><strong>Phone :</strong> <?=$yuva_commitee_member['Committeemember']['phone']?></li>
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