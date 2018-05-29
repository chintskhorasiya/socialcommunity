<?php
################################################################
# Define constant for Error message (ADMIN SIDE)
################################################################
//Folder Constant
define("SITE_NAME","Community Social");
define("ADMIN_HEADER_TITLE","Community Social Administrator");
define("SITE_FOLDER","cakephp/communitysocial/");

if(!defined("DEFAULT_URL")) define("DEFAULT_URL","http://".$_SERVER["HTTP_HOST"]."/".SITE_FOLDER);

if(!defined("DEFAULT_FRONT_NEWS_DETAIL_URL")) define("DEFAULT_FRONT_NEWS_DETAIL_URL", DEFAULT_URL.'news-detail/');
if(!defined("DEFAULT_FRONT_NEWS_CATEGORY_URL")) define("DEFAULT_FRONT_NEWS_CATEGORY_URL", DEFAULT_URL.'news/');
if(!defined("DEFAULT_FRONT_NEWS_SEARCH_RESULTS_URL")) define("DEFAULT_FRONT_NEWS_SEARCH_RESULTS_URL", DEFAULT_URL.'news-search-results/');

if(!defined("DEFAULT_PAGE_IMAGE_URL")) define("DEFAULT_PAGE_IMAGE_URL", DEFAULT_URL.'img/uploads/pages_images/');
if(!defined("DEFAULT_CATEGORY_IMAGE_URL")) define("DEFAULT_CATEGORY_IMAGE_URL", DEFAULT_URL.'img/uploads/category_images/');
if(!defined("DEFAULT_PRODUCTS_IMAGE_URL")) define("DEFAULT_PRODUCTS_IMAGE_URL", DEFAULT_URL.'img/uploads/products_images/');
if(!defined("DEFAULT_NEWSEVENTS_IMAGE_URL")) define("DEFAULT_NEWSEVENTS_IMAGE_URL", DEFAULT_URL.'img/uploads/newsevents_images/');
if(!defined("DEFAULT_BANNER_IMAGE_URL")) define("DEFAULT_BANNER_IMAGE_URL", DEFAULT_URL.'img/uploads/banners_images/');
if(!defined("DEFAULT_CLIENT_IMAGE_URL")) define("DEFAULT_CLIENT_IMAGE_URL", DEFAULT_URL.'img/uploads/clients_images/');
if(!defined("DEFAULT_BLOGS_IMAGE_URL")) define("DEFAULT_BLOGS_IMAGE_URL", DEFAULT_URL.'img/uploads/blogs_images/');
if(!defined("DEFAULT_HOMEMODULE_IMAGE_URL")) define("DEFAULT_HOMEMODULE_IMAGE_URL", DEFAULT_URL.'img/uploads/homemodules_images/');
if(!defined("DEFAULT_ADVERTISE_IMAGE_URL")) define("DEFAULT_ADVERTISE_IMAGE_URL", DEFAULT_URL.'img/uploads/advertises_images/');
if(!defined("DEFAULT_GALLERY_IMAGE_URL")) define("DEFAULT_GALLERY_IMAGE_URL", DEFAULT_URL.'img/uploads/galleryimages_images/');
if(!defined("DEFAULT_COMMITTEEMEMBER_IMAGE_URL")) define("DEFAULT_COMMITTEEMEMBER_IMAGE_URL", DEFAULT_URL.'img/uploads/committeemembers_images/');
if(!defined("DEFAULT_DONATION_IMAGE_URL")) define("DEFAULT_DONATION_IMAGE_URL", DEFAULT_URL.'img/uploads/Donations_images/');


if(!defined("DEFAULT_ADMINURL")) define("DEFAULT_ADMINURL","http://".$_SERVER["HTTP_HOST"]."/".SITE_FOLDER."admin/");
define("INCLUDE_SITE_ROOT",$_SERVER["DOCUMENT_ROOT"]."/".SITE_FOLDER."app/webroot/");
define("SITE_ROOT_IMAGE",$_SERVER["DOCUMENT_ROOT"]."/".SITE_FOLDER."app/webroot/img/");
define("SITE_URL","http://".$_SERVER["HTTP_HOST"]."/".SITE_FOLDER);
define("IMAGE_URL","http://".$_SERVER["HTTP_HOST"]."/".SITE_FOLDER."img/");
define("STATIC_PAGE_URL","http://".$_SERVER["HTTP_HOST"]."/".SITE_FOLDER."static/");

define("UPLOAD_FOLDER",SITE_ROOT_IMAGE."uploads/");
define("DISPLAY_URL_IMAGE",IMAGE_URL."uploads/");

