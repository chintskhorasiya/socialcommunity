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
                                <form action="<?=DEFAULT_ADMINURL?>donationdetails/edit" method="post" name="donationdetails_edit" id="donationdetails_edit">
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Beneficiary Name</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('beneficiary_name', array('value'=>$donationdetails_data['Donationdetail']['beneficiary_name'], 'placeholder' => 'Beneficiary Name','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label> Bank Name</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('bank_name', array('value'=>$donationdetails_data['Donationdetail']['bank_name'], 'placeholder' => 'Bank Name','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Branch</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('branch', array('value'=>$donationdetails_data['Donationdetail']['branch'], 'placeholder' => 'Branch','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>Current account No.</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('current_account_no', array('value'=>$donationdetails_data['Donationdetail']['current_account_no'], 'placeholder' => 'Current account No.','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>RTGS/NEFT IFSC</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('ifsc', array('value'=>$donationdetails_data['Donationdetail']['ifsc'], 'placeholder' => 'RTGS/NEFT IFSC','class' => 'form-control','style'=>'width:95%;'))); ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="form-group col-md-6 padding-left-o">
                                        <label>MICR CODE</label>
                                        <div class="input-group">
                                            <?php echo ($this->Form->text('micr_code', array('value'=>$donationdetails_data['Donationdetail']['micr_code'], 'placeholder' => 'MICR CODE','class' => 'form-control','style'=>'width:95%;'))); ?>
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