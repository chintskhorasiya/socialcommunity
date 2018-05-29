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
                        <section class="panel  border-o">
                            <header class="panel-heading btn-primary">Edit Donor</header>
                            <div class="panel-body">
                                <div class="position-center">
                                    <?php
                                    echo $this->Form->create('Donation', array('novalidate', 'type'=>'file'));

                                    echo $this->Form->input('name', array('class' => 'form-control input-lg', 'value' => $donations_data['Donation']['name']));

                                    echo $this->Form->input('propic', array('type' => 'file', 'label'=>'Image'));

                                    $add_images = $donations_data['Donation']['propic'];

                                    if(!empty($add_images))
                                    {   
                                        echo '<div class="form-group col-md-12 padding-left-o">';
                                        echo '<div class="col-md-2"><label>Current Image:<label></div>';

                                        $add_images = explode(',', $add_images);

                                        echo '<div class="col-md-10">';
                                        
                                        foreach ($add_images as $add_img_num => $add_img) {
                                            echo '<div class="col-md-2 add_image_div">';
                                            echo '<img src="'.DEFAULT_DONATION_IMAGE_URL.'thumb_'.$add_img.'" width="100" height="100" />&nbsp;&nbsp;&nbsp;';
                                            echo '<input type="hidden" name="data[Donation][add_image][]" value="'.$add_img.'" />';
                                            //echo '<input type="button" class="remove-img btn-small btn-info" value="Remove">';
                                            echo '</div>';
                                        }

                                        echo '</div>';

                                        echo '</div>';                                        
                                    }

                                    echo $this->Form->input('address', array('value' => $donations_data['Donation']['address'], 'class' => 'form-control input-lg'));
                                    echo $this->Form->input('phone', array('value' => $donations_data['Donation']['phone'], 'class' => 'form-control input-lg'));

                                    echo $this->Form->input('amount', array('label' => 'Details','class' => 'form-control input-lg', 'value' => $donations_data['Donation']['amount']));

                                    ?>
                                    <div class="form-group col-md-12 padding-left-o">
                                        <label>Status</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Donation][status]" class="form-control-radio" value="1" <?php if($donations_data['Donation']['status'] == "1"){ echo 'checked="checked"'; } ?> />Published
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Donation][status]" class="form-control-radio" value="0" <?php if($donations_data['Donation']['status'] == "0"){ echo 'checked="checked"'; } ?> />Draft
                                            </label>
                                        </div>
                                    </div>
                                    <div class="submit-area">
                                    <?php
                                    echo $this->Form->submit('Submit', array('class' => 'btn btn-info'));
                                    
                                    echo $this->Html->link('Cancel', DEFAULT_ADMINURL.'donations/lists', array('class' => 'btn btn-info'));
                                    ?>
                                    </div>
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