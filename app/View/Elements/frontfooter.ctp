<!-- copyright -->
	<div class="copy-section text-center">
	  <div class="container">
	    <ul class="nav navbar-nav quick-links">
		    <li><a href="<?=DEFAULT_URL?>" class="active">Home</a></li>
			<li><a href="<?=DEFAULT_URL.'page/about-us'?>">About Us</a></li> 
			<li><a href="#">Committee Members </a> </li>
			<li><a href="<?=DEFAULT_URL.'donation-facility'?>">Donation Facility</a> </li>
			<li><a href="#">Matrimonial</a></li> 
			<li><a href="<?=DEFAULT_URL.'donors-list'?>">Donors List</a> </li>
			<li><a href="<?=DEFAULT_URL.'news-events'?>">News and Events</a> </li>
			<li><a href="<?=DEFAULT_URL.'contact-us'?>">Contact Us</a></li>
		</ul>
		  <div class="social-icons col-md-3">
			 <ul>
				<li>
					<a href="<?=$social_data['facebook']?>" target="_blank" class="fa fa-facebook icon-border facebook"> </a>
				</li>
				<li>
					<a href="<?=$social_data['twitter']?>" target="_blank" class="fa fa-twitter icon-border twitter"> </a>
				</li>
				<li>
					<a href="<?=$social_data['google']?>" target="_blank" class="fa fa-google-plus icon-border googleplus"> </a>
				</li>
				<li>
					<a href="<?=$social_data['youtube']?>" target="_blank" class="fa fa-rss icon-border youtube"> </a>
				</li>
			</ul>
		   </div>
		   <div class="clearfix"> </div>
		<p>© Copyright 2018 Community Social. All rights reserved | Design &amp; Developed by <a href="http://seawindsolution.com" target="_blank">Seawind Solution Pvt. Ltd.</a>
		</p>
	</div>
	</div>
	<!-- //copyright -->
	<!-- //footer -->


	<script>
		$(window).load(function () {
			$.fn.lightspeedBox();
		});
	</script>
	<script>
		// You can also use "$(window).load(function() {"
		$(function () {
			// Slideshow 4
			$("#slider3").responsiveSlides({
				auto: true,
				pager: true,
				nav: false,
				speed: 500,
				namespace: "callbacks",
				before: function () {
					$('.events').append("<li>before event fired.</li>");
				},
				after: function () {
					$('.events').append("<li>after event fired.</li>");
				}
			});

		});
	</script>
	<script>
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				start: function (slider) {
					$('body').removeClass('loading');
				}
			});
		});
	</script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->

	<!-- smooth scrolling-bottom-to-top -->
	<script>
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});
		});
	</script>
	<a href="#" id="toTop" style="display: block;">
		<span id="toTopHover" style="opacity: 1;"> </span>
	</a>
	<!-- //smooth scrolling-bottom-to-top -->
	<!-- //Js files -->