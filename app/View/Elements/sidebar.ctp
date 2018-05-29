<!--sidebar start-->
<aside>
    <nav>
        <div id="sidebar" class="nav-collapse">
            <div class="leftside-navigation">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav">
                    <a id="active" class="active" href="<?php echo DEFAULT_ADMINURL ?>users/dashboard">
                        <li class="desh">
                            <i class="fa fa-dashboard"></i>&nbsp;&nbsp;<span>Dashboard</span>
                        </li>
                    </a>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Home Modules</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>homemodules/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Home Modules</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Banners</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>banners/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Banners</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>banners/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Banner</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Pages</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>pages/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Pages</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>pages/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Page</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>News & Events</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>newsevents/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View News & Events</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>newsevents/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add News & Event</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Advertisements</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>advertises/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Advertisements</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>advertises/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Advertisement</a>
                            </li>
                        </ul>   
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Gallery Images</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>galleryimages/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Gallery Images</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>galleryimages/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Gallery Image</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Committee Members</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>committeemembers/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Committee Members</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>committeemembers/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Committee Member</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Donors</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>donations/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Donors</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>donations/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Donor</a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Clients</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>clients/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Clients</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>clients/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Client</a>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="sub-menu">
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Blogs</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>blogs/lists/<?php echo $encrypt_id;?>"><i class="fa fa-eye"></i>View Blogs</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL ?>blogs/add/<?php echo $encrypt_id;?>"><i class="fa fa-plus"></i>Add Blog</a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="sub-menu">
                         <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i><span>Settings</span>
                        </a>
                        <ul class="sub">
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL.'settings/general' ?>"><i class=" fa fa-wrench"></i>General</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL.'contacts/edit' ?>"><i class=" fa fa-envelope"></i>Contact Details</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL.'donationdetails/edit' ?>"><i class=" fa fa-bank"></i>Donation Details</a>
                            </li>
                            <li>
                                <a href="<?php echo DEFAULT_ADMINURL.'users/change_password' ?>"><i class=" fa fa-suitcase"></i>Change Password</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- sidebar menu end-->
        </div>
    </nav>
</aside>
<!--sidebar end-->