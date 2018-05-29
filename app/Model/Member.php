<?php
App::uses('AppModel', 'Model');
App::import('Vendor', 'resize_img');

class Member extends AppModel {
    
    public $name = 'Member';

    public $validate = array(
        'first_name' => array(
            'rule' => 'notBlank',
            'message' => 'First name can not be empty'
        ),
        'last_name' => array(
            'rule' => 'notBlank',
            'message' => 'Last name can not be empty'
        ),
        'middle_name' => array(
            'rule' => 'notBlank',
            'message' => 'Middle name can not be empty'
        ),
        'relation' => array(
            'rule' => 'notBlank',
            'message' => 'Relation name can not be empty'
        ),
        'dob' => array(
            'rule' => 'notBlank',
            'message' => 'DOB can not be empty'
        ),
        'age' => array(
            'rule' => 'notBlank',
            'message' => 'Age can not be empty'
        ),
        'gender' => array(
            'rule' => 'notBlank',
            'message' => 'Please select Gender'
        ),
        'marital_status' => array(
            'rule' => 'notBlank',
            'message' => 'Please select Marital Status'
        ),
        'gotra' => array(
            'rule' => 'notBlank',
            'message' => 'Please select Gotra'
        ),
        'proffession' => array(
            'rule' => 'notBlank',
            'message' => 'Please select Proffession'
        ),
        'education' => array(
            'rule' => 'notBlank',
            'message' => 'Education can not be empty'
        ),
        'mobile' => array(
            'rule' => 'notBlank',
            'message' => 'Mobile can not be empty'
        ),
        'address' => array(
            'rule' => 'notBlank',
            'message' => 'Address can not be empty'
        ),
         'country' => array(
            'rule' => 'notBlank',
            'message' => 'Please select Country'
        ),
        'state' => array(
            'rule' => 'notBlank',
            'message' => 'Please select State'
        ),
        'city' => array(
            'rule' => 'notBlank',
            'message' => 'Please select City'
        ),
        'area' => array(
            'rule' => 'notBlank',
            'message' => 'Area can not be empty'
        ),
        'photo' => array(  
            'fileSize' => array(
                'rule' => array('fileSize', '<=', '2MB'),
                'message' => 'Image must be less than 2MB.',
                'allowEmpty' => true,
            ),
            // http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::mimeType
            'mimeType' => array(
                'rule' => array('mimeType', array('image/gif','image/png','image/jpg','image/jpeg')),
                'message' => 'Invalid file, only images allowed',
                'required' => FALSE,
                'allowEmpty' => TRUE,
            ),
            // custom callback to deal with the file upload
            'processUpload' => array(
                'rule' => 'processUpload',
                'message' => 'Something went wrong processing your file',
                'required' => FALSE,
                'allowEmpty' => TRUE,
                'last' => TRUE,
            )
        ),
        'doc' => array(  
            'fileSize' => array(
                'rule' => array('fileSize', '<=', '10MB'),
                'message' => 'File must be less than 10MB.',
                'allowEmpty' => true,
            ),
            'customTypeCheck' => array(
                'rule' => 'customTypeCheck',
                'message' => 'Invalid file, only documents allowed',
                'required' => FALSE,
                'allowEmpty' => TRUE,
                'last' => TRUE,
            ),
            // http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::mimeType
            /*'mimeType' => array(
                'rule' => array('mimeType', array('image/gif','image/png','image/jpg','image/jpeg')),
                'message' => 'Invalid file, only images allowed',
                'required' => FALSE,
                'allowEmpty' => TRUE,
            ),*/
            // custom callback to deal with the file upload
            'processUpload2' => array(
                'rule' => 'processUpload2',
                'message' => 'Something went wrong processing your file',
                'required' => FALSE,
                'allowEmpty' => TRUE,
                'last' => TRUE,
            )
        ),/*,
        'link' => array(
            'url' => array(
                'rule' => '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}((:[0-9]{1,5})?\\/.*)?$/i',
                //'rule'=>'/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i',
                'message' => 'Please enter valid URL e.g (http://site.com, https://site.com, http://www.site.com)'
            )
        )*/
    );

    /**
     * Upload Directory relative to WWW_ROOT
     * @param string
     */
    public $uploadDir = 'img/uploads/members_images';
    public $uploadDir2 = 'img/uploads/members_docs';

