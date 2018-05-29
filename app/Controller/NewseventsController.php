<?php
class NewseventsController extends AppController
{
	var $name = 'Newsevents';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Newsevents:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $newsevents_data = $this->paginate('Newsevent');

        $this->set('page_heading','News & Events');
        $this->set('newsevents_data',$newsevents_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_newsevents_data_array = $this->data['Newsevent'];
			$insert_newsevents_data_array['created'] = date('Y-m-d H:i:s');
			$insert_newsevents_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_newsevents_data_array['user_id'] = $userid;

			if (!empty($insert_newsevents_data_array['source']['error']) && $insert_newsevents_data_array['source']['error']==4 && $insert_newsevents_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_newsevents_data_array['source']);
	        }
			//$insert_newsevents_data_array['source'] = "some image";
			//$insert_newsevents_data_array['link'] = "http://www.google.com";
			//$insert_newsevents_data_array['position'] = "home_top_left";

			//$this->pre($insert_newsevents_data_array);exit;

			$this->Newsevent->set($insert_newsevents_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Newsevent->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Newsevent->validates())
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Newsevent->data['Newsevent']['filepath']) && is_string($this->Newsevent->data['Newsevent']['filepath'])) {
					$insert_newsevents_data_array['source'] = $this->Newsevent->data['Newsevent']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_newsevents_data_array);exit;
			 	$save = $this->Newsevent->save($insert_newsevents_data_array, false);
				$_SESSION['success_msg'] = "Newsevent Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'newsevents/lists/');
			}
			else
			{
			    $save_errors = $this->Newsevent->validationErrors;

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
			    //$this->pre($this->data['Newsevent']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('newsevents_data',$this->data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_newsevents_data_array = array();
			$insert_newsevents_data_array['Newsevent']['title'] = '';
			$insert_newsevents_data_array['Newsevent']['slug'] = '';
			$insert_newsevents_data_array['Newsevent']['content'] = '';
			$insert_newsevents_data_array['Newsevent']['status'] = '1';
			$this->set('newsevents_data',$insert_newsevents_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Newsevent")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_newsevents_data_array = $this->data['Newsevent'];
				$insert_newsevents_data_array['id'] = $adId;
				//$insert_newsevents_data_array['created'] = date('Y-m-d H:i:s');
				$insert_newsevents_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_newsevents_data_array['user_id'] = $userid;
				//$this->pre($insert_newsevents_data_array);exit;

				//$insert_newsevents_data_array['source'] = "some image";
				//$insert_newsevents_data_array['link'] = "http://www.google.com";
				//$insert_newsevents_data_array['position'] = "home_top_left";

				//$this->pre($insert_newsevents_data_array);exit;
				$this->Newsevent->set($insert_newsevents_data_array);

				if ($this->Newsevent->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Newsevent->save($insert_newsevents_data_array);
					//$_SESSION['success_msg'] = "Newsevent Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'newsevents/lists/');
					if (!empty($insert_newsevents_data_array['source']['error']) && $insert_newsevents_data_array['source']['error']==4 && $insert_newsevents_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_newsevents_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Newsevent->data['Newsevent']['filepath']) && is_string($this->Newsevent->data['Newsevent']['filepath'])) {
							$insert_newsevents_data_array['source'] = $this->Newsevent->data['Newsevent']['filepath'];
						}
			        }

					//$this->pre($insert_newsevents_data_array);exit;

	                

					$this->Newsevent->save($insert_newsevents_data_array, false);
					$_SESSION['success_msg'] = "Newsevent Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'newsevents/lists/');
				}
				else
				{
				    $save_errors = $this->Newsevent->validationErrors;

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
				    //$this->pre($this->data['Newsevent']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('newsevents_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$newsevents_data = $this->Newsevent->find('first', array('conditions' => array('id' => $adId)));

		$this->set('newsevents_data',$newsevents_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Newsevent->id = $this->Newsevent->field('id', array('id' => $adId));

		$this->Newsevent->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Newsevent->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Newsevent";
		$return_url = DEFAULT_ADMINURL.'newsevents/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['Newsevents_checks']))
        {
            $NewseventsSelectedArr = $this->data['Newsevents_checks'];
            $NewseventsNum = count($NewseventsSelectedArr);

            if($NewseventsNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($NewseventsSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Newsevent->id = $this->Newsevent->field('id', array('id' => $pageToDelete));
                    if ($this->Newsevent->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Newsevent->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Newsevent->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Newsevent(s).";
                $return_url = DEFAULT_ADMINURL.'newsevents/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Newsevent.";
                $return_url = DEFAULT_ADMINURL.'newsevents/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'newsevents/lists';
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
	         	$search_key = trim($this->request->data['NewseventsSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Newsevent.title LIKE" => "%".$search_key."%"
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

        $newsevents_data = $this->paginate('Newsevent');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Newsevents List');
        $this->set('newsevents_data',$newsevents_data);

	   	$this->set('from_search',true);

	   	$this->render('/Newsevents/admin_lists');
	}

}