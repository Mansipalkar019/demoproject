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
    $card_type = $this->input->post('card_type');
  
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
              'card_type'=>$card_type,
            );
            $curl=$this->link->hits('register-user',$curl_data); 
            // print_r($curl);die;
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
  
 public function view_history(){
    $this->load->view('viewhistory');
  }

//   public function get_user_history()
//   {
//     $rfid_card_no = $this->input->post('rfid_card_no');
   
//       $curl_data=array(
//         'rfid_card_no'=>$rfid_card_no,
//       ); 
//       //print_r($curl_data);die();
//       $curl=$this->link->hits('get-user-hist',$curl_data); 
//       print_r($curl);die();
      
//       $curl=json_decode($curl,true);
//       $data['product_data'] = $curl['data'];
//       if($curl['status']=='1'){
//           $response['message']='Register successfully';
//           $response['status'] = "success";
//       }else {
//           if($curl['error_status'] == 'rfid') {
//                   $error = 'rfid_card_no';
//               } else {
//                   $error = 'contact_no';
//               }
//             $response['status'] = 'failure';
//             $response['error'] = array($error => $curl['message']);
//       }
        
//       echo json_encode($response);
//   }

 public function get_user_history()
  {
    $rfid_card_no = $this->input->post('rfid_card_no');
      $curl_data=array(
        'rfid_card_no'=>$rfid_card_no,
      ); 
      $curl=$this->link->hits('get-user-hist',$curl_data); 
      $curl=json_decode($curl,true);
       
      $data['user_info'] = $curl['data'];
      $count_all=count($data['user_info']);
      $count_filtered=count($data['user_info']);
      $data_array=array();
    foreach($data['user_info'] as $category_details_key => $data_row)
    {
      $nestedData=array();
      if ($data_row['used_status'] == 1) {
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['first_name'].' '.$data_row['last_name'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['device_id'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['card_type'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['wallet_amount'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['total_amount'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['validity_from_date'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['validity_to_date'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['created_at'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['rfid_card_no'].'</a>';
        $nestedData[] = '<a style="color:red;font-weight: 800;">'.$data_row['rfid_card_num'].'</a>';
      }else{
        $nestedData[] = $data_row['first_name'].' '.$data_row['last_name'];
        $nestedData[] = $data_row['device_id'];
        $nestedData[] = $data_row['card_type'];
        $nestedData[] = $data_row['wallet_amount'];
        $nestedData[] = $data_row['total_amount'];
        $nestedData[] = $data_row['validity_from_date'];
        $nestedData[] = $data_row['validity_to_date'];
        $nestedData[] = $data_row['created_at'];
        $nestedData[] = $data_row['rfid_card_no'];
        $nestedData[] = $data_row['rfid_card_num'];
      }
      
                
      $data_array[] = $nestedData;  

    }   
      $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => intval($count_all),
            "recordsFiltered" => intval($count_filtered),
            "data" => $data_array,
        );
        
        // Output to JSON format
        echo json_encode($output);   
      // if($curl['status']=='1'){
      //     $response['message']='Register successfully';
      //     $response['status'] = "success";
      // }else {
      //     if($curl['error_status'] == 'rfid') {
      //             $error = 'rfid_card_no';
      //         } else {
      //             $error = 'contact_no';
      //         }
      //       $response['status'] = 'failure';
      //       $response['error'] = array($error => $curl['message']);
      // }
        
      //echo json_encode($response);
  }
}