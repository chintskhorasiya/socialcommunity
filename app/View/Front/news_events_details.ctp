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
			<li>News & Events Titles</li>
		</ul>
	</div>
  </div>
</div>
<!-- welcome -->
<div class="welcome inner-page" id="about">	
	<div class="container">
		<h1 class="title"><?=$newsevent_title?></h1>
		<div class="row">
			<div class="col-md-4">
					<img src="<?=DEFAULT_NEWSEVENTS_IMAGE_URL.$newsevent_source?>" />
			</div>
			<div class="col-md-8">  
				
			    <!-- <div class="date-events"><strong>Date : 25-05-2018</strong></div>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
				 <br/><br/>
				It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. 
				 <br/><br/>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type. 
				 <br/><br/>
				 
				It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p> -->
				<?=$newsevent_page?> 
			</div>
		 </div>
		<div class="clearfix"> </div>
	</div>
</div>
<!-- //welcome -->
<?php
echo $this->element('frontfooter');
?>