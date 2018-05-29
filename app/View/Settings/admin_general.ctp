<section id="container">
    <!--header start-->
    <?php echo $this->element('header'); ?>
    <!--header end-->

    <!--sidebar start-->
    <?php echo $this->element('sidebar'); ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    //print_r($_SESSION);
                    if(!empty($_SESSION['error_msg'])){
                        ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error_msg'];unset($_SESSION['error_msg']); ?>
                        </div>
                        <?php
                    }

                    if(!empty($_SESSION['warning_msg'])){
                        ?>
                        <div class="alert alert-warning" style="display: none;">
                            <?php
                            echo $_SESSION['warning_msg'];
                            unset($_SESSION['warning_msg']);
                            ?>
                        </div>
                        <?php
                    }

                    if(!empty($_SESSION['success_msg'])){
                        ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success_msg'];unset($_SESSION['success_msg']); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <section class="panel">
                        <div class="panel-body">
                            <h4><?php echo $page_heading; ?></h4>
                            <p></p>

                            <div class="position-center">
                                <?php
                                $curSymbol = "£";
                                ?>
                                <form action="<?=DEFAULT_ADMINURL?>settings/general" method="post" name="general_settings" id="general_settings">
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Your Facebook Page</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('Settings.key.facebook', array('id' => 'facebook', 'value'=>$settings_data['Setting']['key']['facebook'], 'placeholder' => 'http://www.facebook.com/yourbusinessname','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Your Twitter Page</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('Settings.key.twitter', array('id' => 'twitter', 'value'=>$settings_data['Setting']['key']['twitter'], 'placeholder' => 'http://www.twitter.com/yourbusinessname','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Your Youtube Channel</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('Settings.key.youtube', array('id' => 'youtube', 'value'=>$settings_data['Setting']['key']['youtube'], 'placeholder' => 'http://www.youtube.com/yourbusinessname','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Your Google Page</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('Settings.key.google', array('id' => 'google', 'value'=>$settings_data['Setting']['key']['google'], 'placeholder' => 'http://www.google.com/yourbusinessname','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <input class="btn btn-info" type="submit" name="btn_repricing" id="btn_repricing" value="Submit" />
                                </form>
                            </div>


                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
    <!--main content end-->
    <?php echo $this->element('footer'); ?>
</section>