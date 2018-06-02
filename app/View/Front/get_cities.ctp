<?php
if(!empty($this->Session->read('front_member_directory_city'))) {
	$selectedCity = $this->Session->read('front_member_directory_city');
} else {
	$selectedCity = '';
}
echo $this->Form->input('city', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => $cities, 'empty' => array(0 => 'Select'), 'selected' => $selectedCity ));
?>