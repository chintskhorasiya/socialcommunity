<?php
echo $this->element('frontheader');
?>
<div class="breadcrumb">
	<section class="article-breadcrumb">
			<?php
			$category_breadcrumb = '<span class="br-arrow">» </span> E-Paper';
			?>
			<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><?=$category_breadcrumb;?>
		</section>
</div>
<div class="inner-page">
	<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
	<h1 class="inner-title"><?=$epapers_data['Epaper']['title']?></h1>
	<?php //echo $cms_page_content; ?>
	
	<canvas id="the-canvas"></canvas>

  <div class="epaper-pagination">
    <button class="btn btn-primary" id="prev">Previous</button>
    <button class="btn btn-primary" id="next">Next</button>
    &nbsp; &nbsp;
    <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
  </div>
</div>

<script type="text/javascript">
	// If absolute URL from the remote server is provided, configure the CORS
// header on that server.
var url = '<?=$epapers_data['Epaper']['epaper']?>';

// The workerSrc property shall be specified.
//PDFJS.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';
PDFJS.workerSrc = '<?=DEFAULT_URL?>js/pdf.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.8,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport(scale);
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
PDFJS.getDocument(url).then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});
</script>

<?php
echo $this->element('frontfooter');
?>