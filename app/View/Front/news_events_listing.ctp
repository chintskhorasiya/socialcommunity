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
			<li>News and Events</li>
		</ul>
	</div>
  </div>
</div>


<div class="welcome inner-page trips-section" id="about">	
	<div class="container">
		<h1 class="title">News and  <span>Events</span></h1>
		<div class=" ">
		<?php
		foreach ($newsevents_data as $newsevents_data_key => $newsevent) {
			?>
			<div class="col-md-4 exce-grid1-mmstyle">
				<a href=""><img src="<?=DEFAULT_NEWSEVENTS_IMAGE_URL.'front_'.$newsevent['Newsevent']['source']?>" alt="<?=$newsevent['Newsevent']['title']?>"></a>
				<div class="grid-ec1">
					<a href=""><h3><?=$newsevent['Newsevent']['title']?></h3></a>
					<p><?=mb_substr($newsevent['Newsevent']['page'], 0, 45)?></p>
					 
				</div>
			</div>
			<?php
		}
		?>
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
<?php
echo $this->element('frontfooter');
?>