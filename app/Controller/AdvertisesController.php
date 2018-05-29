<?php
class AdvertisesController extends AppController
{
	var $name = 'Advertises';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Advertises:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $ads_data = $this->paginate('Advertise');

        $this->set('page_heading','Advertises');
        $this->set('ads_data',$ads_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_ads_data_array = $this->data['Advertise'];
			$insert_ads_data_array['created'] = date('Y-m-d H:i:s');
			$insert_ads_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_ads_data_array['user_id'] = $userid;

			if (!empty($insert_ads_data_array['source']['error']) && $insert_ads_data_array['source']['error']==4 && $insert_ads_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_ads_data_array['source']);
	        }
			//$insert_ads_data_array['source'] = "some image";
			//$insert_ads_data_array['link'] = "http://www.google.com";
			//$insert_ads_data_array['position'] = "home_top_left";

			//$this->pre($insert_ads_data_array);exit;

			$this->Advertise->set($insert_ads_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Advertise->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Advertise->validates())
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Advertise->data['Advertise']['filepath']) && is_string($this->Advertise->data['Advertise']['filepath'])) {
					$insert_ads_data_array['source'] = $this->Advertise->data['Advertise']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_ads_data_array);exit;
			 	$save = $this->Advertise->save($insert_ads_data_array, false);
				$_SESSION['success_msg'] = "Advertise Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'advertises/lists/');
			}
			else
			{
			    $save_errors = $this->Advertise->validationErrors;

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
			    //$this->pre($this->data['Advertise']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('ads_data',$this->data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_ads_data_array = array();
			$insert_ads_data_array['Advertise']['title'] = '';
			$insert_ads_data_array['Advertise']['slug'] = '';
			$insert_ads_data_array['Advertise']['content'] = '';
			$insert_ads_data_array['Advertise']['status'] = '1';
			$this->set('ads_data',$insert_ads_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Advertise")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_ads_data_array = $this->data['Advertise'];
				$insert_ads_data_array['id'] = $adId;
				//$insert_ads_data_array['created'] = date('Y-m-d H:i:s');
				$insert_ads_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_ads_data_array['user_id'] = $userid;
				//$this->pre($insert_ads_data_array);exit;

				//$insert_ads_data_array['source'] = "some image";
				//$insert_ads_data_array['link'] = "http://www.google.com";
				//$insert_ads_data_array['position'] = "home_top_left";

				//$this->pre($insert_ads_data_array);exit;
				$this->Advertise->set($insert_ads_data_array);

				if ($this->Advertise->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Advertise->save($insert_ads_data_array);
					//$_SESSION['success_msg'] = "Advertise Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'advertises/lists/');
					if (!empty($insert_ads_data_array['source']['error']) && $insert_ads_data_array['source']['error']==4 && $insert_ads_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_ads_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Advertise->data['Advertise']['filepath']) && is_string($this->Advertise->data['Advertise']['filepath'])) {
							$insert_ads_data_array['source'] = $this->Advertise->data['Advertise']['filepath'];
						}
			        }

					//$this->pre($insert_ads_data_array);exit;

	                

					$this->Advertise->save($insert_ads_data_array, false);
					$_SESSION['success_msg'] = "Advertise Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'advertises/lists/');
				}
				else
				{
				    $save_errors = $this->Advertise->validationErrors;

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
				    //$this->pre($this->data['Advertise']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('ads_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$ads_data = $this->Advertise->find('first', array('conditions' => array('id' => $adId)));

		$this->set('ads_data',$ads_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Advertise->id = $this->Advertise->field('id', array('id' => $adId));

		$this->Advertise->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Advertise->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Advertise";
		$return_url = DEFAULT_ADMINURL.'advertises/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['ads_checks']))
        {
            $adsSelectedArr = $this->data['ads_checks'];
            $adsNum = count($adsSelectedArr);

            if($adsNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($adsSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Advertise->id = $this->Advertise->field('id', array('id' => $pageToDelete));
                    if ($this->Advertise->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Advertise->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Advertise->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Advertise(s).";
                $return_url = DEFAULT_ADMINURL.'advertises/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Advertise.";
                $return_url = DEFAULT_ADMINURL.'advertises/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'advertises/lists';
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
	         	$search_key = trim($this->request->data['adsSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Advertise.title LIKE" => "%".$search_key."%"
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

        $ads_data = $this->paginate('Advertise');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Advertises List');
        $this->set('ads_data',$ads_data);

	   	$this->set('from_search',true);

	   	$this->render('/Advertises/admin_lists');
	}

}