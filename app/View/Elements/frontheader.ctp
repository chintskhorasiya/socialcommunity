<div class="header-w3l">
	<!-- navigation -->
	<div class="nav-agile">
		<nav class="navbar navbar-default">
		  <div class="container">
			<div class="navbar-header logo-sectopn-main">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- logo -->
				<div class="logo">
					<a href="#"><img src="<?=DEFAULT_URL?>img/logo.png" /></a>
					<h2>શ્રી જનોડ એકડા વિશા ખડાયતા પ્રગતિ મંડળ</h2>
				</div>
				<!-- //logo -->
			</div>
			<!-- navbar-header -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<div class="w3l-navtop">
				<?php
				if ($this->Session->check('member_login') == true) {
		            ?>
		            <ul class="top-details login-link">
						<li><a href="#">Hi, <?=$this->Session->read('member_name')?></a></li>
						<li><a href="<?=DEFAULT_URL?>logout">Logout</a></li>
					</ul>
					<?php
		        } else {
				?>
				<ul class="top-details login-link">
					<li><a href="<?=DEFAULT_URL?>login">Login</a></li>
					<li><a href="<?=DEFAULT_URL?>registration">Register</a></li> 
				</ul>
				<?php
				}
				?>
				<ul class="top-details">
					<li><a href="tel:<?=$contact_data['phone']?>"><i class="fa fa-phone"></i> <?=$contact_data['phone']?></a></li>
					<li><a href="mailto:<?=$contact_data['email']?>"><i class="fa fa-envelope"></i> <?=$contact_data['email']?></a></li> 
				</ul> 
				   <div class="clearfix"> </div>
					   <ul class="nav navbar-nav navbar-right">
						<li><a href="<?=DEFAULT_URL?>" class="active">Home</a></li>
						<li><a href="<?=DEFAULT_URL.'page/about-us'?>">About Us</a></li> 
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Committee Members
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu agile_short_dropdown">
								  <li><a href="<?=DEFAULT_URL.'executive-committee'?>"><span>Executive Committee</span></a></li>
								  <li><a href="<?=DEFAULT_URL.'advisory-committee'?>"><span>Advisory Committee</span></a></li>
								  <li><a href="<?=DEFAULT_URL.'yuva-committee'?>"><span>Yuva Committee</span></a></li>
								  <li><a href="#"><span>Member Directory</span></a></li>
							</ul>
						</li>
						<li><a href="<?=DEFAULT_URL.'donation-facility'?>">Donation Facility</a> </li> 
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Matrimonial
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu agile_short_dropdown">
								  <li><a href="#"><span>Matrimonial List</span></a></li>
								  <li><a href="#"><span>Matrimonial Status</span></a></li> 
							</ul>
						</li>
						<li><a href="<?=DEFAULT_URL.'donors-list'?>">Donors List</a> </li>
						<li><a href="<?=DEFAULT_URL.'news-events'?>">News and Events</a> </li>
						<li><a href="<?=DEFAULT_URL.'contact-us'?>">Contact Us</a></li>
						</ul>
				</div>
				 
				<div class="clearfix"> </div>
			</div>
		   </div>	
		</nav>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //navigation -->
<!-- //header -->