<?php
class SettingsController extends AppController
{
	var $name = 'Settings';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function admin_general()
	{
		$userid = $this->Session->read(md5(SITE_TITLE) . 'USERID');

        if ($this->request->is('post'))
	    {
	      	if(!empty($this->request->data) && isset($this->request->data) )
	      	{
	         	//$this->pre($this->request->data);exit;

	         	$settingsData = $this->request->data['Settings']['key'];
	         	$save = false;
	         	$customValidate = true;

	         	foreach ($settingsData as $setting_key => $setting_value) {
	         		$general_settings_data = array();

	         		$keyExistsData = $this->Setting->find('first', array('fields' => array('id'), 'conditions'=>array('key'=>$setting_key, 'status'=>1), 'order' => 'id DESC'));

	         		if(!empty($keyExistsData)){
	         			
	         			if(!empty($setting_key) && !empty($setting_value))
	         			{
		         			if (filter_var($setting_value, FILTER_VALIDATE_URL))
		         			{
			         			$general_settings_data['id'] = $keyExistsData['Setting']['id'];
			         			$general_settings_data['key'] = $setting_key;
			         			$general_settings_data['value'] = $setting_value;
			         			$general_settings_data['status'] = 1; 
								$general_settings_data['modified'] = date('Y-m-d H:i:s');
							}
							else
							{
								$customValidate = false;
								$customErrors[] = $setting_key.' URL is not valid';
							}
						}
						//$this->pre($general_settings_data);exit;

	         		} else {

	         			if(!empty($setting_key) && !empty($setting_value))
	         			{
	         				if (filter_var($setting_value, FILTER_VALIDATE_URL))
	         				{
		         				$general_settings_data['key'] = $setting_key;
			         			$general_settings_data['value'] = $setting_value;
			         			$general_settings_data['status'] = 1; 
								$general_settings_data['created'] = date('Y-m-d H:i:s');
								$general_settings_data['modified'] = date('Y-m-d H:i:s');
							}
							else
							{
								$customValidate = false;
								$customErrors[] = $setting_key.' URL is not valid';
							}
	         			}
	         		}
	         		
	         		if(!empty($general_settings_data))
	         		{
	         			//$this->pre($general_settings_data);
	         			$save = $this->Setting->save($general_settings_data);
	         		}

	         	}
	         	
	         	if($customValidate === false){
	         		//echo "not valid";exit;
	         		if(count($customErrors) > 0)
				    {
				    	foreach ($customErrors as $errKey => $custom_error) {
				    		$errors_html .= "<li>".$custom_error."</li>";	
				    	}
				    }

				    $GeneralSettingsData = $this->Setting->find('all', array('conditions'=>array('status'=>1), 'order' => 'id DESC'));

				    if(!empty($GeneralSettingsData)){
				    	$settings_data = array();
				    	foreach ($GeneralSettingsData as $g_setting_num => $g_setting_data)
				    	{
				    		if(!empty($g_setting_data['Setting']['key']))
				    		{
				    			$settings_data['Setting']['key'][$g_setting_data['Setting']['key']] = $g_setting_data['Setting']['value'];
				    		}
				    	}
				    } else {
				    	$settings_data = array();
				    }

				    $_SESSION['error_msg'] = $errors_html;
			    	$this->set('settings_data',$settings_data);
	         		$this->redirect(DEFAULT_ADMINURL . 'settings/general/');
	         	}

	         	if($save && $customValidate){
	         		$_SESSION['success_msg'] = "Settings Saved";
                	$this->redirect(DEFAULT_ADMINURL . 'settings/general/');
	         	}
	      	}
	    }

	    $GeneralSettingsData = $this->Setting->find('all', array('conditions'=>array('status'=>1), 'order' => 'id DESC'));

	    if(!empty($GeneralSettingsData)){
	    	$settings_data = array();
	    	foreach ($GeneralSettingsData as $g_setting_num => $g_setting_data)
	    	{
	    		if(!empty($g_setting_data['Setting']['key']))
	    		{
	    			$settings_data['Setting']['key'][$g_setting_data['Setting']['key']] = $g_setting_data['Setting']['value'];
	    		}
	    	}
	    } else {
	    	$settings_data = array();
	    }

	    //$this->pre($settings_data);exit;
	    $this->set('settings_data', $settings_data);
	    $this->set('page_heading', 'General Settings');
	}

}