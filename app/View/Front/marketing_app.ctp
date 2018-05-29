<?php
//echo $this->element('frontheader');
?>
<div class="breadcrumb" style="display: none;">
	<section class="article-breadcrumb">
			<a href="<?=DEFAULT_URL?>" title="Home"> Home</a><span class="br-arrow">» </span><?php echo $marketing_page_title; ?>
	</section>
</div>
<div class="inner-page">
	<h1 class="inner-title"><?=$marketing_page_title?></h1>
	<?php //echo $cms_page_content; ?>
	<style type="text/css">
	#commo-div
	{
	    width    : 100%;
	    height   : 150px;
	    overflow : hidden;
	    position : relative;
	}
	#commo-iframe
	{
	    position : absolute;
	    top      : -150px;
	    left     : -40px;
	    width    : 1280px;
	    height   : 1200px;
	}
	</style>
	<div id="commo-div" style="display: none;">
		<iframe src="http://ecommodityworld.com" id="commo-iframe" scrolling="no"></iframe>
		<hr>
	</div>
	<?php
	//echo '<pre>';
	//print_r($marketingprices_alldata);
	//echo '</pre>';

	$commodityengArr = array();
	$centerengArr = array();
	//$commodityengArr[] = "";
	if(!empty($marketingprices_alldata))
    {
        foreach ($marketingprices_alldata as $alldataskey => $singlepricedata) {
            $commodityengArr[$singlepricedata['MarketingPrice']['commodityguj']] = $singlepricedata['MarketingPrice']['commodityeng'];
            $centerengArr[$singlepricedata['MarketingPrice']['centerguj']] = $singlepricedata['MarketingPrice']['centereng'];
        }
    }

	if($this->Session->read('search_key') != "") //&& $from_search
    {
       $search_key = $this->Session->read('search_key');
    }
    else
    {
       $search_key = "";
    }

    if($this->Session->read('search_commodityeng') != "") //&& $from_search
    {
       $selected_commodityeng = $this->Session->read('search_commodityeng');
    }
    else
    {
       $selected_commodityeng = "";
    }

    if($this->Session->read('search_centereng') != "") //&& $from_search
    {
       $selected_centereng = $this->Session->read('search_centereng');
    }
    else
    {
       $selected_centereng = "";
    }

    if($this->Session->read('search_date') != "") //&& $from_search
    {
       $search_date = $this->Session->read('search_date');
    }
    else
    {
       $search_date = date('Y-m-d');
    }

	echo $this->Form->create('marketingpriceSearch', array('url' => array('controller' => 'front', 'action' => 'marketing_app')));
    echo '<div class="search-bar row">';
    echo $this->Form->input('searchtitle', array('label'=>'Search Title', 'class' => 'form-control input-sm', 'value'=>$search_key, 'div' => array('class' => 'col-md-3')));
    ?>
    <div class="form-group col-md-3 padding-left-o">
        <label>Listing Date</label>
        <div class='input-group date' id='datetimepickersearch'>
            <input name="data[Pricelist][listing_date]" type='text' class="form-control" id="marketingpriceSearchListingDate" />
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {

            var selectedDate = new Date('<?=$search_date?>');
            $('#datetimepickersearch').datetimepicker({
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'YYYY-MM-DD', //HH:mm:ss
                defaultDate: selectedDate,
            });

            $('.btn-search-reset').click(function(){

                $('#marketingpriceSearchSearchtitle').val('');
                $('#marketingpriceSearchListingDate').val('<?=date('Y-m-d')?>');
                $('#marketingpriceSearchCommodityeng').val(0);
                $('#marketingpriceSearchCentereng').val(0);
                $('#marketingpriceSearchMarketingForm').submit();

            });
        });
    </script>
    <?php
    $options_commodityeng = array();
    $options_commodityeng[0] = "Select"; 
    //$selected_commodityeng = array();
    if(count($commodityengArr) > 0)
    {
        foreach ($commodityengArr as $come_key => $come_data) {
            $options_commodityeng[$come_data] = $come_data." (".$come_key.")";
        }
    }

    echo $this->Form->input('commodityeng', array('div' => array('class' => 'col-md-3'), 'label'=>'Commodity', /*'multiple' => true, */'class' => 'form-control', 'options' => $options_commodityeng, 'selected' => $selected_commodityeng));

    $options_centereng = array();
    $options_centereng[0] = "Select"; 
    //$selected_commodityeng = array();
    if(count($centerengArr) > 0)
    {
        foreach ($centerengArr as $cene_key => $cene_data) {
            $options_centereng[$cene_data] = $cene_data." (".$cene_key.")";
        }
    }

    echo $this->Form->input('centereng', array('div' => array('class' => 'col-md-3'), 'label'=>'Center', /*'multiple' => true, */'class' => 'form-control', 'options' => $options_centereng, 'selected' => $selected_centereng));
    echo '</div>';
    echo '<div class="row">';
    echo $this->Form->submit('Search', array('class' => 'btn btn-info', 'style' => 'float:left;', 'div'=> array('class' => 'col-md-1')));
    echo $this->Form->button('Reset', array('type'=>'button','class' => 'btn btn-primary btn-search-reset', 'div'=> array('class' => 'col-md-1')));
    echo '</div>';
    echo $this->Form->end();

	if(isset($marketingprices_data) && count($marketingprices_data)>0) 
    {
    ?>

    <div class="adv-table">

        <table class="display table table-bordered table-striped" id="dynamic-table">
            <thead>
                <tr>
                    <!-- <th width="5%"></th> -->
                    <!-- <th width="20%">Created Date</th> -->
                    <th width="20%">Commodity</th>
                    <th width="20%">Center</th>
                    <th width="10%">Arrival</th>
                    <th width="15%">Price</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if(isset($marketingprices_data) && count($marketingprices_data)>0) 
                {
                    for($i=0;$i<count($marketingprices_data);$i++)
                    {
                    ?>
                    <tr class="gradeA">
                        
                        <!-- <td>
                        	<input type="checkbox" name="marketingprices_checks[]" value ="<?php echo $marketingprices_data[$i]['MarketingPrice']['id']; ?>">
                        </td> -->
                        
                        <!-- <td class="align-center">
                        	<?php echo $marketingprices_data[$i]['MarketingPrice']['created']?>
                        </td> -->
                        
                        <td>
                            <div class="btn-group zn-listing-link">
                                <?php echo $marketingprices_data[$i]['MarketingPrice']['commodityeng']; ?>
                                <?php echo ' ('.$marketingprices_data[$i]['MarketingPrice']['commodityguj'].')'; ?>
                            </div>
                        </td>

                        <td>
                            <div class="btn-group zn-listing-link">
                                <?php echo $marketingprices_data[$i]['MarketingPrice']['centereng']; ?>
                                <?php echo ' ('.$marketingprices_data[$i]['MarketingPrice']['centerguj'].')'; ?>
                            </div>
                        </td>

                        <td>
                            <?php echo $marketingprices_data[$i]['MarketingPrice']['arrival']; ?>
                        </td>
                        <td>
                            <?php echo $marketingprices_data[$i]['MarketingPrice']['price']; ?>
                        </td>
                    </tr>
                    <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    
    <?php echo $this->Paginator->prev('« Previous', array('class' => 'btn btn-default'), null, 
        array('class' => 'disabled')); ?>
    <?php echo $this->Paginator->next('Next »', array('class' => 'btn btn-default'), null,
        array('class' => 'disabled')); ?> 
    <?php echo $this->Paginator->counter(); ?> 

    <?php
    }
    else
    {
        
        echo "<h1>No Records</h4>";
    }
    ?>

<?php
//echo $this->element('frontfooter');
?>