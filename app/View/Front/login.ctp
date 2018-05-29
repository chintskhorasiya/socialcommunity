<?php
echo $this->element('frontheader');
?>
<!-- //header -->
<div class="services-breadcrumb">
 <div class="container">	
	<div class="inner_breadcrumb">
		<ul class="short_ls">
			<li>
				<a href="index.html">Home</a>
				<span>/ </span>
			</li>
			<li>Login</li>
		</ul>
	</div>
  </div>
</div>
<!-- welcome -->
<div class="welcome inner-page contact-page" id="about">	
	<div class="container"> 
		<div class="col-md-12">
			 <div class="col-md-4 login-form">
			    <h1 class="title">Login <span>Form</span></h1>
			    <form action="<?=DEFAULT_URL.'login'?>" method="post">
					    <?php
				        //For display error
				        if(isset($error_array['err_username'])){echo '<div class="alert alert-block alert-danger fade in"><span>'.$error_array['err_username'].'</span></div>';}
				        else if(isset($error_array['err_password'])){echo '<div class="alert alert-block alert-danger fade in"><span>'.$error_array['err_password'].'</span></div>';}
				        else if(isset($error_array['err_nomatch'])){echo '<div class="alert alert-block alert-danger fade in"><span>'.$error_array['err_nomatch'].'</span></div>';}
				        ?>
					    <div class="row">
                            <div class="col-md-12" style="padding-bottom: 10px;">
							    <label>Username</label>
                                <input class="form-control" name="data[User][username]" type="text" required autofocus />
                            </div>
                            <div class="col-md-12" style="padding-bottom: 10px;">
							    <label>Password</label>
                                <input class="form-control" name="data[User][password]" type="password" required />
                            </div>
							<div class="col-md-12" style="padding-bottom: 10px;">
							   <p><a href="forgot.html">Forgot your password?</a></p>
                            </div>
							 
                        </div> 
						<div class="ab_button">
						<input type="submit" class="btn btn-primary btn-lg hvr-underline-from-left" value="Login">
						<button class="btn btn-primary btn-lg hvr-underline-from-left" value="Register"><a href="register.html">Register</a></button>
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