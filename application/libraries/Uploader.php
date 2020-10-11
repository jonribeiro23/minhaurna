<?php defined('BASEPATH') or exit('No direct script access allowed');

class Uploader
{
  protected $CI;
  
  public function __construct()
  {
    require APPPATH.'third_party/cloudinary_php/autoload.php';
    $this->CI = &get_instance();
    \Cloudinary::config(array( 
      "cloud_name" => "webfatecrlsantos", 
      "api_key" => "199535923481885", 
      "api_secret" => "8ZGU5X1mCD3qmX410OrMqjsl1qY", 
      "secure" => true
    ));    
    // $this->CI->load->helper('url');
    // $this->CI->load->library('session');
  }

  public function upload($file)
  {
    return \Cloudinary\Uploader::upload($file['tmp_name'],
      array("resource_type"   => "auto",
            "allowed_formats" => array('pdf'),
      )
    );
  }
}
