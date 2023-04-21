<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registeruser extends CI_Controller {

  public function __construct(){

    parent::__construct();
    $this->load->helper('url');

    // Load model
    $this->load->model('User_model');

  }

  public function index(){
    // load view
    $this->load->view('registeruser');

  }

  public function register_user(){

    $curl_data=array(
      'rfid_card_no'=>$this->input->post('rfid_card_no'),
      'first_name'=>$this->input->post('first_name'),
      'last_name'=>$this->input->post('last_name'),
      'contact_no'=>$this->input->post('contact_no'),
    );
    $curl=$this->link->hits('get-home-page-data',$curl_data); 
    //echo "<pre>";print_r($_POST);die();
    $curl1=json_decode($curl,true);
  
  }


}