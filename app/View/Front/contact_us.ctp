<?php
echo $this->element('frontheader');
?>
<div class="services-breadcrumb">
 <div class="container">	
	<div class="inner_breadcrumb">
		<ul class="short_ls">
			<li>
				<a href="<?=DEFAULT_URL?>" title="Home"> Home</a>
				<span>/ </span>
			</li>
			<li><?php echo $cms_page_title; ?></li>
		</ul>
	</div>
  </div>
</div>
<div class="welcome inner-page contact-page" id="about">	
	<div class="container"> 
		<div class="col-md-12">
			 <div class="col-md-6">
			    <h1 class="title">Contact <span>Us</span></h1>
			    <form action="<?=DEFAULT_URL?>contact-us" method="post">
					    <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
                                <input class="form-control" name="firstname" placeholder="Name" type="text" required autofocus />
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
                                <input class="form-control" name="email" placeholder="E-mail" type="text" required />
                            </div>
							<div class="col-lg-4 col-md-4 col-sm-4" style="padding-bottom: 10px;">
                                <input class="form-control" name="contact" placeholder="Contact No" type="text" required />
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                                <textarea style="resize:vertical;" class="form-control" placeholder="Message..." rows="6" name="comment" required></textarea>
                            </div>
                        </div>
						<div class="ab_button">
						<input type="submit" class="btn btn-primary btn-lg hvr-underline-from-left" value="Submit">
					     </div> 
				 </form>
			 </div>
			  <div class="col-md-6 contact-left-w3ls"> 
                     <h3 class="title">Our <span>Location</span></h3>				  
					 <div class="visit">  
						<h4><span class="fa fa-home" aria-hidden="true"></span> Visit Us</h4>
						<p><?=$contact_data['address']?></p> 
					 
						<h4><span class="fa fa-envelope-o" aria-hidden="true"></span> Mail Us</h4>
						<p>
							<a href="mailto:<?=$contact_data['email']?>"><?=$contact_data['email']?></a>
						</p>
					 
						<h4><span class="fa fa-phone" aria-hidden="true"></span> Call Us</h4>
						<p><?=$contact_data['phone']?></p>
					</div>
					<div class="clearfix"></div>  
			 </div> 
			 <div class="clearfix"> </div>
			 <div class="col-md-12" style="padding-top:25px;">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.585688481838!2d72.61665431454537!3d23.00225798496341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e86742b6dc88f%3A0x759d5db9ab4771c4!2sSeawind+Solution+Pvt+Ltd!5e0!3m2!1sen!2sin!4v1481979184975" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen=""></iframe> 
			</div>
		</div>
		
		<div class="clearfix"> </div>
	</div>
</div>
<?php
echo $this->element('frontfooter');
?>