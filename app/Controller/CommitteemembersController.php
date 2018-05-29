<?php
class CommitteemembersController extends AppController
{
	var $name = 'Committeemembers';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Committeemembers:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $committeemembers_data = $this->paginate('Committeemember');

        $this->set('page_heading','Committee Members');
        $this->set('committeemembers_data',$committeemembers_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$customValidate = true;

			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
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

			if (!empty($insert_committeemembers_data_array['source']['error']) && $insert_committeemembers_data_array['source']['error']==4 && $insert_committeemembers_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_committeemembers_data_array['source']);
	        }
			//$insert_committeemembers_data_array['source'] = "some image";
			//$insert_committeemembers_data_array['link'] = "http://www.google.com";
			//$insert_committeemembers_data_array['position'] = "home_top_left";

			//$this->pre($insert_committeemembers_data_array);exit;

			$this->Committeemember->set($insert_committeemembers_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Committeemember->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Committeemember->validates() && $customValidate)
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Committeemember->data['Committeemember']['filepath']) && is_string($this->Committeemember->data['Committeemember']['filepath'])) {
					$insert_committeemembers_data_array['source'] = $this->Committeemember->data['Committeemember']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_committeemembers_data_array);exit;
			 	$save = $this->Committeemember->save($insert_committeemembers_data_array, false);
				$_SESSION['success_msg'] = "Committeemember Added Successfully";
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

			    if(count($customErrors) > 0)
			    {
			    	foreach ($customErrors as $errKey => $custom_error) {
			    		$errors_html .= "<li>".$custom_error."</li>";	
			    	}
			    }

			    $errors_html .= "</ul>";

			    //$this->pre($errors_html);exit;
			    //$this->pre($this->data['Committeemember']);exit;

			    $committeemembers_data['Committeemember'] = $this->data['Committeemember'];

			    $this->loadmodel('CommitteemembersCategory');
				$committeemembers_categories_data = $this->CommitteemembersCategory->find('all', array('conditions' => array('status IN'=> array(1))));
				$committeemembers_data['Committeemember']['all_categories'] = $committeemembers_categories_data;

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
			$committeemembers_categories_data = $this->CommitteemembersCategory->find('all', array('conditions' => array('status IN'=> array(1))));

			//$this->pre($committeemembers_categories_data);exit;

			$insert_committeemembers_data_array['Committeemember']['all_categories'] = $committeemembers_categories_data;

			$this->set('committeemembers_data',$insert_committeemembers_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Committeemember")
			//{
				$customValidate = true;

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_committeemembers_data_array = $this->data['Committeemember'];
				$insert_committeemembers_data_array['id'] = $adId;
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

				//$insert_committeemembers_data_array['source'] = "some image";
				//$insert_committeemembers_data_array['link'] = "http://www.google.com";
				//$insert_committeemembers_data_array['position'] = "home_top_left";

				//$this->pre($insert_committeemembers_data_array);exit;
				$this->Committeemember->set($insert_committeemembers_data_array);

				if ($this->Committeemember->validates() && $customValidate)
				{
					//echo "validates true";exit;
				 	//$save = $this->Committeemember->save($insert_committeemembers_data_array);
					//$_SESSION['success_msg'] = "Committeemember Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'committeemembers/lists/');
					if (!empty($insert_committeemembers_data_array['source']['error']) && $insert_committeemembers_data_array['source']['error']==4 && $insert_committeemembers_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_committeemembers_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Committeemember->data['Committeemember']['filepath']) && is_string($this->Committeemember->data['Committeemember']['filepath'])) {
							$insert_committeemembers_data_array['source'] = $this->Committeemember->data['Committeemember']['filepath'];
						}
			        }

					//$this->pre($insert_committeemembers_data_array);exit;

	                

					$this->Committeemember->save($insert_committeemembers_data_array, false);
					$_SESSION['success_msg'] = "Committeemember Updated Successfully";
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
		
		$committeemembers_data = $this->Committeemember->find('first', array('conditions' => array('id' => $adId)));

		$this->loadmodel('CommitteemembersCategory');
		$committeemembers_categories_data = $this->CommitteemembersCategory->find('all', array('conditions' => array('status IN'=> array(1))));
		$committeemembers_data['Committeemember']['all_categories'] = $committeemembers_categories_data;

		$this->set('committeemembers_data',$committeemembers_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Committeemember->id = $this->Committeemember->field('id', array('id' => $adId));

		$this->Committeemember->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Committeemember->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Committeemember";
		$return_url = DEFAULT_ADMINURL.'committeemembers/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['Committeemembers_checks']))
        {
            $CommitteemembersSelectedArr = $this->data['Committeemembers_checks'];
            $CommitteemembersNum = count($CommitteemembersSelectedArr);

            if($CommitteemembersNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($CommitteemembersSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Committeemember->id = $this->Committeemember->field('id', array('id' => $pageToDelete));
                    if ($this->Committeemember->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Committeemember->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Committeemember->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Committeemember(s).";
                $return_url = DEFAULT_ADMINURL.'committeemembers/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Committeemember.";
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
	         	$search_key = trim($this->request->data['CommitteemembersSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Committeemember.name LIKE" => "%".$search_key."%"
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

	    $this->paginate = array(
            'conditions' => $allConditions,
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $committeemembers_data = $this->paginate('Committeemember');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Committeemembers List');
        $this->set('committeemembers_data',$committeemembers_data);

	   	$this->set('from_search',true);

	   	$this->render('/Committeemembers/admin_lists');
	}

}