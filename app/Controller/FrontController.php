<?php
class FrontController extends AppController
{
	var $name = 'Front';
    public $components = array('Cookie', 'Session', 'Email', 'Paginator');
    public $helpers = array('Html', 'Form', 'Session', 'Time');

    public function comingsoon(){
        //echo "<center><h1>Coming Soon</h1></center>";
        //exit;
    }

    public function home(){
    	//echo "home page";exit;
        $this->loadmodel('Banner');
        $this->loadmodel('Homemodule');

        $BannersData = $this->Banner->find('all', array('conditions'=>array('status'=>1), 'order' => 'id DESC'));

        $welcome_to_data = $this->Homemodule->find('first', array('conditions'=>array('id'=>3)));
        $welcome_to_html = $welcome_to_data['Homemodule']['page'];

        $this->loadmodel('Newsevent');
        $news_event_data = $this->Newsevent->find('all', array('conditions'=>array('status'=>1), 'limit' => 3, 'order' => 'id DESC'));

        $daily_thought_data = $this->Homemodule->find('first', array('conditions'=>array('id'=>4)));
        $daily_thought_html = $daily_thought_data['Homemodule']['page'];

        $this->loadmodel('Advertise');
        $advertise_data = $this->Advertise->find('all', array('conditions'=>array('status'=>1), 'limit' => 2, 'order' => 'id DESC'));

        $this->loadmodel('Galleryimage');
        $gallery_data = $this->Galleryimage->find('all', array('conditions'=>array('status'=>1), 'limit' => 6, 'order' => 'id DESC'));

        //$this->pre($gallery_data);exit;
        $this->set('banner_data', $BannersData);
        $this->set('welcome_to_data', $welcome_to_data);
        $this->set('welcome_to_html', $welcome_to_html);
        $this->set('daily_thought_data', $daily_thought_data);
        $this->set('daily_thought_html', $daily_thought_html);
        $this->set('news_event_data', $news_event_data);
        $this->set('advertise_data', $advertise_data);
        $this->set('gallery_data', $gallery_data);
    	$this->set('owl_enabled', 'enabled');
        $this->set('popup_enabled', 'enabled');

    }

