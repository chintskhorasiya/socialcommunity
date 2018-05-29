<?php
class GotrasController extends AppController
{
	var $name = 'Gotras';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Gotras:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $gotras_data = $this->paginate('Gotra');

        $this->set('page_heading','Gotra');
        $this->set('gotras_data',$gotras_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_gotras_data_array = $this->data['Gotra'];
			$insert_gotras_data_array['created'] = date('Y-m-d H:i:s');
			$insert_gotras_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_gotras_data_array['user_id'] = $userid;

			if (!empty($insert_gotras_data_array['source']['error']) && $insert_gotras_data_array['source']['error']==4 && $insert_gotras_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_gotras_data_array['source']);
	        }
			//$insert_gotras_data_array['source'] = "some image";
			//$insert_gotras_data_array['link'] = "http://www.google.com";
			//$insert_gotras_data_array['position'] = "home_top_left";

			//$this->pre($insert_gotras_data_array);exit;

			$this->Gotra->set($insert_gotras_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Gotra->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Gotra->validates())
			{
				
				//echo "validates true";exit;
				//$this->pre($insert_gotras_data_array);exit;
			 	$save = $this->Gotra->save($insert_gotras_data_array, false);
				$_SESSION['success_msg'] = "Gotra Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'gotras/lists/');
			}
			else
			{
			    $save_errors = $this->Gotra->validationErrors;

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
			    //$this->pre($this->data['Gotra']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('gotras_data',$this->data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_gotras_data_array = array();
			$insert_gotras_data_array['Gotra']['title'] = '';
			$insert_gotras_data_array['Gotra']['status'] = '1';
			$this->set('gotras_data',$insert_gotras_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Gotra")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_gotras_data_array = $this->data['Gotra'];
				$insert_gotras_data_array['id'] = $adId;
				//$insert_gotras_data_array['created'] = date('Y-m-d H:i:s');
				$insert_gotras_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_gotras_data_array['user_id'] = $userid;
				//$this->pre($insert_gotras_data_array);exit;

				//$insert_gotras_data_array['source'] = "some image";
				//$insert_gotras_data_array['link'] = "http://www.google.com";
				//$insert_gotras_data_array['position'] = "home_top_left";

				//$this->pre($insert_gotras_data_array);exit;
				$this->Gotra->set($insert_gotras_data_array);

				if ($this->Gotra->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Gotra->save($insert_gotras_data_array);
					//$_SESSION['success_msg'] = "Gotra Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'gotras/lists/');
					/*if (!empty($insert_gotras_data_array['source']['error']) && $insert_gotras_data_array['source']['error']==4 && $insert_gotras_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_gotras_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Gotra->data['Gotra']['filepath']) && is_string($this->Gotra->data['Gotra']['filepath'])) {
							$insert_gotras_data_array['source'] = $this->Gotra->data['Gotra']['filepath'];
						}
			        }*/

					//$this->pre($insert_gotras_data_array);exit;

	                

					$this->Gotra->save($insert_gotras_data_array, false);
					$_SESSION['success_msg'] = "Gotra Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'gotras/lists/');
				}
				else
				{
				    $save_errors = $this->Gotra->validationErrors;

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
				    //$this->pre($this->data['Gotra']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('gotras_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$gotras_data = $this->Gotra->find('first', array('conditions' => array('id' => $adId)));

		$this->set('gotras_data',$gotras_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Gotra->id = $this->Gotra->field('id', array('id' => $adId));

		$this->Gotra->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Gotra->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Gotra";
		$return_url = DEFAULT_ADMINURL.'gotras/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['Gotras_checks']))
        {
            $GotrasSelectedArr = $this->data['Gotras_checks'];
            $GotrasNum = count($GotrasSelectedArr);

            if($GotrasNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($GotrasSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Gotra->id = $this->Gotra->field('id', array('id' => $pageToDelete));
                    if ($this->Gotra->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Gotra->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Gotra->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Gotra(s).";
                $return_url = DEFAULT_ADMINURL.'gotras/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Gotra.";
                $return_url = DEFAULT_ADMINURL.'gotras/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'gotras/lists';
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
	         	$search_key = trim($this->request->data['GotrasSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Gotra.title LIKE" => "%".$search_key."%"
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

        $gotras_data = $this->paginate('Gotra');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Gotras List');
        $this->set('gotras_data',$gotras_data);

	   	$this->set('from_search',true);

	   	$this->render('/Gotras/admin_lists');
	}

}