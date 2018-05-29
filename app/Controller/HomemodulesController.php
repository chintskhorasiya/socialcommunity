<?php
class HomemodulesController extends AppController
{
	var $name = 'Homemodules';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Homemodules:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $homemodules_data = $this->paginate('Homemodule');

        $this->set('page_heading','Homemodules');
        $this->set('homemodules_data',$homemodules_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_homemodules_data_array = $this->data['Homemodule'];
			$insert_homemodules_data_array['created'] = date('Y-m-d H:i:s');
			$insert_homemodules_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_homemodules_data_array['user_id'] = $userid;

			if (!empty($insert_homemodules_data_array['source']['error']) && $insert_homemodules_data_array['source']['error']==4 && $insert_homemodules_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_homemodules_data_array['source']);
	        }
			//$insert_homemodules_data_array['source'] = "some image";
			//$insert_homemodules_data_array['link'] = "http://www.google.com";
			//$insert_homemodules_data_array['position'] = "home_top_left";

			//$this->pre($insert_homemodules_data_array);exit;

			$this->Homemodule->set($insert_homemodules_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Homemodule->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Homemodule->validates())
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Homemodule->data['Homemodule']['filepath']) && is_string($this->Homemodule->data['Homemodule']['filepath'])) {
					$insert_homemodules_data_array['source'] = $this->Homemodule->data['Homemodule']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_homemodules_data_array);exit;
			 	$save = $this->Homemodule->save($insert_homemodules_data_array, false);
				$_SESSION['success_msg'] = "Homemodule Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'homemodules/lists/');
			}
			else
			{
			    $save_errors = $this->Homemodule->validationErrors;

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
			    //$this->pre($this->data['Homemodule']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('homemodules_data',$this->data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_homemodules_data_array = array();
			$insert_homemodules_data_array['Homemodule']['title'] = '';
			$insert_homemodules_data_array['Homemodule']['slug'] = '';
			$insert_homemodules_data_array['Homemodule']['content'] = '';
			$insert_homemodules_data_array['Homemodule']['status'] = '1';
			$this->set('homemodules_data',$insert_homemodules_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Homemodule")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_homemodules_data_array = $this->data['Homemodule'];
				$insert_homemodules_data_array['id'] = $adId;
				//$insert_homemodules_data_array['created'] = date('Y-m-d H:i:s');
				$insert_homemodules_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_homemodules_data_array['user_id'] = $userid;
				//$this->pre($insert_homemodules_data_array);exit;

				//$insert_homemodules_data_array['source'] = "some image";
				//$insert_homemodules_data_array['link'] = "http://www.google.com";
				//$insert_homemodules_data_array['position'] = "home_top_left";

				//$this->pre($insert_homemodules_data_array);exit;
				$this->Homemodule->set($insert_homemodules_data_array);

				if ($this->Homemodule->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Homemodule->save($insert_homemodules_data_array);
					//$_SESSION['success_msg'] = "Homemodule Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'homemodules/lists/');
					if (!empty($insert_homemodules_data_array['source']['error']) && $insert_homemodules_data_array['source']['error']==4 && $insert_homemodules_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_homemodules_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Homemodule->data['Homemodule']['filepath']) && is_string($this->Homemodule->data['Homemodule']['filepath'])) {
							$insert_homemodules_data_array['source'] = $this->Homemodule->data['Homemodule']['filepath'];
						}
			        }

					//$this->pre($insert_homemodules_data_array);exit;

	                

					$this->Homemodule->save($insert_homemodules_data_array, false);
					$_SESSION['success_msg'] = "Homemodule Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'homemodules/lists/');
				}
				else
				{
				    $save_errors = $this->Homemodule->validationErrors;

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
				    //$this->pre($this->data['Homemodule']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('homemodules_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$homemodules_data = $this->Homemodule->find('first', array('conditions' => array('id' => $adId)));

		$this->set('homemodules_data',$homemodules_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Homemodule->id = $this->Homemodule->field('id', array('id' => $adId));

		$this->Homemodule->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Homemodule->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Homemodule";
		$return_url = DEFAULT_ADMINURL.'homemodules/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['homemodules_checks']))
        {
            $adsSelectedArr = $this->data['homemodules_checks'];
            $adsNum = count($adsSelectedArr);

            if($adsNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($adsSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Homemodule->id = $this->Homemodule->field('id', array('id' => $pageToDelete));
                    if ($this->Homemodule->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Homemodule->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Homemodule->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Homemodule(s).";
                $return_url = DEFAULT_ADMINURL.'homemodules/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Homemodule.";
                $return_url = DEFAULT_ADMINURL.'homemodules/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'homemodules/lists';
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
	         	$search_key = trim($this->request->data['homemodulesSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Homemodule.title LIKE" => "%".$search_key."%"
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

        $homemodules_data = $this->paginate('Homemodule');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Homemodules List');
        $this->set('homemodules_data',$homemodules_data);

	   	$this->set('from_search',true);

	   	$this->render('/Homemodules/admin_lists');
	}

}