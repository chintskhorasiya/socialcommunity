<?php
class BannersController extends AppController
{
	var $name = 'Banners';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Banners:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $banners_data = $this->paginate('Banner');

        $this->set('page_heading','Banners');
        $this->set('banners_data',$banners_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_banners_data_array = $this->data['Banner'];
			$insert_banners_data_array['created'] = date('Y-m-d H:i:s');
			$insert_banners_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_banners_data_array['user_id'] = $userid;

			if (!empty($insert_banners_data_array['source']['error']) && $insert_banners_data_array['source']['error']==4 && $insert_banners_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_banners_data_array['source']);
	        }
			//$insert_banners_data_array['source'] = "some image";
			//$insert_banners_data_array['link'] = "http://www.google.com";
			//$insert_banners_data_array['position'] = "home_top_left";

			//$this->pre($insert_banners_data_array);exit;

			$this->Banner->set($insert_banners_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Banner->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Banner->validates())
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Banner->data['Banner']['filepath']) && is_string($this->Banner->data['Banner']['filepath'])) {
					$insert_banners_data_array['source'] = $this->Banner->data['Banner']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_banners_data_array);exit;
			 	$save = $this->Banner->save($insert_banners_data_array, false);
				$_SESSION['success_msg'] = "Banner Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'banners/lists/');
			}
			else
			{
			    $save_errors = $this->Banner->validationErrors;

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
			    //$this->pre($this->data['Banner']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('banners_data',$this->data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_banners_data_array = array();
			$insert_banners_data_array['Banner']['title'] = '';
			$insert_banners_data_array['Banner']['slug'] = '';
			$insert_banners_data_array['Banner']['content'] = '';
			$insert_banners_data_array['Banner']['status'] = '1';
			$this->set('banners_data',$insert_banners_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Banner")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_banners_data_array = $this->data['Banner'];
				$insert_banners_data_array['id'] = $adId;
				//$insert_banners_data_array['created'] = date('Y-m-d H:i:s');
				$insert_banners_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_banners_data_array['user_id'] = $userid;
				//$this->pre($insert_banners_data_array);exit;

				//$insert_banners_data_array['source'] = "some image";
				//$insert_banners_data_array['link'] = "http://www.google.com";
				//$insert_banners_data_array['position'] = "home_top_left";

				//$this->pre($insert_banners_data_array);exit;
				$this->Banner->set($insert_banners_data_array);

				if ($this->Banner->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Banner->save($insert_banners_data_array);
					//$_SESSION['success_msg'] = "Banner Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'banners/lists/');
					if (!empty($insert_banners_data_array['source']['error']) && $insert_banners_data_array['source']['error']==4 && $insert_banners_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_banners_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Banner->data['Banner']['filepath']) && is_string($this->Banner->data['Banner']['filepath'])) {
							$insert_banners_data_array['source'] = $this->Banner->data['Banner']['filepath'];
						}
			        }

					//$this->pre($insert_banners_data_array);exit;

	                

					$this->Banner->save($insert_banners_data_array, false);
					$_SESSION['success_msg'] = "Banner Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'banners/lists/');
				}
				else
				{
				    $save_errors = $this->Banner->validationErrors;

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
				    //$this->pre($this->data['Banner']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('banners_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$banners_data = $this->Banner->find('first', array('conditions' => array('id' => $adId)));

		$this->set('banners_data',$banners_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Banner->id = $this->Banner->field('id', array('id' => $adId));

		$this->Banner->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Banner->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Banner";
		$return_url = DEFAULT_ADMINURL.'banners/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['banners_checks']))
        {
            $adsSelectedArr = $this->data['banners_checks'];
            $adsNum = count($adsSelectedArr);

            if($adsNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($adsSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Banner->id = $this->Banner->field('id', array('id' => $pageToDelete));
                    if ($this->Banner->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Banner->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Banner->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Banner(s).";
                $return_url = DEFAULT_ADMINURL.'banners/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Banner.";
                $return_url = DEFAULT_ADMINURL.'banners/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'banners/lists';
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
	         	$search_key = trim($this->request->data['bannersSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Banner.title LIKE" => "%".$search_key."%"
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

        $banners_data = $this->paginate('Banner');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Banners List');
        $this->set('banners_data',$banners_data);

	   	$this->set('from_search',true);

	   	$this->render('/Banners/admin_lists');
	}

}