<?php
class GalleryimagesController extends AppController
{
	var $name = 'Galleryimages';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_lists()
	{
		//echo "in Galleryimages:lists";exit;
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        $this->paginate = array(
            'conditions' => array('user_id'=>$userid, 'status IN'=> array(0,1)),
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $galleryimages_data = $this->paginate('Galleryimage');

        $this->set('page_heading','Gallery Images');
        $this->set('galleryimages_data',$galleryimages_data);

	}

	public function admin_add() {

		if (!empty($this->data))
		{
			$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
			
			$insert_galleryimages_data_array = $this->data['Galleryimage'];
			$insert_galleryimages_data_array['created'] = date('Y-m-d H:i:s');
			$insert_galleryimages_data_array['modified'] = date('Y-m-d H:i:s');
			$insert_galleryimages_data_array['user_id'] = $userid;

			if (!empty($insert_galleryimages_data_array['source']['error']) && $insert_galleryimages_data_array['source']['error']==4 && $insert_galleryimages_data_array['source']['size']==0) {
	            //echo "flgkmdfklg";exit;
	            unset($insert_galleryimages_data_array['source']);
	        }
			//$insert_galleryimages_data_array['source'] = "some image";
			//$insert_galleryimages_data_array['link'] = "http://www.google.com";
			//$insert_galleryimages_data_array['position'] = "home_top_left";

			//$this->pre($insert_galleryimages_data_array);exit;

			$this->Galleryimage->set($insert_galleryimages_data_array);

			/*echo "invalidFields:";
			$this->pre($this->Galleryimage->invalidFields());
			echo "<br><br>";exit;
*/
			if ($this->Galleryimage->validates())
			{
				// check if file has been uploaded, if so get the file path
				if (!empty($this->Galleryimage->data['Galleryimage']['filepath']) && is_string($this->Galleryimage->data['Galleryimage']['filepath'])) {
					$insert_galleryimages_data_array['source'] = $this->Galleryimage->data['Galleryimage']['filepath'];
				}
				//echo "validates true";exit;
				//$this->pre($insert_galleryimages_data_array);exit;
			 	$save = $this->Galleryimage->save($insert_galleryimages_data_array, false);
				$_SESSION['success_msg'] = "Gallery Image Added Successfully";
                $this->redirect(DEFAULT_ADMINURL . 'galleryimages/lists/');
			}
			else
			{
			    $save_errors = $this->Galleryimage->validationErrors;

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
			    //$this->pre($this->data['Galleryimage']);exit;

			    $_SESSION['error_msg'] = $errors_html;
			    $this->set('galleryimages_data',$this->data);
			    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
			}
		}
		else
		{
			$insert_galleryimages_data_array = array();
			$insert_galleryimages_data_array['Galleryimage']['title'] = '';
			$insert_galleryimages_data_array['Galleryimage']['slug'] = '';
			$insert_galleryimages_data_array['Galleryimage']['content'] = '';
			$insert_galleryimages_data_array['Galleryimage']['status'] = '1';
			$this->set('galleryimages_data',$insert_galleryimages_data_array);
		}

	}

	public function admin_edit() {

		$adId = $this->params['named']['adId'];

		if (!empty($this->data))
		{
			//if($this->data['btn_save_page'] == "Save Galleryimage")
			//{

				$userid = (int) $this->Session->read(md5(SITE_TITLE) . 'USERID');
				
				$insert_galleryimages_data_array = $this->data['Galleryimage'];
				$insert_galleryimages_data_array['id'] = $adId;
				//$insert_galleryimages_data_array['created'] = date('Y-m-d H:i:s');
				$insert_galleryimages_data_array['modified'] = date('Y-m-d H:i:s');
				$insert_galleryimages_data_array['user_id'] = $userid;
				//$this->pre($insert_galleryimages_data_array);exit;

				//$insert_galleryimages_data_array['source'] = "some image";
				//$insert_galleryimages_data_array['link'] = "http://www.google.com";
				//$insert_galleryimages_data_array['position'] = "home_top_left";

				//$this->pre($insert_galleryimages_data_array);exit;
				$this->Galleryimage->set($insert_galleryimages_data_array);

				if ($this->Galleryimage->validates())
				{
					//echo "validates true";exit;
				 	//$save = $this->Galleryimage->save($insert_galleryimages_data_array);
					//$_SESSION['success_msg'] = "Galleryimage Added Successfully";
	                //$this->redirect(DEFAULT_ADMINURL . 'galleryimages/lists/');
					if (!empty($insert_galleryimages_data_array['source']['error']) && $insert_galleryimages_data_array['source']['error']==4 && $insert_galleryimages_data_array['source']['size']==0) {
			            //echo "flgkmdfklg";exit;
			            unset($insert_galleryimages_data_array['source']);
			        } else {
			        	// check if file has been uploaded, if so get the file path
						if (!empty($this->Galleryimage->data['Galleryimage']['filepath']) && is_string($this->Galleryimage->data['Galleryimage']['filepath'])) {
							$insert_galleryimages_data_array['source'] = $this->Galleryimage->data['Galleryimage']['filepath'];
						}
			        }

					//$this->pre($insert_galleryimages_data_array);exit;

	                

					$this->Galleryimage->save($insert_galleryimages_data_array, false);
					$_SESSION['success_msg'] = "Gallery Image Updated Successfully";
	                $this->redirect(DEFAULT_ADMINURL . 'galleryimages/lists/');
				}
				else
				{
				    $save_errors = $this->Galleryimage->validationErrors;

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
				    //$this->pre($this->data['Galleryimage']);exit;

				    $_SESSION['error_msg'] = $errors_html;
				    $this->set('galleryimages_data',$this->data);
				    //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
				}

			//}
		}
		
		$galleryimages_data = $this->Galleryimage->find('first', array('conditions' => array('id' => $adId)));

		$this->set('galleryimages_data',$galleryimages_data);
	}

	public function admin_delete() {

		$adId = $this->params['named']['adId'];
		
		$this->Galleryimage->id = $this->Galleryimage->field('id', array('id' => $adId));

		$this->Galleryimage->saveField('status', 2);
		$modified_date = date('Y-m-d H:i:s');
		$this->Galleryimage->saveField('modified_date', $modified_date);

		$_SESSION['success_msg'] = "Successfully deleted Gallery Image";
		$return_url = DEFAULT_ADMINURL.'galleryimages/lists';
		return $this->redirect($return_url);  
	}

	public function admin_delete_selected()
	{
		//$this->pre($this->data['pages_checks']);exit;
		if(isset($this->data['galleryimages_checks']))
        {
            $adsSelectedArr = $this->data['galleryimages_checks'];
            $adsNum = count($adsSelectedArr);

            if($adsNum > 0)
            {
                //$this->loadmodel('Product');

                $deletedCount = 0;

                foreach ($adsSelectedArr as $pageDelKey => $pageToDelete) {
                    //var_dump($pageToDelete);

                    $this->Galleryimage->id = $this->Galleryimage->field('id', array('id' => $pageToDelete));
                    if ($this->Galleryimage->id)
                    {
                        //$this->pre($this->Product);exit;
                        $thisDelete = $this->Galleryimage->saveField('status', 2);
                        $modified_date = date('Y-m-d H:i:s');
                        $thisDeleteMod = $this->Galleryimage->saveField('modified_date', $modified_date);

                        if($thisDelete && $thisDeleteMod){
                            $deletedCount++;
                        }

                    }
                }

                $_SESSION['success_msg'] = "Successfully deleted ".$deletedCount." Galleryimage(s).";
                $return_url = DEFAULT_ADMINURL.'galleryimages/lists';
                return $this->redirect($return_url);    
            }
            else
            {
                $_SESSION['error_msg'] = "You have not selected any Gallery Image.";
                $return_url = DEFAULT_ADMINURL.'galleryimages/lists';
                return $this->redirect($return_url);    
            }
        }
        else
        {
            $return_url = DEFAULT_ADMINURL.'galleryimages/lists';
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
	         	$search_key = trim($this->request->data['galleryimagesSearch']['searchtitle']);
	 
	         	$conditions[] = array(
	            	"Galleryimage.title LIKE" => "%".$search_key."%"
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

        $galleryimages_data = $this->paginate('Galleryimage');

        //$this->pre($pages_data);exit;

        $this->set('page_heading','Gallery Images List');
        $this->set('galleryimages_data',$galleryimages_data);

	   	$this->set('from_search',true);

	   	$this->render('/Galleryimages/admin_lists');
	}

}