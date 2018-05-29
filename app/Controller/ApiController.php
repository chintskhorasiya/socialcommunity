<?php
class ApiController extends AppController
{
	var $name = 'Api';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function get_categories_list($parent = 0)
    {
        if(!empty($this->params->query['parent'])){
            $parent = $this->params->query['parent'];
        }

        //var_dump($parent);exit;

        $this->loadmodel('NewsCategory');

        $default_newscate_data = $this->NewsCategory->find('all', array('conditions' => array('status IN'=> array(1), 'menu_enabled'=>1), 'order' => array('id' => 'asc')));

        if(count($default_newscate_data) > 0) {

            $tempParentCateArr = array();
            foreach ($default_newscate_data as $cat_all_key => $cat_all_data) {
                if(!empty($cat_all_data['NewsCategory']['parent'])) $tempParentCateArr[] = $cat_all_data['NewsCategory']['parent'];
            }
        }

        //var_dump($tempParentCateArr);exit;

        $all_newscate_data = $this->NewsCategory->find('all', array('conditions' => array('parent'=>$parent, 'status IN'=> array(1), 'menu_enabled'=>1), 'order' => array('id' => 'asc')));

        if(count($all_newscate_data) > 0) {

            $return_data = array();
            $return_data['result'] = "true";
            foreach ($all_newscate_data as $cat_key => $cat_data) {
                if(in_array($cat_data['NewsCategory']['id'], $tempParentCateArr)) {
                    $cat_data['NewsCategory']['has_subcategories'] = true;
                } else {
                    $cat_data['NewsCategory']['has_subcategories'] = false;                    
                }
                $return_data['categories'][] = $cat_data['NewsCategory'];
            }

        }
        else
        {
            $return_data = array('result'=>'false');
            echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
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
        $category_slug = $latest_newscate_data['NewsCategory']['slug'];

    	$latest_news_data = $this->News->find('first', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\''.$category_id.'\',categories)'), /*'limit' => 1, 'page' => $page,*/ 'order' => array('id' => 'desc')));

    	//$this->pre($latest_news_data);exit;

