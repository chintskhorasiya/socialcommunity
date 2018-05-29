<?php
class ContactsController extends AppController
{
	var $name = 'Contacts';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_edit()
	{
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        if ($this->request->is('post'))
	    {
	      	if(!empty($this->request->data) && isset($this->request->data) )
	      	{
	         	//$this->pre($this->request->data);
	         	//exit;

	         	$save = false;
	         	$customValidate = true;

	         	$keyExistsData = $this->Contact->find('first', array('fields' => array('id'), 'conditions'=>array('id'=>1)));
	         	
         		$general_contacts_data = array();

         		if(!empty($keyExistsData)){

         			$general_contacts_data['id'] = $keyExistsData['Contact']['id'];
         			$general_contacts_data['address'] = $this->request->data['address'];
	     			$general_contacts_data['phone'] = $this->request->data['phone'];
	     			$general_contacts_data['mobile'] = $this->request->data['mobile']; 
					$general_contacts_data['email'] = $this->request->data['email'];
					$general_contacts_data['modified'] = date('Y-m-d H:i:s');

         		} else {

	 				$general_contacts_data['address'] = $this->request->data['address'];
	     			$general_contacts_data['phone'] = $this->request->data['phone'];
	     			$general_contacts_data['mobile'] = $this->request->data['mobile']; 
					$general_contacts_data['email'] = $this->request->data['email'];
					$general_contacts_data['created'] = date('Y-m-d H:i:s');
					$general_contacts_data['modified'] = date('Y-m-d H:i:s');
						
         		}
         		
         		if(!empty($general_contacts_data))
         		{
         			//$this->pre($general_contacts_data);
         			$save = $this->Contact->save($general_contacts_data);
         		}
	         	
	         	if($customValidate === false){
	         		//echo "not valid";exit;
	         		if(count($customErrors) > 0)
				    {
				    	foreach ($customErrors as $errKey => $custom_error) {
				    		$errors_html .= "<li>".$custom_error."</li>";	
				    	}
				    }

				    $GeneralContactsData = $this->Contact->find('all', array('conditions'=>array('status'=>1), 'order' => 'id DESC'));

				    if(!empty($GeneralContactsData)){
				    	$contacts_data = array();
				    	foreach ($GeneralContactsData as $g_setting_num => $g_setting_data)
				    	{
				    		if(!empty($g_setting_data['Contact']['key']))
				    		{
				    			$contacts_data['Contact']['key'][$g_setting_data['Contact']['key']] = $g_setting_data['Contact']['value'];
				    		}
				    	}
				    } else {
				    	$contacts_data = array();
				    }

				    $_SESSION['error_msg'] = $errors_html;
			    	$this->set('contacts_data',$contacts_data);
	         		$this->redirect(DEFAULT_ADMINURL . 'contacts/edit/');
	         	}

	         	if($save && $customValidate){
	         		$_SESSION['success_msg'] = "Contact Details Saved";
                	$this->redirect(DEFAULT_ADMINURL . 'contacts/edit/');
	         	}
	      	}
	    }

	    $GeneralContactsData = $this->Contact->find('all', array('conditions'=>array('id'=>1)));

	    $GeneralContactsData = $GeneralContactsData[0]['Contact'];
	    //var_dump($GeneralContactsData);exit;

	    if(!empty($GeneralContactsData)){
	    	$contacts_data = array();
	    	$contacts_data['Contact']['address'] = $GeneralContactsData['address'];
	    	$contacts_data['Contact']['phone'] = $GeneralContactsData['phone'];
	    	$contacts_data['Contact']['mobile'] = $GeneralContactsData['mobile'];
	    	$contacts_data['Contact']['email'] = $GeneralContactsData['email'];
	    } else {
	    	$contacts_data = array();
	    	$contacts_data['Contact']['address'] = '';
	    	$contacts_data['Contact']['phone'] = '';
	    	$contacts_data['Contact']['mobile'] = '';
	    	$contacts_data['Contact']['email'] = '';
	    }

	    //$this->pre($contacts_data);exit;
	    $this->set('contacts_data', $contacts_data);
	    $this->set('page_heading', 'General Contacts');
	}

}