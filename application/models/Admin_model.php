<?php

class Admin_model extends CI_Model{

    public function check_email($email){

          $this->db->where('email',$email);
          $result = $this->db->get('account');

          if($result->num_rows() > 0){
              return true;
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
    }

    public function profile($account_id){
        $this->db->where('account_id',$account_id);
        $results = $this->db->get('account');

        return $results;
    }

    public function update_account($id,$data){

        $this->db->update('account')
                ->where('account_id',$id);
    }

}

 ?>
