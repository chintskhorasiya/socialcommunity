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
<div class="welcome inner-page" id="about">	
	<div class="container">
		<h1 class="title"><?=$cms_page_title?></h1>
		<div class="col-md-12">
			<?php echo $cms_page_content; ?>
		</div>
	</div>
</div>
<?php
echo $this->element('frontfooter');
?>