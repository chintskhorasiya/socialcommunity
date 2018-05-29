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
                                <form action="<?=DEFAULT_ADMINURL?>contacts/edit" method="post" name="contacts_edit" id="contacts_edit">
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Address</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->textarea('address', array('id' => 'address', 'value'=>$contacts_data['Contact']['address'], 'placeholder' => 'Enter your address here','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Phone</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('phone', array('id' => 'address', 'value'=>$contacts_data['Contact']['phone'], 'placeholder' => 'Enter your address here','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Mobile No</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('mobile', array('id' => 'address', 'value'=>$contacts_data['Contact']['mobile'], 'placeholder' => 'Enter your mobile here','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('email', array('id' => 'address', 'value'=>$contacts_data['Contact']['email'], 'placeholder' => 'Enter your email here','class' => 'form-control','style'=>'width:95%;'))); ?>
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