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
                            <header class="panel-heading btn-primary">Add Member</header>
                            <div class="panel-body">
                                <div class="position-center">
                                    <?php
                                    echo $this->Form->create('Committeemember', array('novalidate', 'type'=>'file'));

                                    $all_categories = $committeemembers_data['Committeemember']['all_categories'];
                                    $options = array();
                                    $selected = array();
                                    if(count($all_categories) > 0)
                                    {
                                        //echo '<div class="form-group">';
                                        //echo '<label for="sel1">Select Categories</label>';
                                        //echo '<select name="data[Committeemember][categories][]" class="form-control" id="" multiple>';
                                        foreach ($all_categories as $alcat_key => $alcat_data) {
                                            $options[$alcat_data['CommitteemembersCategory']['id']] = $alcat_data['CommitteemembersCategory']['name'];
                                            //echo '<option value="'.$alcat_data['CommitteememberCategory']['id'].'">'.$alcat_data['CommitteememberCategory']['name'].'</option>';
                                        }
                                        //echo '</select>';
                                        //echo '</div>';

                                        echo $this->Form->input('categories', array('multiple' => true, 'class' => 'form-control', 'options' => $options, 'selected' => $selected));
                                    }

                                    
                                    echo $this->Form->input('name', array('class' => 'form-control input-lg'));

                                    echo $this->Form->input('source', array('type' => 'file', 'label'=>'Image'));

                                    echo $this->Form->input('area', array('class' => 'form-control input-lg'));
                                    echo $this->Form->input('city', array('class' => 'form-control input-lg'));
                                    echo $this->Form->input('phone', array('class' => 'form-control input-lg'));

                                    echo $this->Form->input('details', array('label' => 'Details','class' => 'form-control input-lg'));

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