<?php
echo $this->element('frontheader');
?>
<div class="breadcrumb">
	<section class="article-breadcrumb">
		<?php
		if(!empty($category_title)){
			//$category_breadcrumb = '<span class="br-arrow">» </span>'.$category_title;
			$category_breadcrumb = '<span class="br-arrow">» </span><a href="'.DEFAULT_URL.'news/'.$this->Common->get_cat_slug($category_id).'">'.$category_title.'</a>';	
		} else {
			$category_breadcrumb = '';
		}
		?>
		<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><?=$category_breadcrumb;?><span class="br-arrow">» </span><?php echo $news_page_title; ?>
	</section>
</div>

<div class="left-part"> <!-- left-part start -->
	<h1 class="details-title"><?=$news_page_title?></h1>
	<?php
    //echo '<pre>';
    $imgs_arr = array();
    $videos_arr = array();

    if(!empty($news_page_images)) $imgs_arr = explode(',', $news_page_images);
    //print_r($imgs_arr);
    if(!empty($news_page_videos)) $videos_arr = explode(',', $news_page_videos);
    //print_r($videos_arr);

    if(count($imgs_arr) > 0 && count($videos_arr) > 0){
    	$media_arr = array_merge($imgs_arr, $videos_arr);
    } elseif(count($imgs_arr) > 0) {
    	$media_arr = $imgs_arr;
    } elseif(count($videos_arr) > 0) {
    	$media_arr = $videos_arr;
    }
    //print_r($media_arr);
    //echo '</pre>';
    if(count($media_arr) > 0){
    ?>
    <style>
    .owl-video-wrapper .owl-video-tn{min-height: 450px !important;}
	</style>
	<div class="owl-carousel owl-theme">

    	<!--<ul class="slides">-->
    		<?php
    		$youtube_regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
			$match;

			foreach ($media_arr as $imgkey => $gimg) {
    			?>
    			<div class="item">
        			<?php
        			if(preg_match($youtube_regex_pattern, $gimg, $match)){
					    //echo "Youtube video id is: ".$match[4];
					    /*?>
					    <div class="youtube" id="<?=$match[4];?>" style="background:url('http://i.ytimg.com/vi/<?=$match[4];?>/hqdefault.jpg');width: 100%; height: 447px;background-size: 100%;" onclick="videodivclick();">
							<div class="play" id="play_<?=$match[4];?>"></div>
						</div>
					    <?php*/
					    ?>
					    <div class="item" data-merge="1">
			              <a class="owl-video" href="https://www.youtube.com/watch?v=<?=$match[4];?>"></a>
			            </div>
			            <?php
					}else{
					    ?><img src="<?=$gimg?>" alt="" /><?php
					}
        			?>
        		</div>
        		<?php
    		}
    		?>
    	<!--</ul> -->
	</div>
	<?php } ?>
	<p class="dba_pdate col-md-6">Updated - <?php echo $news_page_modified; //Nov 22, 2017, 05:11 PM IST ?></p>

 	<div class="social-like col-md-6">
		<div class="clear social-share">  
		  	<span><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>" onclick="return !window.open(this.href, 'Facebook', 'width=640,height=580')"><img src="<?=DEFAULT_URL?>img/social-face.png" alt=""></a></span>
		  	<span><a href="https://plus.google.com/share?url=<?php echo urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>" onclick="return !window.open(this.href, 'Google', 'width=640,height=580')"><img src="<?=DEFAULT_URL?>img/social-google.png" alt=""></a></span>
		  	<span><a href="http://twitter.com/share?text=<?=$news_page_title?>&url=<?=$og_url?>" onclick="return !window.open(this.href, 'Twitter', 'width=640,height=580')"><img src="<?=DEFAULT_URL?>img/social-twitter.png" alt=""></a></span>
		  	<span><a href="http://pinterest.com/pin/create/button/?url=<?=urlencode($og_url)?>&media=<?=$og_image?>" onclick="return !window.open(this.href, 'Pinterest', 'width=640,height=580')"><img src="<?=DEFAULT_URL?>img/social-pint.png" alt=""></a></span>
	  	</div>
	</div>

	<div class="clear"></div>

	<div class="inner-list-dec">
		<?php echo $news_page_content; ?>
	</div>	
   	
   	<?php
  	if($ads_detail_page_latest_bottom_data)
  	{
  		if(!empty($ads_detail_page_latest_bottom_data['Advertise']['source'])){
  		?>
  		<div class="adv6"><a target="_blank" href="<?=$ads_detail_page_latest_bottom_data['Advertise']['link']?>"><img src="<?=$ads_detail_page_latest_bottom_data['Advertise']['source']?>" alt="<?=$ads_detail_page_latest_bottom_data['Advertise']['title']?>" /></a></div>
  		<?php
  		}
  	}
  	?> 

    <div class="cat-list-grid">
	  	<h2 class="main-title">Other News</h2>
      	<div class="clear"></div> 			  
      	<?php
   		if(count($news_page_morenews) > 0){
   		
   			foreach ($news_page_morenews as $morenews_key => $morenews_data) {
   				if(!empty($morenews_data['News']['images'])){
					$morenews_images = explode(',', $morenews_data['News']['images']);
					$morenews_image = $morenews_images[0];
				} else {
					$morenews_image = DEFAULT_URL.'img/new-default.png';
				}
   			?>
   				<div class="news-b1">
   					<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$morenews_data['News']['cat_slug'].'/'.$morenews_data['News']['slug']?>"><img class="cat-list-imgs" src="<?=$morenews_image?>" alt="" /></a>
   					<div class="cat-list-grid-title">
   					<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$morenews_data['News']['cat_slug'].'/'.$morenews_data['News']['slug']?>"><?php echo mb_substr($morenews_data['News']['title'], 0, 50); ?></a>
   					</div>
   				</div>
   			<?php
   			}
   		}
   		?>
	   	<div class="clear"></div> 
  	</div> 		   
  	<div class="clear"></div> 
</div> <!-- left-part end -->

<div class="right-part inner-right"> <!-- right-part start -->
	<?php
  	if($ads_detail_page_rightbar_data)
  	{
  		if(!empty($ads_detail_page_rightbar_data['Advertise']['source'])){
  		?>
  		<div class="adv2"><a target="_blank" href="<?=$ads_detail_page_rightbar_data['Advertise']['link']?>"><img src="<?=$ads_detail_page_rightbar_data['Advertise']['source']?>" alt="<?=$ads_detail_page_rightbar_data['Advertise']['title']?>" /></a></div>
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

<script type="text/javascript">

	/*$(window).load(function(){

		$('.flexslider').flexslider({
			animation: "slide",
			pausePlay: true,
			pauseText: false,
			playText: "Play Slideshow",
			start: function(slider){
				$('body').removeClass('loading');
			}
		});

	});*/

	$(document).ready(function() {
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        //autoHeight:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        video:true,
        lazyLoad:true,
        center:true,
        dots: false,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 1
          },
          1000: {
            items: 1
          }
        }
      })
    });

</script>
<?php
echo $this->element('frontfooter');
?>