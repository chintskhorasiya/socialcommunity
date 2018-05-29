<?php
class FrontController extends AppController
{
	var $name = 'Front';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function comingsoon(){
        echo "<center><h1>Coming Soon</h1></center>";
        exit;
    }

}