    /**
     * Process the Upload
     * @param array $check
     * @return boolean
     */
    public function processUpload($check=array()) {
        //echo '<pre>';print_r($check);exit;
        // deal with uploaded file
        if (!empty($check['photo']['tmp_name'])) {

            // check file is uploaded
            if (!is_uploaded_file($check['photo']['tmp_name'])) {
                return FALSE;
            }

            $images_move_dir = WWW_ROOT . $this->uploadDir . DS;

            if (!is_dir($images_move_dir)) {
                $oldmask = umask(0);
                mkdir($images_move_dir, 0777, true);
                chmod($images_move_dir, 0755);
                umask($oldmask);
            }

            // build full filename
            $new_image_name = Inflector::slug(pathinfo($check['photo']['name'], PATHINFO_FILENAME)).'.'.pathinfo($check['photo']['name'], PATHINFO_EXTENSION);

            $images = $images_move_dir . $new_image_name;

            $res_images = $images_move_dir . 'thumb_'.$new_image_name;
            $res2_images = $images_move_dir . 'front_'.$new_image_name;

            // @todo check for duplicate filename

            // try moving file
            if (!move_uploaded_file($check['photo']['tmp_name'], $images)) {
                return FALSE;

            // file successfully uploaded
            } else {
                // save the file path relative from WWW_ROOT e.g. uploads/example_filename.jpg
                //$this->data[$this->alias]['filepath'] = DEFAULT_URL.str_replace(DS, "/", str_replace(WWW_ROOT, "", $images) );

                $this->data[$this->alias]['filepath'] = $new_image_name;

                $resizeObj = new resize_image();
                $resizeObj->resize($images, $res_images, '150', '150','100');
                chmod($res_images,0777);

                $resize2Obj = new resize_image();
                $resize2Obj->resize($images, $res2_images, '250', '263','100');
                chmod($res2_images,0777);

                //var_dump($this->data[$this->alias]['filepath']);exit;
            }
        }

        return TRUE;
    }

    public function customTypeCheck($check=array()) {
        //echo '<pre>';print_r($check);exit;

        if ($check['doc']['type'] == 'application/pdf' || $check['doc']['type'] == 'application/msword') {
            return true;
        } else {
            return false;            
        }
    }

    public function processUpload2($check=array()) {

        //echo '<pre>';print_r($check);exit;
        // deal with uploaded file
        if (!empty($check['doc']['tmp_name'])) {

            // check file is uploaded
            if (!is_uploaded_file($check['doc']['tmp_name'])) {
                return FALSE;
            }

            // check file is uploaded
            /*if ($check['doc']['type'] == 'application/pdf') {
                return FALSE;
            }*/

            $images_move_dir = WWW_ROOT . $this->uploadDir2 . DS;

            if (!is_dir($images_move_dir)) {
                $oldmask = umask(0);
                mkdir($images_move_dir, 0777, true);
                chmod($images_move_dir, 0755);
                umask($oldmask);
            }

            // build full filename
            $new_image_name = Inflector::slug(pathinfo($check['doc']['name'], PATHINFO_FILENAME)).'.'.pathinfo($check['doc']['name'], PATHINFO_EXTENSION);

            $images = $images_move_dir . $new_image_name;

            //$res_images = $images_move_dir . 'thumb_'.$new_image_name;
            //$res2_images = $images_move_dir . 'front_'.$new_image_name;

            // @todo check for duplicate filename

            // try moving file
            if (!move_uploaded_file($check['doc']['tmp_name'], $images)) {
                return FALSE;

            // file successfully uploaded
            } else {
                // save the file path relative from WWW_ROOT e.g. uploads/example_filename.jpg
                //$this->data[$this->alias]['filepath'] = DEFAULT_URL.str_replace(DS, "/", str_replace(WWW_ROOT, "", $images) );

                $this->data[$this->alias]['filepath2'] = $new_image_name;

                //$resizeObj = new resize_image();
                //$resizeObj->resize($images, $res_images, '150', '150','100');
                //chmod($res_images,0777);

                //$resize2Obj = new resize_image();
                //$resize2Obj->resize($images, $res2_images, '250', '263','100');
                //chmod($res2_images,0777);

                //var_dump($this->data[$this->alias]['filepath']);exit;
            }
        }

        return TRUE;
    }

    /**
     * Before Save Callback
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // a file has been uploaded so grab the filepath
        //echo '<pre>';
        //print_r($this->data);exit;
        if (!empty($this->data[$this->alias]['filepath'])) {
            $this->data[$this->alias]['photo'] = $this->data[$this->alias]['filepath'];
        }
        if (!empty($this->data[$this->alias]['filepath2'])) {
            //var_dump($this->data[$this->alias]['filepath2']);exit;
            $this->data[$this->alias]['doc'] = $this->data[$this->alias]['filepath2'];
        }
        
        return parent::beforeSave($options);
    }

    /**
     * Before Validation
     * @param array $options
     * @return boolean
     */
    public function beforeValidate($options = array()) {
        // ignore empty file - causes issues with form validation when file is empty and optional
        if (!empty($this->data[$this->alias]['photo']['error']) && $this->data[$this->alias]['photo']['error']==4 && $this->data[$this->alias]['photo']['size']==0) {
            //echo "flgkmdfklg";exit;
            unset($this->data[$this->alias]['photo']);
        }
        if (!empty($this->data[$this->alias]['doc']['error']) && $this->data[$this->alias]['doc']['error']==4 && $this->data[$this->alias]['doc']['size']==0) {
            unset($this->data[$this->alias]['doc']);
        }

        parent::beforeValidate($options);
    }
    
}