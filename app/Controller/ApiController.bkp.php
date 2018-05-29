<?php
class ApiController extends AppController
{
	var $name = 'Api';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function get_categories_list()
    {
        $this->loadmodel('NewsCategory');

        $all_newscate_data = $this->NewsCategory->find('all', array('conditions' => array('status IN'=> array(1), 'menu_enabled'=>1), 'order' => array('id' => 'asc')));

        $return_data['categories'] = array();
        foreach ($all_newscate_data as $cat_key => $cat_data) {
            $return_data['categories'][] = $cat_data['NewsCategory'];
        }

        //$this->pre($return_data);exit;

        //echo '<meta http-equiv="content-type" content="text/html;charset=UTF-8">';
        //echo '<meta http-equiv="content-type" content="application/*;charset=UTF-8">';
        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;

    }

    public function get_category_first_news($category_id = 1, $jsonFormat = true)
    {
    	$this->loadmodel('News');
    	$this->loadmodel('NewsCategory');

    	$latest_newscate_data = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id), 'order' => array('id' => 'desc')));

    	///$this->pre($latest_newscate_data);

    	$category_name = $latest_newscate_data['NewsCategory']['name'];

    	$latest_news_data = $this->News->find('first', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\''.$category_id.'\',categories)'), /*'limit' => 1, 'page' => $page,*/ 'order' => array('id' => 'desc')));

    	//$this->pre($latest_news_data);exit;

    	//$this->pre($return_data);exit;
    	if($jsonFormat){
    		$return_data = array();
    		$return_data[$category_name] = $latest_news_data['News'];
    		echo json_encode($return_data);exit;
    	} else {
    		return $latest_news_data['News'];exit;
    	}

    }

    // for home page - start
    public function get_all_categories_first_news()
    {
    	$this->loadmodel('NewsCategory');

    	$all_newscate_data = $this->NewsCategory->find('all', array('conditions' => array('status IN'=> array(1)), 'order' => array('id' => 'asc')));

    	//$this->pre($all_newscate_data);exit;
    	$cate_news_data = array();
    	foreach ($all_newscate_data as $cat_num => $cat_data)
    	{
    		$cate_id = $cat_data['NewsCategory']['id'];
    		$cate_name = $cat_data['NewsCategory']['name'];
    		$cate_news_data['results'][][$cate_name][0] = $this->get_category_first_news($cate_id, false);
    	}

    	//$this->pre($cate_news_data);exit;
    	/*echo '<style>@font-face {
		font-family:"shruti-Regular";
		src:url("../app/webroot/fonts/shruti.ttf");
		}
		@font-face {
		font-family:"gujlekha";
		src:url("../app/webroot/fonts/GujLekha_1.ttf");
		}
		@font-face {
		font-family:"MyriadPro BoldCond";
		src:url("../app/webroot/fonts/MyriadPro-BoldCond.otf");
		}
		*{
			color:red !important;
			font-family:"gujlekha" !important;
			font-weight: normal !important;
		 }
		</style>';*/
		//echo '<meta http-equiv="content-type" content="text/html;charset=UTF-8">';
		//echo '<meta http-equiv="content-type" content="application/*;charset=UTF-8">';
    	echo json_encode($cate_news_data, JSON_UNESCAPED_UNICODE);exit;
    	//echo json_encode($result, JSON_UNESCAPED_UNICODE);

    	//$this->pre($cate_news_data);exit;

    	//$this->set('result', $cate_news_data);

    	//$this->render('/Api/result');
    	//exit;

    }
    // for home page - end


    // for category listing page - start
    public function get_category_news_listing($category_id = 1, $page = 1)
    {
    	//$this->pre($this->params->query);exit;
        
        if(!empty($this->params->query['category_id'])){
            $category_id = $this->params->query['category_id'];
        }
        if(!empty($this->params->query['page'])){
            $page = $this->params->query['page'];
        }

        $this->loadmodel('News');
    	$this->loadmodel('NewsCategory');

    	$latest_newscate_data = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id), 'order' => array('id' => 'desc')));

    	//$this->pre($latest_newscate_data);exit;

    	$category_name = $latest_newscate_data['NewsCategory']['name'];

    	$latest_news_data = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\''.$category_id.'\',categories)'), 'limit' => 5, 'page' => $page, 'order' => array('id' => 'desc')));

    	$return_data = array();

        foreach ($latest_news_data as $newskey => $newsdata) {
            $return_data['news'][] = $newsdata['News'];
        }
        
        //$this->pre($return_data);exit;

    	//echo '<meta http-equiv="content-type" content="text/html;charset=UTF-8">';
        //echo '<meta http-equiv="content-type" content="application/*;charset=UTF-8">';
        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;

        //echo json_encode($latest_news_data);exit;

    }
    // for category listing page - end


    // for news details page - start
    public function get_news_detail($news_id = 1)
    {
    	$this->loadmodel('News');
    	$this->loadmodel('NewsCategory');

    	$latest_newscate_data = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id), 'order' => array('id' => 'desc')));

    	//$this->pre($latest_newscate_data);exit;

    	$category_name = $latest_newscate_data['NewsCategory']['name'];

    	$news_detail_data = $this->News->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$news_id)));

    	//$this->pre($news_detail_data);exit;

        //echo '<meta http-equiv="content-type" content="text/html;charset=UTF-8">';
        //echo '<meta http-equiv="content-type" content="application/*;charset=UTF-8">';
        echo json_encode($news_detail_data, JSON_UNESCAPED_UNICODE);exit;

    	//echo json_encode($news_detail_data);exit;

    }
    // for news details page - end

    public function get_search_results($page = 1)
    {
        if(!empty($this->params->query['page'])){
            $page = $this->params->query['page'];
        }

        if ($this->request->is('post'))
        {
            $this->loadmodel('News');
            $this->loadmodel('NewsCategory');
            
            if(!empty($this->request->data) && isset($this->request->data) )
            {
                $search_key = trim($this->request->data['search_text']);
     
                $conditions[] = array(
                    "OR" => array(
                        "News.title LIKE" => "%".$search_key."%",
                        "News.content LIKE" => "%".$search_key."%",
                        "News.seo_title LIKE" => "%".$search_key."%",
                        "News.seo_desc LIKE" => "%".$search_key."%"
                    )
                );

                $this->Session->write('frontSearchNewsCond', $conditions);
                $this->Session->write('front_search_news_key', $search_key);
            }

            $mainConditions = array('status IN'=> array(1));

            if ($this->Session->check('frontSearchNewsCond')) {
                $conditions = $this->Session->read('frontSearchNewsCond');
                $allConditions = array_merge($mainConditions, $conditions);
            } else {
                $conditions = null;
                $allConditions = array_merge($mainConditions, $conditions);
            }

            $searched_news_data = $this->News->find('all', array('conditions' => $allConditions, 'limit' => 5, 'page' => $page, 'order' => array('id' => 'desc')));

            $return_data = array();

            foreach ($searched_news_data as $newskey => $newsdata) {
                $return_data['news'][] = $newsdata['News'];
            }
            
            echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;

        } else {
            $return_data = array('result'=>'false');
            echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
        }
    }

    // for mobile advertise - start
    public function get_mobile_advertise()
    {
        $this->loadmodel('Advertise');
        
        $mobile_advertise_data = $this->Advertise->find('first', array('conditions' => array('status IN'=> array(1), 'position'=>'mobile_app'), 'order' => array('id' => 'desc')));

        //$this->pre($mobile_advertise_data);exit;

        echo json_encode($mobile_advertise_data, JSON_UNESCAPED_UNICODE);exit;

    }
    // for mobile advertise - end

    // for poll listing - start
    public function get_polls_list()
    {
        $this->loadmodel('Poll');

        $polls_data = $this->Poll->find('all', array('conditions' => array('status IN'=> array(1)), 'limit' => 10, 'page' => 1, 'order' => array('id' => 'asc')));

        $return_data['polls'] = array();
        foreach ($polls_data as $poll_key => $poll_data) {
            $return_data['polls'][] = $poll_data['Poll'];
        }

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;

    }

    public function submit_poll()
    {
        if ($this->request->is('post'))
        {
            $this->loadmodel('Poll');

            if(!empty($this->request->data) && isset($this->request->data) )
            {
                //$this->pre($this->request->data);exit;
                $answer = (int) trim($this->request->data['poll_answer']);
                $poll_id = (int) trim($this->request->data['poll_id']);
                //$redirect_url = $this->request->data['redirect_url'];
     
                if(!empty($answer) && !empty($poll_id))
                {
                    $get_poll_data_by_id = $this->Poll->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$poll_id)));

                    //$this->pre($get_poll_data_by_id);exit;
                    //exit;

                    $update_poll_data = array();
                    $update_poll_data['Poll']['id'] = $poll_id;
                    if($answer == 2){
                        $answer2_votes = $get_poll_data_by_id['Poll']['answer2_vote'];
                        $answer2_votes++;
                        $update_poll_data['Poll']['answer2_vote'] = $answer2_votes;
                        $update_poll_data['Poll']['last_answer'] = 2;
                    } else {
                        $answer1_votes = $get_poll_data_by_id['Poll']['answer1_vote'];
                        $answer1_votes++;
                        $update_poll_data['Poll']['answer1_vote'] = $answer1_votes;
                        $update_poll_data['Poll']['last_answer'] = 1;
                    }
                    //$this->pre($update_poll_data);exit;
                    $saved = $this->Poll->save($update_poll_data, false);

                    //$_SESSION['vote_success_msg'] = "Thanks for voting.";

                    /*if(!empty($redirect_url)){
                        $this->redirect($redirect_url);
                    } else {
                        $this->redirect(DEFAULT_URL);
                    }*/

                    if($saved){
                        //echo 'success';exit;
                        $return_data = array('result'=>'true');
                        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                    }
                    else
                    {
                        //echo 'failed';exit;
                        $return_data = array('result'=>'false');
                        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                    }
                }
                else
                {
                    //$this->redirect(DEFAULT_URL);
                    //echo 'failed';exit;
                    $return_data = array('result'=>'false');
                    echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                }
            }
            else
            {
                //$this->redirect(DEFAULT_URL);
                //echo 'failed';exit;
                $return_data = array('result'=>'false');
                echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
            }
        }
        else
        {
            //$this->redirect(DEFAULT_URL);
            //echo 'failed';exit;
            $return_data = array('result'=>'false');
            echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
        }
    }

}