    	//$this->pre($return_data);exit;
    	if($jsonFormat){
    		$return_data = array();
    		$return_data[$category_name] = $latest_news_data['News'];
    		echo json_encode($return_data);exit;
    	} else {
            $return_data = array();
            $return_data = $latest_news_data['News'];
            $return_data['news_url'] = SITE_URL.'/news-detail/'.$category_slug.'/'.$latest_news_data['News']['slug'];
    		return $return_data;exit;
    	}

    }

    // for home page - start
    public function get_all_categories_first_news()
    {
    	$this->loadmodel('NewsCategory');

    	$all_newscate_data = $this->NewsCategory->find('all', array('conditions' => array('status IN'=> array(1), 'menu_enabled' => 1), 'order' => array('id' => 'asc')));

    	//$this->pre($all_newscate_data);exit;
    	$cate_news_data = array();
    	foreach ($all_newscate_data as $cat_num => $cat_data)
    	{
    		$cate_id = $cat_data['NewsCategory']['id'];
    		$cate_name = $cat_data['NewsCategory']['name'];
    		$news_data = $this->get_category_first_news($cate_id, false);
            $news_data['category_id'] = $cate_id;
            $news_data['category_name'] = $cate_name;
            $cate_news_data['results'][] = $news_data;
    	    // [$cate_name][0]
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

    // for home page - start
    public function get_top_story_first_news()
    {
        $this->loadmodel('NewsCategory');

        $all_newscate_data = $this->NewsCategory->find('all', array('conditions' => array('status IN'=> array(1), 'id' => 9), 'order' => array('id' => 'asc')));

        //$this->pre($all_newscate_data);exit;
        $cate_news_data = array();
        foreach ($all_newscate_data as $cat_num => $cat_data)
        {
            $cate_id = $cat_data['NewsCategory']['id'];
            $cate_name = $cat_data['NewsCategory']['name'];
            $news_data = $this->get_category_first_news($cate_id, false);
            $news_data['category_id'] = $cate_id;
            $news_data['category_name'] = $cate_name;
            $cate_news_data['results'][] = $news_data;
            // [$cate_name][0]
        }

        echo json_encode($cate_news_data, JSON_UNESCAPED_UNICODE);exit;

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
        $category_slug = $latest_newscate_data['NewsCategory']['slug'];

    	$latest_news_data = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\''.$category_id.'\',categories)'), 'limit' => 5, 'page' => $page, 'order' => array('id' => 'desc')));

    	$return_data = array();

        foreach ($latest_news_data as $newskey => $newsdata) {
            $newsdata['News']['news_url'] = SITE_URL.'/news-detail/'.$category_slug.'/'.$newsdata['News']['slug'];
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
    public function get_news_detail($news_id = 1, $category_id = false)
    {
    	if(!empty($this->params->query['news_id'])){
            $news_id = $this->params->query['news_id'];
        }
        if(!empty($this->params->query['category_id'])){
            $category_id = $this->params->query['category_id'];
        }

        $this->loadmodel('News');
    	$this->loadmodel('NewsCategory');

    	$news_detail_data = $this->News->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$news_id)));

    	if(empty($category_id))
        {
            $categories = $news_detail_data['News']['categories'];
            $categories_arr = explode(',', $categories);
            $category_id = $categories_arr[0];
        } else {
            $categories = $news_detail_data['News']['categories'];
            $categories_arr = explode(',', $categories);
            if(!in_array($category_id, $categories_arr)){
                $category_id = $categories_arr[0];
            }
        }

        $latest_newscate_data = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id), 'order' => array('id' => 'desc')));

        $category_name = $latest_newscate_data['NewsCategory']['name'];
        $category_slug = $latest_newscate_data['NewsCategory']['slug'];

        $news_detail_data['News']['news_url'] = SITE_URL.'/news-detail/'.$category_slug.'/'.$news_detail_data['News']['slug'];

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

                $categories = $newsdata['News']['categories'];
                $categories_arr = explode(',', $categories);
                $category_id = $categories_arr[0];

                $latest_newscate_data = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id), 'order' => array('id' => 'desc')));
                $category_id = $latest_newscate_data['NewsCategory']['id'];
                $category_name = $latest_newscate_data['NewsCategory']['name'];
                $category_slug = $latest_newscate_data['NewsCategory']['slug'];
                $newsdata['News']['category_id'] = $category_id;
                $newsdata['News']['category_name'] = $category_name;
                $newsdata['News']['news_url'] = SITE_URL.'/news-detail/'.$category_slug.'/'.$newsdata['News']['slug'];

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

        $polls_data = $this->Poll->find('all', array('conditions' => array('status IN'=> array(1)), 'limit' => 10, 'page' => 1, 'order' => array('id' => 'desc')));

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
            $this->loadmodel('PollAnswer');

            if(!empty($this->request->data) && isset($this->request->data) )
            {
                //$this->pre($this->request->data);exit;
                $answer = (int) trim($this->request->data['poll_answer']);
                $poll_id = (int) trim($this->request->data['poll_id']);

                $user_fullname = trim($this->request->data['user_fullname']);
                $user_mobileno = trim($this->request->data['user_mobileno']);
                $user_city = trim($this->request->data['user_city']);
                $user_district = trim($this->request->data['user_district']);
                $user_state = trim($this->request->data['user_state']);

                //$redirect_url = $this->request->data['redirect_url'];

                if(!empty($answer) && !empty($poll_id) && !empty($user_fullname) && !empty($user_mobileno))
                {
                    $get_poll_data_by_id = $this->Poll->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$poll_id)));

                    //$this->pre($get_poll_data_by_id);exit;
                    //exit;

                    $update_poll_data = array();
                    $update_poll_data['Poll']['id'] = $poll_id;
                    //if($answer == 2){
                        $answernum_vote = 'answer'.$answer.'_vote';
                        $answer_votes = $get_poll_data_by_id['Poll'][$answernum_vote];
                        $answer_votes++;
                        $update_poll_data['Poll'][$answernum_vote] = $answer_votes;
                        $update_poll_data['Poll']['last_answer'] = $answer;
                    /*} else {
                        $answer1_votes = $get_poll_data_by_id['Poll']['answer1_vote'];
                        $answer1_votes++;
                        $update_poll_data['Poll']['answer1_vote'] = $answer1_votes;
                        $update_poll_data['Poll']['last_answer'] = 1;
                    }*/
                    //$this->pre($update_poll_data);exit;
                    //$saved = $this->Poll->save($update_poll_data, false);

                    //$_SESSION['vote_success_msg'] = "Thanks for voting.";

                    /*if(!empty($redirect_url)){
                        $this->redirect($redirect_url);
                    } else {
                        $this->redirect(DEFAULT_URL);
                    }*/

                    $update_poll_answer_data = array();
                    $update_poll_answer_data['PollAnswer']['poll_id'] = $poll_id;
                    $update_poll_answer_data['PollAnswer']['answer_id'] = $answer;
                    $update_poll_answer_data['PollAnswer']['user_fullname'] = $user_fullname;
                    $update_poll_answer_data['PollAnswer']['user_mobileno'] = $user_mobileno;
                    $update_poll_answer_data['PollAnswer']['user_city'] = $user_city;
                    $update_poll_answer_data['PollAnswer']['user_district'] = $user_district;
                    $update_poll_answer_data['PollAnswer']['user_state'] = $user_state;
                    $update_poll_answer_data['PollAnswer']['date_added'] = date('Y-m-d H:i:s');

                    $this->PollAnswer->set($update_poll_answer_data);

                    if ($this->PollAnswer->validates()) //$this->News->validates() &&
                    {
                        //echo "validates true";exit;
                        //$this->pre($insert_news_data_array);exit;
                        $saved = $this->PollAnswer->save($update_poll_answer_data, false);
                        $saved = $this->Poll->save($update_poll_data, false);

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

    public function submit_feedback()
    {
//        echo "Test";
//        $this->pre($this->request);
//        exit;

        if ($this->request->is('post'))
//        if ($this->request->is('get'))
        {
            $this->loadmodel('Feedback');

            if( (!empty($this->request->data) && isset($this->request->data)) || (!empty($this->params->query) && isset($this->params->query)) )
            {
                //$this->pre($this->request->data['feedback_user_image']);exit;
                $feedback_user_name = trim((!empty($this->request->data['feedback_user_name']) ? $this->request->data['feedback_user_name'] : (!empty($this->params->query['feedback_user_name']) ? $this->params->query['feedback_user_name'] : '' ) ));
                $feedback_user_mobile = trim((!empty($this->request->data['feedback_user_mobile']) ? $this->request->data['feedback_user_mobile'] : (!empty($this->params->query['feedback_user_mobile']) ? $this->params->query['feedback_user_mobile'] : '' ) ));
                $feedback_user_comments = trim((!empty($this->request->data['feedback_user_comments']) ? $this->request->data['feedback_user_comments'] : (!empty($this->params->query['feedback_user_comments']) ? $this->params->query['feedback_user_comments'] : '' ) ));
                $feedback_user_city = trim((!empty($this->request->data['feedback_user_city']) ? $this->request->data['feedback_user_city'] : (!empty($this->params->query['feedback_user_city']) ? $this->params->query['feedback_user_city'] : '' ) ));
                $feedback_user_district = trim((!empty($this->request->data['feedback_user_district']) ? $this->request->data['feedback_user_district'] : (!empty($this->params->query['feedback_user_district']) ? $this->params->query['feedback_user_district'] : '' ) ));
                $feedback_user_state = trim((!empty($this->request->data['feedback_user_state']) ? $this->request->data['feedback_user_state'] : (!empty($this->params->query['feedback_user_state']) ? $this->params->query['feedback_user_state'] : '' ) ));
                $feedback_user_image = (!empty($_FILES['feedback_user_image']) && !empty($_FILES['feedback_user_image']['name']) && $_FILES['feedback_user_image']['error'] !== 4 ? $_FILES['feedback_user_image'] : '');

                //var_dump($feedback_user_image);exit;

                //$feedback_user_image = trim((!empty($this->request->data['feedback_user_image']) ? $this->request->data['feedback_user_image'] : (!empty($this->params->query['feedback_user_image']) ? $this->params->query['feedback_user_image'] : '' ) ));
                //$feedback_user_image = (!empty($this->request->data['feedback_user_image']) ? $this->request->data['feedback_user_image'] : '' );
                //exit;
                //var_dump($_FILES);exit;
                //$this->pre($this->request->data['feedback_user_image']);exit;

                $insert_feedback_data = array();



                /*if(!empty($feedback_user_image)){
                    // for image upload
                    $DefaultId = 0;
                    $lastFeedbackRecord = $this->Feedback->find('first', array('columns' => array('id'), 'order' => 'id DESC'));
                    if($lastFeedbackRecord){
                        $lastId = (int) $lastFeedbackRecord['Feedback']['id'];
                        $lastId++;
                    } else {
                        $lastId = 1;
                    }
                    $DefaultId = $DefaultId + $lastId;


                    $ImagePath = "img/uploads/".$DefaultId.".jpg";
                    $ServerURL = DEFAULT_URL.$ImagePath;
                    //exit;
                    // for image upload
                    $insert_feedback_data['Feedback']['user_image'] = $ServerURL;
//                    $insert_feedback_data['Feedback']['user_image'] = 'testing';
                }
                else
                {
                    $insert_feedback_data['Feedback']['user_image'] = '';
                }*/


                $insert_feedback_data['Feedback']['user_fullname'] = $feedback_user_name;
                $insert_feedback_data['Feedback']['user_mobileno'] = $feedback_user_mobile;
                $insert_feedback_data['Feedback']['user_comments'] = $feedback_user_comments;
                $insert_feedback_data['Feedback']['user_city'] = $feedback_user_city;
                $insert_feedback_data['Feedback']['user_district'] = $feedback_user_district;
                $insert_feedback_data['Feedback']['user_state'] = $feedback_user_state;
                $insert_feedback_data['Feedback']['user_image'] = $feedback_user_image;
                $insert_feedback_data['Feedback']['date_added'] = date('Y-m-d H:i:s');
//                $insert_feedback_data['Feedback']['id'] = 59;

                //$validate = $this->Feedback->validates();
                //$this->pre($validate);exit;

                $this->Feedback->set($insert_feedback_data);

                if ($this->Feedback->validates())
                {
                    $saved = $this->Feedback->save($insert_feedback_data, false);

                    //$Email = new CakeEmail();
                    /*if($saved && !empty($insert_feedback_data['Feedback']['user_image'])){
                        $file_upload = file_put_contents($ImagePath,base64_decode($insert_feedback_data['Feedback']['user_image']));
                    }*/
                }
                else
                {

                    $save_errors = $this->Feedback->validationErrors;

                    $errors_html .= "<div class=\"alert alert-danger\"><ul>";
                    foreach ($save_errors as $error_field => $field_errors)
                    {
                        foreach ($field_errors as $err_no => $error)
                        {
                            $errors_html .= "<li>".$error."</li>";
                        }
                    }

                    $errors_html .= "</ul></div>";

                    $return_data = array('result'=>$errors_html);
                    echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                }

                if($saved){
                    $return_data = array('result'=>'true');
                    echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                }
                else
                {
                    $return_data = array('result'=>'false');
                    echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                }

            }
            else
            {
                $return_data = array('result'=>'false');
                echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
            }
        }
        else
        {
            $return_data = array('result'=>'false');
            echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
        }
    }

    // for videos listing page - start
    public function get_videos_listing($page = 1)
    {
        if(!empty($this->params->query['page'])){
            $page = $this->params->query['page'];
        }

        $this->loadmodel('Video');

        $latest_videos_data = $this->Video->find('all', array('conditions' => array('status IN'=> array(1)), 'limit' => 5, 'page' => $page, 'order' => array('id' => 'desc')));

        $return_data = array();

        foreach ($latest_videos_data as $videoskey => $videosdata) {
            $videosdata['Video']['video-url'] = SITE_URL.'/video/'.$videosdata['Video']['slug'];

            $return_data['videos'][] = $videosdata['Video'];
        }

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;

    }
    // for videos listing page - end

    // for gallery listing page - start
    public function get_gallery_listing($page = 1)
    {
        if(!empty($this->params->query['page'])){
            $page = $this->params->query['page'];
        }

        $this->loadmodel('Gallery');

        $latest_gallery_data = $this->Gallery->find('all', array('conditions' => array('status IN'=> array(1)), 'limit' => 5, 'page' => $page, 'order' => array('id' => 'desc')));

        $return_data = array();

        foreach ($latest_gallery_data as $gallerykey => $gallerydata) {
            //http://projects.seawindsolution.com/five/krushiprabhat/gallery-photos/
            $gallerydata['Gallery']['gallery-url'] = SITE_URL.'/gallery-photos/'.$gallerydata['Gallery']['slug'];
            //print_r($gallerydata['Gallery'])
            $return_data['galleries'][] = $gallerydata['Gallery'];
        }

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;

    }
    // for gallery listing page - end

    // for videos listing page - start
    public function get_epapers_listing($page = 1)
    {
        if(!empty($this->params->query['page'])){
            $page = $this->params->query['page'];
        }

        $this->loadmodel('Epaper');

        $latest_epapers_data = $this->Epaper->find('all', array('conditions' => array('status IN'=> array(1)), 'limit' => 6, 'page' => $page, 'order' => array('id' => 'desc')));

        $return_data = array();

        foreach ($latest_epapers_data as $epaperkey => $epaperdata) {
            $epaperdata['Epaper']['epaper-url'] = SITE_URL.'/readepaper/'.$epaperdata['Epaper']['slug'];
            $epaperdata['Epaper']['epaper-img'] = SITE_URL.'/img/newspaper.png';

            $return_data['epapers'][] = $epaperdata['Epaper'];
        }

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;

    }
    // for videos listing page - end

    public function marketing_list($page = 1){

        $this->loadmodel('MarketingPrice');
        $this->loadmodel('Pricelist');

        if(!empty($this->params->query['page'])){
            $page = $this->params->query['page'];
        }

        $conditions = array();
        if(!empty($this->params->query['comodity'])){
            $commodityeng = $this->params->query['comodity'];

            $conditions[] = array(
                "OR" => array(
                    "MarketingPrice.commodityeng" => "".$commodityeng.""
                )
            );
        }

        if(!empty($this->params->query['center'])){
            $centereng = $this->params->query['center'];

            $conditions[] = array(
                "OR" => array(
                    "MarketingPrice.centereng" => "".$centereng.""
                )
            );
        }

        if (!empty($this->params->query['searchtitle']))
        {
            $search_key = trim($this->params->query['searchtitle']);

            $conditions[] = array(
                "OR" => array(
                    "MarketingPrice.commodityeng LIKE" => "%".$search_key."%",
                    "MarketingPrice.commodityguj LIKE" => "%".$search_key."%",
                    "MarketingPrice.centereng LIKE" => "%".$search_key."%",
                    "MarketingPrice.centerguj LIKE" => "%".$search_key."%"
                )
            );
        }

        if(!empty($this->params->query['listing_date'])){
            $search_date = $this->params->query['listing_date'];
        } else {
            $search_date = date('Y-m-d');
        }

        //var_dump($search_date);

        //$this->Session->write('search_date', $search_date);

        $priceListData = $this->Pricelist->find('first', array('conditions' => array('status IN'=> array(1), 'listing_date'=>$search_date)));
        if(!empty($priceListData)) $pricelistId = $priceListData['Pricelist']['id'];
        

        if(!empty($pricelistId)){
            $mainConditions = array('pricelist_id'=>$pricelistId, 'status IN'=> array(0,1));
        } else {
            $mainConditions = array('pricelist_id'=>0, 'status IN'=> array(0,1));
        }


        $allConditions = array_merge($mainConditions, $conditions);

        //$this->pre($allConditions);
        //exit;

        $this->paginate = array(
            'conditions' => $allConditions,
            'limit' => 10000,
            'order' => array('id' => 'asc')
        );
        
        $marketingprices_data = $this->paginate('MarketingPrice');

        $marketingprices_alldata = $this->MarketingPrice->find('all', array('conditions' => $mainConditions));
        
        $return_data = array();
        $return_data['marketing_data'] = array();
        //$return_data['commodities_data'] = array();
        //$return_data['centers_data'] = array();

        foreach ($marketingprices_data as $alldatakey => $alldatavalue) {
            $marketing_ele = array();
            $marketing_ele['commodity'] = $alldatavalue['MarketingPrice']['commodityeng'].'('.$alldatavalue['MarketingPrice']['commodityguj'].')';
            $marketing_ele['center'] = $alldatavalue['MarketingPrice']['centereng'].'('.$alldatavalue['MarketingPrice']['centerguj'].')';
            $marketing_ele['arrival'] = $alldatavalue['MarketingPrice']['arrival'];
            $marketing_ele['price'] = $alldatavalue['MarketingPrice']['price'];
            $return_data['marketing_data'][] = $marketing_ele;
        }
    
        /*foreach ($marketingprices_alldata as $alldatakey => $alldatavalue) {
            $return_data['commodities_data'][$alldatavalue['MarketingPrice']['commodityguj']] = $alldatavalue['MarketingPrice']['commodityeng'];
            $return_data['centers_data'][$alldatavalue['MarketingPrice']['centerguj']] = $alldatavalue['MarketingPrice']['centereng'];
        }*/

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
    }

    public function marketing_commodity_list(){

        $this->loadmodel('MarketingPrice');
        $this->loadmodel('Pricelist');

        if(!empty($this->params->query['listing_date'])){
            $search_date = $this->params->query['listing_date'];
        } else {
            $search_date = date('Y-m-d');
        }

        $priceListData = $this->Pricelist->find('first', array('conditions' => array('status IN'=> array(1), 'listing_date'=>$search_date)));
        if(!empty($priceListData)) $pricelistId = $priceListData['Pricelist']['id'];
        

        if(!empty($pricelistId)){
            $mainConditions = array('pricelist_id'=>$pricelistId, 'status IN'=> array(0,1));
        } else {
            $mainConditions = array('status IN'=> array(0,1));
        }

        $marketingprices_alldata = $this->MarketingPrice->find('all', array('conditions' => $mainConditions));
        
        $return_data = array();
        $return_data['commodities_data'] = array();
        
        foreach ($marketingprices_alldata as $alldatakey => $alldatavalue) {
            $return_data['commodities_data'][$alldatavalue['MarketingPrice']['commodityeng']] = $alldatavalue['MarketingPrice']['commodityeng'].' ('.$alldatavalue['MarketingPrice']['commodityguj'].')';
        }

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
    }

    public function marketing_center_list(){

        $this->loadmodel('MarketingPrice');
        $this->loadmodel('Pricelist');

        if(!empty($this->params->query['listing_date'])){
            $search_date = $this->params->query['listing_date'];
        } else {
            $search_date = date('Y-m-d');
        }

        $priceListData = $this->Pricelist->find('first', array('conditions' => array('status IN'=> array(1), 'listing_date'=>$search_date)));
        if(!empty($priceListData)) $pricelistId = $priceListData['Pricelist']['id'];
        

        if(!empty($pricelistId)){
            $mainConditions = array('pricelist_id'=>$pricelistId, 'status IN'=> array(0,1));
        } else {
            $mainConditions = array('status IN'=> array(0,1));
        }

        $marketingprices_alldata = $this->MarketingPrice->find('all', array('conditions' => $mainConditions));
        
        $return_data = array();
        $return_data['centers_data'] = array();
        
        foreach ($marketingprices_alldata as $alldatakey => $alldatavalue) {
            $return_data['centers_data'][$alldatavalue['MarketingPrice']['centereng']] = $alldatavalue['MarketingPrice']['centereng'].' ('.$alldatavalue['MarketingPrice']['centerguj'].')';
        }

        echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
    }

    public function upload_image_test(){

        if ($this->request->is('post'))
        {
            $DefaultId = 0;
            //$ImageData = $_POST['image_path'];
            //$ImageData = $_FILES['image_path']['tmp_name'];
            //$ImageName = $_POST['image_name'];

            $ImageData = $this->request->data['image_path'];
            $ImageName = $this->request->data['image_name'];

            //$this->pre($this->request->data);
            //$this->pre($_POST);
            //$this->pre($_FILES);
            //exit;
            // 'img/uploads'
            $this->loadmodel('Image');
            $lastImageRecord = $this->Image->find('first', array('columns' => array('id'), 'order' => 'id DESC'));

            //var_dump($lastImageRecord);exit;
            if($lastImageRecord){
                $lastId = (int) $lastImageRecord['Image']['id'];
                $lastId++;
            } else {
                $lastId = 1;
            }

            $DefaultId = $DefaultId + $lastId;

            /*$mime_type = $_FILES['image_path']['type'];

            switch ($mime_type) {
                case 'image/png':
                    $extension = '.png';
                    break;

                case 'image/jpg':
                    $extension = '.jpg';
                    break;

                case 'image/jpeg':
                    $extension = '.jpg';
                    break;

                case 'image/gif':
                    $extension = '.gif';
                    break;

            }*/

            //$ImagePath = "img/uploads/".$DefaultId.$extension;
            $ImagePath = "img/uploads/".$DefaultId.".jpg";

            $ServerURL = DEFAULT_URL.$ImagePath;

            $insert_images_data_array = array();
            $insert_images_data_array['Image']['image_path'] = $ServerURL;
            $insert_images_data_array['Image']['image_name'] = $ImageName;

            $save = $this->Image->save($insert_images_data_array, true);

            //var_dump(base64_decode($ImageData));exit;

            if($save){

                $file_upload = file_put_contents($ImagePath,base64_decode($ImageData));
                //$file_upload = copy($ImagePath,$ImageData);
                //$file_upload = move_uploaded_file($ImageData, $ImagePath);
                //var_dump($file_upload);exit;
                if($file_upload){
                    $return_data = array('result'=>'true');
                    echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                } else {
                    $return_data = array('result'=>'false');
                    echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
                }
            } else {
                $return_data = array('result'=>'false');
                echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
            }

        } else {
            $return_data = array('result'=>'false');
            echo json_encode($return_data, JSON_UNESCAPED_UNICODE);exit;
        }

    }

}