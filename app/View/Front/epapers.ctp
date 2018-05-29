<?php
echo $this->element('frontheader');
?>
<div class="breadcrumb">
	<div class="container">
		<section class="article-breadcrumb">
			<?php
			$category_breadcrumb = '<span class="br-arrow">» </span> E-Paper';
			?>
			<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><?=$category_breadcrumb;?>
		</section>
	</div>
</div>
<section class="main epaper-page"> <!-- sec-part1 start -->
   	<div class="container"> 
	   	<div class="inner-page">
	   		<h1 class="inner-title">E - Paper</h1>
	   		<div class="e-paper-box">
	   			<div class="news-b">
	   				<a href="<?=DEFAULT_FRONT_EPAPERS_AUS_URL?>"><img src="<?=DEFAULT_FRONT_EPAPERS_AUS_IMG_URL?>" alt=""></a>
	   				<a href="<?=DEFAULT_FRONT_EPAPERS_AUS_URL?>"><h3>Australia</h3></a>
	   			</div>
	   			<div class="news-b">
	   				<a href="<?=DEFAULT_FRONT_EPAPERS_NZ_URL?>"><img src="<?=DEFAULT_FRONT_EPAPERS_NZ_IMG_URL?>" alt=""></a>
					<a href="<?=DEFAULT_FRONT_EPAPERS_NZ_URL?>"><h3>New Zealand</h3></a>
				</div>
			</div>
		</div>
	    <div class="clear"></div>
   </div>
</section> <!-- sec-part1 end -->
<?php
echo $this->element('frontfooter');
?>