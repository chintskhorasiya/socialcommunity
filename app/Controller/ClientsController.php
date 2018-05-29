<?php
class ClientsController extends AppController
{
	var $name = 'Clients';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Clients:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $clients_data = $this->paginate('Client');

        $this->set('page_heading','Clients');
        $this->set('clients_data',$clients_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_clients_data_array = $this->data['Client'];
			$insert_clients_data_array['created'] = date('Y-m-d H:i:s');
			$insert_clients_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_clients_data_array['user_id'] = $userid;

			if (!empty($insert_clients_data_array['source']['error']) && $insert_clients_data_array['source']['error']==4 && $insert_clients_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_clients_data_array['source']);
	        }
			//$insert_clients_data_array['source'] = "some image";
			//$insert_clients_data_array['link'] = "http://www.google.com";
			//$insert_clients_data_array['position'] = "home_top_left";

			//$this->pre($insert_clients_data_array);exit;

			$this->Client->set($insert_clients_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Client->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Client->validates())
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Client->data['Client']['filepath']) && is_string($this->Client->data['Client']['filepath'])) {
					$insert_clients_data_array['source'] = $this->Client->data['Client']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_clients_data_array);exit;
			 	$save = $this->Client->save($insert_clients_data_array, false);
				$_SESSION['success_msg'] = "Client Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'clients/lists/');
			}
			else
			{
			    $save_errors = $this->Client->validationErrors;

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
			    //$this->pre($this->data['Client']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('clients_data',$this->data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_clients_data_array = array();
			$insert_clients_data_array['Client']['title'] = '';
			$insert_clients_data_array['Client']['slug'] = '';
			$insert_clients_data_array['Client']['content'] = '';
			$insert_clients_data_array['Client']['status'] = '1';
			$this->set('clients_data',$insert_clients_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Client")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_clients_data_array = $this->data['Client'];
				$insert_clients_data_array['id'] = $adId;
				//$insert_clients_data_array['created'] = date('Y-m-d H:i:s');
				$insert_clients_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_clients_data_array['user_id'] = $userid;
				//$this->pre($insert_clients_data_array);exit;

				//$insert_clients_data_array['source'] = "some image";
				//$insert_clients_data_array['link'] = "http://www.google.com";
				//$insert_clients_data_array['position'] = "home_top_left";

				//$this->pre($insert_clients_data_array);exit;
				$this->Client->set($insert_clients_data_array);

				if ($this->Client->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Client->save($insert_clients_data_array);
					//$_SESSION['success_msg'] = "Client Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'clients/lists/');
					if (!empty($insert_clients_data_array['source']['error']) && $insert_clients_data_array['source']['error']==4 && $insert_clients_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_clients_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Client->data['Client']['filepath']) && is_string($this->Client->data['Client']['filepath'])) {
							$insert_clients_data_array['source'] = $this->Client->data['Client']['filepath'];
						}
			        }

					//$this->pre($insert_clients_data_array);exit;

	                

					$this->Client->save($insert_clients_data_array, false);
					$_SESSION['success_msg'] = "Client Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'clients/lists/');
				}
				else
				{
				    $save_errors = $this->Client->validationErrors;

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
				    //$this->pre($this->data['Client']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('clients_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$clients_data = $this->Client->find('first', array('conditions' => array('id' => $adId)));

		$this->set('clients_data',$clients_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Client->id = $this->Client->field('id', array('id' => $adId));

		$this->Client->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Client->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Client";
		$return_url = DEFAULT_ADMINURL.'clients/lists';
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

                    $this->Client->id = $this->Client->field('id', array('id' => $pageToDelete));
                    if ($this->Client->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Client->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Client->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Client(s).";
                $return_url = DEFAULT_ADMINURL.'clients/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Client.";
                $return_url = DEFAULT_ADMINURL.'clients/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'clients/lists';
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
	            	"Client.title LIKE" => "%".$search_key."%"
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

        $clients_data = $this->paginate('Client');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Clients List');
        $this->set('clients_data',$clients_data);

	   	$this->set('from_search',true);

	   	$this->render('/Clients/admin_lists');
	}

}