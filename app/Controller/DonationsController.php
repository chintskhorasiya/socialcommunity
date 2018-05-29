<?php
class DonationsController extends AppController
{
	var $name = 'Donations';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Donations:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $donations_data = $this->paginate('Donation');

        $this->set('page_heading','Donors');
        $this->set('donations_data',$donations_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$customValidate = true;

			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_donations_data_array = $this->data['Donation'];
			$insert_donations_data_array['created'] = date('Y-m-d H:i:s');
			$insert_donations_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_donations_data_array['user_id'] = $userid;

			// for donations categories
			/*if(is_array($insert_donations_data_array['categories']) && count($insert_donations_data_array['categories']) > 0)
			{
				$insert_donations_data_array['categories'] = implode(',', $insert_donations_data_array['categories']);
			}
			else
			{
				$insert_donations_data_array['categories'] = '';
				$customValidate = false;
				$customErrors[] = 'Please select one or more categories';
			}*/
			// for donations categories

			if (!empty($insert_donations_data_array['propic']['error']) && $insert_donations_data_array['propic']['error']==4 && $insert_donations_data_array['propic']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_donations_data_array['propic']);
	        }
			//$insert_donations_data_array['propic'] = "some image";
			//$insert_donations_data_array['link'] = "http://www.google.com";
			//$insert_donations_data_array['position'] = "home_top_left";

			//$this->pre($insert_donations_data_array);exit;

			$this->Donation->set($insert_donations_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Donation->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Donation->validates() && $customValidate)
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Donation->data['Donation']['filepath']) && is_string($this->Donation->data['Donation']['filepath'])) {
					$insert_donations_data_array['propic'] = $this->Donation->data['Donation']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_donations_data_array);exit;
			 	$save = $this->Donation->save($insert_donations_data_array, false);
				$_SESSION['success_msg'] = "Donor Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'donations/lists/');
			}
			else
			{
			    $save_errors = $this->Donation->validationErrors;

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
			    //$this->pre($this->data['Donation']);exit;

			    $donations_data['Donation'] = $this->data['Donation'];

			    //$this->loadmodel('DonationsCategory');
				//$donations_categories_data = $this->DonationsCategory->find('all', array('conditions' => array('status IN'=> array(1))));
				//$donations_data['Donation']['all_categories'] = $donations_categories_data;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('donations_data',$donations_data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_donations_data_array = array();
			$insert_donations_data_array['Donation']['title'] = '';
			$insert_donations_data_array['Donation']['slug'] = '';
			$insert_donations_data_array['Donation']['content'] = '';
			$insert_donations_data_array['Donation']['status'] = '1';

			//$this->loadmodel('DonationsCategory');
			//$donations_categories_data = $this->DonationsCategory->find('all', array('conditions' => array('status IN'=> array(1))));

			//$this->pre($donations_categories_data);exit;

			//$insert_donations_data_array['Donation']['all_categories'] = $donations_categories_data;

			$this->set('donations_data',$insert_donations_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Donation")
			//{
				$customValidate = true;

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_donations_data_array = $this->data['Donation'];
				$insert_donations_data_array['id'] = $adId;
				//$insert_donations_data_array['created'] = date('Y-m-d H:i:s');
				$insert_donations_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_donations_data_array['user_id'] = $userid;
				//$this->pre($insert_donations_data_array);exit;

				//$insert_donations_data_array['propic'] = "some image";
				//$insert_donations_data_array['link'] = "http://www.google.com";
				//$insert_donations_data_array['position'] = "home_top_left";

				//$this->pre($insert_donations_data_array);exit;
				$this->Donation->set($insert_donations_data_array);

				if ($this->Donation->validates() && $customValidate)
				{
					//echo "validates true";exit;
				 	//$save = $this->Donation->save($insert_donations_data_array);
					//$_SESSION['success_msg'] = "Donation Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'donations/lists/');
					if (!empty($insert_donations_data_array['propic']['error']) && $insert_donations_data_array['propic']['error']==4 && $insert_donations_data_array['propic']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_donations_data_array['propic']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Donation->data['Donation']['filepath']) && is_string($this->Donation->data['Donation']['filepath'])) {
							$insert_donations_data_array['propic'] = $this->Donation->data['Donation']['filepath'];
						}
			        }

					//$this->pre($insert_donations_data_array);exit;

	                

					$this->Donation->save($insert_donations_data_array, false);
					$_SESSION['success_msg'] = "Donor Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'donations/lists/');
				}
				else
				{
				    $save_errors = $this->Donation->validationErrors;

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
				    //$this->pre($this->data['Donation']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('donations_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$donations_data = $this->Donation->find('first', array('conditions' => array('id' => $adId)));

		//$this->loadmodel('DonationsCategory');
		//$donations_categories_data = $this->DonationsCategory->find('all', array('conditions' => array('status IN'=> array(1))));
		//$donations_data['Donation']['all_categories'] = $donations_categories_data;

		$this->set('donations_data',$donations_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Donation->id = $this->Donation->field('id', array('id' => $adId));

		$this->Donation->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Donation->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Donor";
		$return_url = DEFAULT_ADMINURL.'donations/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['Donations_checks']))
        {
            $DonationsSelectedArr = $this->data['Donations_checks'];
            $DonationsNum = count($DonationsSelectedArr);

            if($DonationsNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($DonationsSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Donation->id = $this->Donation->field('id', array('id' => $pageToDelete));
                    if ($this->Donation->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Donation->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Donation->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Donor(s).";
                $return_url = DEFAULT_ADMINURL.'donations/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Donation.";
                $return_url = DEFAULT_ADMINURL.'donations/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'donations/lists';
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
	         	$search_key = trim($this->request->data['DonationsSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Donation.name LIKE" => "%".$search_key."%"
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

        $donations_data = $this->paginate('Donation');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Donors List');
        $this->set('donations_data',$donations_data);

	   	$this->set('from_search',true);

	   	$this->render('/Donations/admin_lists');
	}

}