<?php
App::uses('AppModel', 'Model');
App::import('Vendor', 'resize_img');

class User extends AppModel {
    
    public $name = 'User';

    public $validate = array(
        'username' => array(
            'rule' => 'notBlank',
            'message' => 'Username can not be empty'
        ),
        'password' => array(
            'rule' => 'notBlank',
            'message' => 'Password can not be empty'
        ),
        'email' => array(
            'rule' => 'notBlank',
            'message' => 'Email can not be empty'
        )
    );
    
}