<?php

class Reservation_model extends CI_Model{

	public function reservation_list(){


		$this->db->select('*')
				->from('reservations')
				->join('account','account.account_id = reservations.account_id')
				->join('rooms','rooms.room_id = reservations.room_id')
				->join('movies','movies.movie_id = reservations.movie_id')
				->order_by('reservations.reservation_status','DESC');

		$results = $this->db->get();

		if($results->num_rows() > 0){
			return $results->result_array();
		}else{
			return false;
		}
	}

	public function personCount($room_id){

		$this->db->where('room_id',$room_id);
		$results = $this->db->get('rooms');

		if($results->num_rows() > 0){

			
			$length = $results->row();
			return $length->person;

		}else{

			return false;
		}
	}

	public function userReservation($account_id){


		$this->db->select('*')
				->from('reservations')
				->join('rooms','rooms.room_id = reservations.room_id')
				->join('movies','movies.movie_id = reservations.movie_id')
				->where('reservations.account_id',$account_id)
				->order_by('reservations.reservation_status','DESC');

		$results = $this->db->get();

		if($results->num_rows() > 0){
			return $results->result_array();
		}else{
			return false;
		}
	}

	public function reserve($data){

		$this->db->insert('reservations',$data);

		if($this->db->affected_rows() > 0){
			return true;
		}else{

			return false;
		}
	}

	public function out($id,$data){

		$this->db->where('reservation_id', $id);
      	$this->db->update('reservations', $data); 

		if($this->db->affected_rows() > 0){
			return true;
		}else{

			return false;
		}

	}

	public function get_length($movie_id){

		$this->db->where('movie_id',$movie_id);

		$results = $this->db->get('movies');

		if($results->num_rows() > 0){

			$length = $results->row();
			return $length->movie_length;

		}else{

			return false;
		}
	}

	public function removeReservation($id){

		$this->db->where('reservation_id', $id);
      	$this->db->delete('reservations'); 

		if($this->db->affected_rows() > 0){
			return true;
		}else{

			return false;
		}
	}


	public function roomStatus($room_id,$data){

		$this->db->where('room_id', $room_id);
      	$this->db->update('rooms', $data); 

		if($this->db->affected_rows() > 0){
			return true;
		}else{

			return false;
		}

	}

	public function checkOut($reservation_id,$data){

		$this->db->where('reservation_id', $reservation_id);
      	$this->db->update('reservations', $data); 

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}

	}

	public function checkRoom($room_id){

		$this->db->where('room_id', $room_id);
		$this->db->where('status',1);	
      	$row = $this->db->get('rooms'); 

		if($row ->num_rows() > 0){
			//$room_no = $row->row();
			//return $room_no->room_no;
			return true;
		}else{

			return false;
		}

	}

	public function checkConflict($date,$time_in,$time_out,$room_id){

		$result = $this->db->query("SELECT* FROM `reservations` WHERE reservation_date = '$date' and (TIME('$time_in') >= TIME(time_in) OR TIME('$time_out') <= TIME(time_out)) and room_id = '$room_id'");

		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}