<?php
if(!empty($current_state)) {
	$selectedState = $current_state;
} else {
	$selectedState = '';
}
echo $this->Form->input('states', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => $states, 'selected' => $selectedState, 'empty' => array(0 => 'Select')));
?>