<?php
App::uses('AppHelper', 'View/Helper');

class CommonHelper extends AppHelper {

    // Take advantage of other helpers
    public $helpers = array('Js', 'Html', 'Form');

    // Check if the tiny_mce.js file has been added or not
    public $_script = false;

    public function get_listing_url($category_id)
    {
        //App::import("Model", "NewsCategory");  
		//$NewsCategory = new NewsCategory();  
        //$catdata = $NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id)));
        //$category_slug = $catdata['NewsCategory']['slug'];
        //return DEFAULT_FRONT_NEWS_CATEGORY_URL.$category_slug;           
        return DEFAULT_FRONT_NEWS_CATEGORY_URL; 
    }

    public function get_cat_slug($category_id)
    {
        App::import("Model", "NewsCategory");  
        $NewsCategory = new NewsCategory();  
        $catdata = $NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id)));
        $category_slug = $catdata['NewsCategory']['slug'];
        return $category_slug;           
    }

    public function limit_text($text, $limit) {

        $text = strip_tags($text);
        $textWordsArr = explode(' ', $text);
        $total_words = count($textWordsArr);
        //var_dump($textWordsArr);
        if ($total_words > $limit) {
            $text = '';
            foreach ($textWordsArr as $word_key => $word) {
                if($word_key < $limit){
                    $text .= $word.' ';
                }
            }
            $text .= '...';
            return $text;
        }
        return $text;
    }

    public function test(){
        return "test...";   
    }

    public function getCityName($city_id)
    {
        App::import("Model", "City");  
        $City = new City();  
        $citydata = $City->find('first', array('conditions' => array('id'=>$city_id)));
        $city_name = $citydata['City']['name'];
        return $city_name; 
    }

    public function getStateName($state_id){
        App::import("Model", "State");  
        $State = new State();  
        $statedata = $State->find('first', array('conditions' => array('id'=>$state_id)));
        $state_name = $statedata['State']['name'];
        return $state_name; 
    }

    public function getProfName($prof_id){
        App::import("Model", "Proffession");  
        $Proffession = new Proffession();  
        $proffessiondata = $Proffession->find('first', array('conditions' => array('id'=>$prof_id)));
        $prof_name = $proffessiondata['Proffession']['name'];
        return $prof_name; 
    }

}