//Site constant
define("SITE_TITLE",'Community Social');
define("SITE_EMAIL","project@seawindsolution.com");

//Email configuration
define("SITE_TEAM","Community Social Team ");

define("ADMIN_EMAIL_NAME","Admin");
define("ADMIN_EMAIL_FROM","chintan@seawindsolution.com");
define("ADMIN_EMAIL_TO","project@seawindsolution.com");
define("SUPPORT_SITE_EMAIL","support@seawindsolution.com");
//Contact us message
define("SUC_SEND_CONTACT","your message send successfully we will contact you soon");

// Registration message
define("SUC_REGISTRATION","User Registration successfully");

/* login page messages */
define("ENTER_USERNAME","Please enter username.");
define("ENTER_EMAIL","Please enter email address.");
define("NOTLOGIN", "Invalid username or password.");
define("EMAIL_NOTFOUND", "Email does not found.");
define("ENTER_VALIDEMAIL", "Please enter valid email");

define("DUPLICATE_USERNAME","Username already exists.");
define("DUPLICATE_EMAIL","Email address already exists.");

/* change password page messages */
define("CURRPASS", "Please enter current password.");
define("NEWPASS", "Please enter password.");
define("CONFPASS", "Please enter confirm password.");
define("PASS_CHANGE", "Password has changed successfully.");
define("FORGOT_PASS_CHANGE", "Your passwrod is sent on your register email.");
define("PASS_CHANGE_CLIENT", "Thank you for your request to reset your password. We have sent you an email for that");

/*Error messages for login page */
define("ERROR_LOGIN","Username or password you entered is incorrect. Please try again.");
define("CORRECT_INFO","Please correct given information");

/* change password page messages */
define("ENTER_OLD_PASSWORD","Please enter old password");
define("ENTER_PASSWORD","Please enter password");
define("ENTER_NEW_PASSWORD","Please enter new password");
define("NEW_PASSWORD_LENGTH","Please new password length atleast 5 character");
define("PASSWORD_LENGTH","Please password length atleast 5 character");
define("OLD_PASSWORD_LENGTH","Please old password length atleast 5 character");
define("CONF_PASSWORD_LENGTH","Please confirm password length atleast 5 character");
define("ENTER_CONFPASS","Please enter confirm password");
define("SUC_CHANGE_PROFILE","Profile changed successfully");
define("EMAIL_OLDPASS_NOTMATCH","Email address and old password does not match");
define("SUC_SAVE_SETTINGS","Settings changed successfully");

/*Error messages for change password page */
define("NEWCONFPASS", "Password and Confirm Password does not match.");
define("OLDNOTMATCH", "Current password does not match with old password.");

//Change email validation
define("ENTER_NEW_EMAIL","Please enter new email address");
define("EMAIL_NOTMATCH","Email address does not match");
define("EMAIL_PASS_NOMATCH","Email address and password does not match");
define("EMAIL_SUC_CHANGE","Email address change successfully");

/* Common messages */
define("SUCCHANGE","succhange");
define("SUCADD","sucadd");
define("SUCUPDATE","sucup");
define("SUCACTIVE","sucactive");
define("SUCINACTIVE","sucinactive");
define("SUCDELETE","sucdel");
define("NOTDELETE","notdel");

define("ACTIVE","Active");
define("INACTIVE","Inactive");
define("EXISTS","exists");
define("ACTIVATE","Activate");
define("DEACTIVATE","Deactivate");

define("REQUIREFIELD","Mandatory fields are required");

//Common Message
define('RECORDADD',"Record added successfully.");
define('RECORDUPDATE',"Record updated successfully.");
define('RECORDDELETE',"Record deleted successfully.");
define('RECORDACTIVE',"Record activated successfully.");
define('RECORBLOCKED',"Record blocked successfully.");
define('RECORDINACTIVE',"Record inactivated successfully.");
define('RECORDDEACTIVE',"Record deactivated successfully.");
define('RECORDPROPERTY',"Property type changed successfully.");
define("RECOPENDING","Record pending successfully");
define("RECOINPROCESS","Record inprocess successfully");
define('RECORDAPPROVE',"Record approved successfully.");
define('RECORDUNAPPROVE',"Record unapproved successfully.");
define("RECORD_NOTFOUND","Record not found.");

// User page Messge
define('USERINFOUPDATE',"User information updated successfully.");
define("ENTER_FNAME","Please enter first name");
define("ENTER_LNAME","Please enter last name");
define("ENTER_PHONE","Please enter phone");
define("ENTER_ADDRESS","Please enter address");
define("ENTER_MOBILE","Please enter mobile number");
define("USER_TYPE","Please select user type");
define("ENTER_DESC","Please enter description");
define("ENTER_MESSAGE","Please enter message");
define("ENTER_CITY","Please enter city");

