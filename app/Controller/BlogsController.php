<?php
class BlogsController extends AppController
{
	var $name = 'Blogs';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    //public function beforeFilter(){
    	//$isAuth = $this->checklogin();
    	//var_dump($isAuth);exit;	
    //}

    public function admin_index(){
    	//echo "in Blogss:index";exit;
    }

	public function admin_lists()
	{
		//echo "in Blogs:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $this->loadmodel('Blogs');
        $blogs_data = $this->paginate('Blogs');

        //$this->pre($blogs_data);exit;

        $this->set('page_heading','Blogs List');
        $this->set('blogs',$blogs_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$customValidate = true;

			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');

			//$this->pre($this->data['Blogs']);exit;
			
			$insert_blogs_data_array = $this->data['Blogs'];
			$insert_blogs_data_array['created'] = date('Y-m-d H:i:s');
			$insert_blogs_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_blogs_data_array['user_id'] = $userid;

			$lastRecord = $this->Blog->find('first', array('colomns' => array('id'), 'order' => 'id DESC'));

			//var_dump($lastRecord);exit;

			$lastId = (int) $lastRecord['Blog']['id'];
			$lastId++;
			// for blogs images
			$first_fail_imgs = array();
			if(count($insert_blogs_data_array['images']) > 0){
				foreach ($insert_blogs_data_array['images'] as $ff_img_num => $ff_img) {
					//var_dump($ff_img);
					if($ff_img['error'] == "1"){
						$first_fail_imgs[] = $ff_img['name'];
					}
				}

				if(count($first_fail_imgs) > 0){
					
					$insert_blogs_data_array['images'] = '';
					$customValidate = false;
					$customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

				} else {
					$images_result = $this->Blog->processMultipleUpload($insert_blogs_data_array, $lastId);
					//$this->pre($images_result);exit;
					$fail_imgs = array();

					if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
						foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
							$fail_imgs[] = $fail_img;
						}

						$insert_blogs_data_array['images'] = '';
						$customValidate = false;
						$customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

					} else {
						$suc_imgs = array();
						if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
							foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
								$suc_imgs[] = $suc_img;
							}

							$insert_blogs_data_array['images'] = implode(',', $suc_imgs);
						} else {
							$insert_blogs_data_array['images'] = false;
						}
					}
				}
				
			} else {
				$insert_blogs_data_array['images'] = false;
			}
			// for blogs images

			
			$this->Blog->set($insert_blogs_data_array);

			if ($this->Blog->validates() && $customValidate) //$this->Blog->validates() && 
			{
				//echo "validates true";exit;
				//$this->pre($insert_blogs_data_array);exit;
			 	$save = $this->Blog->save($insert_blogs_data_array, true);
				$_SESSION['success_msg'] = "Blogs Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'blogs/lists/');
			}
			else
			{

				$save_errors = $this->Blog->validationErrors;

			    $errors_html = "<ul>";
			    foreach ($save_errors as $error_field => $field_errors)
			    {
					foreach ($field_errors as $err_no => $error)
					{
						$errors_html .= "<li>".$error."</li>";	
					}
			    }

			    if(count($customErrors) > 0)
			    {
			    	foreach ($customErrors as $errKey => $custom_error) {
			    		$errors_html .= "<li>".$custom_error."</li>";	
			    	}
			    }

			    $errors_html .= "</ul>";

			    //$this->pre($errors_html);exit;
			    $blogs_data['Blogs'] = $this->data['Blogs'];

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('blogs_data',$blogs_data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_blogs_data_array = array();
			$insert_blogs_data_array['Blogs']['title'] = '';
			$insert_blogs_data_array['Blogs']['slug'] = '';
			$insert_blogs_data_array['Blogs']['content'] = '';
			$insert_blogs_data_array['Blogs']['status'] = '1';
			
			$this->set('blogs_data',$insert_blogs_data_array);
		}

	}

	public function admin_edit() {

		$this->loadmodel('Blogs');
		
		$blogsId = $this->params['named']['blogsId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Blogs")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_blogs_data_array = $this->data['Blog'];
				$insert_blogs_data_array['id'] = $blogsId;
				//$insert_blogs_data_array['created'] = date('Y-m-d H:i:s');
				$insert_blogs_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_blogs_data_array['user_id'] = $userid;
				//$this->pre($insert_blogs_data_array);exit;

				// for blogs images
				$first_fail_imgs = array();
				if(count($insert_blogs_data_array['images']) > 0){
					foreach ($insert_blogs_data_array['images'] as $ff_img_num => $ff_img) {
						//var_dump($ff_img);
						if($ff_img['error'] == "1"){
							$first_fail_imgs[] = $ff_img['name'];
						}
					}

					if(count($first_fail_imgs) > 0){
						
						$insert_blogs_data_array['images'] = '';
						$customValidate = false;
						$customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

					} else {
						$images_result = $this->Blog->processMultipleUpload($insert_blogs_data_array, $blogsId);
						//$this->pre($images_result);exit;
						$fail_imgs = array();

						if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
							foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
								$fail_imgs[] = $fail_img;
							}

							$insert_blogs_data_array['images'] = '';
							$customValidate = false;
							$customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

						} else {
							$suc_imgs = array();
							if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
								foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
									$suc_imgs[] = $suc_img;
								}

								$insert_blogs_data_array['images'] = implode(',', $suc_imgs);
							} else {
								$insert_blogs_data_array['images'] = false;
							}
						}
					}
					
				} else {
					$insert_blogs_data_array['images'] = false;
				}
				// for blogs images

				// for edit images only
				if(isset($insert_blogs_data_array['add_image'])){
					if (count($insert_blogs_data_array['add_image']) > 0)
					{
						if(!empty($insert_blogs_data_array['images'])){
							$insert_blogs_data_array['images'] = explode(',', $insert_blogs_data_array['images']);
							$insert_blogs_data_array['images'] = array_merge($insert_blogs_data_array['add_image'], $insert_blogs_data_array['images']);
							$insert_blogs_data_array['add_image'] = false;
							$insert_blogs_data_array['images'] = implode(',', $insert_blogs_data_array['images']);
						} else {
							$insert_blogs_data_array['images'] = $insert_blogs_data_array['add_image'];
							$insert_blogs_data_array['add_image'] = false;
							$insert_blogs_data_array['images'] = implode(',', $insert_blogs_data_array['images']);
						}
					}
				}
				// for edit images only

				// for blogs videos
				if(isset($insert_blogs_data_array['videos']) && count($insert_blogs_data_array['videos']) > 0)
				{
					$real_videos = array();
					foreach ($insert_blogs_data_array['videos'] as $vid_num => $vid)
					{
						if(!empty($vid)){
							$real_videos[] = $vid;
						}
					}

					if(count($real_videos) > 0){
						$insert_blogs_data_array['videos'] = implode(',', $real_videos);
					} else {
						$insert_blogs_data_array['videos'] = false;
					}
				}
				// for blogs videos


				//$this->pre($insert_blogs_data_array);exit;

				$this->Blog->set($insert_blogs_data_array);

				if ($this->Blog->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Blog->save($insert_blogs_data_array);
					//$_SESSION['success_msg'] = "Blogs Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'blogs/lists/');

	                $this->Blog->save($insert_blogs_data_array);
					$_SESSION['success_msg'] = "Blogs Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'blogs/lists/');
				}
				else
				{
				    $save_errors = $this->Blog->validationErrors;

				    //$this->pre($save_errors);exit;
				    $errors_html = "<ul>";
				    foreach ($save_errors as $error_field => $field_errors)
				    {
						foreach ($field_errors as $err_no => $error)
						{
							$errors_html .= "<li>".$error."</li>";	
						}
				    }

				    $errors_html .= "</ul>";

				    //$this->pre($errors_html);exit;
				    //$this->pre($this->data['Blogs']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('blogs_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$blogs_data = $this->Blog->find('first', array('conditions' => array('id' => $blogsId)));

		$this->set('blogs_data',$blogs_data);
	}

	public function admin_delete() {

		$this->loadmodel('Blogs');

		$blogsId = $this->params['named']['blogsId'];
		
		$this->Blog->id = $this->Blog->field('id', array('id' => $blogsId));

		$this->Blog->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Blog->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted blogs";
		$return_url = DEFAULT_ADMINURL.'blogs/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['blogss_checks']);exit;
		if(isset($this->data['blogs_checks']))
        {
            $blogsSelectedArr = $this->data['blogs_checks'];
            $blogsNum = count($blogsSelectedArr);

            if($blogsNum > 0)
            {
            	$this->loadmodel('Blogs');

                $deletedCount = 0;

                foreach ($blogsSelectedArr as $blogsDelKey => $blogsToDelete) {
                    //var_dump($blogsToDelete);

                    $this->Blog->id = $this->Blog->field('id', array('id' => $blogsToDelete));
                    if ($this->Blog->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Blog->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Blog->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted for ".$deletedCount." blogs.";
                $return_url = DEFAULT_ADMINURL.'blogs/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any blogs.";
                $return_url = DEFAULT_ADMINURL.'blogs/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'blogs/lists';
            return $this->redirect($return_url);
        }
	}

	public function admin_search()
	{
	    $userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

	    if ($this->request->is('post'))
	    {
	      	if(!empty($this->request->data) && isset($this->request->data) )
	      	{
	         	//$this->pre($this->request->data);exit;
	         	$search_key = trim($this->request->data['blogsSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	         		"OR" => array(
	            		"Blogs.title LIKE" => "%".$search_key."%",
	            		"Blogs.content LIKE" => "%".$search_key."%"
	            	)
	         	);

	         	$this->Session->write('searchCond', $conditions);
         		$this->Session->write('search_key', $search_key);
	      	}
	    }

	    $mainConditions = array('user_id'=>$userid, 'status IN'=> array(0,1));

	    if ($this->Session->check('searchCond')) {
	    	$conditions = $this->Session->read('searchCond');
	    	$allConditions = array_merge($mainConditions, $conditions);
	   	} else {
	      	$conditions = null;
	      	$allConditions = array_merge($mainConditions, $conditions);
	   	}

	    //$this->pre($allConditions);exit;

	   	$this->paginate = array(
            'conditions' => $allConditions,
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

	   	$this->loadmodel('Blogs');
	   	$blogs_data = $this->paginate('Blogs');

	   	//$this->pre($blogs_data);exit;

	   	$this->set('page_heading','Blogs List');

	   	$this->set('blogs',$blogs_data);

	   	$this->set('from_search',true);

	   	$this->render('/Blogs/admin_lists');
	}

}