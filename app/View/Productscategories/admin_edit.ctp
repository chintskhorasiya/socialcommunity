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
                            <header class="panel-heading btn-primary">Edit Category</header>
                            <div class="panel-body">
                                <div class="position-center">
                                    <?php
                                    echo $this->Form->create('ProductsCategory', array('novalidate','type'=>'file'));
                                    
                                    echo $this->Form->input('name', array('class' => 'form-control input-lg', 'label'=>'Category Name', 'value' => $category_data['ProductsCategory']['name']));

                                    echo $this->Form->input('slug', array('class' => 'form-control input-lg', 'value' => $category_data['ProductsCategory']['slug']));

                                    $selected = $category_data['ProductsCategory']['parent'];

                                    echo $this->Form->input('parent', array('label'=>'Parent Category','class' => 'form-control', 'options' => $parent_categories, 'selected' => $selected));

                                    echo $this->Form->input('image', array('type' => 'file'));

                                    $add_images = $category_data['ProductsCategory']['image'];

                                    if(!empty($add_images))
                                    {   
                                        echo '<div class="form-group col-md-12 padding-left-o">';
                                        echo '<div class="col-md-2"><label>Selected Image:<label></div>';

                                        $add_images = explode(',', $add_images);

                                        echo '<div class="col-md-10">';
                                        
                                        foreach ($add_images as $add_img_num => $add_img) {
                                            echo '<div class="col-md-2 add_image_div">';
                                            echo '<img src="'.DEFAULT_CATEGORY_IMAGE_URL.'thumb_'.$add_img.'" width="50" height="50" />&nbsp;&nbsp;&nbsp;';
                                            echo '<input type="hidden" name="data[ProductsCategory][add_image]" value="'.$add_img.'" />';
                                            echo '</div>';
                                        }

                                        echo '</div>';

                                        echo '</div>';                                        
                                    }
                                    
                                    //var_dump($category_data['ProductsCategory']['status']);exit;
                                    ?>
                                    <div class="form-group col-md-12 padding-left-o">
                                        <label>Status</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[ProductsCategory][status]" class="form-control-radio" value="1" <?php if($category_data['ProductsCategory']['status'] == "1"){ echo 'checked="checked"'; } ?> />Published
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[ProductsCategory][status]" class="form-control-radio" value="0" <?php if($category_data['ProductsCategory']['status'] == "0"){ echo 'checked="checked"'; } ?> />Draft
                                            </label>
                                        </div>
                                    </div>
                                    <div class="submit-area">
                                    <?php
                                    echo $this->Form->submit('Submit', array('class' => 'btn btn-info'));

                                    echo $this->Html->link('Cancel', DEFAULT_ADMINURL.'productscategories/lists', array('class' => 'btn btn-info'));
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