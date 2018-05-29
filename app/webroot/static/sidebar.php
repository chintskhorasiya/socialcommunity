<!--sidebar start-->
<?php
define("SITE_FOLDER","seven/dropshipping");
define("DEFAULT_URL","http://".$_SERVER["HTTP_HOST"]."/".SITE_FOLDER."/");
define("STATIC_PAGE_URL","http://".$_SERVER["HTTP_HOST"]."/".SITE_FOLDER."/static/");

?>
<aside>
    <nav>
        <div id="sidebar" class="nav-collapse">
            <div class="leftside-navigation">
                <!-- sidebar menu start-->

                <ul class="sidebar-menu" id="nav">
                    <a id="active" class="active" href="<?php echo DEFAULT_URL ?>users/dashboard">
                        <li class="desh"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </li>
                    </a>

                    <li class="sub-menu"> <a href="javascript:void(0);"> <i class="fa fa-tags"></i> <span>Stores</span> </a>
                        <ul class="sub">
                            <li><a href="<?php echo DEFAULT_URL ?>stores/store_setting/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>Store Setting</a></li>
                            <li><a href="<?php echo DEFAULT_URL ?>stores/store_stat/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>Store Stat</a></li>
                            <li><a href="<?php echo DEFAULT_URL ?>stores/store_add"><i class="fa fa-plus-circle"></i>Add Store</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu"> <a href="javascript:void(0);"> <i class="fa fa-tags"></i> <span>Add Source</span> </a>
                        <ul class="sub">
                            <li><a href="<?php echo DEFAULT_URL ?>sources/source_settings/type:amazon-us/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>Amazon US</a></li>
                            <li><a href="<?php echo DEFAULT_URL ?>sources/source_settings/type:amazon-uk/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>Amazon UK</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu"> <a href="javascript:void(0);"> <i class="fa fa-tags"></i> <span>Create Listings</span> </a>
                        <ul class="sub">
                            <li><a href="<?php echo DEFAULT_URL ?>listings/create_listing/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>Create Listings</a></li>
                            <li><a href="<?php echo DEFAULT_URL ?>listings/listing_requests/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>Listing Requests</a></li>
                            <li><a href="<?php echo DEFAULT_URL ?>listings/listing_settings/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>Listing Settings</a></li>
                        </ul>
                    </li>

                    <?php /* */ ?>
                    <li class="sub-menu"> <a href="javascript:void(0);"> <i class="fa fa-tags"></i> <span>Listing Settings</span> </a>
                        <ul class="sub">
                            <li><a href="<?php echo STATIC_PAGE_URL ?>edit-lister-template.php"><i class="fa fa-eye"></i>Listing Template</a></li>
                            <li><a href="<?php echo STATIC_PAGE_URL ?>manage-listing-blacklists.php"><i class="fa fa-eye"></i>Manage Listing Blacklists</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu"> <a href="javascript:void(0);"> <i class="fa fa-tags"></i> <span>Current Listings</span> </a>
                        <ul class="sub">
                            <li><a href="<?php echo STATIC_PAGE_URL ?>all-listings.php"><i class="fa fa-eye"></i>All Listings</a></li>
                            <li><a href="<?php echo STATIC_PAGE_URL ?>listings-performance.php"><i class="fa fa-eye"></i>Listings Performance</a></li>
                            <li><a href="<?php echo STATIC_PAGE_URL ?>recent-listing-revisions.php"><i class="fa fa-eye"></i>Recent Listing Revisions</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu"> <a href="#"> <i class="fa fa-tags"></i> <span>Source Settings</span> </a>
                        <ul class="sub">
                            <li><a href="<?php echo STATIC_PAGE_URL ?>repricing-settings.php"><i class="fa fa-eye"></i>Repricing Settings</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu"> <a href="#"> <i class="fa fa-tags"></i> <span>Orders</span> </a>
                        <ul class="sub">
                            <li><a href="<?php echo STATIC_PAGE_URL ?>orders-report.php"><i class="fa fa-eye"></i>Orders Report</a></li>
                            <li><a href="<?php echo STATIC_PAGE_URL ?>auto-ordering-settings.php"><i class="fa fa-eye"></i>Auto Ordering Settings</a></li>
                        </ul>
                    </li>

                    <li class="sub-menu"> <a href="#"> <i class="fa fa-tags"></i> <span>Troubleshoot</span> </a>
                        <ul class="sub">
                            <li><a href="#"><i class="fa fa-eye"></i>Tag Listings</a></li>
                            <li><a href="<?php echo STATIC_PAGE_URL ?>duplicate-listings.php"><i class="fa fa-eye"></i>Duplicate Listings</a></li>
                            <li><a href="<?php echo STATIC_PAGE_URL ?>manual-track.php"><i class="fa fa-eye"></i>Manual track with CSV file</a></li>
                        </ul>
                    </li>
                    <?php /* */ ?>
                </ul>
            </div>
            <!-- sidebar menu end-->
        </div>
    </nav>
</aside>
<!--sidebar end-->