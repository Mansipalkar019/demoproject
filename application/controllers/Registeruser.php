<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registeruser extends CI_Controller {

  public function __construct(){

    parent::__construct();
  }

  public function index(){
    // $data =  token_get();
    // echo '<pre>'; print_r($data); exit;
    $this->load->view('registeruser');
  }

  public function register_user(){
    $rfid_card_no = $this->input->post('rfid_card_no');
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $contact_no = $this->input->post('contact_no');
    $wallet_amount = $this->input->post('wallet_amount');
    $this->form_validation->set_rules('rfid_card_no', 'RFID card no', 'trim|required',array('required' => 'You must provide a %s',));  
    $this->form_validation->set_rules('first_name', 'First Name', 'trim|required',array('required' => 'You must provide a %s',));  
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required',array('required' => 'You must provide a %s',)); 
    $this->form_validation->set_rules('contact_no', 'Contact No', 'trim|required',
      array('required' => 'You must provide a %s',)); 
    $this->form_validation->set_rules('wallet_amount', 'Amount', 'trim|required',array('required' => 'You must provide a %s',));  
    if ($this->form_validation->run() == FALSE) {
            $response['status'] = 'failure';
            $response['error'] = array(
              'rfid_card_no' => strip_tags(form_error('rfid_card_no')), 
              'first_name' => strip_tags(form_error('first_name')),
              'last_name' => strip_tags(form_error('last_name')),
              'contact_no' => strip_tags(form_error('contact_no')),
              'wallet_amount' => strip_tags(form_error('wallet_amount')),
            );
        } else{
            $curl_data=array(
              'rfid_card_no'=>$rfid_card_no,
              'first_name'=>$first_name,
              'last_name'=>$last_name,
              'contact_no'=>$contact_no,
              'wallet_amount'=>$wallet_amount,
            );
            $curl=$this->link->hits('register-user',$curl_data); 
            $curl=json_decode($curl,true);
            if($curl['status']=='1'){
                $response['message']='Register successfully';
                $response['status'] = "success";
            }else {
                if($curl['error_status'] == 'rfid') {
                        $error = 'rfid_card_no';
                    } else {
                        $error = 'contact_no';
                    }
                  $response['status'] = 'failure';
                 $response['error'] = array($error => $curl['message']);
            }
        }
        echo json_encode($response);
  }


}