<?php
echo $this->element('frontheader');
?>
<div class="breadcrumb">
	<section class="article-breadcrumb">
		<?php
		$category_breadcrumb = '<span class="br-arrow">» </span> <a href="'.DEFAULT_FRONT_EPAPERS_URL.'">E-Paper</a> <span class="br-arrow">» '.$category_name;
		?>
		<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><?=$category_breadcrumb;?>
	</section>
</div>
<section class="main epaper-page"> <!-- sec-part1 start --> 
	   	<div class="inner-page">
	   		<h1 class="inner-title">E-Paper Listings</h1>
	   		<div class="e-paper-listing">
	   			<?php
	   			if(count($epapers_data) > 0){
	   				foreach ($epapers_data as $epaper_key => $epaper_data) {
	   					?>
	   					<div class="news-b col-md-4">
			   				<a target="_blank" href="<?=DEFAULT_URL?>epaper/<?=$epaper_data['Epaper']['slug']?>"><img width="250px" src="<?=$category_image?>" alt=""></a>
			   				<a target="_blank" href="<?=DEFAULT_URL?>epaper/<?=$epaper_data['Epaper']['slug']?>"><h3><?=$epaper_data['Epaper']['title']?></h3></a>
			   			</div>
	   					<?php
	   				}
	   			}
	   			?>
	   		</div>
		</div>
	    <div class="clear"></div>
	    <div class="front-pagination">
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
</section> <!-- sec-part1 end -->
<?php
echo $this->element('frontfooter');
?>