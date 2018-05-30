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
                            <header class="panel-heading btn-primary">Edit Member</header>
                            <div class="panel-body">
                                <div class="position-center">
                                    <?php
                                    echo $this->Form->create('Member', array('novalidate', 'type'=>'file'));

                                    /*$all_categories = $members_data['Member']['all_categories'];
                                    $options = array();
                                    
                                    $selectedCategories=$members_data['Member']['categories'];
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
                                        //echo '<select name="data[Members][categories][]" class="form-control" id="" multiple>';
                                        foreach ($all_categories as $alcat_key => $alcat_data) {
                                            $options[$alcat_data['MembersCategory']['id']] = $alcat_data['MembersCategory']['name'];
                                            //echo '<option value="'.$alcat_data['MembersCategory']['id'].'">'.$alcat_data['MembersCategory']['name'].'</option>';
                                        }
                                        //echo '</select>';
                                        //echo '</div>';

                                        echo $this->Form->input('categories', array('multiple' => true, 'class' => 'form-control', 'options' => $options, 'selected' => $selected));
                                    }*/
                                    
                                    echo $this->Form->input('first_name', array('div'=>'col-md-4', 'class' => 'form-control input-lg', 'value' => $members_data['Member']['first_name']));
                                    echo $this->Form->input('middle_name', array('div'=>'col-md-4','class' => 'form-control input-lg', 'value' => $members_data['Member']['middle_name']));
                                    echo $this->Form->input('last_name', array('div'=>'col-md-4','class' => 'form-control input-lg', 'value' => $members_data['Member']['last_name']));

                                    echo $this->Form->input('relation', array('class' => 'form-control input-lg', 'div' => 'col-md-4', 'selected' => $members_data['Member']['relation'], 'options' => $relations, 'empty' => array('' => 'Select')));
                                    
                                    //echo $this->Form->input('dob', array('class' => 'form-control input-lg', 'label'=>'Date Of Birth', 'div' => 'col-md-6'));
                                    ?>
                                    <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>DOB</label>
                                            <div class='input-group date' id='datetimepicker6'>
                                                <input name="data[Member][dob]" type='text' class="form-control" />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                        echo $this->Form->input('age', array('class' => 'form-control input-lg', 'div' => 'col-md-6', 'value' => $members_data['Member']['age']));

                                    ?>
                                    </div>
                                    </div>
                                    <?php

                                    echo $this->Form->input('birth_place', array('class' => 'form-control input-lg', 'div' => 'col-md-4', 'value' => $members_data['Member']['birth_place']));
                                    echo $this->Form->input('gender', array('class' => 'form-control input-lg', 'div' => 'col-md-4', 'selected' => $members_data['Member']['gender'], 'options' => array(''=> 'Select', 1=>'Male', 2=>'Female')));
                                    echo $this->Form->input('marital_status', array('class' => 'form-control input-lg', 'div' => 'col-md-4', 'selected' => $members_data['Member']['marital_status'], 'options' => array(''=>'Select', 1=>'Married', 2=>'Unmarried', 4=>'Widow')));

                                    echo $this->Form->input('native', array('class' => 'form-control input-lg', 'div' => 'col-md-6', 'value' => $members_data['Member']['native']));
                                    echo $this->Form->input('gotra', array('class' => 'form-control input-lg', 'div' => 'col-md-6', 'selected' => $members_data['Member']['gotra'], 'options' => $gotras, 'empty' => array('' => 'Select')));
                                    
                                    echo $this->Form->input('education', array('class' => 'form-control input-lg', 'div' => 'col-md-6', 'value' => $members_data['Member']['education']));
                                    echo $this->Form->input('blood_group', array('class' => 'form-control input-lg', 'div' => 'col-md-6', 'selected' => $members_data['Member']['blood_group'], 'options' => array('B+','B-','A+','A-','AB+','AB-','O+','O-'), 'empty' => array('' => 'Select')));

                                    echo $this->Form->input('proffession', array('class' => 'form-control input-lg', 'div' => 'col-md-12', 'selected' => $members_data['Member']['proffession'], 'options' => $proffessions, 'empty' => array('' => 'Select')));
                                    echo $this->Form->input('proffession_details', array('type' => 'textarea','class' => 'form-control', 'div' => 'col-md-12', 'value' => $members_data['Member']['proffession_details']));

                                    echo $this->Form->input('phone', array('class' => 'form-control input-lg', 'div' => 'col-md-6', 'value' => $members_data['Member']['phone']));
                                    echo $this->Form->input('mobile', array('class' => 'form-control input-lg', 'div' => 'col-md-6', 'value' => $members_data['Member']['mobile']));

                                    /*echo $this->Form->input('photo', array('type'=>'file','class' => 'form-control input-lg', 'div' => 'col-md-6'));
                                    echo $this->Form->input('doc', array('type'=>'file', 'label' => 'Document', 'accept'=>"application/pdf,application/msword", 'class' => 'form-control input-lg', 'div' => 'col-md-6'));*/

                                    echo $this->Form->input('address', array('type' => 'textarea','class' => 'form-control', 'div' => 'col-md-12', 'value' => $members_data['Member']['address']));
                                    echo $this->Form->input('country', array('class' => 'form-control input-lg', 'div' => 'col-md-4', 'selected' => $members_data['Member']['country'], 'options' => $countries, 'empty' => array('' => 'Select')));
                                    echo $this->Form->input('state', array('class' => 'form-control input-lg', 'div' => 'col-md-4' , 'selected' => $members_data['Member']['state'] , 'options' => $states, 'empty' => array('' => 'Select')));
                                    echo $this->Form->input('city', array('class' => 'form-control input-lg', 'div' => 'col-md-4', 'selected' => $members_data['Member']['city'], 'options' => $cities, 'empty' => array('' => 'Select')));
                                    
                                    echo $this->Form->input('area', array('class' => 'form-control', 'div' => 'col-md-4', 'value' => $members_data['Member']['area']));
                                    echo $this->Form->input('hobbies', array('class' => 'form-control', 'div' => 'col-md-4', 'value' => $members_data['Member']['hobbies']));
                                    echo $this->Form->input('relative_member_no', array('class' => 'form-control', 'div' => 'col-md-4', 'value' => $members_data['Member']['relative_member_no']));

                                    /*echo $this->Form->input('source', array('type' => 'file', 'label'=>'Image'));

                                    $add_images = $members_data['Member']['source'];

                                    if(!empty($add_images))
                                    {   
                                        echo '<div class="form-group col-md-12 padding-left-o">';
                                        echo '<div class="col-md-2"><label>Current Image:<label></div>';

                                        $add_images = explode(',', $add_images);

                                        echo '<div class="col-md-10">';
                                        
                                        foreach ($add_images as $add_img_num => $add_img) {
                                            echo '<div class="col-md-2 add_image_div">';
                                            echo '<img src="'.DEFAULT_COMMITTEEMEMBER_IMAGE_URL.'thumb_'.$add_img.'" width="100" height="100" />&nbsp;&nbsp;&nbsp;';
                                            echo '<input type="hidden" name="data[Member][add_image][]" value="'.$add_img.'" />';
                                            //echo '<input type="button" class="remove-img btn-lgall btn-info" value="Remove">';
                                            echo '</div>';
                                        }

                                        echo '</div>';

                                        echo '</div>';                                        
                                    }

                                    echo $this->Form->input('area', array('value' => $members_data['Member']['area'], 'class' => 'form-control input-lg'));
                                    echo $this->Form->input('city', array('value' => $members_data['Member']['city'], 'class' => 'form-control input-lg'));
                                    echo $this->Form->input('phone', array('value' => $members_data['Member']['phone'], 'class' => 'form-control input-lg'));

                                    echo $this->Form->input('details', array('label' => 'Details','class' => 'form-control input-lg', 'value' => $members_data['Member']['details']));
                                    */

                                    /*?>
                                    <div class="form-group col-md-12 padding-left-o">
                                        <label>Status</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Member][status]" class="form-control-radio" value="1" <?php if($members_data['Member']['status'] == "1"){ echo 'checked="checked"'; } ?> />Published
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data[Member][status]" class="form-control-radio" value="0" <?php if($members_data['Member']['status'] == "0"){ echo 'checked="checked"'; } ?> />Draft
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    */
                                    ?>
                                    <div class="submit-area col-md-12">
                                    <?php 
                                    echo $this->Form->submit('Submit', array('class' => 'btn btn-info'));
                                    
                                    echo $this->Html->link('Cancel', DEFAULT_ADMINURL.'members/lists', array('class' => 'btn btn-info'));
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
    <?php
    $today_date = date('Y-m-d');
    $selected_date = $members_data['Member']['dob'];
    if(!empty($selected_date)) {
        $default_date = $selected_date;
    } else {
        $default_date = $today_date;
    }
    $min_date = '1900-01-01';
    $max_date = date('Y-m-d');
    ?>
    <script type="text/javascript">
        $(function () {

            var todayDate = new Date('<?=$today_date?>');
            var defaultDate = new Date('<?=$default_date?>');
            
            $('#datetimepicker6').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-arrow-up",
                    down: "fa fa-arrow-down"
                },
                format: 'YYYY-MM-DD',
                defaultDate: defaultDate,
                minDate: new Date('<?=$min_date?>'),
                maxDate: new Date('<?=$max_date?>'),
            });

            $("#datetimepicker6").on("dp.change", function (e) {
                //$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
                console.log(e.date);
                var dob = e.date
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                console.log(age+' years old');
                $("#MemberAge").val(age);
            });

        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            //alert("fgdfgfghfgh");
            jQuery('#MemberCountry').change(function(){
                console.log(jQuery(this).val());
                var country = jQuery(this).val();

                var postData = {
                    "country_id":country
                };

                $.ajax({
                    url: "<?=DEFAULT_URL?>get-states",
                    type: "POST",
                    data: {myData:postData},
                    success: function(data)
                     {
                      //alert(data);
                      jQuery('#MemberState').html(data);
                     },
                });

            });

            jQuery('#MemberState').change(function(){
                console.log(jQuery(this).val());
                var state = jQuery(this).val();

                var postData = {
                    "state_id":state
                };

                $.ajax({
                    url: "<?=DEFAULT_URL?>get-cities",
                    type: "POST",
                    data: {myData:postData},
                    success: function(data)
                     {
                      //alert(data);
                      jQuery('#MemberCity').html(data);
                     },
                });

            });
        });
    </script>
    <?php echo $this->element('footer'); ?>
</section>