<?php

class Image_model extends CI_Model{
	

	public function fetch_slideshows(){

		$shows = $this->db->get('slideshows');

		if($shows->num_rows() > 0){
			return $shows->result_array();
		}else{	
			return false;
		}
	}

	public function insert_img($data){

		$this->db->insert('slideshows',$data);
	}

	public function delete_img($id){
		
	  $this->db->where('slide_id', $id);
	  $this->db->delete('slideshows'); 

	  if($this->db->affected_rows() > 0){
	  	return true;
	  }else{
	  	return false;
	  }
 	}
}