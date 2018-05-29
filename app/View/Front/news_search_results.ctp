<?php
echo $this->element('frontheader');
if($this->Session->read('front_search_news_key') != "" && $from_search)
{
   $search_key = $this->Session->read('front_search_news_key');
}
else
{
   $search_key = "";
}
?>
<div class="breadcrumb">
	<section class="article-breadcrumb">
		<?php
		$category_breadcrumb = '<span class="br-arrow">» </span> Search Results <span class="br-arrow">» '.$search_key;
		?>
		<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><?=$category_breadcrumb;?>
	</section>
</div>
<div class="inner-page">
		<h1 class="inner-title">News Search Results</h1>
		<div class="e-paper-listing">
			<?php
			if(count($news_search_data) > 0){
				foreach ($news_search_data as $news_data_key => $news_data) {
					//echo '<pre>';print_r($news_data);echo '</pre>';
					if(!empty($news_data['News']['images'])){
					$search_news_images = explode(',', $news_data['News']['images']);
					$gallery_main_search = $search_news_images[0];
				} else {
					$gallery_main_search = DEFAULT_URL.'img/new-default.png';
				}
				if(!empty($news_data['News']['categories'])){
					$catArr = explode(',', $news_data['News']['categories']);
					$first_cat = $catArr[0];
					$first_cat_slug = $this->Common->get_cat_slug($first_cat);
				} else {
					$first_cat_slug = '';
				}
				?>
					<div class="grid-listing grid-listing-left">
						<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$first_cat_slug.'/'.$news_data['News']['slug']?>"><img src="<?=$gallery_main_search?>" alt="<?php echo $news_data['News']['title']; ?>" /></a>

					<a href="<?=DEFAULT_FRONT_NEWS_DETAIL_URL.$first_cat_slug.'/'.$news_data['News']['slug']?>"><h3><?php echo mb_substr($news_data['News']['title'], 0, 80); ?></h3></a>
   				</div>
					<?php
				}
			}
			?>
		</div>
</div>
<div class="clear"></div>
<?php echo $this->Paginator->prev('« Previous', array('class' => 'btn btn-default'), null, 
            array('class' => 'disabled')); ?>
	<!-- Shows the page numbers -->
<?php echo $this->Paginator->numbers(); ?>
<!-- Shows the next and previous links -->
<?php echo $this->Paginator->next('Next »', array('class' => 'btn btn-default'), null,
    array('class' => 'disabled')); ?> 
<!-- prints X of Y, where X is current page and Y is number of pages -->
<?php echo $this->Paginator->counter(); ?>
<div class="clear"></div>
<?php
echo $this->element('frontfooter');
?>