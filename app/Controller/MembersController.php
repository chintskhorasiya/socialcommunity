<?php
class MembersController extends AppController
{
	var $name = 'Members';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Members:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array(/*'user_id'=>$userid,*/'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $members_data = $this->paginate('Member');

        $this->set('page_heading','Committee Members');
        $this->set('members_data',$members_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$customValidate = true;

			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_members_data_array = $this->data['Member'];
			$insert_members_data_array['created'] = date('Y-m-d H:i:s');
			$insert_members_data_array['modified'] = date('Y-m-d H:i:s');
			//$insert_members_data_array['user_id'] = $userid;

			if (!empty($insert_members_data_array['source']['error']) && $insert_members_data_array['source']['error']==4 && $insert_members_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_members_data_array['source']);
	        }
			
			$this->Member->set($insert_members_data_array);

			if ($this->Member->validates() && $customValidate)
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Member->data['Member']['filepath']) && is_string($this->Member->data['Member']['filepath'])) {
					$insert_members_data_array['source'] = $this->Member->data['Member']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_members_data_array);exit;
			 	$save = $this->Member->save($insert_members_data_array, false);
				$_SESSION['success_msg'] = "Member Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'members/lists/');
			}
			else
			{
			    $save_errors = $this->Member->validationErrors;

			    //$this->pre($save_errors);exit;
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
			    //$this->pre($this->data['Member']);exit;

			    $members_data['Member'] = $this->data['Member'];

			    $this->loadmodel('MembersCategory');
				$members_categories_data = $this->MembersCategory->find('all', array('conditions' => array('status IN'=> array(1))));
				$members_data['Member']['all_categories'] = $members_categories_data;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('members_data',$members_data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_members_data_array = array();
			$insert_members_data_array['Member']['title'] = '';
			$insert_members_data_array['Member']['slug'] = '';
			$insert_members_data_array['Member']['content'] = '';
			$insert_members_data_array['Member']['status'] = '1';

			$this->loadmodel('MembersCategory');
			$members_categories_data = $this->MembersCategory->find('all', array('conditions' => array('status IN'=> array(1))));

			//$this->pre($members_categories_data);exit;

			$insert_members_data_array['Member']['all_categories'] = $members_categories_data;

			$this->set('members_data',$insert_members_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Member")
			//{
				$customValidate = true;

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_members_data_array = $this->data['Member'];
				$insert_members_data_array['id'] = $adId;
				//$insert_members_data_array['created'] = date('Y-m-d H:i:s');
				$insert_members_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_members_data_array['user_id'] = $userid;
				//$this->pre($insert_members_data_array);exit;

				$this->Member->set($insert_members_data_array);

				if ($this->Member->validates() && $customValidate)
				{
					//echo "validates true";exit;
				 	//$save = $this->Member->save($insert_members_data_array);
					//$_SESSION['success_msg'] = "Member Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'members/lists/');
					if (!empty($insert_members_data_array['source']['error']) && $insert_members_data_array['source']['error']==4 && $insert_members_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_members_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Member->data['Member']['filepath']) && is_string($this->Member->data['Member']['filepath'])) {
							$insert_members_data_array['source'] = $this->Member->data['Member']['filepath'];
						}
			        }

					//$this->pre($insert_members_data_array);exit;

	                

					$this->Member->save($insert_members_data_array, false);
					$_SESSION['success_msg'] = "Member Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'members/lists/');
				}
				else
				{
				    $save_errors = $this->Member->validationErrors;

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
				    //$this->pre($this->data['Member']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('members_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$members_data = $this->Member->find('first', array('conditions' => array('id' => $adId)));

		$this->loadmodel('MembersCategory');
		$members_categories_data = $this->MembersCategory->find('all', array('conditions' => array('status IN'=> array(1))));
		$members_data['Member']['all_categories'] = $members_categories_data;

		$this->set('members_data',$members_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Member->id = $this->Member->field('id', array('id' => $adId));

		$this->Member->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Member->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Member";
		$return_url = DEFAULT_ADMINURL.'members/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['Members_checks']))
        {
            $MembersSelectedArr = $this->data['Members_checks'];
            $MembersNum = count($MembersSelectedArr);

            if($MembersNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($MembersSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Member->id = $this->Member->field('id', array('id' => $pageToDelete));
                    if ($this->Member->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Member->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Member->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Member(s).";
                $return_url = DEFAULT_ADMINURL.'members/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Member.";
                $return_url = DEFAULT_ADMINURL.'members/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'members/lists';
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
	         	$search_key = trim($this->request->data['MembersSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Member.name LIKE" => "%".$search_key."%"
	         	);

	         	$this->Session->write('searchCond', $conditions);
         		$this->Session->write('search_key', $search_key);
	      	}
	    }

	    //$mainConditions = array('user_id'=>$userid, 'status IN'=> array(0,1));

	    if ($this->Session->check('searchCond')) {
	    	$conditions = $this->Session->read('searchCond');
	    	$allConditions = array_merge($mainConditions, $conditions);
	   	} else {
	      	$conditions = null;
	      	$allConditions = array_merge($mainConditions, $conditions);
	   	}

	    $this->paginate = array(
            'conditions' => $allConditions,
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $members_data = $this->paginate('Member');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Members List');
        $this->set('members_data',$members_data);

	   	$this->set('from_search',true);

	   	$this->render('/Members/admin_lists');
	}

}