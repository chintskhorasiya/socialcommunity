<?php
echo $this->element('frontheader');
?>
<div class="breadcrumb">
	<section class="article-breadcrumb">
			<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><span class="br-arrow">» </span><?php echo $livetv_page_title; ?>
	</section>
</div>
<div class="inner-page">
	<h1 class="inner-title"><?=$livetv_page_title?></h1>
	<?php //echo $cms_page_content; ?>
</div>
<?php
echo $this->element('frontfooter');
?>