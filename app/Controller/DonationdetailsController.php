<?php
class DonationdetailsController extends AppController
{
	var $name = 'Donationdetails';
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

	         	$keyExistsData = $this->Donationdetail->find('first', array('fields' => array('id'), 'conditions'=>array('id'=>1)));
	         	
         		$general_donationdetails_data = array();

         		if(!empty($keyExistsData)){

         			$general_donationdetails_data['id'] = $keyExistsData['Donationdetail']['id'];
         			$general_donationdetails_data['beneficiary_name'] = $this->request->data['beneficiary_name'];
	     			$general_donationdetails_data['bank_name'] = $this->request->data['bank_name'];
	     			$general_donationdetails_data['branch'] = $this->request->data['branch']; 
					$general_donationdetails_data['current_account_no'] = $this->request->data['current_account_no'];
					$general_donationdetails_data['ifsc'] = $this->request->data['ifsc']; 
					$general_donationdetails_data['micr_code'] = $this->request->data['micr_code'];
					$general_donationdetails_data['modified'] = date('Y-m-d H:i:s');

         		} else {

	 				$general_donationdetails_data['beneficiary_name'] = $this->request->data['beneficiary_name'];
	     			$general_donationdetails_data['bank_name'] = $this->request->data['bank_name'];
	     			$general_donationdetails_data['branch'] = $this->request->data['branch']; 
					$general_donationdetails_data['current_account_no'] = $this->request->data['current_account_no'];
					$general_donationdetails_data['ifsc'] = $this->request->data['ifsc']; 
					$general_donationdetails_data['micr_code'] = $this->request->data['micr_code'];
					$general_donationdetails_data['created'] = date('Y-m-d H:i:s');
					$general_donationdetails_data['modified'] = date('Y-m-d H:i:s');
						
         		}
         		
         		if(!empty($general_donationdetails_data))
         		{
         			//$this->pre($general_donationdetails_data);
         			$save = $this->Donationdetail->save($general_donationdetails_data);
         		}
	         	
	         	if($customValidate === false){
	         		//echo "not valid";exit;
	         		if(count($customErrors) > 0)
				    {
				    	foreach ($customErrors as $errKey => $custom_error) {
				    		$errors_html .= "<li>".$custom_error."</li>";	
				    	}
				    }

				    $GeneralDonationdetailsData = $this->Donationdetail->find('all', array('conditions'=>array('status'=>1), 'order' => 'id DESC'));

				    if(!empty($GeneralDonationdetailsData)){
				    	$donationdetails_data = array();
				    	foreach ($GeneralDonationdetailsData as $g_setting_num => $g_setting_data)
				    	{
				    		if(!empty($g_setting_data['Donationdetail']['key']))
				    		{
				    			$donationdetails_data['Donationdetail']['key'][$g_setting_data['Donationdetail']['key']] = $g_setting_data['Donationdetail']['value'];
				    		}
				    	}
				    } else {
				    	$donationdetails_data = array();
				    }

				    $_SESSION['error_msg'] = $errors_html;
			    	$this->set('donationdetails_data',$donationdetails_data);
	         		$this->redirect(DEFAULT_ADMINURL . 'donationdetails/edit/');
	         	}

	         	if($save && $customValidate){
	         		$_SESSION['success_msg'] = "Donationdetail Details Saved";
                	$this->redirect(DEFAULT_ADMINURL . 'donationdetails/edit/');
	         	}
	      	}
	    }

	    $GeneralDonationdetailsData = $this->Donationdetail->find('all', array('conditions'=>array('id'=>1)));

	    $GeneralDonationdetailsData = $GeneralDonationdetailsData[0]['Donationdetail'];
	    //var_dump($GeneralDonationdetailsData);exit;

	    if(!empty($GeneralDonationdetailsData)){
	    	$donationdetails_data = array();
	    	$donationdetails_data['Donationdetail']['beneficiary_name'] = $GeneralDonationdetailsData['beneficiary_name'];
	    	$donationdetails_data['Donationdetail']['bank_name'] = $GeneralDonationdetailsData['bank_name'];
	    	$donationdetails_data['Donationdetail']['branch'] = $GeneralDonationdetailsData['branch'];
	    	$donationdetails_data['Donationdetail']['current_account_no'] = $GeneralDonationdetailsData['current_account_no'];
	    	$donationdetails_data['Donationdetail']['ifsc'] = $GeneralDonationdetailsData['ifsc'];
	    	$donationdetails_data['Donationdetail']['micr_code'] = $GeneralDonationdetailsData['micr_code'];
	    } else {
	    	$donationdetails_data = array();
	    	$donationdetails_data['Donationdetail']['beneficiary_name'] = '';
	    	$donationdetails_data['Donationdetail']['bank_name'] = '';
	    	$donationdetails_data['Donationdetail']['branch'] = '';
	    	$donationdetails_data['Donationdetail']['current_account_no'] = '';
	    	$donationdetails_data['Donationdetail']['ifsc'] = '';
	    	$donationdetails_data['Donationdetail']['micr_code'] = '';
	    }

	    //$this->pre($donationdetails_data);exit;
	    $this->set('donationdetails_data', $donationdetails_data);
	    $this->set('page_heading', 'Donation Details');
	}

}