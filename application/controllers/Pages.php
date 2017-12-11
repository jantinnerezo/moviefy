<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller{

	 public function __construct ()
      {

          parent::__construct();

         $this->load->model('image_model');
         $this->load->model('movies_model');
         $this->load->model('rooms_model');


      }

	  public function view($page = 'home'){

		// if($this->session->userdata('logged_in')){
			if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);
			$data['slideshows'] = $this->image_model->fetch_slideshows();
			$data['movies'] = $this->movies_model->fetch_movies();
			$data['rooms'] = $this->rooms_model->fetch_available();

			$this->load->view('includes/header');
			$this->load->view('pages/'.$page, $data);
			$this->load->view('includes/footer');

		//}else{
			//redirect('/');
		//}
	}
}

