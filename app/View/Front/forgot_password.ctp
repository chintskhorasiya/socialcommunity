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
				<li>Forgot Password</li>
			</ul>
		</div>
	  </div>
   </div>
	<!-- welcome -->
	<div class="welcome inner-page contact-page" id="about">	
		<div class="container"> 
			<div class="col-md-12">
				<?php
	            if(empty($errorarray) && isset($succhange) && !empty($succhange))
	            {
	                echo '<div class="alert alert-success sign-up suc-message" style="text-align: center; padding-bottom: 15px;">We will send you a password reset email within a few minutes.</div>';
	            }
	            ?>
				 <div class="col-md-4 login-form">
				    <h1 class="title">Forgot <span>Password</span></h1>
				    <form action="<?=DEFAULT_URL?>forgot-password" method="post">
						    <div class="row"> 
                                <div class="col-md-12" style="padding-bottom: 10px;">
								   <p style="line-height: 21px;margin: 0px 0px 8px;">Please enter your email or username</p>
                                    <input class="form-control" name="User[email]" type="text" required />
                                    <?php if (isset($errorarray['enter_email'])) echo "<span class='error-message'>" . $errorarray['enter_email'] . "</span>"; ?>
					                <?php if (isset($errorarray['valid_email'])) echo "<span class='error-message'>" . $errorarray['valid_email'] . "</span>"; ?>
					                <?php if (isset($errorarray['email_not_match'])) echo "<span class='error-message'>" . $errorarray['email_not_match'] . "</span>"; ?>
                                </div> 								   
                            </div> 
							<div class="ab_button">
							<input type="submit" class="btn btn-primary btn-lg hvr-underline-from-left" style="width:100%;" value="Reset my password"> 
						     </div> 
					 </form>
					 
				 </div>
				 
				 
			</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
	<!-- //welcome -->
<?php
echo $this->element('frontfooter');
?>