<?php
echo $this->Form->input('city', array('class' => 'form-control input-sm', 'div' => 'col-md-4', 'options' => $cities, 'empty' => array(0 => 'Select')));
?>