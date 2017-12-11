<?php

class Movies_model extends CI_Model{

	public function fetch_movies($search = FALSE, $category = FALSE){

		if($search)
			$this->db->like('movies.movie_title',$search);

		if($category)
			$this->db->like('movies.category_id',$category);

		
		$this->db->select('*');
		$this->db->from('movies');
		$this->db->join('category','category.category_id = movies.category_id');
		$this->db->order_by('movies.timestamp', 'DESC');
		$this->db->limit(15);
		$movies = $this->db->get();

		if($movies->num_rows() > 0){
			return $movies->result_array();
		}else{	
			return false;
		}

	}

	public function fetchAll($search = FALSE){

		if($search)
			$this->db->like('movies.movie_title',$search);

		
		$this->db->select('*');
		$this->db->from('movies');
		$this->db->join('category','category.category_id = movies.category_id');
		$this->db->order_by('movies.timestamp', 'DESC');
		$this->db->limit(15);
		$movies = $this->db->get();

		if($movies->num_rows() > 0){
			return $movies->result_array();
		}else{	
			return false;
		}

	}

	public function insert_movie($data){

		$this->db->insert('movies',$data);
	}


	public function movie($id){
		
        $this->db->where('movie_id',$id);
        $results = $this->db->get('movies');

		if($results->num_rows() > 0){
			return $results->result_array();
		}else{	
			return false;
		}
       
    }

    public function fetch_category(){
		
       
        $results = $this->db->get('category');

		if($results->num_rows() > 0){
			return $results->result_array();
		}else{	
			return false;
		}
       
    }


	public function update_movie($id,$data){
		
		$this->db->where('movie_id', $id);
		$this->db->update('movies', $data); 

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}
		
	public function delete_movie($id){
		
	  $this->db->where('movie_id', $id);
	  $this->db->delete('movies'); 

	  if($this->db->affected_rows() > 0){
	  	return true;
	  }else{
	  	return false;
	  }
 	}
		
}