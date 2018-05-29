<?php
echo $this->element('frontheader');
?>
<div class="breadcrumb">
	<section class="article-breadcrumb">
		<?php
		$category_breadcrumb = '<span class="br-arrow">» </span> <a href="'.DEFAULT_URL.'videos">Videos</a>';
		?>
		<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><?=$category_breadcrumb;?><span class="br-arrow">» </span><?php echo $video_page_title; ?>
	</section>
</div>
<div class="left-part"> <!-- left-part start --> 
            <style>
            .youtube .play {
			    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAERklEQVR4nOWbTWhcVRTHb1IJVoxGtNCNdal2JYJReC6GWuO83PM/59yUS3FRFARdFlwYP1CfiojQWt36sRCUurRIdVFXIn41lAoVdRGrG1M01YpKrWjiYmaSl8ybZJL3cd+YA//NLObd3++eO8x79z5jSq5Gw+8kov0AP8vMR5l1BtBZQM4B8ks75wCdZdYZZj5qLZ4hov2Nht9Z9vhKKSIaB/gI4M4w62KeAO6Mte4lYOq20FxrlqqOibhHmeWbvNC9ZfDX1mLae391aN6limO/gwgvAPJbWeAZuSDingdwXTBw7/0IsyaA/Fkh+KqOkD+YNfHej1QKD+y7iVlOhgLvFqFfNJvNGyuBJ+KDAF8MDd0tgS8y64OlgSdJMsysL4cG7SOHkyQZLhTee7+d2R2rAVy/S+Jd7/32ouBHAP4gNNRGQyTHc/84NhqNywZp5rvjjnnvt21aABFeCQ+RLwAf2hQ8s7sv9OCLk6AHNgQvIrvbfzKCD76g/O6cu7lf/iER/aQGgy448pExZmhdegAPhR9sObFWH1gT3lp7DaA/5bkIgJhZPgsNmz02novj+KqeApj1ubwXWe4kdyeznAgNvTpE/HQmvKqOMeuFogTUVQSRno+iaLRLAJF7uIgL9O4ubgL8aWgB7S44mNX+35YpICUiAvS9sBLkq1WzT+NFffl6AuoiApi6NT37h6sWkBIRZGkQ8YtLgyji6e1mBYTqCEBPG2Naz+0BWQgtoGoRgCzEsd9hAN1X5BfnFZASUfrSAFQNsyZ1FJASUVpHiLinDJG8U2cBZYogkrcNs5waBAGdstbeU9zdqpw0gPwwSAI6VUxHyFlDpOcHUUBBIuYNs14aZAE5RVwyzPr3/0EAEY0TyfGNjBWQvwZ +CTSbehfAH29mrID8bET0+0EUkAd8WYDOmqJ3ecsG30yr9wqRfm6Y+a1BEFDEjHfHvWmY9ck6CygHvBVr8Xhtb4ZE5HZA3y8DvBNA1TjnrmXWf+sioMwZX5V/VHXMGGMMoKdDCxCRvRWBdzKzdHEO+EisilbPyopHYqp6S9UCAsz4iojI7hUDAtyXVQgIDd6KnOoaWNkbI6FaPSuZGyMArsi7MZoloB4zviI/Nhr3X95jltwTRQmoIfgisy5ai+me67OI7fE4nrqjrqfK1t0eby0FPRB6oGVlchL3rgnfrq19RKbVBdhV9IOSwJmfmJi4vi/4ThERitwyCxVAFqydshuCX5awhQ9KtmuIWd8IDZED/nXT77rvVVv6sHRKwjYi91poqP7Dr+Y6JJ1VSZIMA3wkPNy6bX+o8Bcm0sXMdwM8Fxo0A3xORPaWBp6uPXsmbxCRD0NDL0dOANhVCXy6iAjMcjbcrMt3RITKwdMVRdFo+y5yvkL4eWZ+zHt/ZVD4dEVRNGotpst+dZZZH8k86lqn2pIvT/eqrNfn2xuyqYPZ8mv7s8pfn/8Pybm4TIjanscAAAAASUVORK5CYII=") no-repeat center center;
			    background-size: 64px 64px;
			    position: absolute;
			    height: 100%;
			    width: 100%;
			    opacity: .8;
			    filter: alpha(opacity=80);
			    transition: all 0.2s ease-out;
			}

			.youtube .play:hover {
			    opacity: 1;
			    filter: alpha(opacity=100);
			}
            </style>
            <script type="text/javascript">
				'use strict';
				function r(f){/in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
				r(function(){
				    if (!document.getElementsByClassName) {
				        // IE8 support
				        var getElementsByClassName = function(node, classname) {
				            var a = [];
				            var re = new RegExp('(^| )'+classname+'( |$)');
				            var els = node.getElementsByTagName("*");
				            for(var i=0,j=els.length; i<j; i++)
				                if(re.test(els[i].className))a.push(els[i]);
				            return a;
				        }
				        var videos = getElementsByClassName(document.body,"youtube");
				    } else {
				        var videos = document.getElementsByClassName("youtube");
				    }

				    var nb_videos = videos.length;
				    for (var i=0; i<nb_videos; i++) {
				        // Based on the YouTube ID, we can easily find the thumbnail image
				        videos[i].style.backgroundImage = 'url(http://i.ytimg.com/vi/' + videos[i].id + '/hqdefault.jpg)';

				        // Overlay the Play icon to make it look like a video player
				        var play = document.createElement("div");
				        play.setAttribute("class","play");
				        videos[i].appendChild(play);

				        videos[i].onclick = function() {
				            // Create an iFrame with autoplay set to true
				            var iframe = document.createElement("iframe");
				            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
				            if (this.getAttribute("data-params")) iframe_url+='&'+this.getAttribute("data-params");
				            iframe.setAttribute("src",iframe_url);
				            iframe.setAttribute("frameborder",'0');

				            // The height and width of the iFrame should be the same as parent
				            iframe.style.width  = this.style.width;
				            iframe.style.height = this.style.height;

				            // Replace the YouTube thumbnail with YouTube Player
				            this.parentNode.replaceChild(iframe, this);
				        }
				    }
				});
			</script>
			<?php
    		$youtube_regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
			$match;
			?>
			<div class="item col-md-12">
    			<?php
    			if(preg_match($youtube_regex_pattern, $video_page_video, $match)){
				    //echo "Youtube video id is: ".$match[4];
				    ?>
				    <div class="youtube" id="<?=$match[4];?>" style="width: 100%; height: 447px;background-size: 100%;">
					</div>
				    <?php
				}else{
				    echo $video_page_title;
				}
    			?>
    		</div>
        	<div class="inner-list-dec">
			    <p class="dba_pdate">Last Modified - <?php echo $video_page_modified; //date('M d, Y, g:i A', $news_page_modified); ?></p>
				<h1><?=$video_page_title?></h1>
				<div style="word-wrap: break-word;"><?php echo $video_page_content; ?></div>
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
           	<div class="clear"></div>

           	<div class="col-md-12 cat-list-grid">
           		<h2 class="main-title yellow">More Videos</h2>
           		<span class="yellow-border"></span>
           		<div class="clear"></div>
           		<?php
           		if(count($video_page_morevideos) > 0){
           		
           			foreach ($video_page_morevideos as $morevideos_key => $morevideos_data) {
           			?>
           				<div class="col-md-6">
			        		<a href="<?=DEFAULT_URL.'video/'.$morevideos_data['Video']['slug']?>">
			        			<?php
			        			$youtube_regex_pattern = "/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/";
			        			$match;

		            			if(preg_match($youtube_regex_pattern, $morevideos_data['Video']['video'], $match)){
								    //echo "Youtube video id is: ".$match[4];
								    ?>
								    <!--<div class="youtube" id="<?=$match[4];?>" style="width: 100%; height: 250px;background-size: 100%;">
									</div>-->
									<img src="http://i.ytimg.com/vi/<?=$match[4];?>/hqdefault.jpg" alt="$morevideos_data['Video']['title']" style="width: 100%; height: 250px;background-size: 100%;" />
								    <?php
								}else{
								    echo $morevideos_data['Video']['title'];
								}
		            			?>
			        			<h3><?php echo mb_substr($morevideos_data['Video']['title'], 0, 80); ?></h3>
								<p>Click here to Watch Video</p>
							</a>
			         	</div>
           			<?php
           			}
           		}
           		?>
			   	<div class="clear"></div>
         	</div>  	  
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