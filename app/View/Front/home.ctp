<?php
echo $this->element('frontheader');
?>
<!-- banner -->
<!-- banner-slider -->
<div class="w3l_banner_info">
	<div class="slider">
		<div class="callbacks_container">
			<ul class="rslides" id="slider3">
				<!-- <li>
					<div class="slider-img" style="background: url(img/2.jpg) no-repeat 0px 0px;background-size: 100% !important;">
						<div class="slider_banner_info">
							<h4>
								 
							</h4>
							 
						</div>
					</div>
				</li> -->
				<?php
				foreach ($banner_data as $banner_key => $banner) {
				?>
					<li>
						<div class="slider-img" style="background: url(<?=DEFAULT_BANNER_IMAGE_URL.$banner['Banner']['source']?>) no-repeat 0px 0px;background-size: 100% !important;">
							<div class="slider_banner_info">
								<h4>
									 
								</h4>
								 
							</div>
						</div>
					</li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>
<!-- //banner-slider -->
 
<!-- //banner -->

<!-- welcome -->
<div class="welcome" id="about">	
	<div class="container">
		<h1 class="title">Welcome to <span>Community Social</span></h1>
		<div class="col-md-12 welcome-left text-center">
			<?=$welcome_to_html?>
			<div class="readmore-w3-agileits about-read">
				<a href="#" >Read More</a>
			</div>
		</div>
		 
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //welcome -->

<!-- middle section -->
<div class="middle-w3l" style="background: url(img/bg1.jpg) no-repeat fixed;">
	<div class="container">
		<div class="middle-left-w3l">
			<h4>Lorem Ipsum is simply dummy text of the printing</h4>
			<p>Lorem Ipsum is simply dummy text of the printing</p>
			<div class="readmore-w3-agileits about-read">
				<a href="#">Donation Facility</a>
			</div>
		</div>
	</div>
</div>
<!-- //middle section -->

<!-- tours sectopn -->
<div class="trips-section">
	<div class="container">
		<h3 class="title">News & <span>Events</span></h3>
		<?php
		foreach ($news_event_data as $news_event_data_key => $news_event) {
			?>
			<div class="col-xs-4 exce-grid1-mmstyle">
				<a href=""><img src="<?=DEFAULT_NEWSEVENTS_IMAGE_URL.'front_'.$news_event['Newsevent']['source']?>" alt=""></a>
				<div class="grid-ec1">
					<a href=""><h3><?=$news_event['Newsevent']['title']?></h3></a>
					<p><?=mb_substr($news_event['Newsevent']['page'], 0, 50)?></p>
					 
				</div>
			</div>
			<?php
		}
		?>
		<!-- <div class="col-xs-4 exce-grid1-mmstyle">
			<a href=""><img src="images/k2.jpg" alt=""></a>
			<div class="grid-ec1">
				<a href=""><h3>Lorem Ipsum is simply dummy text of the.</h3></a>
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type...</p>
				 
			</div>
		</div>
		<div class="col-xs-4 exce-grid1-mmstyle">
			<a href=""><img src="images/k3.jpg" alt=""></a>
			<div class="grid-ec1">
				<a href=""><h3>Lorem Ipsum is simply dummy text of the.</h3></a>
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type...</p>
				 
			</div>
		</div> -->
		<div class="clearfix"></div>
		    <div class="readmore-w3-agileits about-read text-center">
				<a href="<?=DEFAULT_URL.'news-events'?>" >Read More</a>
			</div>
	</div>
</div>
<!-- //tours sectopn -->

<!-- services -->
<div class="wthree_services" id="services">
	<div class="container">
      <div class="col-md-8">		 
			<h3 class="title">Daily <span>Thoughts</span></h3>
			<?=$daily_thought_html?>
		</div>
		
		<div class="col-md-4 adv">
				<?php
				foreach ($advertise_data as $advertise_key => $advertise) {
					?>
					<a href="<?=$advertise['Advertise']['link']?>" target="_blank"><img src="<?=DEFAULT_ADVERTISE_IMAGE_URL.'front_'.$advertise['Advertise']['source']?>" alt="<?=$advertise['Advertise']['title']?>" class="img-responsive"></a>
					<?php
				}
				?>
				  <!--<img src="images/adv.png" alt=" " class="img-responsive">
				  <img src="images/adv.png" alt=" " class="img-responsive">-->
			</div>
		<div class="clearfix"> </div>
		<!-- another-section -->
		 
		<!-- //another-section -->
	</div>
</div>
<!-- //services -->

<!-- testimonials -->
<div class="testimonials">
	<div class="container">
		<h3 class="title">Our <span>Gallery</span></h3>
		<div class="w3_testimonials_grids">
			<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<?php
						$gal_count = 1;
						foreach ($gallery_data as $gallery_key => $gallery) {
							//var_dump($gal_count);
							//var_dump($gal_count%3);
							//echo '<br>';
							//$modulo = ($gal_count%3);
							if(($gal_count%3) === 1){
								echo '<li>';
							}
							?>
							<div class="col-md-4 col-xs-4 sectopn-main_gallery_grid <?=$gal_count?>">
								<a href="<?=DEFAULT_GALLERY_IMAGE_URL.$gallery['Galleryimage']['source']?>" class="lsb-preview" data-lsb-group="header">
									<div class="sectopn-main_news_grid">
										<img src="<?=DEFAULT_GALLERY_IMAGE_URL.'front_'.$gallery['Galleryimage']['source']?>" alt="<?=$gallery['Galleryimage']['title']?>" class="img-responsive">
										<div class="sectopn-main_news_grid_pos">
											<div class="wthree_text">
												<h3><?=$gallery['Galleryimage']['title']?></h3>
											</div>
										</div>
									</div>
								</a>
							</div>
							<?php
							//var_dump($gal_count);
							//var_dump($gal_count%3);
							//echo '<br>';
							if(($gal_count%3) === 0){
								echo '</li>';
							}
							$gal_count++;
						}
						?>
					</ul>
				</div>
			</section>

		</div>
	</div>
</div>
<!-- //testimonials --> 
<?php
echo $this->element('frontfooter');
?>