define("FNAME_HAS_NUM","Please enter only character in first name");
define("LNAME_HAS_NUM","Please enter only character in last name");
define("NAME_HAS_NUM","Please enter only character in name");
define("ENTER_NUMERIC_COMPANY_NAME","Please enter only character in company name");
define("MOBILE_LENGTH","Please enter 10 digit in mobile number");
define("PHONE_LENGTH","Please enter minimun 10 digit in contact number");
define("ENTER_NUMERIC_PHONE","Please enter numeric contact number");
define("ENTER_NUMERIC_MOBILE","Please enter numeric mobile number");
define("ENTER_NUMERIC_CITY","Please enter only character in city");

//User image message
define('SELECT_IMAGE','Please select image');
define("IMAGECORRUPT", "Image is corrupted. please upload again.");
define("INVALIDSIZEIMAGE", "Image size should be up to 1MB.");
define("INVALIDSIZEIMAGE_2MB", "Image size should be up to 1MB.");
define("VALIDIMAGETYPE", "Please upload jpg, jpeg file only.");
define("VALID_IMAGETYPE", "Please upload jpg, jpeg, png file only.");

//define("VALIDIMAGETYPE1", "Please upload jpg, jpeg, gif and png file only.");
define("SUGGEST_JPG","(Upload jpg, jpeg file only)");
define("SUGGEST_ALLIMAGE","(Upload jpg, jpeg, gif and png file)");

// Image Notes module
define("BANNER_IMAGE_NOTES","Image size should be 1366x319.");
define("USERADD","User added successfully.");
define("USERUPDATE","User updated successfully.");
define("USERDELETE","User deleted successfully.");

//Cmspage message
define("ENTER_NAME","Please enter name");
define("DUPLICATE_NAME","Name already exists");

//Product page message
define("ENTER_PCODE","Please enter product code");
define("ENTER_WEIGHT","Please enter weight");
define("SELECT_CATEGORY","Please select category");
define("SELECT_SUB_CATEGORY","Please select sub category");
define("CODE_EXISTS","Product code already exists");
define("PRODUCT_NOT_DEL","Product can not delete because Images already exists");
define("ARRIVAL_PRODUCT","Product added in to arrival list");
define("ARRIVAL_DELETE_PRODUCT","Product remove from arrival list");
define("CATALOGUE_PRODUCT","Product added in to catalogue list");
define("CATALOGUE_DELETE_PRODUCT","Product remove from catalogue list");
define("TRENDING_PRODUCT","Product added in to trending list");
define("TRENDING_DELETE_PRODUCT","Product remove from trending list");
define("EXCLUSIVE_PRODUCT","Product added in to exclusive list");
define("EXCLUSIVE_DELETE_PRODUCT","Product remove from exclusive list");
define("ENTER_LINK","Please enter page link");

// For Pagignation
define("PREVIOUS","Prev");
define("NEXT","Next");
define("FIRST","First");
define("LAST","Last");

//For format URL
define("FORMATURL","E.g:http://www.abc.com");


//Date format message
define("DATEFORMAT","%d-%m-%Y %h:%i");
define("DISPLAY_DATEFORMAT","d-M-Y H:i");
define("DATE_FORMAT","d-m-Y");

define("IMAGE_SIZE_2","2097152");       //1024*1024*2 = 2097152 For 2MB
define("IMAGE_SIZE_1","1048576");       //1024*1024*1 = 1048576 For 1MB

//Page limit constant
define("ADMINUSER_LIMIT","10");
define("ADMINCMS_LIMIT","10");

define("PASSWORD_LIMIT",'5');
if(!defined("ID_LENGTH")) define("ID_LENGTH",'20');   //For encryption data

//Footer constant
define('FOOTER_LEFT','&copy '.date('Y').' '.SITE_NAME.' All rights reserved');

//cart message
define('QTY_ERROR','Please enter more then zero(0) in Quantity');

//Mail subject
define('REGISTRATION_CLIENT','Thank you for registration with '.SITE_NAME);
define('REGISTRATION_ADMIN','New customer register with '.SITE_NAME);
define('FORGET_PASSWORD_CLIENT','Password Recovery with '.SITE_NAME);
define('PASSWORD_CHANGE_CLIENT','Password change with '.SITE_NAME);

//Product imaege size
define('PRO_HEIGHT','150');
define('PRO_WIDTH','150');
define('PRO_IMAGE_FOLDER','product_images');
define('PRODUCT_EXISTS','Product already exists');

?>
