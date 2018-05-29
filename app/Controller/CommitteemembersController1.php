<?php
class CommitteemembersController extends AppController
{
	var $name = 'Committeemembers';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    //public function beforeFilter(){
    	//$isAuth = $this->checklogin();
    	//var_dump($isAuth);exit;	
    //}

    public function admin_index(){
    	//echo "in Committeememberss:index";exit;
    }

	public function admin_lists()
	{
		//echo "in Committeemembers:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $this->loadmodel('Committeemember');
        $committeemembers_data = $this->paginate('Committeemember');

        //$this->pre($committeemembers_data);exit;

        $this->set('page_heading','Committeemembers List');
        $this->set('committeemembers',$committeemembers_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$customValidate = true;

			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');

			//$this->pre($this->data['Committeemember']);exit;
			
			$insert_committeemembers_data_array = $this->data['Committeemember'];
			$insert_committeemembers_data_array['created'] = date('Y-m-d H:i:s');
			$insert_committeemembers_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_committeemembers_data_array['user_id'] = $userid;

			// for committeemembers categories
			if(is_array($insert_committeemembers_data_array['categories']) && count($insert_committeemembers_data_array['categories']) > 0)
			{
				$insert_committeemembers_data_array['categories'] = implode(',', $insert_committeemembers_data_array['categories']);
			}
			else
			{
				$insert_committeemembers_data_array['categories'] = '';
				$customValidate = false;
				$customErrors[] = 'Please select one or more categories';
			}
			// for committeemembers categories
			$this->loadmodel('Committeemember');
			$lastRecord = $this->Committeemember->find('first', array('columns' => array('id'), 'order' => 'id DESC'));

			//var_dump($lastRecord);exit;

			$lastId = (int) $lastRecord['Committeemember']['id'];
			$lastId++;
			// for committeemembers images
			$first_fail_imgs = array();
			if(count($insert_committeemembers_data_array['images']) > 0){
				foreach ($insert_committeemembers_data_array['images'] as $ff_img_num => $ff_img) {
					//var_dump($ff_img);
					if($ff_img['error'] == "1"){
						$first_fail_imgs[] = $ff_img['name'];
					}
				}

				if(count($first_fail_imgs) > 0){
					
					$insert_committeemembers_data_array['images'] = '';
					$customValidate = false;
					$customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

				} else {
					$images_result = $this->Committeemember->processMultipleUpload($insert_committeemembers_data_array, $lastId);
					//$this->pre($images_result);exit;
					$fail_imgs = array();

					if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
						foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
							$fail_imgs[] = $fail_img;
						}

						$insert_committeemembers_data_array['images'] = '';
						$customValidate = false;
						$customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

					} else {
						$suc_imgs = array();
						if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
							foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
								$suc_imgs[] = $suc_img;
							}

							$insert_committeemembers_data_array['images'] = implode(',', $suc_imgs);
						} else {
							$insert_committeemembers_data_array['images'] = false;
						}
					}
				}
				
			} else {
				$insert_committeemembers_data_array['images'] = false;
			}
			// for committeemembers images

			//$this->pre($insert_committeemembers_data_array);exit;

			// for committeemembers videos
			if(isset($insert_committeemembers_data_array['videos']) && count($insert_committeemembers_data_array['videos']) > 0)
			{
				$real_videos = array();
				foreach ($insert_committeemembers_data_array['videos'] as $vid_num => $vid)
				{
					if(!empty($vid)){
						$real_videos[] = $vid;
					}
				}

				if(count($real_videos) > 0){
					$insert_committeemembers_data_array['videos'] = implode(',', $real_videos);
				} else {
					$insert_committeemembers_data_array['videos'] = false;
				}
			}
			// for committeemembers videos

			//$this->pre($insert_committeemembers_data_array);exit;

			$this->Committeemember->set($insert_committeemembers_data_array);

			if ($this->Committeemember->validates() && $customValidate) //$this->Committeemember->validates() && 
			{
				//echo "validates true";exit;
				//$this->pre($insert_committeemembers_data_array);exit;
			 	$save = $this->Committeemember->save($insert_committeemembers_data_array, true);
				$_SESSION['success_msg'] = "Committeemembers Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'committeemembers/lists/');
			}
			else
			{

				$save_errors = $this->Committeemember->validationErrors;

			    //$this->pre($save_errors);
			    //$this->pre($customErrors);
			    //exit;

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

			    /*if(count($imgErrors) > 0)
			    {
			    	foreach ($imgErrors as $imgerror_field => $imgfield_errors)
				    {
						foreach ($imgfield_errors as $imgerr_no => $imgerror)
						{
							$errors_html .= "<li>".$imgerror[0]."</li>";	
						}
				    }
			    }*/

			    $errors_html .= "</ul>";

			    //$this->pre($errors_html);exit;
			    $committeemembers_data['Committeemember'] = $this->data['Committeemember'];

			    $this->loadmodel('CommitteemembersCategory');
				$committeemembers_categories_data = $this->CommitteemembersCategory->find('all', array('conditions' => array('status IN'=> array(0,1))));
				$committeemembers_data['Committeemember']['all_categories'] = $committeemembers_categories_data;

			    //$this->pre($committeemembers_data['Committeemember']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('committeemembers_data',$committeemembers_data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_committeemembers_data_array = array();
			$insert_committeemembers_data_array['Committeemember']['title'] = '';
			$insert_committeemembers_data_array['Committeemember']['slug'] = '';
			$insert_committeemembers_data_array['Committeemember']['content'] = '';
			$insert_committeemembers_data_array['Committeemember']['status'] = '1';
			
			$this->loadmodel('CommitteemembersCategory');
			$committeemembers_categories_data = $this->CommitteemembersCategory->find('all', array('conditions' => array('status IN'=> array(0,1))));

			//$this->pre($committeemembers_categories_data);exit;

			$insert_committeemembers_data_array['Committeemember']['all_categories'] = $committeemembers_categories_data;
			$this->set('committeemembers_data',$insert_committeemembers_data_array);
		}

	}

	public function admin_edit() {

		$this->loadmodel('Committeemember');
		
		$committeemembersId = $this->params['named']['committeemembersId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Committeemembers")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_committeemembers_data_array = $this->data['Committeemember'];
				$insert_committeemembers_data_array['id'] = $committeemembersId;
				//$insert_committeemembers_data_array['created'] = date('Y-m-d H:i:s');
				$insert_committeemembers_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_committeemembers_data_array['user_id'] = $userid;
				//$this->pre($insert_committeemembers_data_array);exit;

				// for committeemembers categories
				if(is_array($insert_committeemembers_data_array['categories']) && count($insert_committeemembers_data_array['categories']) > 0)
				{
					$insert_committeemembers_data_array['categories'] = implode(',', $insert_committeemembers_data_array['categories']);
				}
				else
				{
					$insert_committeemembers_data_array['categories'] = '';
					$customValidate = false;
					$customErrors[] = 'Please select one or more categories';
				}
				// for committeemembers categories

				//$this->pre($insert_committeemembers_data_array);exit;

				// for committeemembers images
				$first_fail_imgs = array();
				if(count($insert_committeemembers_data_array['images']) > 0){
					foreach ($insert_committeemembers_data_array['images'] as $ff_img_num => $ff_img) {
						//var_dump($ff_img);
						if($ff_img['error'] == "1"){
							$first_fail_imgs[] = $ff_img['name'];
						}
					}

					if(count($first_fail_imgs) > 0){
						
						$insert_committeemembers_data_array['images'] = '';
						$customValidate = false;
						$customErrors[] = 'Could not upload, Some problems in images :'.implode(',', $first_fail_imgs);

					} else {
						$images_result = $this->Committeemember->processMultipleUpload($insert_committeemembers_data_array, $committeemembersId);
						//$this->pre($images_result);exit;
						$fail_imgs = array();

						if(isset($images_result['failed_images']) && count($images_result['failed_images']) > 0){
							foreach ($images_result['failed_images'] as $fail_img_num => $fail_img) {
								$fail_imgs[] = $fail_img;
							}

							$insert_committeemembers_data_array['images'] = '';
							$customValidate = false;
							$customErrors[] = 'These images got failed when upload :'.implode(',', $fail_imgs);

						} else {
							$suc_imgs = array();
							if(isset($images_result['succeed_images']) && count($images_result['succeed_images']) > 0){
								foreach ($images_result['succeed_images'] as $suc_img_num => $suc_img) {
									$suc_imgs[] = $suc_img;
								}

								$insert_committeemembers_data_array['images'] = implode(',', $suc_imgs);
							} else {
								$insert_committeemembers_data_array['images'] = false;
							}
						}
					}
					
				} else {
					$insert_committeemembers_data_array['images'] = false;
				}
				// for committeemembers images

				// for edit images only
				if(isset($insert_committeemembers_data_array['add_image'])){
					if (count($insert_committeemembers_data_array['add_image']) > 0)
					{
						if(!empty($insert_committeemembers_data_array['images'])){
							$insert_committeemembers_data_array['images'] = explode(',', $insert_committeemembers_data_array['images']);
							$insert_committeemembers_data_array['images'] = array_merge($insert_committeemembers_data_array['add_image'], $insert_committeemembers_data_array['images']);
							$insert_committeemembers_data_array['add_image'] = false;
							$insert_committeemembers_data_array['images'] = implode(',', $insert_committeemembers_data_array['images']);
						} else {
							$insert_committeemembers_data_array['images'] = $insert_committeemembers_data_array['add_image'];
							$insert_committeemembers_data_array['add_image'] = false;
							$insert_committeemembers_data_array['images'] = implode(',', $insert_committeemembers_data_array['images']);
						}
					}
				}
				// for edit images only

				// for committeemembers videos
				if(isset($insert_committeemembers_data_array['videos']) && count($insert_committeemembers_data_array['videos']) > 0)
				{
					$real_videos = array();
					foreach ($insert_committeemembers_data_array['videos'] as $vid_num => $vid)
					{
						if(!empty($vid)){
							$real_videos[] = $vid;
						}
					}

					if(count($real_videos) > 0){
						$insert_committeemembers_data_array['videos'] = implode(',', $real_videos);
					} else {
						$insert_committeemembers_data_array['videos'] = false;
					}
				}
				// for committeemembers videos


				//$this->pre($insert_committeemembers_data_array);exit;

				$this->Committeemember->set($insert_committeemembers_data_array);

				if ($this->Committeemember->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Committeemember->save($insert_committeemembers_data_array);
					//$_SESSION['success_msg'] = "Committeemembers Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'committeemembers/lists/');

	                $this->Committeemember->save($insert_committeemembers_data_array);
					$_SESSION['success_msg'] = "Committeemembers Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'committeemembers/lists/');
				}
				else
				{
				    $save_errors = $this->Committeemember->validationErrors;

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
				    //$this->pre($this->data['Committeemember']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('committeemembers_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$committeemembers_data = $this->Committeemember->find('first', array('conditions' => array('id' => $committeemembersId)));

		$this->loadmodel('CommitteemembersCategory');
		$committeemembers_categories_data = $this->CommitteemembersCategory->find('all', array('conditions' => array('status IN'=> array(0,1))));
		$committeemembers_data['Committeemember']['all_categories'] = $committeemembers_categories_data;

		$this->set('committeemembers_data',$committeemembers_data);
	}

	public function admin_delete() {

		$this->loadmodel('Committeemember');

		$committeemembersId = $this->params['named']['committeemembersId'];
		
		$this->Committeemember->id = $this->Committeemember->field('id', array('id' => $committeemembersId));

		$this->Committeemember->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Committeemember->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted committeemembers";
		$return_url = DEFAULT_ADMINURL.'committeemembers/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['committeememberss_checks']);exit;
		if(isset($this->data['committeemembers_checks']))
        {
            $committeemembersSelectedArr = $this->data['committeemembers_checks'];
            $committeemembersNum = count($committeemembersSelectedArr);

            if($committeemembersNum > 0)
            {
            	$this->loadmodel('Committeemember');

                $deletedCount = 0;

                foreach ($committeemembersSelectedArr as $committeemembersDelKey => $committeemembersToDelete) {
                    //var_dump($committeemembersToDelete);

                    $this->Committeemember->id = $this->Committeemember->field('id', array('id' => $committeemembersToDelete));
                    if ($this->Committeemember->id)
                    {
                        //$this->pre($this->Committeemember);exit;
                        $thisDelete = $this->Committeemember->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Committeemember->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted for ".$deletedCount." committeemembers.";
                $return_url = DEFAULT_ADMINURL.'committeemembers/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any committeemembers.";
                $return_url = DEFAULT_ADMINURL.'committeemembers/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'committeemembers/lists';
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
	         	$search_key = trim($this->request->data['committeemembersSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	         		"OR" => array(
	            		"Committeemembers.title LIKE" => "%".$search_key."%",
	            		"Committeemembers.content LIKE" => "%".$search_key."%"
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

	   	$this->loadmodel('Committeemember');
	   	$committeemembers_data = $this->paginate('Committeemember');

	   	//$this->pre($committeemembers_data);exit;

	   	$this->set('page_heading','Committeemembers List');

	   	$this->set('committeemembers',$committeemembers_data);

	   	$this->set('from_search',true);

	   	$this->render('/Committeemembers/admin_lists');
	}

}