<?php
App::uses('AppModel', 'Model');
App::import('Vendor', 'resize_img');

class Donation extends AppModel {
    
    public $name = 'Donation';

    public $validate = array(
        'name' => array(
            'rule' => 'notBlank',
            'message' => 'Name can not be empty'
        ),
        'address' => array(
            'rule' => 'notBlank',
            'message' => 'Address can not be empty'
        ),
        'amount' => array(
            'rule' => 'notBlank',
            'message' => 'Amount can not be empty'
        ),
        'propic' => array(  
            // http://book.cakephp.org/2.0/en/models/data-validation.html#Validation::uploadError
            /*'uploadError' => array(
                'rule' => 'uploadError',
                'message' => 'Something went wrong with the file upload',
                'required' => TRUE,
                'allowEmpty' => TRUE,
            ),*/
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
        )/*,
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
    public $uploadDir = 'img/uploads/Donations_images';

    /**
     * Process the Upload
     * @param array $check
     * @return boolean
     */
    public function processUpload($check=array()) {
        //echo '<pre>';print_r($check);exit;
        // deal with uploaded file
        if (!empty($check['propic']['tmp_name'])) {

            // check file is uploaded
            if (!is_uploaded_file($check['propic']['tmp_name'])) {
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
            $new_image_name = Inflector::slug(pathinfo($check['propic']['name'], PATHINFO_FILENAME)).'.'.pathinfo($check['propic']['name'], PATHINFO_EXTENSION);

            $images = $images_move_dir . $new_image_name;

            $res_images = $images_move_dir . 'thumb_'.$new_image_name;
            $res2_images = $images_move_dir . 'front_'.$new_image_name;

            // @todo check for duplicate filename

            // try moving file
            if (!move_uploaded_file($check['propic']['tmp_name'], $images)) {
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

    /**
     * Before Save Callback
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // a file has been uploaded so grab the filepath
        if (!empty($this->data[$this->alias]['filepath'])) {
            $this->data[$this->alias]['filepath'] = $this->data[$this->alias]['filepath'];
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
        if (!empty($this->data[$this->alias]['propic']['error']) && $this->data[$this->alias]['propic']['error']==4 && $this->data[$this->alias]['propic']['size']==0) {
            //echo "flgkmdfklg";exit;
            unset($this->data[$this->alias]['propic']);
        }

        parent::beforeValidate($options);
    }
    
}