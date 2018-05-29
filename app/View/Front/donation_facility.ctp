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
<div class="welcome inner-page payment-page" id="about">	
	<div class="container">
		<h1 class="title">Donation <span>Facility</span></h1>
		<div class="col-md-12">
			 <div class="col-md-6">
			    <form action="<?=DEFAULT_URL?>donation-facility" method="post">
					    <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <input class="form-control" name="firstname" placeholder="Name" type="text" required autofocus />
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                                <input class="form-control" name="email" placeholder="E-mail" type="text" required />
                            </div>
							<div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
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
			  <div class="col-md-6 payment-details">
			           <h3>શ્રી જનોડ એકડા વિશા ખડાયતા પ્રગતિ મંડળ</h3> 
						<h4>Online Registration – Payment Details</h4> <br>
						<strong>Beneficiary Name</strong><br> <?=$donation_data['beneficiary_name']?> <br><br>
						<strong>Bank Name</strong><br> <?=$donation_data['bank_name']?> <br><br>
						<strong>Branch</strong> <br><?=$donation_data['branch']?><br><br>
						<strong>Current account No.<br></strong> <?=$donation_data['current_account_no']?><br><br>
						<strong>RTGS/NEFT IFSC</strong> <br><?=$donation_data['ifsc']?><br><br>
						<strong>MICR CODE</strong><br> <?=$donation_data['micr_code']?>
			 </div>
			 
		</div>
		 
		<div class="clearfix"> </div>
	</div>
</div>
<?php
echo $this->element('frontfooter');
?>