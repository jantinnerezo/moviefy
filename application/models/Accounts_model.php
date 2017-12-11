<?php

class Accounts_model extends CI_Model{
	
    public function check_email($email){

          $this->db->where('email',$email);
          $result = $this->db->get('account');

          if($result->num_rows() > 0){
              return true;
          }else{

             return false;
          }

    }
    public function logged_in($email, $password){

          $this->db->where('email',$email);
          $this->db->where('password',$password);
          $result = $this->db->get('account');

          if($result->num_rows() > 0){
              return $result->result_array();
          }else{

              return false;
          }
    }

    public function show_accounts($type = null,$sort = null, $search = null, $limit = null, $offset = null){

      if(!IS_NULL($type) && $type != 0)
        $this->db->where('account_type',$type);

      if(!IS_NULL($sort))
        if($sort == 'newest')
          $this->db->order_by('timestamp','DESC');
        if($sort == 'oldest')
          $this->db->order_by('timestamp','ASC');
        if($sort == 'verified')
          $this->db->where('verified',1);
        if($sort == 'not')
          $this->db->where('verified',0);

      if(!IS_NULL($search))
        $this->db->like('lastname',$search);
        $this->db->or_like('firstname',$search);
        $this->db->or_like('email',$search);
        $this->db->or_like('phone',$search);

      if(!IS_NULL($limit))
        $this->db->limit($limit,$offset);

       $result = $this->db->get('account');
       if($result->num_rows() > 0){
           return  $result->result_array();
       }else{

          return false;
       }
    }


    public function insert_account($data){

        $this->db->insert('account',$data);

        if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
    }

    public function profile($account_id){
        $this->db->where('account_id',$account_id);
        $results = $this->db->get('account');

        if($results->num_rows() > 0){
          return  $results->result_array();
        }else{

         return false;
        }
       
    }

    public function update_account($id,$data){

      $this->db->where('account_id', $id);
      $this->db->update('account', $data); 

    }

     public function verify($id,$data){

      $this->db->where('account_id', $id);
      $this->db->update('account', $data); 
      
        if($this->db->affected_rows() > 0){
          return true;
        }else{
          return false;
        }
    }

    public function delete_account($id){

      $this->db->where('account_id', $id);
      $this->db->delete('account'); 
    }



     /*public function sendEmail($email, $name){

        $from = "qlouelven@gmail.com";    //senders email address
        $subject = 'Moviefy Home Theatre - Email verification';  //email subject
        
        //sending confirmEmail($receiver) function calling link to the user, inside message body
        $message = 'Hi '.$email.',<br><br> Please click on the below activation link to verify your email address<br><br>
        <a href=\'http://www.localhost/moviefy/accounts/confirm/'.md5($email).'\'>http://www.localhost/moviefy/accounts/confirm/'. md5($email) .'</a><br><br>Thanks';
        
        $this->load->library('email');
        //config email settings
        $config['protocol'] = 'smtp';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = $from;
        $config['smtp_pass'] = 'Wengta12345';  //sender's password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = 'TRUE';
        $config['newline'] = "\r\n"; 
        
       
        $this->email->initialize($config);
        //send email
        $this->email->from($from,'Moviefy Admin');
        $this->email->to($email);
        $this->email->subject($subject);
        $this->email->message($message);
        
        if($this->email->send()){
     
            return true;
        }else{
           
           echo $this->email->print_debugger();
        }
        
       
    }

    public function send_email($email, $name){

         $to      = $email; // Send email to our user
         $subject = 'Moviefy Home Theatre - Email verification';  //email subject

           $message = 'Hi '.$email.',<br><br> Please click on the below activation link to verify your email address<br><br>
        <a href=\'http://www.localhost/moviefy/accounts/confirm/'.md5($email).'\'>http://www.localhost/moviefy/accounts/confirm/'. md5($email) .'</a><br><br>Thanks'; *
        $message = 'Hi!';

        $headers = 'From:qouelven@moviefy.com'; // Set from headers

        mail($to, $subject, $message, $headers);
        
        return true;

    } */

    public function verifyEmail($email){
      $data = array('verified' => 1);
        $this->db->where('email',$email);
        return $this->db->update('account', $data);    
    }
  
}