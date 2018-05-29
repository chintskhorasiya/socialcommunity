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
                            <header class="panel-heading btn-primary">Edit Committeemember</header>
                            <div class="panel-body">
                                <div class="position-center">
                                    <?php
                                    echo $this->Form->create('Committeemembers', array('novalidate', 'type'=>'file'));

                                    $all_categories = $committeemembers_data['Committeemembers']['all_categories'];
                                    $options = array();
                                    
                                    $selectedCategories=$committeemembers_data['Committeemembers']['categories'];
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
                                    
                                    echo $this->Form->input('title', array('class' => 'form-control input-lg', 'value' => $committeemembers_data['Committeemembers']['title']));

                                    echo $this->Form->input('slug', array('class' => 'form-control input-lg', 'value' => $committeemembers_data['Committeemembers']['slug']));
                                    
                                    //echo $this->Form->input('content', array('rows' => '10', 'class' => 'form-control input-lg'));

                                    echo $this->Tinymce->input('Committeemembers.content', array(
                                                'label' => 'Content',
                                                'class' => 'tinymce-textarea form-control input-lg', 'value' => $committeemembers_data['Committeemembers']['content']
                                                ),array(
                                                        'language'=>'en'
                                                ),
                                                'bbcode'
                                    );

                                    echo '<label>Images</label>';
                                    echo $this->Form->input('images.', array('type' => 'file', 'multiple'));

                                    $add_images = $committeemembers_data['Committeemembers']['images'];

                                    if(!empty($add_images))
                                    {   
                                        echo '<div class="form-group col-md-12 padding-left-o">';
                                        echo '<div class="col-md-2"><label>Images selected when add:<label></div>';

                                        $add_images = explode(',', $add_images);

                                        echo '<div class="col-md-10">';
                                        
                                        foreach ($add_images as $add_img_num => $add_img) {
                                            echo '<div class="col-md-2 add_image_div">';
                                            echo '<img src="'.DEFAULT_PRODUCTS_IMAGE_URL.$committeemembers_data['Committeemembers']['id'].'/thumb_'.$add_img.'" width="50" height="50" />&nbsp;&nbsp;&nbsp;';
                                            echo '<input type="hidden" name="data[Committeemembers][add_image][]" value="'.$add_img.'" />';
                                            echo '<input type="button" class="remove-img btn-small btn-info" value="Remove">';
                                            echo '</div>';
                                        }

                                        echo '</div>';

                                        echo '</div>';                                        
                                    }

                                    //var_dump($committeemembers_data['Committeemembers']['status']);exit;
                                    ?>
                                    <div class="form-group col-md-12 padding-left-o">
                                        <label>Videos</label>
                                        <p>(e.g. https://www.youtube.com/watch?v=n0hvKL6V3AI OR http://youtu.be/-wtIMTCHWuI etc)</p>
                                        <?php
                                        $add_videos = $committeemembers_data['Committeemembers']['videos'];
                                        if(!empty($add_videos))
                                        {   
                                            $add_videos = explode(',', $add_videos);
                                            foreach ($add_videos as $add_vid_num => $add_vid) {
                                                echo '<div class="col-md-12 you-video-area">';
                                                echo '<input type="text" name="data[Committeemembers][videos][]" class="form-control" value="'.$add_vid.'" placeholder="Paste Video URL here" />';
                                                echo '<input type="button" class="remove-video-btn btn btn-info" value="Remove">';
                                                echo '</div>';
                                            }
                                        }
                                        ?>
                                        <div class="col-md-12 you-video-area">
                                            <input type="text" name="data[Committeemembers][videos][]" class="form-control" value="" placeholder="Paste Video URL here" />
                                            <input type="button" class="remove-video-btn btn btn-info" value="Remove">
                                        </div>
                                        <input type="button" class="add-video-btn btn btn-info" value="Add More">
                                    </div>

                                    <div class="form-group col-md-12 padding-left-o">
                                        <label>Status</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Committeemembers][status]" class="form-control-radio" value="1" <?php if($committeemembers_data['Committeemembers']['status'] == "1"){ echo 'checked="checked"'; } ?> />Published
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Committeemembers][status]" class="form-control-radio" value="0" <?php if($committeemembers_data['Committeemembers']['status'] == "0"){ echo 'checked="checked"'; } ?> />Draft
                                            </label>
                                        </div>
                                    </div>

                                    <h5>SEO Details</h5>
                                    <hr>
                                    <?php
                                    echo $this->Form->input('seo_title', array('label'=>'SEO Title','value'=>$committeemembers_data['Committeemembers']['seo_title'],'type'=>'text', 'class' => 'form-control input-lg'));
                                    ?>
                                    <?php
                                    echo $this->Form->input('seo_desc', array('label'=>'SEO Description','value'=>$committeemembers_data['Committeemembers']['seo_desc'],'class' => 'form-control input-lg'));
                                    ?>
                                    <?php
                                    echo $this->Form->input('seo_keywords', array('label'=>'SEO Keywords','value'=>$committeemembers_data['Committeemembers']['seo_keywords'],'class' => 'form-control input-lg'));
                                    ?>
                                    <hr>

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
        <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.remove-img').click(function(){
                console.log(jQuery(this).parent());
                jQuery(this).parent().remove();
            })
        });
        jQuery('.add-video-btn').click(function(){
            //console.log(jQuery(this).parent());
            jQuery(this).before('<div class="col-md-12 you-video-area"><input type="text" name="data[Committeemembers][videos][]" class="form-control" value="" placeholder="Paste Video URL here" /><input type="button" class="remove-video-btn btn btn-info" value="Remove"></div>');
        })
        jQuery(function(){
            jQuery('body').on('click', '.remove-video-btn', function () {
                jQuery(this).parent().remove();
            });
        });
        </script>
    <!--main content end-->
    <?php echo $this->element('footer'); ?>
</section>