    public function news_listing($categoryslug)
    {
        $this->loadmodel('NewsCategory');
        $get_newscat_data_by_slug = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$categoryslug)));

        if(!empty($get_newscat_data_by_slug['NewsCategory']['name']))
        {
            $category_title = $get_newscat_data_by_slug['NewsCategory']['name'];
            $category_id = $get_newscat_data_by_slug['NewsCategory']['id'];
        } else {
            $category_title = '';
            $category_id = '';
        }

        if(!empty($category_id)){
            $get_catenews_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\''.$category_id.'\',categories)'), 'limit' => 17, 'order' => array('id' => 'desc')));
            //$this->pre($get_morenews_data_by_category);exit;
            $catenews_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id)));
            foreach ($get_catenews_data_by_category as $catenews_key => $catenews_data)
            {
                $get_catenews_data_by_category[$catenews_key]['News']['cat_id'] = $catenews_catdata['NewsCategory']['id'];
                $get_catenews_data_by_category[$catenews_key]['News']['cat_name'] = $catenews_catdata['NewsCategory']['name'];
                $get_catenews_data_by_category[$catenews_key]['News']['cat_slug'] = $catenews_catdata['NewsCategory']['slug'];
            }

            $get_sidebarupr_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'6\',categories)'), 'limit' => 5, 'order' => array('id' => 'desc')));
            //$this->pre($get_morenews_data_by_category);exit;
            $sidebarupr_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>3)));
            foreach ($get_sidebarupr_data_by_category as $sidebarupr_key => $sidebarupr_data)
            {
                $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_id'] = $sidebarupr_catdata['NewsCategory']['id'];
                $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_name'] = $sidebarupr_catdata['NewsCategory']['name'];
                $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_slug'] = $sidebarupr_catdata['NewsCategory']['slug'];
            }

            $get_sidebardown_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'8\',categories)'), 'limit' => 4, 'order' => array('id' => 'desc')));
            //$this->pre($get_morenews_data_by_category);exit;
            $sidebardown_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>2)));
            foreach ($get_sidebardown_data_by_category as $sidebardown_key => $sidebardown_data)
            {
                $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_id'] = $sidebardown_catdata['NewsCategory']['id'];
                $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_name'] = $sidebardown_catdata['NewsCategory']['name'];
                $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_slug'] = $sidebardown_catdata['NewsCategory']['slug'];
            }

        } else {
            $get_catenews_data_by_category = array();
            $get_sidebarupr_data_by_category = array(); 
            $get_sidebardown_data_by_category = array();    
        }

        //$this->pre($category_title);
        //$this->pre($get_catenews_data_by_category);
        $this->set('category_id', $category_id);
        $this->set('category_title', $category_title);
        $this->set('category_news_data', $get_catenews_data_by_category);
        $this->set('news_page_sidebarupr', $get_sidebarupr_data_by_category);
        $this->set('news_page_sidebardown', $get_sidebardown_data_by_category);
    }

    public function news_detail($categoryslug, $slug)
    {
        //$this->loadmodel('Page');
        $get_news_data_by_slug = $this->News->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$slug)));

        if(!empty($get_news_data_by_slug['News']['content']))
        {
            $news_page_id = $get_news_data_by_slug['News']['id'];
            $news_page_content = $get_news_data_by_slug['News']['content'];
            $news_page_title = $get_news_data_by_slug['News']['title'];
            $news_page_slug = $get_news_data_by_slug['News']['slug'];
            $news_page_content = $get_news_data_by_slug['News']['content'];
            $news_page_images = $get_news_data_by_slug['News']['images'];
            $news_page_videos = $get_news_data_by_slug['News']['videos'];
            $news_page_modified = $get_news_data_by_slug['News']['modified'];
            $news_page_views = (int) $get_news_data_by_slug['News']['views'];

            if(!empty($news_page_images)){
                $og_images = explode(',', $news_page_images);
                $og_image = $og_images[0];
            } else {
                $og_image = DEFAULT_URL.'img/new-default.png';
            }

        } else {
            $news_page_id = '';
            $news_page_content = '';
            $news_page_title = '';
            $news_page_content = '';
            $news_page_slug = '';
            $news_page_images = '';
            $news_page_videos = '';
            $news_page_modified = '';
            $new_page_views = 0;
            $og_image = DEFAULT_URL.'img/new-default.png';
        }

        $this->loadmodel('NewsCategory');
        $get_newscat_data_by_slug = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$categoryslug)));

        if(!empty($get_newscat_data_by_slug['NewsCategory']['name']))
        {
            $category_title = $get_newscat_data_by_slug['NewsCategory']['name'];
            $category_slug = $get_newscat_data_by_slug['NewsCategory']['slug'];
            $category_id = $get_newscat_data_by_slug['NewsCategory']['id'];
        } else {
            $category_title = '';
            $category_slug = '';
            $category_id = '';
        }

        if(!empty($category_id)){
            $get_morenews_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'id NOT IN'=>array($news_page_id), 'FIND_IN_SET(\''.$category_id.'\',categories)'), 'limit' => 20, 'order' => array('id' => 'desc')));
            //$this->pre($get_morenews_data_by_category);exit;
            $morenews_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$category_id)));
            foreach ($get_morenews_data_by_category as $morenews_key => $morenews_data)
            {
                $get_morenews_data_by_category[$morenews_key]['News']['cat_id'] = $morenews_catdata['NewsCategory']['id'];
                $get_morenews_data_by_category[$morenews_key]['News']['cat_name'] = $morenews_catdata['NewsCategory']['name'];
                $get_morenews_data_by_category[$morenews_key]['News']['cat_slug'] = $morenews_catdata['NewsCategory']['slug'];
            }

            $get_sidebarupr_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'3\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
            //$this->pre($get_morenews_data_by_category);exit;
            $sidebarupr_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>3)));
            foreach ($get_sidebarupr_data_by_category as $sidebarupr_key => $sidebarupr_data)
            {
                $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_id'] = $sidebarupr_catdata['NewsCategory']['id'];
                $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_name'] = $sidebarupr_catdata['NewsCategory']['name'];
                $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_slug'] = $sidebarupr_catdata['NewsCategory']['slug'];
            }

            $get_sidebardown_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'2\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
            //$this->pre($get_morenews_data_by_category);exit;
            $sidebardown_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>2)));
            foreach ($get_sidebardown_data_by_category as $sidebardown_key => $sidebardown_data)
            {
                $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_id'] = $sidebardown_catdata['NewsCategory']['id'];
                $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_name'] = $sidebardown_catdata['NewsCategory']['name'];
                $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_slug'] = $sidebardown_catdata['NewsCategory']['slug'];
            }

        } else {
            $get_morenews_data_by_category = array();
            $get_sidebarupr_data_by_category = array();
            $get_sidebardown_data_by_category = array();
        }

        if($news_page_id){
            $news_page_views++;
            $update_views_data = array();
            $update_views_data['News']['id'] = $news_page_id;
            $update_views_data['News']['views'] = $news_page_views;
            //$this->pre($update_views_data);exit;
            $this->News->save($update_views_data, false);
        }

        $this->set('page_name', 'news_detail');
        $this->set('owl_enabled', 'enabled');

        $this->set('og_enabled', true);
        $this->set('og_url', DEFAULT_URL.'news-detail/'.$category_slug.'/'.$news_page_slug);
        $this->set('og_title', $news_page_title);
        $this->set('og_description', $news_page_content);
        $this->set('og_image', $og_image);

        $this->set('category_id', $category_id);
        $this->set('category_title', $category_title);
        $this->set('news_page_id', $news_page_id);
        $this->set('news_page_title', $news_page_title);
        $this->set('news_page_images', $news_page_images);
        $this->set('news_page_videos', $news_page_videos);
        $this->set('news_page_content', $news_page_content);
        $this->set('news_page_modified', $news_page_modified);
        $this->set('news_page_morenews', $get_morenews_data_by_category);
        $this->set('news_page_sidebarupr', $get_sidebarupr_data_by_category);
        $this->set('news_page_sidebardown', $get_sidebardown_data_by_category);
    }

    public function page_display($slug)
    {
        $this->loadmodel('Page');
        $get_page_data_by_slug = $this->Page->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$slug)));

        if(!empty($get_page_data_by_slug['Page']['content']))
        {
            $cms_page_content = $get_page_data_by_slug['Page']['content'];
            $cms_page_title = $get_page_data_by_slug['Page']['title'];
        } else {
            $cms_page_content = '';
            $cms_page_title = '';
        }

        $this->set('cms_page_title', $cms_page_title);
        $this->set('cms_page_content', $cms_page_content);
    }

    public function contact_us()
    {
        
        if(isset($this->data) && count($this->data)>0)
        {
            //$this->pre($this->data);exit;
            
            $contact_data = $this->data;

            $send_page = 'contact-us';
            //exit;

            $subject = 'Contact Us Details';

            $email_from = trim(ADMIN_EMAIL_FROM);        
            $email_to =  ADMIN_EMAIL_TO;
            $email_cc = '';
            $email_bcc = '';
            $email_reply_to = '';
            
            $content = "<table width='80%' border='0' cellspacing='5' cellpadding='3' align='left' style='font-size: 14px; margin:0; padding:0px; font-family:Trebuchet MS, Arial, Helvetica, sans-serif'>
                    <tr>
                        <td colspan='2'>
                            Dear " . ADMIN_EMAIL_NAME . ",<div style='height:3px;'>&nbsp;</div>
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>".trim($contact_data['firstname'])."</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>".trim($contact_data['email'])."</td>
                    </tr>
                    <tr>
                        <td>Mobile No</td>
                        <td>".trim($contact_data['contact'])."</td>
                    </tr>
                    <tr>
                        <td valign='top'>Message</td>
                        <td>".nl2br(trim($contact_data['comment']))."</td>
                    </tr>

                    <tr>
                        <td colspan='2'><div style='height:3px;'>&nbsp;</div></td>
                    </tr>
                    </table>";


            $headers = "From:" . $email_from . "\r\n";
            /* *
            if ($email_cc != '' && $email_cc != 'NULL') {
                $headers .= "Cc:" . trim($email_cc) . "\r\n";
            }
            if ($email_bcc != '' && $email_bcc != 'NULL') {
                $headers .= "Bcc:" . trim($email_bcc) . "\r\n";
            }
            if ($email_reply_to != '' && $email_reply_to != 'NULL') {
                $headers .= "Reply-To:" . trim($email_reply_to) . "\r\n";
            }
            /* */

            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            //echo $content;
            //exit;

            // Mail it
            $send_mail = mail($email_to, $subject, $content, $headers,'-fsupport@seawindsolution.com');
            
            if(!empty($send_mail))
            {
                ?>
                <script>
                    alert('Thanks for your Inquiry,We Will Contact You Soon!');
                    window.location.href = '<?php echo DEFAULT_URL.$send_page;?>'; //Will take you to Google.
                </script>
                <?php 
            }
        }
        $this->set('cms_page_title', 'Contact Us');
    }

    public function executive_committee_list()
    {
        $this->loadmodel('Committeemember');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'1\',categories)'),
            'limit' => 2,
            'order' => array('id' => 'desc')
        );

        $get_executive_commitee_data = $this->paginate('Committeemember');

        //$this->pre($get_executive_commitee_data);exit;

        $this->set('cms_page_title', 'Executive Members List');
        $this->set('executive_commitee_data', $get_executive_commitee_data);
    }

    public function advisory_committee_list()
    {
        $this->loadmodel('Committeemember');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'2\',categories)'),
            'limit' => 2,
            'order' => array('id' => 'desc')
        );

        $get_advisory_commitee_data = $this->paginate('Committeemember');

        //$this->pre($get_executive_commitee_data);exit;

        $this->set('cms_page_title', 'Advisory Members List');
        $this->set('advisory_commitee_data', $get_advisory_commitee_data);
    }

    public function yuva_committee_list()
    {
        $this->loadmodel('Committeemember');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'3\',categories)'),
            'limit' => 2,
            'order' => array('id' => 'desc')
        );

        $get_yuva_commitee_data = $this->paginate('Committeemember');

        //$this->pre($get_executive_commitee_data);exit;

        $this->set('cms_page_title', 'Yuva Members List');
        $this->set('yuva_commitee_data', $get_yuva_commitee_data);
    }

    public function member_directory_list()
    {
        $this->loadmodel('Member');

        $this->paginate = array(
            'conditions' => array('User.status IN'=> array(1)),
            'joins' => array(
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => '`User`.`member_id` = `Member`.`id`'
                )
            ),
            'limit' => 2,
            'order' => array('id' => 'desc')
        );

        $get_members_data = $this->paginate('Member');

        //$this->pre($get_members_data);exit;

        $this->set('cms_page_title', 'Member Directory');
        $this->set('members_data', $get_members_data);
    }

    public function news_events_listing()
    {
        $this->loadmodel('Newsevent');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1)),
            'limit' => 3,
            'order' => array('id' => 'desc')
        );

        $get_newsevents_data = $this->paginate('Newsevent');

        //$this->pre($get_newsevents_data);exit;

        $this->set('cms_page_title', 'News Events');
        $this->set('newsevents_data', $get_newsevents_data);
    }

    public function donation_facility()
    {
        if(isset($this->data) && count($this->data)>0)
        {
            //$this->pre($this->data);exit;
            
            $contact_data = $this->data;

            $send_page = 'contact-us';
            //exit;

            $subject = 'Donation Inquiry';

            $email_from = trim(ADMIN_EMAIL_FROM);        
            $email_to =  ADMIN_EMAIL_TO;
            $email_cc = '';
            $email_bcc = '';
            $email_reply_to = '';
            
            $content = "<table width='80%' border='0' cellspacing='5' cellpadding='3' align='left' style='font-size: 14px; margin:0; padding:0px; font-family:Trebuchet MS, Arial, Helvetica, sans-serif'>
                    <tr>
                        <td colspan='2'>
                            Dear " . ADMIN_EMAIL_NAME . ",<div style='height:3px;'>&nbsp;</div>
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>".trim($contact_data['firstname'])."</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>".trim($contact_data['email'])."</td>
                    </tr>
                    <tr>
                        <td>Mobile No</td>
                        <td>".trim($contact_data['contact'])."</td>
                    </tr>
                    <tr>
                        <td valign='top'>Message</td>
                        <td>".nl2br(trim($contact_data['comment']))."</td>
                    </tr>

                    <tr>
                        <td colspan='2'><div style='height:3px;'>&nbsp;</div></td>
                    </tr>
                    </table>";


            $headers = "From:" . $email_from . "\r\n";
            /* *
            if ($email_cc != '' && $email_cc != 'NULL') {
                $headers .= "Cc:" . trim($email_cc) . "\r\n";
            }
            if ($email_bcc != '' && $email_bcc != 'NULL') {
                $headers .= "Bcc:" . trim($email_bcc) . "\r\n";
            }
            if ($email_reply_to != '' && $email_reply_to != 'NULL') {
                $headers .= "Reply-To:" . trim($email_reply_to) . "\r\n";
            }
            /* */

            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            //echo $content;
            //exit;

            // Mail it
            $send_mail = mail($email_to, $subject, $content, $headers,'-fsupport@seawindsolution.com');
            
            if(!empty($send_mail))
            {
                ?>
                <script>
                    alert('Thanks for your Inquiry,We Will Contact You Soon!');
                    window.location.href = '<?php echo DEFAULT_URL.$send_page;?>'; //Will take you to Google.
                </script>
                <?php 
            }
        }

        $this->loadmodel('Donationdetails');

        $DonationdetailsData = $this->Donationdetails->find('all', array('conditions'=>array('id'=>1)));

        if(!empty($DonationdetailsData)){
            $donation_data = array();
            foreach ($DonationdetailsData as $g_donation_num => $g_donation_data)
            {
                $donation_data['beneficiary_name'] = $g_donation_data['Donationdetails']['beneficiary_name'];
                $donation_data['bank_name'] = $g_donation_data['Donationdetails']['bank_name'];
                $donation_data['branch'] = $g_donation_data['Donationdetails']['branch'];
                $donation_data['current_account_no'] = $g_donation_data['Donationdetails']['current_account_no'];
                $donation_data['ifsc'] = $g_donation_data['Donationdetails']['ifsc'];
                $donation_data['micr_code'] = $g_donation_data['Donationdetails']['micr_code'];
            }
        } else {
            $donation_data = array();
            $donation_data['beneficiary_name'] = '';
            $donation_data['bank_name'] = '';
            $donation_data['branch'] = '';
            $donation_data['current_account_no'] = '';
            $donation_data['ifsc'] = '';
            $donation_data['micr_code'] = '';
        }


        $this->set('cms_page_title', 'Donation Facility');
        $this->set('donation_data', $donation_data);
    }

    public function donors_list()
    {
        $this->loadmodel('Donations');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1)),
            'limit' => 2,
            'order' => array('id' => 'desc')
        );

        $get_donations_data = $this->paginate('Donations');

        //$this->pre($get_executive_commitee_data);exit;

        $this->set('cms_page_title', 'Donors List');
        $this->set('donations_data', $get_donations_data);
    }

    public function registration()
    {
        //echo '<pre>';
        //print_r($_SESSION);
        //exit;
        $this->layout = 'default';
        //var_dump($this->Session->check('member_login'));
        if ($this->Session->check('member_login') == true) {
            //$this->Session->setFlash('The URL you\'ve followed requires you login.');
            //$this->redirect(DEFAULT_ADMINURL);
            $this->redirect(DEFAULT_URL);
            exit();
        }

        if (!empty($this->data)) {

            $this->loadmodel('Member');
            $this->loadmodel('User');

            $insert_member_data = array();
            $insert_member_data = $this->data;

            //$this->pre($this->data['User']);exit;

            $this->Member->set($insert_member_data['Member']);
            $this->User->set($insert_member_data['User']);

            //$this->pre($this->Member);
            //$this->pre($this->User);exit;

            //var_dump($this->User->validates());
            //var_dump($this->User->validationErrors);
            //exit;

            if($this->User->validates()){
                $save_errors2 = array();
            } else {
                $save_errors2 = $this->User->validationErrors;
            }

            if ($this->Member->validates()) //$this->News->validates() && 
            {
                //echo "validates true";exit;
                // /$this->pre($insert_member_data);exit;
                //$saved = $this->PollAnswer->save($update_poll_answer_data, false);
                //$saved = $this->Poll->save($update_poll_data, false);
                $insert_member_data['Member']['photo'] = '';
                $insert_member_data['Member']['doc'] = '';
                $lastRecord = $this->Member->find('first', array('columns' => array('id'), 'order' => 'id DESC'));
                //var_dump($lastRecord);exit;
                $lastId = (int) $lastRecord['Member']['id'];
                $lastId++;
                $lastId = sprintf("%05d", $lastId);
                //echo $lastId;exit;
                $insert_member_data['Member']['memberno'] = 'REGMEMNO'.$lastId;
                //$this->pre($insert_member_data);exit;
                $saved = $this->Member->save($insert_member_data, false);
                $insert_member_data['User']['member_id'] = $this->Member->getLastInsertID();
                $insert_member_data['User']['name'] = $insert_member_data['Member']['first_name'];
                $insert_member_data['User']['user_type'] = "member";
                $insert_member_data['User']['password'] = md5($insert_member_data['User']['password']);
                $saved = $this->User->save($insert_member_data, false);

                $_SESSION['success_msg'] = 'Registered Successfully';
                $this->redirect(DEFAULT_URL . 'registration');
            }
            else
            {   
                //$this->User->validates();
                //var_dump($this->User->validationErrors);exit;
                $save_errors = $this->Member->validationErrors;
                //$save_errors2 = $this->User->validationErrors;

                $save_errors = array_merge($save_errors, $save_errors2);
                //$this->pre($save_errors);
                //$this->pre($save_errors2);
                //exit;
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
                //$this->pre($this->data);exit;
                if(!empty($this->data['Member']['country'])){
                    $country_id = $this->data['Member']['country'];
                    $this->loadmodel('State');
                    $states = $this->State->find('list', array('conditions' => array('country_id' => $country_id)));
                    $this->set('states',$states); //$states
                }

                if(!empty($this->data['Member']['state'])){
                    $state_id = $this->data['Member']['state'];
                    $this->loadmodel('City');
                    $cities = $this->City->find('list', array('conditions' => array('state_id' => $state_id)));
                    $this->set('cities',$cities); //$states
                }

                $_SESSION['error_msg'] = $errors_html;
                //$this->set('gotras_data',$this->data);

                //$this->pre($save_errors);
                //$this->pre($customErrors);
                //exit;
            }

            

            /*if(empty($errorarray))
            {

                $this->request->data['User']['user_type'] = 'user';
                $this->request->data['User']['password'] = md5($this->data['User']['newpwd']);
                $this->request->data['User']['encrypt_password'] = $this->encrypt_pass($this->data['User']['newpwd']);
                $this->request->data['User']['status'] = '0';
                $this->request->data['User']['created_date'] = date('Y-m-d H:i:s', time());
                $this->request->data['User']['modified_date'] = date('Y-m-d H:i:s', time());

                unset($this->request->data['User']['newpwd']);
                unset($this->request->data['User']['confirmpwd']);
                $this->User->save($this->data['User']);

                $this->redirect(DEFAULT_ADMINURL . 'users/registration/'.SUCADD);

    //                $this->pre($this->data);
    //                exit;
            }*/

        }

        $this->loadmodel('Relation');
        $relations = $this->Relation->find('list');
        $this->set('relations', $relations);

        $this->loadmodel('Gotra');
        $gotras = $this->Gotra->find('list');
        $this->set('gotras', $gotras);

        $this->loadmodel('Proffession');
        $proffessions = $this->Proffession->find('list');
        $this->set('proffessions', $proffessions);

        $this->loadmodel('Country');
        $countries = $this->Country->find('list');
        $this->set('countries', $countries);

        //$this->loadmodel('State');
        //$states = $this->State->find('list');
        if(!isset($states) && empty($states))
        {
            $this->set('states', array()); //$states
        }

         if(!isset($cities) && empty($cities))
        {
            $this->set('cities', array()); //$states
        }

        //$this->loadmodel('City');
        //$cities = $this->City->find('list');
        //$this->set('cities', array()); //$cities

        //$this->pre($countries);exit;

        $this->set('cms_page_title', 'Registration');
    }

    public function login(){

        if ($this->Session->check('member_login') == true) {
            //$this->Session->setFlash('The URL you\'ve followed requires you login.');
            //$this->redirect(DEFAULT_ADMINURL);
            $this->redirect(DEFAULT_URL);
            exit();
        }

        if (!empty($this->data))
        {
            //$this->pre($this->data);exit;
            $error_array = array();
            if (isset($this->data['User']['username']) && $this->data['User']['username'] == '') {
                $error_array['err_username'] = ENTER_USERNAME;
            }

            if (isset($this->data['User']['password']) && $this->data['User']['password'] == '') {
                $error_array['err_password'] = NEWPASS;
            }

            if (empty($error_array)) {


                $dbuser = $this->User->find('first', array('conditions' => array('User.username like' => $this->data['User']['username'], 'User.password like' => md5(trim($this->data['User']['password'])), 'User.status' => 1, 'User.user_type' => 'member')));


                if (!empty($dbuser)) {
                    $this->Session->write('member_login', $dbuser['User']['id']);
                    $this->Session->write('member_name', $dbuser['User']['name']);
                    $this->Session->write('member_username', $dbuser['User']['username']);
                    $this->Session->write('member_usermail', $dbuser['User']['email']);
                    $this->Session->write('member_usertype', $dbuser['User']['user_type']);
                    //$this->Session->write(md5(SITE_TITLE) . 'USERNAME', $dbuser['User']['username']);
                    //$this->Session->write(md5(SITE_TITLE) . 'USEREMAIL', $dbuser['User']['email']);
                    //$this->Session->write(md5(SITE_TITLE) . 'USERTYPE', $dbuser['User']['user_type']);
                    //$this->redirect(DEFAULT_ADMINURL.array('controller' => 'users', 'action' => 'dashboard'));
                    $this->redirect(DEFAULT_URL);
                }
                else
                {
                    $error_array['err_nomatch'] = CORRECT_INFO;
                }
            }
            //var_dump($error_array);exit;
            $this->set('error_array', $error_array);
        }

    }

    public function logout(){
        $this->Session->delete('member_login');
        $this->Session->delete('member_name');
        $this->Session->delete('member_username');
        $this->Session->delete('member_usermail');
        $this->Session->delete('member_usertype');
        $this->redirect(DEFAULT_URL);
    }

    public function get_states()
    {
        if (!empty($this->data)) {

            $country_id = $this->data['myData']['country_id'];
            $this->loadmodel('State');
            $states = $this->State->find('list', array('conditions' => array('country_id' => $country_id)));
            $this->set('states',$states); //$states
        }
    }

    public function get_cities()
    {
        if (!empty($this->data)) {

            $state_id = $this->data['myData']['state_id'];
            $this->loadmodel('City');
            $cities = $this->City->find('list', array('conditions' => array('state_id' => $state_id)));
            $this->set('cities',$cities); //$cities
        }
    }

    public function videos_listing(){
        $this->loadmodel('Video');
        $this->loadmodel('News');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1)),
            'limit' => 10,
            'order' => array('id' => 'desc')
        );

        $videos_data = $this->paginate('Video');

        //$this->pre($videos_data);exit;

        $get_sidebarupr_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'6\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebarupr_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>6)));
        foreach ($get_sidebarupr_data_by_category as $sidebarupr_key => $sidebarupr_data)
        {
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_id'] = $sidebarupr_catdata['NewsCategory']['id'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_name'] = $sidebarupr_catdata['NewsCategory']['name'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_slug'] = $sidebarupr_catdata['NewsCategory']['slug'];
        }

        $get_sidebardown_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'8\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebardown_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>8)));
        foreach ($get_sidebardown_data_by_category as $sidebardown_key => $sidebardown_data)
        {
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_id'] = $sidebardown_catdata['NewsCategory']['id'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_name'] = $sidebardown_catdata['NewsCategory']['name'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_slug'] = $sidebardown_catdata['NewsCategory']['slug'];
        }

        $this->set('videos_data',$videos_data);
        $this->set('news_page_sidebarupr', $get_sidebarupr_data_by_category);
        $this->set('news_page_sidebardown', $get_sidebardown_data_by_category);      
    }

    public function video_detail($slug)
    {
        $this->loadmodel('Video');

        $get_video_data_by_slug = $this->Video->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$slug)));

        if(!empty($get_video_data_by_slug['Video']['video']))
        {
            $video_page_id = $get_video_data_by_slug['Video']['id'];
            $video_page_content = $get_video_data_by_slug['Video']['content'];
            $video_page_title = $get_video_data_by_slug['Video']['title'];
            $video_page_video = $get_video_data_by_slug['Video']['video'];
            $video_page_modified = $get_video_data_by_slug['Video']['modified'];
        } else {
            $video_page_id = '';
            $video_page_content = '';
            $video_page_title = '';
            $video_page_images = '';
            $video_page_video = '';
            $video_page_modified = '';
        }

        $get_morevideos_data = $this->Video->find('all', array('conditions' => array('status IN'=> array(1), 'id NOT IN'=>array($video_page_id)), 'limit' => 10, 'order' => array('id' => 'desc')) );

        $get_sidebarupr_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'6\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebarupr_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>6)));
        foreach ($get_sidebarupr_data_by_category as $sidebarupr_key => $sidebarupr_data)
        {
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_id'] = $sidebarupr_catdata['NewsCategory']['id'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_name'] = $sidebarupr_catdata['NewsCategory']['name'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_slug'] = $sidebarupr_catdata['NewsCategory']['slug'];
        }

        $get_sidebardown_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'8\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebardown_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>8)));
        foreach ($get_sidebardown_data_by_category as $sidebardown_key => $sidebardown_data)
        {
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_id'] = $sidebardown_catdata['NewsCategory']['id'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_name'] = $sidebardown_catdata['NewsCategory']['name'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_slug'] = $sidebardown_catdata['NewsCategory']['slug'];
        }

        $this->set('video_page_title', $video_page_title);
        $this->set('video_page_video', $video_page_video);
        $this->set('video_page_content', $video_page_content);
        $this->set('video_page_modified', $video_page_modified);
        $this->set('video_page_morevideos', $get_morevideos_data);
        $this->set('news_page_sidebarupr', $get_sidebarupr_data_by_category);
        $this->set('news_page_sidebardown', $get_sidebardown_data_by_category);

    }

    public function epapers(){
        //echo "epapers";
    }

    public function epapers_listing(){
        //echo "epapers ".$cat_slug;

        /*if($cat_slug == "aus"){
            $category = 1;
            $category_name = "Australia";
            $category_image = DEFAULT_FRONT_EPAPERS_AUS_IMG_URL;
        } else {*/
        $category = 0;
        //$category_name = "New Zealand";            
        $category_image = DEFAULT_FRONT_EPAPERS_IMG_URL;
        //}

        $this->loadmodel('Epaper');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1), 'category IN'=>array($category)),
            'limit' => 8,
            'order' => array('id' => 'desc')
        );

        $get_epapers_data = $this->paginate('Epaper');

        //$this->pre($get_epapers_data);exit;
        //$this->set('category_name', $category_name);
        $this->set('category_image', $category_image);
        $this->set('epapers_data', $get_epapers_data);
    }

    public function epaper($slug){
        $this->loadmodel('Epaper');

        $get_epaper_data_by_id = $this->Epaper->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$slug)));

        //$this->pre($get_epaper_data_by_id);exit;
        $this->set('epapers_data', $get_epaper_data_by_id);
    }

    public function readepaper($slug){
        $this->loadmodel('Epaper');

        $get_epaper_data_by_id = $this->Epaper->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$slug)));

        //$this->pre($get_epaper_data_by_id);exit;
        $this->set('epapers_data', $get_epaper_data_by_id);
    }

    public function news_search_results(){

        $this->loadmodel('News');

        if ($this->request->is('post'))
        {
            if(!empty($this->request->data) && isset($this->request->data) )
            {
                //$this->pre($this->request->data);exit;
                $search_key = trim($this->request->data['search_query']);
     
                $conditions[] = array(
                    "OR" => array(
                        "News.title LIKE" => "%".$search_key."%",
                        "News.content LIKE" => "%".$search_key."%",
                        "News.seo_title LIKE" => "%".$search_key."%",
                        "News.seo_desc LIKE" => "%".$search_key."%"
                    )
                );

                $this->Session->write('frontSearchNewsCond', $conditions);
                $this->Session->write('front_search_news_key', $search_key);
            }
        }

        $mainConditions = array('status IN'=> array(1));

        if ($this->Session->check('frontSearchNewsCond')) {
            $conditions = $this->Session->read('frontSearchNewsCond');
            $allConditions = array_merge($mainConditions, $conditions);
        } else {
            $conditions = null;
            $allConditions = array_merge($mainConditions, $conditions);
        }

        //$this->pre($allConditions);exit;

        $this->paginate = array(
            'conditions' => $allConditions,
            'limit' => 25,
            'order' => array('id' => 'desc')
        );

        $news_data = $this->paginate('News');

        //$this->pre($news_data);exit;

        $this->set('page_heading','News Search Results');

        $this->set('news_search_data',$news_data);
        $this->set('from_search',true);

        //exit;
    }

    public function pollsubmit(){

        if ($this->request->is('post'))
        {
            //$this->pre($this->request->data);
            //$this->pre($this->params->query);
            //exit;
            $this->loadmodel('Poll');
            $this->loadmodel('PollAnswer');

            if( (!empty($this->request->data) && isset($this->request->data)) || (!empty($this->params->query) && isset($this->params->query)) )
            {
                //$this->pre($this->request->data);exit;
                $answer = (int) (!empty($this->request->data['poll_answer']) ? $this->request->data['poll_answer'] : (!empty($this->params->query['poll_answer']) ? $this->params->query['poll_answer'] : '' ) );

                if(empty($answer)) $answer = 1;
                $poll_id = (int) (!empty($this->request->data['poll_id']) ? $this->request->data['poll_id'] : (!empty($this->params->query['poll_id']) ? $this->params->query['poll_id'] : '' ) );
                //$redirect_url = $this->request->data['redirect_url'];

                $poll_user_name = trim((!empty($this->request->data['poll_user_name']) ? $this->request->data['poll_user_name'] : (!empty($this->params->query['poll_user_name']) ? $this->params->query['poll_user_name'] : '' ) ));
                $poll_user_mobile = trim((!empty($this->request->data['poll_user_mobile']) ? $this->request->data['poll_user_mobile'] : (!empty($this->params->query['poll_user_mobile']) ? $this->params->query['poll_user_mobile'] : '' ) ));
                $poll_user_city = trim((!empty($this->request->data['poll_user_city']) ? $this->request->data['poll_user_city'] : (!empty($this->params->query['poll_user_city']) ? $this->params->query['poll_user_city'] : '' ) ));
                $poll_user_district = trim((!empty($this->request->data['poll_user_district']) ? $this->request->data['poll_user_district'] : (!empty($this->params->query['poll_user_district']) ? $this->params->query['poll_user_district'] : '' ) ));
                $poll_user_state = trim((!empty($this->request->data['poll_user_state']) ? $this->request->data['poll_user_state'] : (!empty($this->params->query['poll_user_state']) ? $this->params->query['poll_user_state'] : '' ) ));
     
                if(!empty($answer) && !empty($poll_id))
                {
                    $get_poll_data_by_id = $this->Poll->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>$poll_id)));

                    //$this->pre($get_poll_data_by_id);exit;
                    //exit;

                    $update_poll_data = array();
                    $update_poll_data['Poll']['id'] = $poll_id;
                    //if($answer == 2){
                    $answernum_vote = 'answer'.$answer.'_vote';
                    $answer_votes = $get_poll_data_by_id['Poll'][$answernum_vote];
                    $answer_votes++;
                    $update_poll_data['Poll'][$answernum_vote] = $answer_votes;
                    $update_poll_data['Poll']['last_answer'] = $answer;
                    /*} else {
                        $answer1_votes = $get_poll_data_by_id['Poll']['answer1_vote'];
                        $answer1_votes++;
                        $update_poll_data['Poll']['answer1_vote'] = $answer1_votes;
                        $update_poll_data['Poll']['last_answer'] = 1;
                    }*/
                    //$this->pre($update_poll_data);exit;
                    //$saved = $this->Poll->save($update_poll_data, false);

                    $update_poll_answer_data = array();
                    $update_poll_answer_data['PollAnswer']['poll_id'] = $poll_id;
                    $update_poll_answer_data['PollAnswer']['answer_id'] = $answer;
                    $update_poll_answer_data['PollAnswer']['user_fullname'] = $poll_user_name;
                    $update_poll_answer_data['PollAnswer']['user_mobileno'] = $poll_user_mobile;
                    $update_poll_answer_data['PollAnswer']['user_city'] = $poll_user_city;
                    $update_poll_answer_data['PollAnswer']['user_district'] = $poll_user_district;
                    $update_poll_answer_data['PollAnswer']['user_state'] = $poll_user_state;
                    $update_poll_answer_data['PollAnswer']['date_added'] = date('Y-m-d H:i:s');

                    $this->PollAnswer->set($update_poll_answer_data);

                    if ($this->PollAnswer->validates()) //$this->News->validates() && 
                    {
                        //echo "validates true";exit;
                        //$this->pre($insert_news_data_array);exit;
                        $saved = $this->PollAnswer->save($update_poll_answer_data, false);
                        $saved = $this->Poll->save($update_poll_data, false);
                        
                    }
                    else
                    {

                        $save_errors = $this->PollAnswer->validationErrors;

                        //$this->pre($save_errors);
                        //$this->pre($customErrors);
                        //exit;

                        $errors_html = '
                            <div class="header">Fill your detail here</div>
                            <div class="content">';

                        $errors_html .= "<div class=\"alert alert-danger\"><ul>";
                        foreach ($save_errors as $error_field => $field_errors)
                        {
                            foreach ($field_errors as $err_no => $error)
                            {
                                $errors_html .= "<li>".$error."</li>";  
                            }
                        }
                        
                        $errors_html .= "</ul></div>";


                        $errors_html .= '<form name="poll_user_form" class="mobilepopup-form" id="poll_user_form_id" method="POST" action="'.SITE_URL.'/front/pollsubmit">
                                    <div class="form-group col-md-12 padding-left-o">
                                        <div class="input text">
                                            <label>Full Name *</label>
                                            <input type="text" name="poll_user_name" id="poll_user_name" class="form-control" value="'.$poll_user_name.'" />
                                        </div>
                                        <div class="input text">
                                            <label>Mobile *</label>
                                            <input type="text" name="poll_user_mobile" id="poll_user_mobile" class="form-control" value="'.$poll_user_mobile.'" />
                                        </div>
                                        <div class="input text">
                                            <label>City/Village</label>
                                            <input type="text" name="poll_user_city" id="poll_user_city" class="form-control" value="'.$poll_user_city.'" />
                                        </div>
                                        <div class="input text">
                                            <label>District</label>
                                            <input type="text" name="poll_user_district" id="poll_user_district" class="form-control" value="'.$poll_user_district.'" />
                                        </div>
                                        <div class="input text">
                                            <label>State</label>
                                            <input type="text" name="poll_user_state" id="poll_user_state" class="form-control" value="'.$poll_user_state.'" />
                                        </div>
                                        <input type="hidden" name="poll_id" id="poll_id" class="form-control" value="'.$poll_id.'" />
                                        <input type="hidden" name="poll_answer" id="poll_answer" class="form-control" value="'.$answer.'" />
                                    </div>
                                </form>
                            </div>
                            <div class="footer">
                                <!--<a href="" class="button get-demopopup2">Open demo 2</a>
                                <button id="submit_vote_detail" type="button" class="button" onclick="voteAction();" >Submit</button>-->
                                <a href="" class="submit-mobilepopup-form button">Send</a>
                            </div>';

                        echo $errors_html;exit;

                        //$this->pre($errors_html);exit;
                        $news_data['News'] = $this->data['News'];

                        $this->loadmodel('NewsCategory');
                        $news_categories_data = $this->NewsCategory->find('all', array('conditions' => array('status IN'=> array(0,1))));
                        $news_data['News']['all_categories'] = $news_categories_data;

                        //$this->pre($news_data['News']);exit;

                        $_SESSION['error_msg'] = $errors_html;
                        $this->set('news_data',$news_data);
                        //$this->redirect(DEFAULT_ADMINURL . 'pages/add/');
                    }

                    //$saved = $this->PollAnswer->save($update_poll_answer_data, false);

                    //$_SESSION['vote_success_msg'] = "Thanks for voting.";

                    /*if(!empty($redirect_url)){
                        $this->redirect($redirect_url);
                    } else {
                        $this->redirect(DEFAULT_URL);
                    }*/

                    if($saved){
                        echo 'success';exit;
                    }
                    else
                    {
                        echo 'failed';exit;
                    }
                }
                else
                {
                    //$this->redirect(DEFAULT_URL);
                    echo 'failed';exit;
                }
            }
            else
            {
                //$this->redirect(DEFAULT_URL);
                echo 'failed';exit;
            }
        }
        else
        {
            //$this->redirect(DEFAULT_URL);
            echo 'failed';exit;
        }

    }

    public function feedbacksubmit(){

        if ($this->request->is('post'))
        {
            //$this->pre($this->request->data);
            //$this->pre($this->params->query);
            //$this->pre($_FILES);
            //$this->pre($this->data);
            //exit;
            $this->loadmodel('Feedback');

            if( (!empty($this->request->data) && isset($this->request->data)) || (!empty($this->params->query) && isset($this->params->query)) )
            {

                $feedback_user_name = trim((!empty($this->request->data['feedback_user_name']) ? $this->request->data['feedback_user_name'] : (!empty($this->params->query['feedback_user_name']) ? $this->params->query['feedback_user_name'] : '' ) ));
                $feedback_user_mobile = trim((!empty($this->request->data['feedback_user_mobile']) ? $this->request->data['feedback_user_mobile'] : (!empty($this->params->query['feedback_user_mobile']) ? $this->params->query['feedback_user_mobile'] : '' ) ));
                $feedback_user_comments = trim((!empty($this->request->data['feedback_user_comments']) ? $this->request->data['feedback_user_comments'] : (!empty($this->params->query['feedback_user_comments']) ? $this->params->query['feedback_user_comments'] : '' ) ));
                $feedback_user_city = trim((!empty($this->request->data['feedback_user_city']) ? $this->request->data['feedback_user_city'] : (!empty($this->params->query['feedback_user_city']) ? $this->params->query['feedback_user_city'] : '' ) ));
                $feedback_user_district = trim((!empty($this->request->data['feedback_user_district']) ? $this->request->data['feedback_user_district'] : (!empty($this->params->query['feedback_user_district']) ? $this->params->query['feedback_user_district'] : '' ) ));
                $feedback_user_state = trim((!empty($this->request->data['feedback_user_state']) ? $this->request->data['feedback_user_state'] : (!empty($this->params->query['feedback_user_state']) ? $this->params->query['feedback_user_state'] : '' ) ));
                $feedback_user_image = (!empty($_FILES['feedback_user_image']) && !empty($_FILES['feedback_user_image']['name']) && $_FILES['feedback_user_image']['error'] !== 4 ? $_FILES['feedback_user_image'] : '');
     
                $insert_feedback_data = array();
                $insert_feedback_data['Feedback']['user_fullname'] = $feedback_user_name;
                $insert_feedback_data['Feedback']['user_mobileno'] = $feedback_user_mobile;
                $insert_feedback_data['Feedback']['user_comments'] = $feedback_user_comments;
                $insert_feedback_data['Feedback']['user_city'] = $feedback_user_city;
                $insert_feedback_data['Feedback']['user_district'] = $feedback_user_district;
                $insert_feedback_data['Feedback']['user_state'] = $feedback_user_state;
                $insert_feedback_data['Feedback']['user_image'] = $feedback_user_image;
                $insert_feedback_data['Feedback']['date_added'] = date('Y-m-d H:i:s');

                $this->Feedback->set($insert_feedback_data);

                if ($this->Feedback->validates()) //$this->News->validates() && 
                {
                    //$this->pre($this->data);
                    //$this->pre($insert_feedback_data);exit;
                    $saved = $this->Feedback->save($insert_feedback_data, false);

                    $headers = "From: Chintan <".$sender.">\r\n";
                    $headers .= "Reply-To: ".$sender."\r\n";
                    $headers .= "Return-Path: ".$sender."\r\n";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                    //$headers .= "CC: sombodyelse@example.com\r\n";
                    //$headers .= "BCC: hidden@example.com\r\n";

                    $to = "chintan@seawindsolution.com";

                    $subject = "New feedback - ".SITE_NAME;

                    $message = "<p>You have new feedback for ".SITE_NAME."</p>\r\n\r\n";
                    $message .= "<p>Below are the details for User submitted feedback :- </p>\r\n\r\n";

                    $message .= "<p>Full name :<b>".$feedback_user_name."</b></p>\r\n";
                    $message .= "<p>Mobile/Phone number:<b>".$feedback_user_mobile."</b></p>\r\n";
                    $message .= "<p>User comments :<b>"."</b></p>\r\n";
                    $message .= "<div class=\"user-comments\" style=\"word-wrap:break-word;\">".wordwrap($feedback_user_comments)."</div>\r\n";
                    $message .= "<p>City/Village :<b>".$feedback_user_city."</b></p>\r\n";
                    $message .= "<p>District :<b>".$feedback_user_district."</b></p>\r\n";
                    $message .= "<p>State :<b>".$feedback_user_state."</b></p>\r\n";

                    $saved_user_image = $saved['Feedback']['filepath'];

                    if(!empty($saved_user_image)){

                        /*$feedback_data = $this->Feedback->find('first', array('conditions' => array('status IN'=> array(1)), 'order' => array('id' => 'desc')));*/

                        /*$feedback_data = $this->Feedback->find('first', array('conditions' => array('status IN'=> array(1))));
                        
                        print_r($feedback_data);exit;*/

                        $message .= "<p>Feedback image </p>\r\n\r\n";

                        $message .= '<img src="'.$saved_user_image.'" width="100" height="100" />';

                        $message .= "\r\n";
                    }

                    //echo $message;

                    //exit;

                    $mail_status = mail($to,$subject,$message,$headers);
                }
                else
                {

                    $save_errors = $this->Feedback->validationErrors;

                    $errors_html = '
                        <div class="header">Fill your detail here</div>
                        <div class="content">';

                    $errors_html .= "<div class=\"alert alert-danger\"><ul>";
                    foreach ($save_errors as $error_field => $field_errors)
                    {
                        foreach ($field_errors as $err_no => $error)
                        {
                            $errors_html .= "<li>".$error."</li>";  
                        }
                    }
                    
                    $errors_html .= "</ul></div>";


                    $errors_html .= '<form name="feedback_user_form" class="mobilepopup-form" id="feedback_user_form_id" method="POST" action="'.SITE_URL.'/front/feedbacksubmit" enctype="multipart/form-data">
                                <div class="form-group col-md-12 padding-left-o">
                                    <div class="input text">
                                        <label>Full Name *</label>
                                        <input type="text" name="feedback_user_name" id="feedback_user_name" class="form-control" value="'.$feedback_user_name.'" />
                                    </div>
                                    <div class="input text">
                                        <label>Mobile *</label>
                                        <input type="text" name="feedback_user_mobile" id="feedback_user_mobile" class="form-control" value="'.$feedback_user_mobile.'" />
                                    </div>
                                    <div class="input text">
                                        <label>Comments *</label>
                                        <textarea name="feedback_user_comments" id="feedback_user_comments" class="form-control">'.$feedback_user_comments.'</textarea>
                                    </div>
                                    <div class="input text">
                                        <label>City/Village</label>
                                        <input type="text" name="feedback_user_city" id="feedback_user_city" class="form-control" value="'.$feedback_user_city.'" />
                                    </div>
                                    <div class="input text">
                                        <label>District</label>
                                        <input type="text" name="feedback_user_district" id="feedback_user_district" class="form-control" value="'.$feedback_user_district.'" />
                                    </div>
                                    <div class="input text">
                                        <label>State</label>
                                        <input type="text" name="feedback_user_state" id="feedback_user_state" class="form-control" value="'.$feedback_user_state.'" />
                                    </div>
                                    <div class="input text">
                                        <label>Upload Image</label>
                                        <input type="file" name="feedback_user_image" id="feedback_user_image" class="" accept="image/*" />
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="footer">
                            <a href="" class="submit-mobilepopup-form button">Send</a>
                        </div>';

                    echo $errors_html;exit;
                }

                if($saved){
                    echo 'success';exit;
                }
                else
                {
                    echo '<div class="alert alert-danger">Something went wrong</div>';exit;
                }
                
            }
            else
            {
                //$this->redirect(DEFAULT_URL);
                echo '<div class="alert alert-danger">Something went wrong</div>';exit;
            }
        }
        else
        {
            //$this->redirect(DEFAULT_URL);
            echo '<div class="alert alert-danger">Something went wrong</div>';exit;
        }

    }

    public function polls_listing(){
        $this->loadmodel('Poll');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1)),
            'limit' => 1,
            'order' => array('id' => 'desc')
        );

        $polls_data = $this->paginate('Poll');

        //$this->pre($videos_data);exit;

        $get_sidebarupr_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'6\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebarupr_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>6)));
        foreach ($get_sidebarupr_data_by_category as $sidebarupr_key => $sidebarupr_data)
        {
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_id'] = $sidebarupr_catdata['NewsCategory']['id'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_name'] = $sidebarupr_catdata['NewsCategory']['name'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_slug'] = $sidebarupr_catdata['NewsCategory']['slug'];
        }

        $get_sidebardown_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'8\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebardown_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>8)));
        foreach ($get_sidebardown_data_by_category as $sidebardown_key => $sidebardown_data)
        {
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_id'] = $sidebardown_catdata['NewsCategory']['id'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_name'] = $sidebardown_catdata['NewsCategory']['name'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_slug'] = $sidebardown_catdata['NewsCategory']['slug'];
        }

        $this->set('polls_data',$polls_data);
        $this->set('news_page_sidebarupr', $get_sidebarupr_data_by_category);
        $this->set('news_page_sidebardown', $get_sidebardown_data_by_category);      
    }

    public function gallery_listing(){
        $this->loadmodel('Gallery');
        $this->loadmodel('News');

        $this->paginate = array(
            'conditions' => array('status IN'=> array(1)),
            'limit' => 10,
            'order' => array('id' => 'desc')
        );

        $galleries_data = $this->paginate('Gallery');

        //$this->pre($videos_data);exit;

        $get_sidebarupr_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'6\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebarupr_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>6)));
        foreach ($get_sidebarupr_data_by_category as $sidebarupr_key => $sidebarupr_data)
        {
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_id'] = $sidebarupr_catdata['NewsCategory']['id'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_name'] = $sidebarupr_catdata['NewsCategory']['name'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_slug'] = $sidebarupr_catdata['NewsCategory']['slug'];
        }

        $get_sidebardown_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'8\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebardown_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>8)));
        foreach ($get_sidebardown_data_by_category as $sidebardown_key => $sidebardown_data)
        {
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_id'] = $sidebardown_catdata['NewsCategory']['id'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_name'] = $sidebardown_catdata['NewsCategory']['name'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_slug'] = $sidebardown_catdata['NewsCategory']['slug'];
        }

        $this->set('galleries_data',$galleries_data);
        $this->set('news_page_sidebarupr', $get_sidebarupr_data_by_category);
        $this->set('news_page_sidebardown', $get_sidebardown_data_by_category);      
    }

    public function gallery_detail($slug)
    {
        $this->loadmodel('Gallery');

        $get_gallery_data_by_slug = $this->Gallery->find('first', array('conditions' => array('status IN'=> array(1), 'slug'=>$slug)));

        if(!empty($get_gallery_data_by_slug['Gallery']['images']))
        {
            $gallery_page_id = $get_gallery_data_by_slug['Gallery']['id'];
            $gallery_page_content = $get_gallery_data_by_slug['Gallery']['content'];
            $gallery_page_title = $get_gallery_data_by_slug['Gallery']['title'];
            $gallery_page_images = $get_gallery_data_by_slug['Gallery']['images'];
            $gallery_page_modified = $get_gallery_data_by_slug['Gallery']['modified'];
        } else {
            $gallery_page_id = '';
            $gallery_page_content = '';
            $gallery_page_title = '';
            $gallery_page_images = '';
            $gallery_page_modified = '';
        }

        $get_moregallery_data = $this->Gallery->find('all', array('conditions' => array('status IN'=> array(1), 'id NOT IN'=>array($gallery_page_id)), 'limit' => 10, 'order' => array('id' => 'desc')) );

        //$this->pre($get_moregallery_data);

        $get_sidebarupr_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'6\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebarupr_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>6)));
        foreach ($get_sidebarupr_data_by_category as $sidebarupr_key => $sidebarupr_data)
        {
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_id'] = $sidebarupr_catdata['NewsCategory']['id'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_name'] = $sidebarupr_catdata['NewsCategory']['name'];
            $get_sidebarupr_data_by_category[$sidebarupr_key]['News']['cat_slug'] = $sidebarupr_catdata['NewsCategory']['slug'];
        }

        $get_sidebardown_data_by_category = $this->News->find('all', array('conditions' => array('status IN'=> array(1), 'FIND_IN_SET(\'8\',categories)'), 'limit' => 7, 'order' => array('id' => 'desc')));
        //$this->pre($get_morenews_data_by_category);exit;
        $sidebardown_catdata = $this->NewsCategory->find('first', array('conditions' => array('status IN'=> array(1), 'id'=>8)));
        foreach ($get_sidebardown_data_by_category as $sidebardown_key => $sidebardown_data)
        {
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_id'] = $sidebardown_catdata['NewsCategory']['id'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_name'] = $sidebardown_catdata['NewsCategory']['name'];
            $get_sidebardown_data_by_category[$sidebardown_key]['News']['cat_slug'] = $sidebardown_catdata['NewsCategory']['slug'];
        }

        $this->set('owl_enabled', 'enabled');
        $this->set('page_name', 'gallery_detail');
        $this->set('gallery_page_title', $gallery_page_title);
        $this->set('gallery_page_images', $gallery_page_images);
        $this->set('gallery_page_content', $gallery_page_content);
        $this->set('gallery_page_modified', $gallery_page_modified);
        $this->set('gallery_page_moregallery', $get_moregallery_data);
        $this->set('news_page_sidebarupr', $get_sidebarupr_data_by_category);
        $this->set('news_page_sidebardown', $get_sidebardown_data_by_category);

    }

    public function live_tv(){
        $this->set('livetv_page_title', 'Live TV');
    }

    public function marketing(){
        $this->set('marketing_page_title', 'માર્કેટિંગ યાર્ડ ભાવ');
        
        //$pricelistId = $this->params['named']['pricelistId'];

        $this->loadmodel('MarketingPrice');
        $this->loadmodel('Pricelist');

        if ($this->request->is('post'))
        {
            if(!empty($this->request->data) && isset($this->request->data) )
            {
                //$this->pre($this->request->data);exit; 

                $search_key = trim($this->request->data['marketingpriceSearch']['searchtitle']);
                if (!empty($search_key))
                {
                    $conditions[] = array(
                        "OR" => array(
                            "MarketingPrice.commodityeng LIKE" => "%".$search_key."%",
                            "MarketingPrice.commodityguj LIKE" => "%".$search_key."%",
                            "MarketingPrice.centereng LIKE" => "%".$search_key."%",
                            "MarketingPrice.centerguj LIKE" => "%".$search_key."%"
                        )
                    );
                }
                $this->Session->write('search_key', $search_key);

                $commodityeng = trim($this->request->data['marketingpriceSearch']['commodityeng']);
                if (!empty($commodityeng))
                {
                    $conditions[] = array(
                        "OR" => array(
                            "MarketingPrice.commodityeng" => "".$commodityeng.""
                        )
                    );
                    //$this->set('from_search',true);
                }
                $this->Session->write('search_commodityeng', $commodityeng);

                $centereng = trim($this->request->data['marketingpriceSearch']['centereng']);
                if (!empty($centereng))
                {
                    $conditions[] = array(
                        "OR" => array(
                            "MarketingPrice.centereng" => "".$centereng.""
                        )
                    );
                    //$this->set('from_search',true);
                }
                $this->Session->write('search_centereng', $centereng);

                $this->Session->write('searchCond', $conditions);
            }
        }

        if(!empty($this->request->data['Pricelist']['listing_date'])){
            $search_date = $this->request->data['Pricelist']['listing_date'];
        } else {
            $search_date = date('Y-m-d');
        }

        //var_dump($search_date);

        $this->Session->write('search_date', $search_date);

        $priceListData = $this->Pricelist->find('first', array('conditions' => array('status IN'=> array(1), 'listing_date'=>$search_date)));
        $pricelistId = $priceListData['Pricelist']['id'];
        

        //var_dump($pricelistId);
        //exit;

        $mainConditions = array('pricelist_id'=>$pricelistId, 'status IN'=> array(0,1));

        if ($this->Session->check('searchCond')) {
            $conditions = $this->Session->read('searchCond');
            $allConditions = array_merge($mainConditions, $conditions);
        } else {
            $conditions = array();
            $allConditions = array_merge($mainConditions, $conditions);
        }

        //$this->pre($allConditions);
        //exit;

        $this->paginate = array(
            'conditions' => $allConditions,
            'limit' => 25,
            'order' => array('id' => 'asc')
        );
        
        $marketingprices_data = $this->paginate('MarketingPrice');

        $marketingprices_alldata = $this->MarketingPrice->find('all', array('conditions' => $mainConditions));
        //$this->pre($marketingprices_alldata);exit;

        $this->set('marketingprices_data',$marketingprices_data);
        $this->set('marketingprices_alldata',$marketingprices_alldata);
    }

    public function marketing_app(){
        $this->set('marketing_page_title', 'માર્કેટિંગ યાર્ડ ભાવ');
        
        //$pricelistId = $this->params['named']['pricelistId'];

        $this->loadmodel('MarketingPrice');
        $this->loadmodel('Pricelist');

        if ($this->request->is('post'))
        {
            if(!empty($this->request->data) && isset($this->request->data) )
            {
                //$this->pre($this->request->data);exit; 

                $search_key = trim($this->request->data['marketingpriceSearch']['searchtitle']);
                if (!empty($search_key))
                {
                    $conditions[] = array(
                        "OR" => array(
                            "MarketingPrice.commodityeng LIKE" => "%".$search_key."%",
                            "MarketingPrice.commodityguj LIKE" => "%".$search_key."%",
                            "MarketingPrice.centereng LIKE" => "%".$search_key."%",
                            "MarketingPrice.centerguj LIKE" => "%".$search_key."%"
                        )
                    );
                }
                $this->Session->write('search_key', $search_key);

                $commodityeng = trim($this->request->data['marketingpriceSearch']['commodityeng']);
                if (!empty($commodityeng))
                {
                    $conditions[] = array(
                        "OR" => array(
                            "MarketingPrice.commodityeng" => "".$commodityeng.""
                        )
                    );
                    //$this->set('from_search',true);
                }
                $this->Session->write('search_commodityeng', $commodityeng);

                $centereng = trim($this->request->data['marketingpriceSearch']['centereng']);
                if (!empty($centereng))
                {
                    $conditions[] = array(
                        "OR" => array(
                            "MarketingPrice.centereng" => "".$centereng.""
                        )
                    );
                    //$this->set('from_search',true);
                }
                $this->Session->write('search_centereng', $centereng);

                $this->Session->write('searchCond', $conditions);
            }
        }

        if(!empty($this->request->data['Pricelist']['listing_date'])){
            $search_date = $this->request->data['Pricelist']['listing_date'];
        } else {
            $search_date = date('Y-m-d');
        }

        //var_dump($search_date);

        $this->Session->write('search_date', $search_date);

        $priceListData = $this->Pricelist->find('first', array('conditions' => array('status IN'=> array(1), 'listing_date'=>$search_date)));
        $pricelistId = $priceListData['Pricelist']['id'];
        

        //var_dump($pricelistId);
        //exit;

        $mainConditions = array('pricelist_id'=>$pricelistId, 'status IN'=> array(0,1));

        if ($this->Session->check('searchCond')) {
            $conditions = $this->Session->read('searchCond');
            $allConditions = array_merge($mainConditions, $conditions);
        } else {
            $conditions = array();
            $allConditions = array_merge($mainConditions, $conditions);
        }

        //$this->pre($allConditions);
        //exit;

        $this->paginate = array(
            'conditions' => $allConditions,
            'limit' => 25,
            'order' => array('id' => 'asc')
        );
        
        $marketingprices_data = $this->paginate('MarketingPrice');

        $marketingprices_alldata = $this->MarketingPrice->find('all', array('conditions' => $mainConditions));
        //$this->pre($marketingprices_alldata);exit;

        $this->set('marketingprices_data',$marketingprices_data);
        $this->set('marketingprices_alldata',$marketingprices_alldata);
    }

    public function polluserform($poll_id, $selected_ans)
    {
        $this->set('poll_id', $poll_id);
        $this->set('selected_ans', $selected_ans);
    }

}