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
				<li>Change Password</li>
			</ul>
		</div>
	  </div>
   </div>
	<!-- welcome -->
	<div class="welcome inner-page contact-page" id="about">
		<div class="container"> 
			<div class="col-md-12">
				<div class="col-md-4 login-form">
					<?php
		            if(empty($errorarray) && isset($succhange) && !empty($succhange))
		            {
		                echo '<div class="alert alert-success sign-up suc-message" style="text-align: center; padding-bottom: 15px;">We will send you a password changed email within a few minutes.</div>';

		            } elseif(!empty($errorarray)) {
		            	foreach ($errorarray as $error) {
		            		echo '<div class="alert alert-danger" style="text-align: center; padding-bottom: 15px;">'.$error.'</div>';
		            	}
		            }
		            ?>
				    <h1 class="title">Change <span>Password</span></h1>
				    <form action="<?=DEFAULT_URL?>change-password" method="post">
						    <div class="row"> 
                                <div class="col-md-12" style="padding-bottom: 10px;">
								   <p style="line-height: 21px;margin: 0px 0px 8px;">Please enter old password</p>
                                    <input class="form-control" name="User[oldpwd]" type="password" required />
                                </div> 
                                <div class="col-md-12" style="padding-bottom: 10px;">
								   <p style="line-height: 21px;margin: 0px 0px 8px;">Please enter new password</p>
                                    <input class="form-control" name="User[newpwd]" type="password" required />
                                </div>
                                <div class="col-md-12" style="padding-bottom: 10px;">
								   <p style="line-height: 21px;margin: 0px 0px 8px;">Please confirm your new password</p>
                                    <input class="form-control" name="User[confirmpwd]" type="password" required />
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