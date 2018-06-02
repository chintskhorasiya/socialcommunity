<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    // ,'DebugKit'
    var $helpers = array('Html', 'Form', 'Time', 'Session');
    //var $components = array('Email','Session','Cookie','RequestHandler','DebugKit.Toolbar' => array(/* array of settings */));
    var $components = array('Email', 'Session', 'Cookie', 'RequestHandler');
    var $uses = array('User');

    function beforeFilter() {

        if($this->params['controller'] == "pages" || $this->params['controller'] == "contacts" || $this->params['controller'] == "homemodules" || $this->params['controller'] == "banners" || $this->params['controller'] == "newsevents" || $this->params['controller'] == "advertises" || $this->params['controller'] ==  "galleryimages" || $this->params['controller'] == "committeemembers" || $this->params['controller'] == "clients" || $this->params['controller'] == "infrastructures" || $this->params['controller'] == "videos" || $this->params['controller'] == "galleries" || $this->params['controller'] == "epapers" || $this->params['controller'] == "polls" || $this->params['controller'] == "pricelists" || $this->params['controller'] == "marketingprices" || $this->params['controller'] == "settings" || $this->params['controller'] == "donations" || $this->params['controller'] == "members" || $this->params['controller'] == "donationdetails")
        {
            $this->checklogin();
        }

        date_default_timezone_set('Asia/Kolkata');
        //echo $today = date("Y-m-d H:i:s");

//        $sendpage = $this->referer();
//        $this->set("sendpage",$sendpage);

        //$this->pre($this->params);

        if($this->params['controller'] == "pages" || $this->params['controller'] == "contacts" || $this->params['controller'] == "homemodules" || $this->params['controller'] == "banners" || $this->params['controller'] == "newsevents" || $this->params['controller'] == "advertises" || $this->params['controller'] ==  "galleryimages" || $this->params['controller'] == "committeemembers" || $this->params['controller'] == "clients" || $this->params['controller'] == "infrastructures" || $this->params['controller'] == "videos" || $this->params['controller'] == "galleries" || $this->params['controller'] == "epapers" || $this->params['controller'] == "polls" || $this->params['controller'] == "pricelists" || $this->params['controller'] == "marketingprices" || $this->params['controller'] == "settings" || $this->params['controller'] == "donations" || $this->params['controller'] == "members" || $this->params['controller'] == "donationdetails")
        {
            $pagenames = $this->params['controller'].'/'.$this->params['action'];
        }
        else
        {
            $pagenames = $this->params['action'];
        }

        // for front footer data
        if($this->params['controller'] == "front")
        {
            $this->set('front', true);
            $this->loadmodel('Page');
            $this->loadmodel('Setting');
            $this->loadmodel('Contact');
            $GeneralSettingsData = $this->Setting->find('all', array('conditions'=>array('status'=>1), 'order' => 'id DESC'));

            if(!empty($GeneralSettingsData)){
                $social_data = array();
                foreach ($GeneralSettingsData as $g_setting_num => $g_setting_data)
                {
                    if(!empty($g_setting_data['Setting']['key']))
                    {
                        $social_data[$g_setting_data['Setting']['key']] = $g_setting_data['Setting']['value'];
                    }
                }
            } else {
                $social_data = array();
                $social_data['facebook'] = '';
                $social_data['google'] = '';
                $social_data['youtube'] = '';
                $social_data['twitter'] = '';
            }

            $ContactsData = $this->Contact->find('all', array('conditions'=>array('id'=>1)));

            if(!empty($ContactsData)){
                $contact_data = array();
                foreach ($ContactsData as $g_contact_num => $g_contact_data)
                {
                    $contact_data['address'] = $g_contact_data['Contact']['address'];
                    $contact_data['phone'] = $g_contact_data['Contact']['phone'];
                    $contact_data['mobile'] = $g_contact_data['Contact']['mobile'];
                    $contact_data['email'] = $g_contact_data['Contact']['email'];
                    $contact_data['mapcode'] = $g_contact_data['Contact']['mapcode'];
                }
            } else {
                $contact_data = array();
                $contact_data['address'] = '';
                $contact_data['phone'] = '';
                $contact_data['mobile'] = '';
                $contact_data['email'] = '';
                $contact_data['mapcode'] = '';
            }
            
            //$this->pre($contact_data);exit;
            $this->set('contact_data', $contact_data);
            $this->set('social_data', $social_data);
            // for social links

        }
        // for front footer data
        
        if($this->params['controller'] == "front") {
            $this->set_title($pagenames, $this->params['pass']);
        } else {
            $this->set_title($pagenames);
        }

        $encrypt_id = $this->encrypt_data($this->Session->read(md5(SITE_TITLE) . 'USERID'),ID_LENGTH);
        $this->set('encrypt_id',$encrypt_id);
    }

    function set_title($pagenames, $params='') {
        //echo $pagenames;
        //var_dump($params);
        $dynamic_name = '';

        if($pagenames == "page_display"){

            if($params[0] == "about-us"){
                $dynamic_name .= 'About Us';
            }

        }

        if($pagenames == "executive_committee_list"){ $dynamic_name .= 'Executive Committee Members'; }
        if($pagenames == "advisory_committee_list"){ $dynamic_name .= 'Advisory Committee Members'; }
        if($pagenames == "yuva_committee_list"){ $dynamic_name .= 'Yuva Committee Members'; }
        if($pagenames == "contact_us"){ $dynamic_name .= 'Contact Us'; }
        if($pagenames == "news_events_listing"){ $dynamic_name .= 'News & Events'; }
        if($pagenames == "donors_list"){ $dynamic_name .= 'Donors List'; }

        $title_arr = array(
            'index'=>'Login',
            'admin_dashboard'=>'Dashboard',
            'admin_editprofile'=>'Edit Profile',
            'admin_change_password'=>'Change Password',
            'member_directory_list'=>'Member Directory',
            'matrimonial_list'=>'Matrimonial List',
            'registration'=>'Registration',
            'forgot_password'=>'Forgot Password',
            'homemodules/admin_search'=>'Searched Home Modules List',
            'homemodules/admin_lists'=>'Home Modules List',
            'homemodules/admin_add'=>'Add Home Module',
            'homemodules/admin_edit'=>'Edit Home Module',
            'banners/admin_search'=>'Searched Banners List',
            'banners/admin_lists'=>'Banners List',
            'banners/admin_add'=>'Add Banner',
            'banners/admin_edit'=>'Edit Banner',
            'pages/admin_search'=>'Searched Pages List',
            'pages/admin_lists'=>'Pages List',
            'pages/admin_add'=>'Add Page',
            'pages/admin_edit'=>'Edit Page',
            'newsevents/admin_search'=>'Searched News & Events List',
            'newsevents/admin_lists'=>'News & Events List',
            'newsevents/admin_add'=>'Add News & Event',
            'newsevents/admin_edit'=>'Edit News & Event',
            'galleryimages/admin_search'=>'Searched Gallery Images List',
            'galleryimages/admin_lists'=>'Gallery Images List',
            'galleryimages/admin_add'=>'Add Gallery Image',
            'galleryimages/admin_edit'=>'Edit Gallery Image',
            'committeemembers/admin_search'=>'Searched Committee Members List',
            'committeemembers/admin_lists'=>'Committee Members List',
            'committeemembers/admin_add'=>'Add Committee Member',
            'committeemembers/admin_edit'=>'Edit Committee Member',
            'members/admin_search'=>'Searched Members List',
            'members/admin_lists'=>'Members List',
            'members/admin_add'=>'Add Member',
            'members/admin_edit'=>'Edit Member',
            'donations/admin_search'=>'Searched Donors List',
            'donations/admin_lists'=>'Donors List',
            'donations/admin_add'=>'Add Donor',
            'donations/admin_edit'=>'Edit Donor',
            'newscategories/admin_search'=>'Searched News Categories',
            'newscategories/admin_lists'=>'News Categories',
            'newscategories/admin_add'=>'Add News Category',
            'newscategories/admin_edit'=>'Edit News Category',
            'news/admin_lists'=>'News List',
            'news/admin_add'=>'Add News',
            'news/admin_edit'=>'Edit News',
            'news/admin_search'=>'Searched News List',
            'home'=>'Home page',
            'news_detail'=>$dynamic_name,
            'news_listing'=>$dynamic_name,
            'advertises/admin_search'=>'Searched Advertises List',
            'advertises/admin_add'=>'Add Advertise',
            'advertises/admin_lists'=>'Advertises List',
            'advertises/admin_edit'=>'Edit Advertise',
            'videos/admin_search'=>'Searched Videos List',
            'videos/admin_lists'=>'Videos List',
            'videos/admin_add'=>'Add Video',
            'videos/admin_edit'=>'Edit Video',
            'videos_listing'=>'Videos',
            'video_detail'=>$dynamic_name,
            'epapers/admin_search'=>'Searched E-Papers List',
            'epapers/admin_lists'=>'E-Papers List',
            'epapers/admin_add'=>'Add E-Paper',
            'epapers/admin_edit'=>'Edit E-Paper',
            'epapers'=>'E-Papers',
            'epapers_listing'=>$dynamic_name,
            'epaper'=>$dynamic_name,
            'news_search_results'=>'News Search Results',
            'settings/admin_general'=>'General Settings',
            'contacts/admin_edit'=>'Contacts Settings',
            'donationdetails/admin_edit'=>'Donations Settings',
            'galleries/admin_search'=>'Searched Galleries List',
            'galleries/admin_lists'=>'Galleries List',
            'galleries/admin_add'=>'Add Gallery',
            'galleries/admin_edit'=>'Edit Gallery',
            'gallery_listing'=>'Photo Gallery',
            'gallery_detail'=>$dynamic_name,
            'polls/admin_search'=>'Searched Polls List',
            'polls/admin_lists'=>'Polls List',
            'polls/admin_add'=>'Add Poll',
            'polls/admin_edit'=>'Edit Poll',
            'pricelists/admin_search'=>'Searched Prices List',
            'pricelists/admin_lists'=>'Prices List',
            'pricelists/admin_add'=>'Add Prices List',
            'pricelists/admin_edit'=>'Edit Prices List',
            'marketingprices/admin_lists'=>'Prices',
            'live_tv'=>'લાઈવ ટીવી',
            'marketing'=>'માર્કેટિંગ યાર્ડ ભાવ',
            'page_display'=>$dynamic_name,
            'executive_committee_list'=>$dynamic_name,
            'advisory_committee_list'=>$dynamic_name,
            'yuva_committee_list'=>$dynamic_name,
            'contact_us'=>$dynamic_name,
            'news_events_listing'=>$dynamic_name,
            'donors_list'=>'Donors List',
            'donation_facility'=>'Donation Facility',
        );
//
        //echo $title_arr[$pagenames];
        $this->set('page_title_tag',(isset($title_arr[$pagenames]) && $title_arr[$pagenames]!='')?$title_arr[$pagenames]:'');
    }

    //Function for check admin session
    function checklogin() {
        // if the admin session hasn't been set  3
        if ($this->Session->check(md5(SITE_TITLE) . 'USERID') == false) {
            //$this->Session->setFlash('The URL you\'ve followed requires you login.');
            //$this->redirect(DEFAULT_URL);
            $this->redirect(DEFAULT_ADMINURL);
            exit();
        }
    }

    //Function for check admin session
    function checkadminlogin() {
        // if the admin session hasn't been set  3
        if ($this->Session->check(md5(SITE_TITLE) . 'AUSERID') == false) {
            //$this->Session->setFlash('The URL you\'ve followed requires you login.');
            //$this->redirect(DEFAULT_URL);
            $this->redirect(DEFAULT_ADMINURL . 'users/index');
            exit();
        }
    }

    //function for add slug for seo friendly
    function _toSlug($string) {
        return strtolower(Inflector::slug($string, '-'));
    }

    //function for add slashed to string
    function addslashes($string) {
        return addslashes(trim($string));
    }

    //function for remove slashed to string
    function stripslashes($string) {
        return stripslashes(trim($string));
    }

    //Function for set date format
    function setdateformat($date, $format) {
        $return_date = date($format, strtotime($date));
        return $return_date;
    }
    //For remove space
    function remove_space($str, $charlist = " \t\n\r\0\x0B") {
        return str_replace(str_split($charlist), '', $str);
    }

    //For compare date
    function greaterdate($start_date, $end_date) {
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        if ($start - $end > 0)
            return 1;
        else
            return 0;
    }

    //For check email validation
    function IsEmail($value, $msg = '') {
        //echo $value = "vivek.acharya@digi-corp.co";
        //$result = ereg('^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$', $value);
        //Changes by vivek for check valid email (1 for valid and 0 for Invalid)
        //Reference site http://www.plus2net.com/php_tutorial/php_email_validation.php
        $result = ereg("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", strtolower(strip_tags($value)));
        if ($result) {
            return 1;
            //For Valid
        } else {
            //For Invalid
            return 0;
        }
    }

    //for generate password
    function generatePassword($length = PASSWORD_LIMIT) {
        // initialize variables
        $password = "";
        $i = 0;
        //$possible = "0123456789bcdfghjkmnpqrstvwxyz";
        $possible = md5(rand(1, 26));
        // add random characters to $password until $length is reached
        while ($i < $length) {
            // pick a random character from the possible ones
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            // we don't want this character if it's already in the password
            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }

    //check valid url
    function isValidURL($value, $msg = '') {
        //CHECK All URL FOR TESTING
        //echo $url = "192.168.0.9"; //Not valid
        //echo $url = "ftp://192.168.0.9"; //Not valid
        //echo $url = "192.168.0.9/caps/event.php?action=edit&ids=4&start=1&nstart=1";  //valid
        //echo $url = "www.google.com";
        //echo $url = "http://www.a.a.s/a.zxa";
        //echo $url = "http://sogame.awardspace.com/dummylipsum/"; //valid
        //echo $url = "http://192.168.0.9"; //valid
        //echo $url = "http://test/qq"; //valid
        //echo $url = "http://192.168.0.9/caps/event.php?action=edit&ids=2&start=1&nstart=1"; //valid
        //echo $url = "http://aps/event.php?action=edit&ids=2&start=1&nstart=1"; //valid

        $url = trim($value);

        // SCHEME
        $urlregex = "^(https?|ftp)\:\/\/";

        // USER AND PASS (optional)
        $urlregex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";

        // HOSTNAME OR IP
        //$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*";  // http://x = allowed (ex. http://localhost, http://routerlogin)
        //$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)+";  // http://x.x = minimum
        $urlregex .= "([a-z0-9+\$_-]+\.)*[a-z0-9+\$_-]{2,3}";  // http://x.xx(x) = minimum
        //use only one of the above
        // PORT (optional)
        //$urlregex .= "(\:[0-9]{2,5})?";
        // PATH  (optional)
        //$urlregex .= "(\/([a-z0-9+\$_-]\.?)+)*\/?";
        // GET Query (optional)
        //$urlregex .= "(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?";
        // ANCHOR (optional)
        //$urlregex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?\$";
        // check
        if (!eregi($urlregex, $url)) {
            //echo " false";
            return 0;
        } else {
            //echo " true";
            return 1;
        }
    }

    // For remove all files and that directory
    function rrmdir($dir) {
        foreach (glob($dir . '/*') as $file) {
            if (is_dir($file))
                rrmdir($file);
            else
                unlink($file);
        }
        rmdir($dir);
    }

    //Function for encrypt data
    function encrypt_data($id,$length) {
        return substr(md5($id), 0, $length) . dechex($id);
    }

    //Function for decrypt data
    function decrypt_data($id,$length) {
        $md5_8 = substr($id, 0, $length);
        $real_id = hexdec(substr($id, $length));
        return ($md5_8 == substr(md5($real_id), 0, $length)) ? $real_id : 0;
    }

    //Function for encrypt password
    function encrypt_pass($password) {
        return base64_encode($password);
    }

    //Function for decrypt password
    function decrypt_pass($password) {
        return base64_decode($password);
    }

    // function for set usertype combo
    function set_usertype() {
        $utype = array('superadmin'=> 'Super Admin','admin'=>'Admin','manufacturer'=>'Manufacturer','image-management'=>'Image Management','office-order-management'=>'Office order Management');
        $this->set('user_type',$utype);
        return $utype;
    }

    function pre($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        //exit;
    }

    // Function for check only interger value
    function check_int($var) {
        if(preg_match("/^[0-9]+$/",$var))
            return 0;   //Only number
        else
            return 1;   //Not Number
    }

    //function for check string
    function check_hasnumber($str) {
        if (preg_match('#[0-9]#',$str)){
            return 1;   //echo 'has number';
        }else{
            return 0;   //echo 'no number';
        }
    }

    //For delete shopping cart details
    function deletesession() {
        $this->Session->delete("cartarraydata");
    }

    // For send notes email with multiple file attachment
    function mailAttachments($to, $from, $subject, $message, $attachments = array(), $headers = array(), $additional_parameters = '') {
        $headers['From'] = $from;

        // Define the boundray we're going to use to separate our data with.
        $mime_boundary = '==MIME_BOUNDARY_' . md5(time());

        // Define attachment-specific headers
        $headers['MIME-Version'] = '1.0';
        $headers['Content-Type'] = 'multipart/mixed; boundary="' . $mime_boundary . '"';

        // Convert the array of header data into a single string.
        $headers_string = '';
        foreach ($headers as $header_name => $header_value) {
            if (!empty($headers_string)) {
                $headers_string .= "\r\n";
            }
            $headers_string .= $header_name . ': ' . $header_value;
        }

        // Message Body
        $message_string = '--' . $mime_boundary;
        $message_string .= "\r\n";
        $message_string .= 'Content-Type: text/html; charset="iso-8859-1"';
        $message_string .= "\r\n";
        $message_string .= 'Content-Transfer-Encoding: 7bit';
        $message_string .= "\r\n";
        $message_string .= "\r\n";
        $message_string .= $message;
        $message_string .= "\r\n";
        $message_string .= "\r\n";

        // Add attachments to message body
        foreach ($attachments as $local_filename => $attachment_filename) {
            if (is_file($local_filename)) {
                $message_string .= '--' . $mime_boundary;
                $message_string .= "\r\n";
                $message_string .= 'Content-Type: application/octet-stream; name="' . $attachment_filename . '"';
                $message_string .= "\r\n";
                $message_string .= 'Content-Description: ' . $attachment_filename;
                $message_string .= "\r\n";

                $fp = @fopen($local_filename, 'rb'); // Create pointer to file
                $file_size = filesize($local_filename); // Read size of file
                $data = @fread($fp, $file_size); // Read file contents
                $data = chunk_split(base64_encode($data)); // Encode file contents for plain text sending

                $message_string .= 'Content-Disposition: attachment; filename="' . $attachment_filename . '"; size=' . $file_size . ';';
                $message_string .= "\r\n";
                $message_string .= 'Content-Transfer-Encoding: base64';
                $message_string .= "\r\n\r\n";
                $message_string .= $data;
                $message_string .= "\r\n\r\n";
            }
        }

        // Signal end of message
        $message_string .= '--' . $mime_boundary . '--';

        // Send the e-mail.
        return mail($to, $subject, $message_string, $headers_string, $additional_parameters);
    }

    function emailheader() {
        $content = '
                <table width="100%" cellspacing="10" cellpadding="10" style="background:#f8f8f8;" style="font-family:Arial, Helvetica, sans-serif;border:2px solid #ccc;">
                <tr style="background:#fff;border-radius:10px;">
                    <td valign="center"><img src="'.IMAGE_URL.'email_header_part.jpg" alt="'.SITE_TITLE.'" style="margin:0px auto;display:block;width:100%;"/></td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">';
        return $content;
    }

    function emailfooter() {
        $content = '    <tr>
                            <td height="10"></td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif;color:#333;font-size:12px;">
                                Thanks & Regards,
                                <br/>
                                Mobile No: +91 8488872493
                                <br/>
                                Website :
                                <a href="#" style="color:#01a0e4;text-decoration:none;">www.bhagyagold.com</a>
                                <br/>
                                <br/>
                                Facebook : <a href="#" style="color:#01a0e4;text-decoration:none;" target="_blank">https://www.facebook.com/bhagyagold</a>
                                <br/>
                                Twitter : <a href="#" style="color:#01a0e4;text-decoration:none;" target="_blank">https://twitter.com/bhagyagold</a>
                                <br/>
                                Google Plus : <a href="#" style="color:#01a0e4;text-decoration:none;" target="_blank">https://plus.google.com/bhagyagold</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px; padding-bottom:15px; padding-top:15px; border-top:1px solid #ccc;text-align:center;background:#02a0e7;color:#fff;"> &copy; 2016 <a href="#" style="color:#fff;text-decoration:none;">www.bhagyagold.com</a></td>
                </tr>
            </table>
        </table>';
        return $content;
    }

    //Function for send email to admin when registration
    function email_admin_registration($userpassword) {
        $this->Email->from = trim($this->data['User']['email']);
        $this->Email->to = ADMIN_EMAIL_TO;
        $this->Email->subject = REGISTRATION_ADMIN;
        $this->Email->sendAs = 'html';

//        $this->pre($this->data);
//        exit;

        $content = $this->emailheader();
        $content .= '
                        <tr>
                            <td><p style="font-weight:bold; text-align:left; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0;">Dear '.trim(ADMIN_EMAIL_NAME).',</p></td>
                        </tr>
                        <tr>
                            <td><p style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:10px; margin:0;">New customer signing up with '.SITE_NAME.'!</p></td>
                        </tr>
                        <tr>
                            <td><p style="font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0; text-align:left; font-size:12px;" >Below are customer details.</p></td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:5px; margin:0;"><b>Name:</b> '.trim($this->data['User']['fname']).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:5px; margin:0;"><b>Company Name:</b> '.trim($this->data['User']['company_name']).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:5px; margin:0;"><b>Email:</b> '.trim($this->data['User']['email']).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px;padding-bottom:5px; margin:0;"><b>Password:</b> '.trim($userpassword).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px;padding-bottom:5px; margin:0;"><b>Mobile:</b> '.trim($this->data['User']['mobile']).'</td>
                        </tr>';

        $content .= $this->emailfooter();

//        echo $content;
//        exit;

        $sendmail = $this->Email->send($content); // if $sendmail=1 then send successfully
        return $sendmail;
    }

    //Function for send email to client when registration
    function email_client_registration($userpassword) {

        $this->Email->from = ADMIN_EMAIL_FROM;
        $this->Email->to = trim($this->data['User']['email']);
        $this->Email->subject = REGISTRATION_CLIENT;
        $this->Email->sendAs = 'html';

        $content = $this->emailheader();
        $content .= '    <tr>
                            <th style="color:#12AFE3; text-align:left; font-size:17px; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; padding:10px 0;">Welcome To '.SITE_NAME.'</th>
                        </tr>
                        <tr>
                            <td><p style="font-weight:bold; text-align:left; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0;">Dear '.trim($this->data['User']['fname']).',</p></td>
                        </tr>
                        <tr>
                            <td><p style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:10px; margin:0;">Thank you for signing up with '.SITE_NAME.'!</p></td>
                        </tr>
                        <tr>
                            <td><p style="font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0; text-align:left; font-size:12px;" >Below are your credentials. Please keep this email for future use.</p></td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:5px; margin:0;"><b>Email:</b> '.trim($this->data['User']['email']).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px;"><b>Password:</b> '.trim($userpassword).'</td>
                        </tr>';

        $content .= $this->emailfooter();

//        echo $content;
//        exit;

        $sendmail = $this->Email->send($content); // if $sendmail=1 then send successfully
        return $sendmail;
    }

    //Function for forget password
    function email_client_forgetpass($name,$email,$new_pass) {

        $this->Email->from = ADMIN_EMAIL_FROM;
        $this->Email->to = trim($email);
        $this->Email->subject = FORGET_PASSWORD_CLIENT;
        $this->Email->sendAs = 'html';

        $content = $this->emailheader();
        $content .= '
                        <tr>
                            <td><p style="font-weight:bold; text-align:left; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0;">Dear '.$name.',</p></td>
                        </tr>
                        <tr>
                            <td><p style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:10px; margin:0;">Below are your credentials. Please keep this email for future use.</p></td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:5px; margin:0;"><b>Email:</b> '.trim($email).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px;"><b>Password:</b> '.trim($new_pass).'</td>
                        </tr>';

        $content .= $this->emailfooter();

//        echo $content;
//        exit;

        $sendmail = $this->Email->send($content); // if $sendmail=1 then send successfully
        return $sendmail;
    }

    //Function for forget password
    function email_admin_forgetpass($to, $newpass, $name) {

        $this->Email->from = ADMIN_EMAIL_FROM;
        $this->Email->to = trim($to);
        $this->Email->subject = FORGET_PASSWORD_CLIENT;
        $this->Email->sendAs = 'html';

        $content = $this->emailheader();
        $content .= '
                        <tr>
                            <td><p style="font-weight:bold; text-align:left; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0;">Dear '.$name.',</p></td>
                        </tr>
                        <tr>
                            <td><p style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:10px; margin:0;">Below are your credentials. Please keep this email for future use.</p></td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:5px; margin:0;"><b>Email:</b> '.trim($to).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px;"><b>Password:</b> '.trim($newpass).'</td>
                        </tr>';

        $content .= $this->emailfooter();

//        echo $content;
//        exit;

        $sendmail = $this->Email->send($content); // if $sendmail=1 then send successfully
        return $sendmail;
    }

    //Function for change password
    function email_client_changepassword($name,$email,$new_pass) {

        $this->Email->from = ADMIN_EMAIL_FROM;
        $this->Email->to = trim($email);
        $this->Email->subject = PASSWORD_CHANGE_CLIENT;
        $this->Email->sendAs = 'html';

        //echo 'Name'.$name.' Email '.$email.' new pass '.$new_pass;

        $content = $this->emailheader();
        $content .= '    <tr>
                            <th style="color:#12AFE3; text-align:left; font-size:17px; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif; padding:10px 0;">Welcome To '.SITE_NAME.'</th>
                        </tr>
                        <tr>
                            <td><p style="font-weight:bold; text-align:left; font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0;">Dear '.trim($name).',</p></td>
                        </tr>
                        <tr>
                            <td><p style="font-family:Verdana, Arial, Helvetica, sans-serif; padding-bottom:10px; margin:0; text-align:left; font-size:12px;" >Below are your credentials after change password</p></td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px; padding-bottom:5px; margin:0;"><b>Email:</b> '.trim($email).'</td>
                        </tr>
                        <tr>
                            <td style="font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; font-size:12px;"><b>Password:</b> '.trim($new_pass).'</td>
                        </tr>';

        $content .= $this->emailfooter();

//        echo $content;
//        exit;

        $sendmail = $this->Email->send($content); // if $sendmail=1 then send successfully
        return $sendmail;
    }
    function check_login_user($userid)
    {
        $session_user_id = $this->Session->read(md5(SITE_TITLE) . 'USERID');
        //echo $userid.' '.$session_user_id;

        if($userid != $session_user_id)
        {
            $this->redirect(DEFAULT_URL . 'users/dashboard');
        }
    }
    function check_url($content)
    {
        $check_url = explode('://',$content);
        if(count($check_url)>1)
        {
            //echo 'Url';
            return 1;
        }
        else
        {
            //echo 'No Url';
            return 0;
        }
    }
    function get_awnid($content)
    {
        $explode_content = explode('dp/',$content);
        $explode_ncontent = explode('/',$explode_content[1]);
        return $awnid = $explode_ncontent[0];
//        echo
//        $this->pre($explode_content);

    }
}
?>