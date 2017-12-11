<?php

class Rooms_model extends CI_Model{

	public function fetch_rooms(){

		$results = $this->db->get('rooms');

		if($results->num_rows() > 0){
			return $results->result_array();
		}else{
			return false;
		}
	}

	public function fetch_available(){


		$this->db->where('status !=', 1);
		$results = $this->db->get('rooms');

		if($results->num_rows() > 0){
			return $results->result_array();
		}else{
			return false;
		}
	}

	public function insert_room($data){

		$this->db->insert('rooms',$data);
	}

	 public function update_room($id,$data){

      $this->db->where('room_id', $id);
      $this->db->update('rooms', $data); 

    }

    public function delete_room($id){
		
	  $this->db->where('room_id', $id);
	  $this->db->delete('rooms'); 

	  if($this->db->affected_rows() > 0){
	  	return true;
	  }else{
	  	return false;
	  }
 	}

 	public function room_type($id){

 		$this->db->where('room_id',$id);

		$results = $this->db->get('rooms');

		if($results->num_rows() > 0){

			$room_type = $results->row();
			return $room_type->room_type;

		}else{

			return false;
		}
	}




}