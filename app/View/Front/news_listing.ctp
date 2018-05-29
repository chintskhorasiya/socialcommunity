<?php
echo $this->element('frontheader');
?>
<div class="breadcrumb">
	<section class="article-breadcrumb">
		<?php
		if(!empty($category_title)){
			$category_breadcrumb = '<span class="br-arrow">» </span><a href="'.DEFAULT_URL.'news/'.$this->Common->get_cat_slug($category_id).'">'.$category_title.'</a>';	
		} else {
			$category_breadcrumb = '';
		}
		?>
		<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><?=$category_breadcrumb;?>
	</section>
</div>

<div class="left-part"> <!-- left-part start --> 
	<section class="main listing-part"> <!-- sec-part1 start -->
		<div class="row">
			<?php
			if(count($category_news_data) > 0)
	     	{
	     		$last_catenews_count = count($category_news_data)-1;
	     		foreach ($category_news_data as $cat_news_key => $cat_news_data)
	     		{
	     			if(!empty($cat_news_data['News']['images'])){
						$catenews_images = explode(',', $cat_news_data['News']['images']);
						$catenews_image = $catenews_images[0];
					} else {
						$catenews_image = DEFAULT_URL.'img/new-default.png';
					}
		     	if($cat_news_key == 0){
		    ?>
			<div class="cat-main">
          		<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$cat_news_data['News']['cat_slug'].'/'.$cat_news_data['News']['slug']?>"><h3 class="col-md-12"><?php echo mb_substr($cat_news_data['News']['title'], 0, 80); ?></h3></a>		
		 		<div class="col-md-5">
            		<div id="listmyCarousel" class="carousel slide" data-ride="carousel"> 
						<div class="carousel-inner">
					  		<div class="news-b">
  					      		<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$cat_news_data['News']['cat_slug'].'/'.$cat_news_data['News']['slug']?>"><img src="<?=$catenews_image?>" alt="" /></a> 
					  		</div> 
						</div>  
					</div>
         		</div>	
	         	<div class="col-md-7 list-dec"> 
		            <?php echo mb_substr($cat_news_data['News']['content'], 0, 240); ?>
	         	</div>	 
		  		<div class="clear"></div> 
		 	</div>
		 		<?php } ?>
		 		<?php if($cat_news_key >= 1 && $cat_news_key <= $last_catenews_count){ ?>
				<?php if($cat_news_key == 1){ ?><div class="col-md-12 cat-list-grid"><?php } ?>
		      	<div class="news-b1">
		        	<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$cat_news_data['News']['cat_slug'].'/'.$cat_news_data['News']['slug']?>"><img class="cat-list-imgs" src="<?=$catenews_image?>" height="100" alt="" /></a>
				 	<div class="cat-list-grid-title">
				    	<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$cat_news_data['News']['cat_slug'].'/'.$cat_news_data['News']['slug']?>"><h3><?php echo mb_substr($cat_news_data['News']['title'], 0, 50); ?></h3></a> 
				 	</div> 
			     	<div class="clear"></div>
			  	</div>
			   	<?php if($cat_news_key == $last_catenews_count){ ?><div class="clear"></div></div><?php } ?>
			   	<?php } ?>
			<?php } ?>
			<?php } ?>
        </div> 		  
	    <div class="clear"></div> 
    </section> <!-- sec-part1 end -->
</div> <!-- left-part end -->

<div class="right-part inner-right"> <!-- right-part start -->
	<?php
  	if($ads_category_page_rightbar_data)
  	{
  		if(!empty($ads_category_page_rightbar_data['Advertise']['source'])){
  		?>
  		<div class="adv1"><a target="_blank" href="<?=$ads_category_page_rightbar_data['Advertise']['link']?>"><img src="<?=$ads_category_page_rightbar_data['Advertise']['source']?>" alt="<?=$ads_category_page_rightbar_data['Advertise']['title']?>" /></a></div>
  		<?php
  		}
  	}
  	?> 

	<div class="commo-market-widget">
		<h2 class="main-title">Commodity Market</h2>
		<iframe frameborder="0" src="http://www.indianotes.com/widgets/currency-prices/index.php?type=all-currency-prices&w=300&h=200" width="300" height="200" scrolling="no"></iframe>
	</div>

	<a href="<?php echo $this->Common->get_listing_url(6); ?>"><h2 class="main-title">ગૌ સેવા</h2></a>
	<div class="clear"></div>
	<div id="PressmyCarousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php
       		if(count($news_page_sidebarupr) > 0){
       		
       			foreach ($news_page_sidebarupr as $sidebarupr_key => $sidebarupr_data) {
       				if(!empty($sidebarupr_data['News']['images'])){
						$sidebarupr_images = explode(',', $sidebarupr_data['News']['images']);
						$sidebarupr_image = $sidebarupr_images[0];
					} else {
						$sidebarupr_image = DEFAULT_URL.'img/new-default.png';
					}
       			?>
       				<div class="item <?php if($sidebarupr_key == 0){ echo 'active'; } ?> news-b">
       					<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$sidebarupr_data['News']['cat_slug'].'/'.$sidebarupr_data['News']['slug']?>"><img src="<?=$sidebarupr_image?>" alt="" /></a>
       					<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$sidebarupr_data['News']['cat_slug'].'/'.$sidebarupr_data['News']['slug']?>"><h3><?php echo mb_substr($sidebarupr_data['News']['title'], 0, 80); ?></h3></a>
       				</div>
       			<?php
       			}
       		}
       		?>
		</div>			
		<a class="left carousel-control" href="#PressmyCarousel" data-slide="prev">
		   <span class="glyphicon-chevron-left"><img src="<?=DEFAULT_URL?>img/prev-arrow.png" alt="arrow"></span>
		</a>
		<a class="right carousel-control" href="#PressmyCarousel" data-slide="next">
		    <span class="glyphicon-chevron-right"><img src="<?=DEFAULT_URL?>img/left-arrow.png" alt="arrow"></span>
		</a>
	</div>
	<div class="clear"></div>
		   
	<a href="<?php echo $this->Common->get_listing_url(8); ?>"><h2 class="main-title">લેં-વેંચ</h2></a>
    <div class="clear"></div> 
   	<div class="gray-bg">
	   	<?php
   		if(count($news_page_sidebardown) > 0){
   		
   			foreach ($news_page_sidebardown as $sidebardown_key => $sidebardown_data) {
   				if(!empty($sidebardown_data['News']['images'])){
					$sidebardown_images = explode(',', $sidebardown_data['News']['images']);
					$sidebardown_image = $sidebardown_images[0];
				} else {
					$sidebardown_image = DEFAULT_URL.'img/new-default.png';
				}
   			?>
   				<div class="grid-listing">
   					<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$sidebardown_data['News']['cat_slug'].'/'.$sidebardown_data['News']['slug']?>"><img src="<?=$sidebardown_image?>" alt="" /></a>
   					<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$sidebardown_data['News']['cat_slug'].'/'.$sidebardown_data['News']['slug']?>"><h3><?php echo mb_substr($sidebardown_data['News']['title'], 0, 80); ?></h3></a>
   				</div>
   			<?php
   			}
   		}
   		?>
  	</div>
  	<div class="clear"></div>
</div> <!-- right-part end -->  

<div class="clear"></div>   

<?php
echo $this->element('frontfooter');
?>