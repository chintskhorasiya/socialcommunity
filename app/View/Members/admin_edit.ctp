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
                            <header class="panel-heading btn-primary">Edit Committee Member</header>
                            <div class="panel-body">
                                <div class="position-center">
                                    <?php
                                    echo $this->Form->create('Committeemember', array('novalidate', 'type'=>'file'));

                                    $all_categories = $committeemembers_data['Committeemember']['all_categories'];
                                    $options = array();
                                    
                                    $selectedCategories=$committeemembers_data['Committeemember']['categories'];
                                    $selectedCategories = explode(',', $selectedCategories);
                                    if(count($selectedCategories) > 0){
                                        $selected = $selectedCategories;
                                    } else {
                                        $selected = array();    
                                    }
                                    //var_dump($selected);
                                    
                                    if(count($all_categories) > 0)
                                    {
                                        //echo '<div class="form-group">';
                                        //echo '<label for="sel1">Select Categories</label>';
                                        //echo '<select name="data[Committeemembers][categories][]" class="form-control" id="" multiple>';
                                        foreach ($all_categories as $alcat_key => $alcat_data) {
                                            $options[$alcat_data['CommitteemembersCategory']['id']] = $alcat_data['CommitteemembersCategory']['name'];
                                            //echo '<option value="'.$alcat_data['CommitteemembersCategory']['id'].'">'.$alcat_data['CommitteemembersCategory']['name'].'</option>';
                                        }
                                        //echo '</select>';
                                        //echo '</div>';

                                        echo $this->Form->input('categories', array('multiple' => true, 'class' => 'form-control', 'options' => $options, 'selected' => $selected));
                                    }
                                    
                                    echo $this->Form->input('name', array('class' => 'form-control input-lg', 'value' => $committeemembers_data['Committeemember']['name']));

                                    echo $this->Form->input('source', array('type' => 'file', 'label'=>'Image'));

                                    $add_images = $committeemembers_data['Committeemember']['source'];

                                    if(!empty($add_images))
                                    {   
                                        echo '<div class="form-group col-md-12 padding-left-o">';
                                        echo '<div class="col-md-2"><label>Current Image:<label></div>';

                                        $add_images = explode(',', $add_images);

                                        echo '<div class="col-md-10">';
                                        
                                        foreach ($add_images as $add_img_num => $add_img) {
                                            echo '<div class="col-md-2 add_image_div">';
                                            echo '<img src="'.DEFAULT_COMMITTEEMEMBER_IMAGE_URL.'thumb_'.$add_img.'" width="100" height="100" />&nbsp;&nbsp;&nbsp;';
                                            echo '<input type="hidden" name="data[Committeemember][add_image][]" value="'.$add_img.'" />';
                                            //echo '<input type="button" class="remove-img btn-small btn-info" value="Remove">';
                                            echo '</div>';
                                        }

                                        echo '</div>';

                                        echo '</div>';                                        
                                    }

                                    echo $this->Form->input('area', array('value' => $committeemembers_data['Committeemember']['area'], 'class' => 'form-control input-lg'));
                                    echo $this->Form->input('city', array('value' => $committeemembers_data['Committeemember']['city'], 'class' => 'form-control input-lg'));
                                    echo $this->Form->input('phone', array('value' => $committeemembers_data['Committeemember']['phone'], 'class' => 'form-control input-lg'));

                                    echo $this->Form->input('details', array('label' => 'Details','class' => 'form-control input-lg', 'value' => $committeemembers_data['Committeemember']['details']));

                                    ?>
                                    <div class="form-group col-md-12 padding-left-o">
                                        <label>Status</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Committeemember][status]" class="form-control-radio" value="1" <?php if($committeemembers_data['Committeemember']['status'] == "1"){ echo 'checked="checked"'; } ?> />Published
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Committeemember][status]" class="form-control-radio" value="0" <?php if($committeemembers_data['Committeemember']['status'] == "0"){ echo 'checked="checked"'; } ?> />Draft
                                            </label>
                                        </div>
                                    </div>
                                    <div class="submit-area">
                                    <?php
                                    echo $this->Form->submit('Submit', array('class' => 'btn btn-info'));
                                    
                                    echo $this->Html->link('Cancel', DEFAULT_ADMINURL.'committeemembers/lists', array('class' => 'btn btn-info'));
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